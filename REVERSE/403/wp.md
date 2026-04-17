## [SWPUCTF 2021 新生赛]简简单单的逻辑
- 1. 变量定义与数据准备
```python
flag = 'xxxxxxxxxxxxxxxxxx'                      # 原始 flag（18个字符）
list = [47, 138, 127, 57, 117, 188, 51, 143, 17, 84, 42, 135, 76, 105, 28, 169, 25]
result = ''
```
flag 是待加密的字符串，长度为 18（与 list 长度一致，因为代码中 range(len(list)) 将迭代 18 次，ord(flag[i]) 要求 flag 长度至少为 18）。

list 是一组整数，每个整数用于生成一个 8 位的 key。

result 初始为空，最终存储加密后的十六进制字符串。

- 2. 加密循环逐字符处理
```python
for i in range(len(list)):
    key = (list[i] >> 4) + ((list[i] & 0xf) << 4)
    result += str(hex(ord(flag[i]) ^ key))[2:].zfill(2)
```
第一步：生成 key
```python
key = (list[i] >> 4) + ((list[i] & 0xf) << 4)
list[i] >> 4：将整数右移 4 位，取出原数值的高 4 位（例如 47 = 0b00101111，右移 4 位得 0b00000010 = 2）。

list[i] & 0xf：用掩码 0xf（二进制 1111）提取原数值的低 4 位（例如 47 & 0xf = 0b1111 = 15）。

((list[i] & 0xf) << 4)：将提取出的低 4 位左移 4 位，变成高 4 位（15 << 4 = 240 = 0b11110000）。
```
最后相加：实现了高 4 位与低 4 位的交换。
例如 47 二进制 0010 1111，交换后变为 1111 0010 = 242。

本质上 key 是对 list[i] 的一个半字节交换（nibble swap）。

第二步：异或并转十六进制
```python
result += str(hex(ord(flag[i]) ^ key))[2:].zfill(2)
ord(flag[i])：取 flag 第 i 个字符的 ASCII 码（8 位整数）。

ord(flag[i]) ^ key：将 ASCII 码与 key 按位异或（异或运算可逆）。

hex(...)：将异或结果转换为十六进制字符串，格式为 '0x??'。
```
[2:]：去掉前缀 '0x'，只保留两位十六进制数字部分。

.zfill(2)：确保结果始终为两位（若结果小于 0x10，hex 会输出单字符，例如 '0xa' 去掉前缀后为 'a'，此时补零为 '0a'）。

最后将生成的两位十六进制字符串追加到 result 中。

3. 输出最终密文
```python
print(result)
# result = 'bcfba4d0038d48bd4b00f82796d393dfec'
```
所有字符处理完毕后，result 即为 36 个字符的十六进制串（每个原始字符对应两位十六进制）。

- 复原代码
```python
# 已知数据
list_data = [47, 138, 127, 57, 117, 188, 51, 143, 17, 84, 42, 135, 76, 105, 28, 169, 25]
result = 'bcfba4d0038d48bd4b00f82796d393dfec'

flag = ''
for i in range(len(list_data)):
    # 计算与加密时完全相同的 key
    key = (list_data[i] >> 4) + ((list_data[i] & 0xf) << 4)
    
    # 取两位十六进制字符串，转换为整数（即加密时的异或结果）
    enc_byte = int(result[2*i:2*i+2], 16)
    
    # 异或解密，还原原始字符
    flag += chr(enc_byte ^ key)

print(flag)
```