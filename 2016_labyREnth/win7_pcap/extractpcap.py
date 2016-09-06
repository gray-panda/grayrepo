from scapy.all import *
import pprint

pcap = 'G0blinKing.pcap'
pkts = rdpcap(pcap)

out = ''
counter = 0
for p in pkts:
	if p[IP].dst == "172.16.95.1" and p[TCP].dport == 8080 and p[TCP].chksum == 0x16fc:
	#if p[IP].dst == "172.16.95.1" and p[TCP].dport == 8080 and p[TCP].len > 0:
		#pprint.pprint(p)
		counter += 1

		srcport = p[TCP].sport
		cur = p[Raw].load
		#print str(srcport) + " " + cur
		out = out + cur

print counter
print out