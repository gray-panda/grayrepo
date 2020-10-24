"""
016828 some_xorkey_maybe db 8, 67h, 53h, 9, 85h, 1Fh, 3 dup(0), 58h, 2 dup(0), 50h
.rdata:0000000140016828                                         ; DATA XREF: decrypt_some_binary_Stuff+2B↑o
.rdata:0000000140016828                 db 29h, 2 dup(0), 0B2h, 22h, 2 dup(0)                                     ; DATA XREF: decrypt_some_
"""

def xor_decrypt(msg, key):
    out = b""
    for i in range(len(msg)):
        cur = msg[i]
        tmp = cur ^ key[i%len(key)]
        out += bytes([tmp])
    return out

enc = b""
with open("encrypted_credhelper", "rb") as f:
    enc = f.read()

key = bytes.fromhex("08675309")

decrypted = xor_decrypt(enc, key)
print(decrypted[0:0x10])
with open("credhelper.dll", "wb") as f:
    f.write(decrypted)
