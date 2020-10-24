import base64

indict = "abcdefghijklmnop"
outdict = "0123456789abcdef"
translation = str.maketrans(indict, outdict)

data = ""
with open("encodedhint.txt", "r") as f:
    data = f.read()
    
hex_decoded = bytes.fromhex(data.lower().translate(translation))

decoded = base64.b64decode(hex_decoded[:-1])
with open("decoded_hint.png", "wb") as f:
    f.write(decoded)
