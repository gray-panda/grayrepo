from pwintools import *
import time
import base64


RECVSIZE = 128

def xorbytes(msg, key):
    out = b""
    for i in range(len(msg)):
        out += (msg[i] ^ key[i % len(key)]).to_bytes(1)
    return out 

def processMath(p, mathline):
    parts = mathline.split(b" ")
    tmpsum = int(parts[2]) + int(parts[4])
    print(tmpsum)
    p.sendline(str(tmpsum))
    print(p.recvline())
    print(p.recvline())

def processChecksum(p, reqline):
    tmp = base64.b64decode("cQoFRQErX1YAVw1zVQdFUSxfAQNRBXUNAxBSe15QCVRVJ1pQEwd/WFBUAlElCFBFUnlaB1ULByRdBEFdfVtWVA==")
    tmphex = xorbytes(tmp, b"FlareOn2024")
    print(tmphex)
    p.sendline(tmphex)
    print(p.recvline())
    return ""

p = Process("checksum.exe")
for x in range(32):
    time.sleep(1)
    tmp = p.recv(RECVSIZE)
    print(tmp)
    if tmp.split(b":")[0] == b"Check sum":
        processMath(p, tmp)
    elif tmp.split(b":")[0] == b"Checksum":
        processChecksum(p, tmp)
        break
    else:
        print("Unknown Request")
        break
    
