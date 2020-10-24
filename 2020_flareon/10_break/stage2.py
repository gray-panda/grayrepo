import struct

ENC_BEE_FILE = "bee_encrypted"
DEC_BEE_FILE = "bee_decrypted"

def xor_decrypt(msg, key):
	out = b""
	for i in range(len(msg)):
		tmp = msg[i] ^ key[i%len(key)]
		out += bytes([tmp])
	return out

# Rotate left: 0b1001 --> 0b0011
rol = lambda val, r_bits, max_bits: \
    (val << r_bits%max_bits) & (2**max_bits-1) | \
    ((val & (2**max_bits-1)) >> (max_bits-(r_bits%max_bits)))
 
# Rotate right: 0b1001 --> 0b1100
ror = lambda val, r_bits, max_bits: \
    ((val & (2**max_bits-1)) >> r_bits%max_bits) | \
    (val << (max_bits-(r_bits%max_bits)) & (2**max_bits-1))
 
max_bits = 32  # For fun, try 2, 17 or other arbitrary (positive!) values


ADD_KEYS = [0x4b695809, 0xe35b9b24, 0x71adcd92, 0x38d6e6c9,
			0x5a844444, 0x2d422222, 0x16a11111, 0xcdbfbfa8,
			0xe6dfdfd4, 0xf36fefea, 0x79b7f7f5, 0xfa34ccda,
			0x7d1a666d, 0xf8620416, 0x7c31020b, 0x78f7b625]

XOR_KEYS = [0x674a1dea, 0xad92774c, 0x56c93ba6, 0x2b649dd3,
			0x8b853750, 0x45c29ba8, 0x22e14dd4, 0x8f47df53,
			0x47a3efa9, 0x23d1f7d4, 0x11e8fbea, 0x96c3044c,
			0x4b618226, 0xbb87b8aa, 0x5dc3dc55, 0xb0d69793]

ROR_KEYS = [(0x1e>>1), (0x22>>1), (0x22>>1), (0x22>>1),
			(0x18>>1), (0x18>>1), (0x18>>1), (0x2a>>1),
			(0x2a>>1), (0x2a>>1), (0x2a>>1), (0x1e>>1),
			(0x1e>>1), (0x1e>>1), (0x1e>>1), (0x24>>1)]

DEBUG_PRINT = False
			
def chmod_func(dword1, dword2):
	for i in range(16):
		starting_dword2 = dword2
		dword2 = (dword2 + ADD_KEYS[i]) & 0xffffffff
		dword2 = ror(dword2, ROR_KEYS[i], max_bits)
		dword2 = dword2 ^ XOR_KEYS[i]
		dword2 = dword2 ^ dword1
		dword1 = starting_dword2
		#print("%x" % dword2)
	return (dword2, dword1)
	
def chmod_func_rev(dword1, dword2):
	for i in range(16):
		starting_dword2 = dword2
		dword2 = (dword2 + ADD_KEYS[15-i]) & 0xffffffff
		dword2 = ror(dword2, ROR_KEYS[15-i], max_bits)
		dword2 = dword2 ^ XOR_KEYS[15-i]
		dword2 = dword2 ^ dword1
		dword1 = starting_dword2
		#print("%x" % dword2)
	return (dword2, dword1)


print("%x %x" % chmod_func(0x106a3fd6, 0xf4dc92aa))			# sanity check
print("%x %x" % chmod_func_rev(0x41414141, 0x41414141))		# sanity check

# truncdata = bytes.fromhex("7553E656A1421FBD7553E656A1421FBD7553E656A1421FBD7553E656A1421FBD,")
beedata = bytes.fromhex("64A06002EA8A877D6CE97CE4823F2D0C8CB7B5EBCF354F424FAD2B4920287CE0") # from 0x081A5100

out = b""
i = 0
while i < len(beedata):
	d1 = struct.unpack("<I", beedata[i:i+4])[0]
	d2 = struct.unpack("<I", beedata[i+4:i+8])[0]
	# print("%x %x" % (curkey, curenc))
	# res = chmod_func(curkey, curenc)
	res = chmod_func_rev(d1, d2)
	out += struct.pack("<I", res[0])
	out += struct.pack("<I", res[1])
	i += 8

print(out)
