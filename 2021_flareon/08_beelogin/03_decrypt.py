#!/bin/python3

import base64
import itertools

# stage1
ENCRYPTION_KEY = base64.b64decode(b"b2JDN2luc2tiYXhLOFZaUWRRWTlSeXdJbk9lVWxLcHlrMXJsRnk5NjJaWkQ4SHdGVjhyOENQeFE5dGxUaEd1dGJ5ZDNOYTEzRmZRN1V1emxkZUJQNTN0Umt6WkxjbDdEaU1KVWF1M29LWURzOGxUWFR2YjJqQW1HUmNEU2RRcXdFSERzM0d3emhOaGVIYlE3dm9aeVJTMHdLY2Vhb3YyVGQ4UnQ2SXUwdm1ZbGlVYjA4YVRES2xESnlXU3NtZENMN0J4MnBYdlZET3RUSmlhY2V6Y3B6eUM2Mm4yOWs=")

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
    
    with open("stage1_b64.txt", "rb") as f:
        tmpdata = f.read()
    ciphertext = base64.b64decode(tmpdata)

    # stage1
    #keyb = b"CbVCSYwI1aU9cVg1ukBnO2u4RGr6aVCNWEjGUuVDLmAO20cdeXq3oqp5jmKBBOQI"
    keyb = b"ChVCVYzI1dU9cVg1ukBqO2u4UGr9aVCNWHpMUuYDLmDO22cdhXq3oqp8jmKBHUWI"
    print("Trying %s" % keyb)
    result = decrypt(ciphertext, keyb)
    print(result[:256])

    with open("03_decrypted.txt", "wb") as f:
        f.write(result)
    
if __name__ == "__main__":
    main()
