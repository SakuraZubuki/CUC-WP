flag = 'xxxxxxxxxxxxxxxxxxxxx'
s = 'wesyvbniazxchjko1973652048@$+-&*<>'
result = ''
for i in range(len(flag)):
    s1 = ord(flag[i])//17
    s2 = ord(flag[i])%17
    result += s[(s1+i)%34]+s[-(s2+i+1)%34]
print(result)
# result = 'v0b9n1nkajz@j0c4jjo3oi1h1i937b395i5y5e0e$i'