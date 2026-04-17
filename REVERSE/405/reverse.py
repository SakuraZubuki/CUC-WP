s = 'wesyvbniazxchjko1973652048@$+-&*<>'  # 字符集，长度34

# 给定的编码结果（每两个字符对应一个明文字符）
result = 'v0b9n1nkajz@j0c4jjo3oi1h1i937b395i5y5e0e$i'

# 初始化明文
flag = ''

# 每两个字符一组处理
for i in range(0, len(result), 2):
    c1 = result[i]
    c2 = result[i+1]
    
    # 逆向计算s1: (s1 + i//2) % 34 = s.index(c1)
    idx1 = s.index(c1)
    s1 = (idx1 - (i//2)) % 34
    
    # 逆向计算s2: -(s2 + i//2 + 1) % 34 = s.index(c2)
    idx2 = s.index(c2)
    # idx2 = 34 - ((s2 + i//2 + 1) % 34)  if idx2 != 0 else 0
    if idx2 == 0:
        temp = 0
    else:
        temp = 34 - idx2
    s2 = (temp - (i//2) - 1) % 17
    
    # 恢复ASCII码
    ascii_val = s1 * 17 + s2
    flag += chr(ascii_val)

print("解密后的flag:", flag)