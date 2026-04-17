#qwe密码解密，输入字符串，返回解密的明文
def encrypt_qwe(s):
    DIC_QWE = "qwertyuiopasdfghjklzxcvbnm"
    DIC_ABC = "abcdefghijklmnopqrstuvwxyz"
    result=""
    for i in s:
        for j in range(len(DIC_ABC)):
            if i==DIC_QWE[j]:
                result=result+DIC_ABC[j]
    return result

s="bolkqltqelxxbmnabktctklt"
s=s.lower()#统一转化为小写
s=s.strip().replace(" ","")#去掉空格

print(encrypt_qwe(s))
