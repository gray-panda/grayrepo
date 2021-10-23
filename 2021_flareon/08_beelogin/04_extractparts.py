#!/bin/python3

import base64
import itertools

# stage2
ENCRYPTION_KEY = base64.b64decode(b"N0l2N2l2RTVDYlNUdk5UNGkxR0lCbTExZmI4YnZ4Z0FpeEpia2NGN0xGYUh2N0dubWl2ZFpOWm15c0JMVDFWeHV3ZFpsd2JvdTVSTW1vZndYRGpYdnhrcGJFS0taRnZOMnNJU1haRXlMM2lIWEZtN0RSQThoMG8yYUhjNFZLTGtmOXBDOFR3OUpyT2RwUmFOOUdFck12bXd2dnBzOUVMWVpxRmpnc0ZHTFFtMGV4WW11Wmc1bWRpZWZ6U3FoZUNaOEJiMURCRDJTS1o3SFpNRzcwRndMZ0RCNFFEZWZsSWE4Vg==")

def main():
    global ENCRYPTION_KEY

    with open("stage2_b64.txt", "rb") as f:
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

        with open("parts2/%d.bin" % i, "wb") as f:
            f.write(bytes(data))    
    
if __name__ == "__main__":
    main()
