#run under python3

import random
from secret import flag,name,phone,mail,address,school,seed
from gmpy2 import *
from Crypto.Util.number import *
from Crypto.Cipher import AES
from hashlib import sha256
random.seed(seed)
def encrypt1(m):
    a =  random.getrandbits(96)
    b =  random.getrandbits(96)
    p = next_prime(a)
    q = next_prime(b)
    n = p*q
    e = 65537
    assert(m<n)
    print (pow(m,e,n))
    print (n)


def encrypt2(m):
    p = 11616788973244169211540879051135531683500013311175857700532973853592727185033846064980717918194540453710515251945345524986932165003196804187526561468278997
    q = random.randrange(11616788973244169211540879051135531683500013311175857700532973853592727185033846064980717918194540453710515251945345524986932165003196804187526561468278997,11616788973244169211540879051135531683500013311175857700532973853592727185033846064980717918194540453710515251945345524986932165003196804187526563615762644)
    nq = next_prime(q)
    n = p*q
    e = 65537
    
    assert(m<n)
    print (pow(m,e,n))
    print (n)


def encrypt3(msg):
    q = getPrime(33)
    key = [[] for i in range(34)]
    for  i in range(len(key)):
        for j in range(len(msg)):
            tmp = random.getrandbits(32)
            assert(tmp<q)
            key[i].append(tmp)
    cipher = []
    for l in key:
        tmp = 0
        for x,y in zip(l,msg):
            tmp = (tmp+x*y)%q
        cipher.append(tmp)
    print (q)
    print (key)
    print (cipher)

def encrypt4(msg):
    key = long_to_bytes(random.getrandbits(128))
    a = AES.new(key,AES.MODE_ECB)
    cipher = a.encrypt(msg)
    print (bytes_to_long(cipher))

def encrypt5(msg):
    q = getPrime(512)
    g = random.randrange(q-1)
    x = random.randrange(q-1)
    h = pow(g,x,q)
    y = random.randrange(q-1)
    s = pow(h,y,q)
    c1 = pow(g,y,q)
    c2 = (msg*s)%q
    print (q,g,h)
    print (c1,c2)

msg1 = bytes_to_long(name)

encrypt1(msg1)

msg2 = bytes_to_long(phone+long_to_bytes(random.getrandbits(160)))

encrypt2(msg2)

msg3 = [x for x in mail]

encrypt3(msg3)

#Note the address incude digits,letters, '.' and '_'
msg4 = address
encrypt4(msg4)

msg5 = bytes_to_long(school)
encrypt5(msg5)


flag = 'flag{'+sha256(name).hexdigest()[:8]+'-'+sha256(phone).hexdigest()[:4]+'-'+sha256(mail).hexdigest()[:4]+'-'+sha256(address).hexdigest()[:4]+'-'+sha256(school).hexdigest()[:12]+'}'
#print (flag)
