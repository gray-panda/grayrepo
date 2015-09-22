## CSAW CTF 2015
# Forensics 100 : Transfer

You are provided with a pcap file

Using the filter "http contains flag" in wireshark will present you with one packet

[01](img/01.png)

Follow the tcp stream on that packet and you are presented with what seems like python code

[02](img/02.png)

[extracted.py](extracted.py)

The python code shows an encoding function followed by a long data string.

The solution ([soln.py](soln.py)) is to write a decoding function to decode the long data string

Run the solution script to get the flag

[03](img/03.png)

Flag is **flag{li0ns_and_tig3rs_4nd_b34rs_0h_mi}**
