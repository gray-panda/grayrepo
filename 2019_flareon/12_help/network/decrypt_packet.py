from arc4 import ARC4
import lznt1

def decrypt_packet(fname, decompression_rounds=1):
    with open(fname, "rb") as binfile:
        data = binfile.read()

    rc4 = ARC4("FLARE ON 2019\x00")
    msg = rc4.decrypt(data[4:])
    for i in xrange(decompression_rounds):
        msg = lznt1.decompress_data(msg)

    return msg

print("Decrypting kdb file (Port 6666)\n")
kdb_bytes = decrypt_packet("6666.bin")
with open("flag.kdb", "wb") as flagfile:
    flagfile.write(kdb_bytes)
    print("flag.kdb written...\n")

print("Decrypting Keylogs (Port 8888):\n")
print(decrypt_packet("8888_a.bin"))
print("----------------------")
print(decrypt_packet("8888_b.bin"))
print("----------------------")
print(decrypt_packet("8888_c.bin"))
print("----------------------")
print(decrypt_packet("8888_d.bin"))
print("----------------------")
print(decrypt_packet("8888_e.bin"))
