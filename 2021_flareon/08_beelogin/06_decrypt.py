#!/bin/python3

import base64
import itertools

# stage2
ENCRYPTION_KEY = base64.b64decode(b"N0l2N2l2RTVDYlNUdk5UNGkxR0lCbTExZmI4YnZ4Z0FpeEpia2NGN0xGYUh2N0dubWl2ZFpOWm15c0JMVDFWeHV3ZFpsd2JvdTVSTW1vZndYRGpYdnhrcGJFS0taRnZOMnNJU1haRXlMM2lIWEZtN0RSQThoMG8yYUhjNFZLTGtmOXBDOFR3OUpyT2RwUmFOOUdFck12bXd2dnBzOUVMWVpxRmpnc0ZHTFFtMGV4WW11Wmc1bWRpZWZ6U3FoZUNaOEJiMURCRDJTS1o3SFpNRzcwRndMZ0RCNFFEZWZsSWE4Vg==")

def decrypt(ciphertext, seed):
    global ENCRYPTION_KEY    
    
    # Initialize the key with the seed
    # seed must be 64 bytes long
    enc_key = bytearray()
    for i in range(len(ENCRYPTION_KEY)):
    #for i in range(len(addkey)):
        tmp = (ENCRYPTION_KEY[i] + seed[i % 64]) & 0xff
        enc_key.append(tmp)
        
    # Decrypt the data
    enc_key = bytes(enc_key)
    decrypted = bytearray()
    for i in range(len(ciphertext)):
        tmp = (ciphertext[i] - enc_key[i % len(enc_key)]) & 0xff
        decrypted.append(tmp)
    return decrypted

def main():
    
    with open("stage2_b64.txt", "rb") as f:
        tmpdata = f.read()
    ciphertext = base64.b64decode(tmpdata)

    # stage2
    keyb = b"UQ8yjqwAkoVGm7VDdhLoDk0Q75eKKhTfXXke36UFdtKAi0etRZ3DoHPz7NxJPgHl"
    print("Trying %s" % keyb)
    result = decrypt(ciphertext, keyb)
    print(result[:256])

    with open("06_decrypted.txt", "wb") as f:
        f.write(result)
    
if __name__ == "__main__":
    main()
