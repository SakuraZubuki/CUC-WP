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