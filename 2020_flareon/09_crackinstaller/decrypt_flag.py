from arc4 import ARC4

"""
 db 16h, 56h, 0BCh, 86h, 9Eh, 0E1h, 0D1h, 2, 65h, 0C1h
.data:000000018001A9F0                                         ; DATA XREF: Registry_SetFlag+A5↑o
.data:000000018001A9F0                 db 69h, 9Fh, 10h, 0Ah, 0ACh, 0C1h, 0F6h, 0E9h, 0FDh, 0B4h
.data:000000018001A9F0                 db 0CDh, 22h, 4Ah, 35h, 9Ch, 12h, 73h, 0BDh, 2Bh, 10h
.data:000000018001A9F0                 db 54h, 0B9h, 43h, 0D2h, 13h, 9Ah, 84h, 65h, 0ADh, 0B0h
.data:000000018001A9F0                 db 0BFh, 5Ah, 81h, 10h, 4 dup(0)
"""

enc = bytes.fromhex("1656BC869EE1D10265C1699F100AACC1F6E9FDB4CD224A359C1273BD2B1054B943D2139A8465ADB0BF5A8110")
key = b"H@n $h0t FiRst!"
crypt = ARC4(key)
print(crypt.decrypt(enc))