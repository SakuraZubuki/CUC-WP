flag = 'xxxxxxxxxxxxxxxxxx'
list = [47, 138, 127, 57, 117, 188, 51, 143, 17, 84, 42, 135, 76, 105, 28, 169, 25]
result = ''
for i in range(len(list)):
    key = (list[i]>>4)+((list[i] & 0xf)<<4)
    result += str(hex(ord(flag[i])^key))[2:].zfill(2)
print(result)
# result=bcfba4d0038d48bd4b00f82796d393dfec