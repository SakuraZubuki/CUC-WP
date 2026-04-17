import base64
import urllib.parse

# 密钥
key = "HereIsFlagggg"

# 给定的加密输出（URL编码的密文）
enc = "%C2%A6n%C2%87Y%1Ag%3F%C2%A01.%C2%9C%C3%B7%C3%8A%02%C3%80%C2%92W%C3%8C%C3%BA"

# 步骤1: URL解码得到密文cipher
cipher = urllib.parse.unquote(enc)

# 步骤2: 初始化S-box (KSA)
s_box = list(range(256))
j = 0
for i in range(256):
    j = (j + s_box[i] + ord(key[i % len(key)])) % 256
    s_box[i], s_box[j] = s_box[j], s_box[i]

# 步骤3: 生成密钥流并解密 (PRGA，与加密相同，因为异或是可逆的)
res = []
i = j = 0
for s in cipher:
    i = (i + 1) % 256
    j = (j + s_box[i]) % 256
    s_box[i], s_box[j] = s_box[j], s_box[i]
    t = (s_box[i] + s_box[j]) % 256
    k = s_box[t]
    res.append(chr(ord(s) ^ k))

# 解密后的明文
flag = "".join(res)
print("解密后的flag:", flag)