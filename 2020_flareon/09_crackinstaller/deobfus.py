
def xor_decrypt(msg, key):
    out = b""
    for i in range(len(msg)):
        cur = msg[i]
        tmp = cur ^ key[i%len(key)]
        out += bytes([tmp])
    return out
    
key = bytes.fromhex("3C677E7B3C6974")

msg = bytes.fromhex("47243B3E7D2A370A2253387F2B4611533D4F7A44367F214856785B450B514E480B284D7D5003277F061A5A0E197B")
print(xor_decrypt(msg,key))

msg1 = bytes.fromhex("75083A1E500C0059230C124A0C063C")
print(xor_decrypt(msg1,key))

msg2 = bytes.fromhex("0F514E4B0C5974")
print(xor_decrypt(msg2,key))

msg3 = bytes.fromhex("602A17184E060753010A277F1B115802100F5508184F3B1D09590D3C590B0E1E4E4710500B7E")
print(xor_decrypt(msg3, key))

msg4 = bytes.fromhex("780B1229590E1D4F131B096F0C064A020C7B")
print(xor_decrypt(msg4, key))