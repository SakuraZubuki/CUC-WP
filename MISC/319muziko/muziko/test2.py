import struct

def extract_private_bits(mp3_path):
    with open(mp3_path, 'rb') as f:
        data = f.read()
    
    bits = []
    off = 0
    # MPEG-1 Layer III 比特率表 (kbps)
    brs = [0,32,40,48,56,64,80,96,112,128,160,192,224,256,320,0]
    srs = [44100, 48000, 32000, 0]
    
    while off < len(data) - 4:
        if data[off] == 0xFF and (data[off+1] & 0xE0) == 0xE0:
            header = struct.unpack('>I', data[off:off+4])[0]
            br_idx = (header >> 12) & 0xF
            sr_idx = (header >> 10) & 0x3
            pad = (header >> 9) & 1
            private = (header >> 8) & 1  # Private Bit
            
            br = brs[br_idx] * 1000 if br_idx < 16 else 0
            sr = srs[sr_idx] if sr_idx < 4 else 0
            
            if sr and br:
                fs = int(144 * br / sr + pad)
                if 0 < fs < 2000:
                    bits.append(str(private))
                    off += fs
                    continue
        off += 1
        
    bit_str = ''.join(bits)
    print(f"Total Private Bits: {len(bit_str)}")
    
    # Convert to bytes
    result_bytes = bytearray()
    for i in range(0, len(bit_str) - 7, 8):
        byte_val = int(bit_str[i:i+8], 2)
        result_bytes.append(byte_val)
        
    try:
        text = result_bytes.decode('ascii', errors='ignore')
        print(f"Decoded Text: {text}")
        if 'flag{' in text.lower():
            print(f"[!] FLAG FOUND: {text}")
    except:
        pass
        
    # Also check padding bits if needed
    # Similar logic for padding bit: (header >> 9) & 1

if __name__ == "__main__":
    # Replace with your actual file path
    extract_private_bits(r"D:\Workstation\CTF\WP\MISC\319muziko\muziko\output.mp3")
