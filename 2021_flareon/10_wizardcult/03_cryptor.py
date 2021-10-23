import hashlib

SBOX = [90, 132, 6, 69, 174, 203, 232, 243, 87, 254, 166, 61, 94, 65, 8, 208, 51, 34, 33, 129, 32, 221, 0, 160, 35, 175, 113, 4, 139, 245, 24, 29, 225, 15, 101, 9, 206, 66, 120, 62, 195, 55, 202, 143, 100, 50, 224, 172, 222, 145, 124, 42, 192, 7, 244, 149, 159, 64, 83, 229, 103, 182, 122, 82, 78, 63, 131, 75, 201, 130, 114, 46, 118, 28, 241, 30, 204, 183, 215, 199, 138, 16, 121, 26, 77, 25, 53, 22, 125, 67, 43, 205, 134, 171, 68, 146, 212, 14, 152, 20, 185, 155, 167, 36, 27, 60, 226, 58, 211, 240, 253, 79, 119, 209, 163, 12, 72, 128, 106, 218, 189, 216, 71, 91, 250, 150, 11, 236, 207, 73, 217, 17, 127, 177, 39, 231, 197, 178, 99, 230, 40, 54, 179, 93, 251, 220, 168, 112, 37, 246, 176, 156, 165, 95, 184, 57, 228, 133, 169, 252, 19, 2, 81, 48, 242, 105, 255, 116, 191, 89, 181, 70, 23, 194, 88, 97, 153, 235, 164, 158, 137, 238, 108, 239, 162, 144, 115, 140, 84, 188, 109, 219, 44, 214, 227, 161, 141, 80, 247, 52, 213, 249, 1, 123, 142, 190, 104, 107, 85, 157, 45, 237, 47, 147, 21, 31, 196, 136, 170, 248, 13, 92, 234, 86, 3, 193, 154, 56, 5, 111, 98, 74, 18, 223, 96, 148, 41, 117, 126, 173, 233, 10, 49, 180, 187, 186, 135, 59, 38, 210, 110, 102, 200, 76, 151, 198]
XORKEY = [97, 49, 49, 95, 109, 89, 95, 104, 111, 109, 49, 101, 115, 95, 104, 52, 116, 51, 95, 98, 52, 114, 100, 115] # a11_mY_hom1es_h4t3_b4rds

def reverse_sbox():
	global SBOX

	out = SBOX[:] # make a copy

	for i in range(len(SBOX)):
		out[SBOX[i]] = i
	return out

def encryptbyte(msgb, i):
	global SBOX, XORKEY

	tmp = SBOX[msgb]
	xorb = XORKEY[i % len(XORKEY)]
	if i % 2 == 1: #odd index
		xorb = (~xorb) & 0xff
	tmp ^= xorb
	tmp = SBOX[tmp]

	if tmp & 0x80:
		tmp ^= 0x42

	result = (~tmp) & 0xff
	return result


def encrypt(msg):
	out = bytearray()
	for i in range(len(msg)):
		out.append(encryptbyte(msg[i], i))

	return bytes(out)


def decryptbyte(encb, i, rev_sbox):
	tmp = (~encb) & 0xff

	if tmp & 0x80:
		tmp ^= 0x42

	tmp = rev_sbox[tmp]
	xorb = XORKEY[i % len(XORKEY)]
	if i % 2 == 1: #odd index
		xorb = (~xorb) & 0xff
	tmp ^= xorb
	result = rev_sbox[tmp]

	return result

def decrypt(enc):
	rev_sbox = reverse_sbox()

	out = bytearray()
	for i in range(len(enc)):
		out.append(decryptbyte(enc[i], i, rev_sbox))

	return bytes(out)


def main():
	
	'''
	# sanity check
	running = bytearray()
	for i in range(256):
		running.append(i)
	running = bytes(running)

	enc = encrypt(running)
	print(enc)
	print(hashlib.sha1(enc).hexdigest())
	dec = decrypt(enc)
	print(dec)
	'''

	
	with open("encrypted.png", "rb") as f:
		spellfight = f.read()
	png = decrypt(spellfight)
	with open("decrypted.png", "wb") as f:
		f.write(png)
	print("decrypted png")	

if __name__ == "__main__":
	main()