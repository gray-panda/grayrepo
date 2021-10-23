#!/bin/python3

import base64
import itertools

# stage2
ENCRYPTION_KEY = base64.b64decode(b"N0l2N2l2RTVDYlNUdk5UNGkxR0lCbTExZmI4YnZ4Z0FpeEpia2NGN0xGYUh2N0dubWl2ZFpOWm15c0JMVDFWeHV3ZFpsd2JvdTVSTW1vZndYRGpYdnhrcGJFS0taRnZOMnNJU1haRXlMM2lIWEZtN0RSQThoMG8yYUhjNFZLTGtmOXBDOFR3OUpyT2RwUmFOOUdFck12bXd2dnBzOUVMWVpxRmpnc0ZHTFFtMGV4WW11Wmc1bWRpZWZ6U3FoZUNaOEJiMURCRDJTS1o3SFpNRzcwRndMZ0RCNFFEZWZsSWE4Vg==")
     
def seed_encryption_key(keyb, seedb):
    return (keyb + seedb) & 0xff

def decrypt_byte(cipherb, keyb):
    return (cipherb - keyb) & 0xff

def is_valid_output(num):
    if num > 127:
        return False

    if num < 0x20:
        if num != 0xa and num != 0xd and num != 0x9:
            return False

    return True

def match_1_position(pos, seedb):
    global ENCRYPTION_KEY

    keyb = seed_encryption_key(ENCRYPTION_KEY[pos], seedb)

    fname = "parts2/%d.bin" % pos
    with open(fname, "rb") as f:
        ciphered = f.read()

    allascii = True
    for c in ciphered:
        tmp = decrypt_byte(c, keyb)
        if is_valid_output(tmp) == False:
            return False
    return True

def main():
    influence = [0] * 64
    for i in range(len(influence)):
        influence[i] = [x for x in range(len(ENCRYPTION_KEY)) if x%64 == i]

    possible = [0] * 64
    for i in range(len(influence)):
        inf = influence[i]

        possible_keys = []

        for t in range(0x30, 0x80):
            if t >= 0x3a and t <0x41:
                continue
            elif t >= 0x5b and t<0x61:
                continue
            elif t >= 0x7b and t<0x80:
                continue
            if match_1_position(inf[0], t):
                possible_keys.append(chr(t))

        #print(possible_keys)
        for x in range(1, len(inf)):
            new_possible_keys = []
            for t in possible_keys:
                if match_1_position(inf[x], ord(t)):
                    new_possible_keys.append(t)
            possible_keys = new_possible_keys
            #print(possible_keys)

        possible[i] = possible_keys
    
    firstchoice = ""
    for i in range(len(possible)):
        print("%d: %s" % (i, possible[i]))
        firstchoice += possible[i][0]
        #firstchoice += possible[i][len(possible[i])-1]

    print(firstchoice)

    
if __name__ == "__main__":
    main()
