## CSAW CTF 2014
# Networking 100 : Big Data

![question]{img/qn.png}

You are provided with a huge pcap file

Most of the traffic is not relevant to the challenge. Hidden within all these traffic is a telnet connection.

Use the "telnet" filter in Wireshark and you will see the telnet connection. 

![01](img/01.png)

Follow the stream and you will get the flag

![02](img/02.png)

Flag is **flag{bigdataisaproblemnotasolution}**
