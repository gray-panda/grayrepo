from scapy.all import *
import base64

pcap = '20141226101055_1.pcap'
pkts = rdpcap(pcap)
theimg = ''

i=0
start = False
for p in pkts:
	if p.haslayer('Raw'):
		data = str(p[Raw])

		if start == False:		
			pos = data.find('"GiYH_Architecture.jpg"')
			if  pos != -1:
				start = True
				pos += len('"GiYH_Architecture.jpg"')
				tmp = data[pos:]
				pos = tmp.find('"GiYH_Architecture.jpg"') + len('"GiYH_Architecture.jpg"')
				tmp = tmp[pos:]
				tmp = tmp.strip()
				theimg = tmp
				#print str(i) + ' ' + str(tmp);
		else:
			if data.find('250 2.0.0') != -1:
				break
			theimg += data
			#print data
	i += 1

theimg = base64.b64decode(theimg)
f = open('GIYH_Architecture.jpg', 'w')
f.write(theimg)
f.close()