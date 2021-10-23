#!/bin/python3

import base64
import itertools

# stage1
ENCRYPTION_KEY = base64.b64decode(b"b2JDN2luc2tiYXhLOFZaUWRRWTlSeXdJbk9lVWxLcHlrMXJsRnk5NjJaWkQ4SHdGVjhyOENQeFE5dGxUaEd1dGJ5ZDNOYTEzRmZRN1V1emxkZUJQNTN0Umt6WkxjbDdEaU1KVWF1M29LWURzOGxUWFR2YjJqQW1HUmNEU2RRcXdFSERzM0d3emhOaGVIYlE3dm9aeVJTMHdLY2Vhb3YyVGQ4UnQ2SXUwdm1ZbGlVYjA4YVRES2xESnlXU3NtZENMN0J4MnBYdlZET3RUSmlhY2V6Y3B6eUM2Mm4yOWs=")

def main():
    global ENCRYPTION_KEY

    with open("stage1_b64.txt", "rb") as f:
        tmpdata = f.read()
    ciphertext = base64.b64decode(tmpdata)
    

    # ENCRYPTION_KEY is 221 bytes long
    # split ciphertext into 221 byte chunks
    n = len(ENCRYPTION_KEY)
    ct = [ciphertext[i:i+n] for i in range(0, len(ciphertext), n)]
    # remove last chunk as its not 221 bytes long (easier for later analysis)
    ct = ct[:-1]

    for i in range(n):
        data = bytearray()
        for part in ct:
            data.append(part[i])

        with open("parts1/%d.bin" % i, "wb") as f:
            f.write(bytes(data))    
    
if __name__ == "__main__":
    main()
