cipher = "YLOPJOGJVOCCYNMZYPGXGPOGJDVIG"  # 去掉 ATBASH 提示部分

# Atbash 解密
def atbash_decrypt(text):
    result = ''
    for char in text:
        if char.isalpha():
            if char.isupper():
                result += chr(155 - ord(char))  # 'A'(65) + 'Z'(90) = 155
            else:
                result += chr(219 - ord(char))  # 'a'(97) + 'z'(122) = 219
        else:
            result += char
    return result

plain = atbash_decrypt(cipher)
print(plain)
# 输出：BOLKQLTQELXXBMNABKTCTKLTQWERT