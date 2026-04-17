#!/usr/bin/env python3
import re

filepath = r"D:\Workstation\CTF\WP\MISC\319muziko\muziko\output.mp3"

with open(filepath, 'rb') as f:
    data = f.read()

# 查找所有帧头
frame_positions = []
for i in range(len(data) - 4):
    if data[i] == 0xFF and (data[i+1] & 0xE0) == 0xE0:
        frame_positions.append(i)

print(f"找到 {len(frame_positions)} 个帧头")

# 提取第3字节（偏移+2）
raw_bytes = [data[pos + 2] for pos in frame_positions]

# 尝试: 直接拼接字节，看是否有flag
raw_data = bytes(raw_bytes)
print(f"原始字节前50: {raw_data[:50]}")
print(f"ASCII: {''.join([chr(b) if 32 <= b <= 126 else '.' for b in raw_bytes[:50]])}")

# 尝试: 每字节的最低位，但8位一组反转
bits = ''.join([format(b & 0x01, '01') for b in raw_bytes])

# 反转每8位（LSB -> MSB）
reversed_bits = ''
for i in range(0, len(bits)-7, 8):
    byte_bits = bits[i:i+8]
    reversed_bits += byte_bits[::-1]  # 反转

# 解码
hex_str = ''
for i in range(0, len(reversed_bits)-7, 8):
    hex_str += format(int(reversed_bits[i:i+8], 2), '02x')

decoded = bytes.fromhex(hex_str)
print(f"\n反转比特后解码: {decoded[:100]}")

# 查找flag
if b'flag' in decoded.lower():
    idx = decoded.lower().find(b'flag')
    print(f"\n[+] FLAG: {decoded[idx:idx+50]}")