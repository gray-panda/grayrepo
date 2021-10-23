from scapy.all import *
import time
import struct


def evil(cmd, msg):
	win_ip = "10.4.4.2" # my windows box ip
	win_port = 0x1104
	msglen = len(msg)

	payl = struct.pack("<I", cmd) 
	payl += struct.pack("<I", msglen)
	payl += msg

	pkt1 = IP(dst=win_ip, flags=4)/UDP(dport=win_port)/Raw(load=payl)
	#pkt1.show()
	print("Sending")
	send(pkt1)


def main():
	attempt = [b'g0d\x00', b'L0ve\x00', b's3cret\x00', b'5Ex\x00']
	for x in attempt:
		evil(2, x)
		time.sleep(5)

	evil(3, b"MZ")
	time.sleep(5)

	#evil(1, b"haha")
	#evil(3, b"MZ")


if __name__ == "__main__":
	main()
