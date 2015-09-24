## CSAW CTF 2014
# Forensics 200 : why not sftp?

![question](img/qn.png)

You are provided with zip file which contains a pcap file

The question itself is a clue, there is a FTP connection within the pcap file

Search for "ftp" in the wireshark filter will bring up this connection. At the end of this connection a data transfer is initiated

![01](img/01.png)

![02](img/02.png)

In order to see what is sent in the transfer, search for "ftp-data" in wireshark filter. Follow the stream and you should notice its a zip file (with the "PK" header)

![03](img/03.png)

![04](img/04.png)

Save the stream as a zip file and open it. It contains a image called "flag.png"

![05](img/05.png)

Opening it will show the flag

![flag](img/flag.png)

Flag is **flag{91e02cd2b8621d0c05197f645668c5c4}**
