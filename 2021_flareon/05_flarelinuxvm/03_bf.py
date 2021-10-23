import hashlib

target_hash = "b3c20caa9a1a82add9503e0eac43f741793d2031eb1c6e830274ed5ea36238bf"

for i in range(256):
    password = bytes([0x45, 0x34, 0x51, 0x35, 0x64, 0x36, 0x66, 0x60, 115, 52, 108, i, 0x35, 73])
    guess = hashlib.sha256(password).hexdigest()
    print("%s: %s" %(password, guess))
    if guess == target_hash:
        print("Found")
        break