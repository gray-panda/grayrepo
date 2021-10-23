from scapy.all import *

def isAllNulls(data):
	for x in data:
		if x != 0:
			return False
	return True

def main():
	pcap = rdpcap("IR_PURRMACHINE.pcapng")

	CLIENT_TO_SERVER = "cs"
	SERVER_TO_CLIENT = "sc"

	running_index = {}
	running_index[CLIENT_TO_SERVER] = 1
	running_index[SERVER_TO_CLIENT] = 1


	for packet in pcap:
		if TCP in packet:
			if packet[TCP].dport == 1337 or packet[TCP].sport == 1337:
				direction = 0

				if packet[TCP].dport == 1337:
					direction = CLIENT_TO_SERVER
				else:
					direction = SERVER_TO_CLIENT


				payload = bytes(packet[TCP].payload)
				if len(payload) > 1 and not isAllNulls(payload):
					fname = "data/1337_%d_%s" % (running_index[direction], direction)

					with open(fname, "wb") as f:
						f.write(payload)
					print("%s written" % fname)
					running_index[direction] += 1
				

if __name__ == "__main__":
	main()
