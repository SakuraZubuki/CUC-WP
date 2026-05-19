---
title: "[SWPUCTF 2021 新生赛] re1"
date: 2026-05-18
category: REVERSE
tags:
  - Windows PE
  - 静态分析
  - 字符串替换
NSSCTF: https://www.nssctf.cn/problem/444
---

# [SWPUCTF 2021 新生赛] re1

## 题目信息

- **附件**: `re1.exe`
- **类型**: Windows x64 PE 逆向
- **核心考点**: 静态分析提取硬编码字符串、逆向字符替换逻辑

## 静态分析

使用 `file` + `radare2` 分析：

```bash
$ file re1.exe
re1.exe: PE32+ executable for MS Windows 5.02 (console), x86-64

$ r2 -A -q -c 's sym.main; pdf' re1.exe
```

### main 函数关键逻辑

1. **硬编码目标字符串**（小端序存储）：
   ```asm
   movabs rdx, 0x33725f797334337b   ; "{34sy_r3"
   mov dword [rax+8], 0x73723376    ; "v3rs"
   mov word  [rax+0xc], 0x7d33      ; "3}"
   ```
   拼接后目标字符串 `s2 = "{34sy_r3v3rs3}"`。

2. **读取用户输入** `s1`。

3. **第一轮遍历**：将所有字符 `'e'` (0x65) 替换为 `'3'` (0x33)。

4. **第二轮遍历**：将所有字符 `'a'` (0x61) 替换为 `'4'` (0x34)。

5. **`strcmp(s1, s2)`**，相等则输出 `"you are right!"`。

## 逆向推导

程序对输入做正向变换：
- `e → 3`
- `a → 4`

目标字符串为 `{34sy_r3v3rs3}`，逆向还原：
- 所有 `4` 还原为 `a`
- 所有 `3` 还原为 `e`

```python
target = "{34sy_r3v3rs3}"
flag = target.replace('4', 'a').replace('3', 'e')
print(flag)  # {easy_reverse}
```

验证：
- `{easy_reverse}` → `e→3` → `{3asy_r3v3rs3}` → `a→4` → `{34sy_r3v3rs3}` ✅

## Flag

```
{easy_reverse}
```

## 总结

- 入门级 RE，无混淆/无壳，直接 `radare2`/`IDA` 分析 main 即可
- 关键是识别出**比较方向**：`transform(input) == target`，需要逆向变换
- 硬编码字符串在 x86-64 中以 8/4/2 字节小端序分段存储，拼接时注意字节序
