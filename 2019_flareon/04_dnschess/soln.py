from scapy.all import *

# The interesting code is in the getNextMove function in the ChessAI.so file
# Clue was looking at the 0x4060 area (looks like a buffer to store the flag)

# Use scapy to extract IPs from all the DNS responses
ips = []
pkts = rdpcap("capture.pcap")
for pkt in pkts:
	if pkt.haslayer(DNSRR):
		ips.append(pkt[DNSRR].rdata)

enc = bytearray.fromhex("795AB8BCECD3DFDD99A5B6AC1536858D090877524D71547DA7A70816FDD7") # from 0x2020
out = ""


# The code only decrypts the flag if the returned IP matches the following conditions
# Each pair of characters in the flag is decrypted by 1 IP that matches the conditions
flag_index = 0		
while flag_index < 15:
	for ip in ips:
		tmp = ip.split(".")
		if int(tmp[0]) != 127:	# first octet must be 127
			continue
		if int(tmp[3]) & 1:		# last octet must be odd
			continue
		if (int(tmp[2]) & 0xf) != flag_index:	# 3rd octet's lower bytes must equal current flag index
			continue
			
		print "%d %s" % (flag_index, tmp)
		
		# Condition met, perform the decryption
		out += chr(enc[(flag_index * 2)] ^ int(tmp[1]))
		out += chr(enc[(flag_index * 2) + 1] ^ int(tmp[1]))
		
		# Increment flag_index and repeat the loop to find the IP for the next 2 characters
		flag_index += 1

print out + "flare-on.com"
# LooksLikeYouLockedUpTheLookupZ@flare-on.com