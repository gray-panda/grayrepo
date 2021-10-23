''' 
Decryption routine (key, data)

For each 8 bytes (c is the index, starting with 0):
x = key[c] ^ data[c]
x = x rol c
x = x - c

1 of the file is a PNG file.
A PNG always starts with these 8 bytes
    137 80 78 71 13 10 26 10
    
Therefore, we can recover the first 8 bytes of the key
'''

def byte_ror(n, d):
    return (n >> d)|(n << (8 - d)) & 0xFF

png_hdr = [137, 80, 78, 71, 13, 10, 26, 10]
enc_png = [0xC7, 0xC7, 0x25, 0x1D, 0x63, 0x0D, 0xF3, 0x56]

key = ""
for c in range(8):
    tmp = png_hdr[c] + c
    tmp = byte_ror(tmp, c)
    tmp = tmp ^ enc_png[c]
    key += chr(tmp)
    
print(key)
