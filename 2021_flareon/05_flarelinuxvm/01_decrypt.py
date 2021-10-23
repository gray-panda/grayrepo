import hexdump
import os

def encrypt(msg, seed):
    sbox = []
    result = 0

    # create sbox
    for i in range(256):
        sbox.append(i)
        
    # initialize sbox with seed
    
    valindex = 0
    for i in range(256):
        valindex = (sbox[i] + valindex + seed[i % 52]) % 256
        tmp_swap = sbox[i]
        sbox[i] = sbox[valindex]
        sbox[valindex] = tmp_swap
        
    # Actual encryption loop
    running_index = 0
    jumping_index = 0
    v8 = 0
    output = bytearray()
    keystream = bytearray()
    loop_limit = 1024
    if len(msg) < 1024:
        loop_limit = len(msg)
        
    for k in range(loop_limit):
        running_index = (running_index + 1) % 256
        jumping_index = (jumping_index + sbox[running_index]) % 256
        tmp_swap = sbox[running_index]
        sbox[running_index] = sbox[jumping_index]
        sbox[jumping_index] = tmp_swap
        
        v4 = sbox[(sbox[jumping_index] + sbox[running_index]) % 256]
        xorkey = v4 ^ v8
        #print("xorkey: %x" % xorkey)
        keystream.append(xorkey)
        output.append(msg[k] ^ xorkey)
        v8 = v4
        
    #return output
    return (output, keystream)
    
def xor_decrypt(enc, key):
    output = bytearray()
    for i in range(len(enc)):
        output.append(enc[i] ^ key[i])
    return output
    
    
def main():
    # Looking at the encryption code, the xor keystream is always the same
    seed = b"A secret is no longer a secret once someone knows it"
    (result, xor_keystream) = encrypt(b"a"*1024, seed)
    
    '''
    with open("Documents/a.txt.broken", "rb") as f:
        data = f.read()
    hexdump.hexdump(xor_decrypt(data, bytes(xor_keystream)))
    '''
    
    directory = os.fsencode("encrypted")

    for file in os.listdir(directory):
        filename = os.fsdecode(file).encode()
        #print(filename)
        with open(directory + b"/" + filename, "rb") as f:
            data = f.read()

        decrypted = xor_decrypt(data, xor_keystream)
        outfname = filename[0:filename.find(b".broken")]
        with open(b"decrypted/" + outfname, "wb") as f:
            f.write(decrypted)
    
    print("done")
    
if __name__ == "__main__":
    main()
    