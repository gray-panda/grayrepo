from scapy.all import *
import base64

pcap = 'giyh-capture.pcap'
pkts = rdpcap(pcap)
myjpg = ''			# stores the output img
ignorecount = 2		# for ignoring the first 2 FILE packets

i = 0
for p in pkts:
	i = i+1
	if p.haslayer(DNSRR):
		data = p[DNSRR].rdata
		data = data[1:]
		plain = base64.b64decode(data)
		pos = plain.find(":")		# Remove the "XXXX: " from each packet
		cmd = plain[:pos]
		res = plain[pos+1:]
		
		if cmd == "FILE":
			if ignorecount > 0:		# Ignore the first 2 FILE packets as it 
				ignorecount -= 1	# contains the command itself and not the image data
			else:
				myjpg += res
		elif cmd == "EXEC":			# write 'EXEC' packets into a file
			efile = open('exec.txt', 'a')
			efile.write(res)
			efile.close()
		elif cmd == "NONE":
			a = 1					# Do nothing
		else :
			print "Unknown Command " + cmd

imgfile = open('res.jpg', 'w')		# Write the final jpg into a file
imgfile.write(myjpg)
imgfile.close()