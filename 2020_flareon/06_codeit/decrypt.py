from Cryptodome.Cipher import AES
import hashlib
import struct

def do_some_shifting(compname, mask):
    output = b""
    mask_index = 0
    for i in range(len(compname)):
        tmp = compname[i]
        shift_val = 6
        while shift_val >= 0:
            tmp += ((mask[mask_index] & 0x01) << shift_val)
            shift_val -= 1
            mask_index += 1
        tmp = (tmp >> 1) + ((tmp & 0x01) << 7)
        output += bytes([tmp])
    
    return output 
    
BLOCK_SIZE = 16
pad = lambda s: s + (BLOCK_SIZE - len(s) % BLOCK_SIZE) * chr(BLOCK_SIZE - len(s) % BLOCK_SIZE)
unpad = lambda s: s[:-ord(s[len(s) - 1:])]
    
def decrypt(enc, password):
    private_key = hashlib.sha256(password).digest()
    # enc = base64.b64decode(enc)
    iv = b"\x00" * 16
    cipher = AES.new(private_key, AES.MODE_CBC, iv)
    return unpad(cipher.decrypt(enc))
    

def decode_imgdata(imgdata):
    img_index = 0
    out = b""
    for i in range(16):
        cur_byte = 0
        shift_val = 6
        while shift_val >= 0:
            cur_byte += (imgdata[img_index] & 0x01) << shift_val
            shift_val -= 1
            img_index += 1
        out += bytes([cur_byte])
    return out
        
def main():
    imgdata = b""
    with open("sprite.bmp", "rb") as f:
        imgdata = f.read()
        
    imgsize = len(imgdata)
    imgdata = imgdata[54:]
    
    print(decode_imgdata(imgdata))
    
    enc = bytes.fromhex("CD4B32C650CF21BDA184D8913E6F920A37A4F3963736C042C459EA07B79EA443FFD1898BAE49B115F6CB1E2A7C1AB3C4C25612A519035F18FB3B17528B3AECAF3D480E98BF8A635DAF974E0013535D231E4B75B2C38B804C7AE4D266A37B36F2C555BF3A9EA6A58BC8F906CC665EAE2CE60F2CDE38FD30269CC4CE5BB090472FF9BD26F9119B8C484FE69EB934F43FEEDEDCEBA791460819FB21F10F832B2A5D4D772DB12C3BED947F6F706AE4411A52")
    print(len(enc))
    
    key = b"aut01tfan1999"
    #key = do_some_shifting(key, imgdata)
    decrypted = decrypt(enc, key)
    if decrypted[0:5] == b"FLARE" and decrypted[::-1][0:5] == b"FLARE":
        print(decrypted)
        result = []
        result.append(struct.unpack("<I", decrypted[5:5+4])[0]) # width
        result.append(struct.unpack("<I", decrypted[9:9+4])[0]) # height
        result.append(decrypted[14:-4]) # bmp data
        print(result)
    

if __name__ == "__main__":
    main()
