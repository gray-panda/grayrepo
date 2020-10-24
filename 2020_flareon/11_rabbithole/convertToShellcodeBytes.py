data = b""
with open("decodedb64.wtf", 'rb') as f:
	data = f.read()
	

hexstr = ""
for cur in data:
	tmp = hex(cur)[2:]
	if len(tmp) < 2:
		tmp = "0" + tmp
	tmp = "\\x" + tmp
	hexstr += tmp

chunk_size = 0x1000
n = 4 * chunk_size
chunks = [hexstr[i:i+n] for i in range(0, len(hexstr), n)]
chunklen = len(chunks)
print(chunklen)

with open ("shellcode_c.txt", "w") as f:
	f.write("unsigned char b[%d][CHUNK_SIZE+1] = {\n" % chunklen)
	i = 0
	
	for chunk in chunks:
		f.write("\t\"" + chunk + "\",\n")
		i = i + 1
	f.write("};\n")
	
print("Done")