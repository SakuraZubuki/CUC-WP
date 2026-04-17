from string import *
# 出题人给出的爆破脚本
def get_flag(l):
    retlist = [1 for i in range(len(l))]
    for i in range(len(l)):
        if isinstance(l[i],list):
            tmplist = get_flag(l[i])
            retlist[i] = tmplist
        else:
            for n in range(len(l)):
                tmplist = []
                h4 = ord(l[n][-1])>>4
                l4 = int(s[-4*(len(l[n])+1):-4*len(l[n])],2)^h4
                for m in li:
                    maybe = (int(m,2)<<4)+l4
                    if chr(maybe) in box:
                        tmplist.append(l[n]+chr(maybe))
                retlist[n] = tmplist
            return retlist
    return retlist

result = 591620785604527668617886
ret = str(bin(result))[2:].zfill(80)
s = ret[8:52]
li = ['0000','0001','0010','0011','0100','0101','0110','0111']
box = ascii_uppercase+'_'
h12 = str(bin(ord('{')))[2:5].zfill(4)
r = int(s[-4:],2)^int(h12,2)
maybel = []
for n in li:
    maybe = (int(n,2)<<4)+r
    if chr(maybe) in box:
        maybel.append(chr(maybe))
retli = maybel
for i in range(9):
    retli = get_flag(retli)
# 至此会生成一个正确爆破的多维数组

# 以为正确答案只有一个，写了一个读取多维数组并检查的脚本，最后发现爆破出来的字符串全能过check
a = []
def read_array(ary):
    for i in range(len(ary)):
        if type(ary[i]) == type(a):
            read_array(ary[i])
        else:
            check_flag('NSSCTF{' + ary[i] + '}')


def check_flag(flag):
    flag = flag[::-1]
    res = 0
    for i in range(0, len(flag) - 1):
        s1 = ord(flag[i])
        s2 = ord(flag[i + 1])
        if i == 0:
            res = (s1 << 8) ^ (s2 << 4) ^ s2
        else:
            res = (res << 4) ^ ((s1 << 8) ^ (s2 << 4) ^ s2)
    if res == result:
        print(flag[::-1])


read_array(retli)