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
box = 'QWERTYUIOPASDFGHJKLZXCVBNM_'
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
print(retli)
