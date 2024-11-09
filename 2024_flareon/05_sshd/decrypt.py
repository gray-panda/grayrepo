from Crypto.Cipher import ChaCha20

thekey = bytes.fromhex("943DF638A81813E2DE6318A507F9A0BA2DBB8A7BA63666D08D11A65EC914D66F")
thenonce = bytes.fromhex("F236839F4DCD711A52862955") # 12-byte version F236839F4DCD711A52862955

with open("encrypted.bin", "rb") as f:
    ciphertext = f.read()

cipher = ChaCha20.new(key=thekey, nonce=thenonce)
plaintext = cipher.decrypt(ciphertext)

with open("decrypted.bin", "wb") as f:
    f.write(plaintext)

print("Decrypted contents written to decrypted.bin")