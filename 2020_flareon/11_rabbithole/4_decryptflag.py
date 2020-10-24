import struct
import serpent

# Rotate left: 0b1001 --> 0b0011
rol = lambda val, r_bits, max_bits: \
    (val << r_bits%max_bits) & (2**max_bits-1) | \
    ((val & (2**max_bits-1)) >> (max_bits-(r_bits%max_bits)))
 
# Rotate right: 0b1001 --> 0b1100
ror = lambda val, r_bits, max_bits: \
    ((val & (2**max_bits-1)) >> r_bits%max_bits) | \
    (val << (max_bits-(r_bits%max_bits)) & (2**max_bits-1))
 
max_bits = 32  # For fun, try 2, 17 or other arbitrary (positive!) values

def XorDecryptBuffer(enc, key):
    count = 0
    prev = 0
    out = b""
    for i in range(0, len(enc), 4):
        cur = struct.unpack("<I", enc[i:i+4])[0]
        tmp = cur ^ prev ^ key
        tmp = rol(tmp, count << 2, max_bits)
        count ^= 1
        prev = cur
        out += struct.pack("<I", tmp)
        
    return out
        
def sanitycheck_xordecryptbuffer():
    with open("sanity1.encrypted", "rb") as f:
        enc = f.read()
    key = 0xE7019EF0
    dec = XorDecryptBuffer(enc, key)
    with open("sanity.checked", "wb") as f:
        f.write(dec)
    
def sanitycheck_serpent():
    with open("publickey.encrypted", "rb") as f:
        enc = f.read()
    key = b"90982d21090ef347"
    dec = serpent.serpent_cbc_decrypt(key, enc).hex()
    assert "c3da263df172293373b0431ee00bac4c3db723bee2d9ccc0a7ef8d0368c33c577df7e64f09503437e9178533c9f3b4d4eebd7fe1075e2e553939d43c25eb8a89a5fd7ad5f8a52c20713ae878cf2b1f322acfe8b7c55dad60b352061419fa713c903d9efc36baf95185880d03ec165a51186cf1c323bc58c40b85fcbc7fa162ad" in dec
    #print(dec)
    
def main():
    #sanitycheck_xordecryptbuffer()
    #sanitycheck_serpent()
    
    enc = bytes.fromhex("040C0181E1851FEF8D890FAB13A6A264EFF544B710D0A8F5731F9CFF069FFC23084A113A923C5F5171709BD0769F50E711A722CE48C7F36978721CA205B6F231A5A4BAA6F371E0614BAD5566BA344FA04937E6EF58575607B2FB1363BCC20BE3D291F7B71A766A42E3E82F09312F4FE2914454EFC78C23350D25F1E1388014B7F27C55382A9BB411D0631F242890F1F3E7C8744602EA66CE1BA971CC1B12B3979E058B1904731F83E5D7DAF90583F57170D459C21FD7D47E6E771AC358CBB9341C8173C9DEA9649A6EFD0FE2C33DC3A3")
    
    #key = 0xe7019ef0 # based on my sid
    g_MachineRandSeed = 0xfb307bfa
    tmp = XorDecryptBuffer(enc, g_MachineRandSeed)
    g_pServerKey = b"GSPyrv3C79ZbR0k1" # recovered from the config file via one of the downloaded files (the "notpe")
    tmp2 = serpent.serpent_cbc_decrypt(g_pServerKey, tmp)
    print(tmp2)
    
    with open("flag.zip", "wb") as f:
        f.write(tmp2)
    
if __name__ == "__main__":
    main()
