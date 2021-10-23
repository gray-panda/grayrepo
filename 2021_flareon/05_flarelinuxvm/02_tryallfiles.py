import os
import hexdump
import binascii
from arc4 import ARC4
from Crypto.Cipher import AES
from Crypto.Util.Padding import unpad

def xor_strings(msg, key):
    output = bytearray()
    for i in range(len(msg)):
        output.append(msg[i] ^ key[i % len(key)])
    return output
    
def decode_bananachips(enc):
    output = bytearray()
    for cur in enc:
        output.append((cur + 27 + 2 * 3 - 37) & 0xff)
    return output
    
def decode_rc4_icedcoffee(enc):
    #key = "SREFBE".encode("UTF-8")
    key = "493513" # refer to dictionary in ice_cream.txt
    cipher = ARC4(key)
    return cipher.decrypt(enc)
    
    
def byte_ror(n, d):
    return (n >> d)|(n << (8 - d)) & 0xFF
    
def byte_rol(n, d):
    return ((n << d)|(n >> (8 - d)) & 0xFF) & 0xff
    
def decode_rotleft_ugali(msg):
    output = bytearray()
    for cur in msg:
        output.append(byte_rol(cur, 1))
    return output
    
def hex_decode(msg):
    return bytes.fromhex(msg)
    
def decode_aes_oats(msg):
    try:
        ct = bytes.fromhex(msg.decode())
        key = "Sheep should sleep in a shed15.2".encode("UTF-8")
        iv = ("PIZZA" + "0" * 11).encode("UTF-8")
        cipher = AES.new(key, AES.MODE_CBC, iv)
        return unpad(cipher.decrypt(ct), AES.block_size)
    except:
        return b"Failed"

directory = os.fsencode("decrypted")
for file in os.listdir(directory):
    filename = os.fsdecode(file).encode()
    print(filename)
    target_file = directory + b"/" + filename
    if os.path.isdir(target_file):
        continue
        
    with open(target_file, "rb") as f:
        data = f.read()
        
    # Try the things
    result = xor_strings(data, b"Reese's") #done
    #result = decode_bananachips(data) #done
    #result = decode_rc4_icedcoffee(data) #done
    #result = decode_rotleft_ugali(data) #done
    #result = decode_aes_oats(data)
    
    # display and maybe save output
    hexdump.hexdump(result)
    choice = input("Enter to continue (s to save output)...")
    if choice == "s":
        # save the output
        with open(b"plain/new/"+filename, "wb") as f:
            f.write(result)
        print("output saved")
    
print("done")