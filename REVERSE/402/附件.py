flag = 'xxxxxxxxxxxxxxxxxx'
flag = flag[::-1]
result = 0
for i in range(0,len(flag)-1):
    s1 = ord(flag[i])
    s2 = ord(flag[i+1])
    if i == 0:
        result = (s1<<8)^(s2<<4)^s2
    else:
        result = (result<<4)^((s1<<8)^(s2<<4)^s2)
print(result)
# result = 591620785604527668617886