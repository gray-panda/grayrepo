from scapy.all import *
import struct
from delta_patch import *

def xorstrings(msg, key):
    output = bytearray()
    for i in range(len(msg)):
        output.append(msg[i] ^ key[i % len(key)])
    return output

def isAllNulls(data):
    for x in data:
        if x != 0:
            return False
    return True

TMP_FILE = "patch.tmp"
    
def main():
    pcap = rdpcap("IR_PURRMACHINE.pcapng")

    for packet in pcap:
        if TCP in packet:
            if packet[TCP].dport == 1337 or packet[TCP].sport == 1337:

                payload = bytes(packet[TCP].payload)
                if len(payload) > 1 and not isAllNulls(payload):
                    plain_len = struct.unpack("<I", payload[4:8])[0]
                    decoded_len = struct.unpack("<I", payload[8:12])[0]
                    patch_data = payload[12:]
				
                    # Write the patch_data into a tmp file
                    with open(TMP_FILE, "wb") as f:
                        f.write(patch_data)
                    
                    # read in the base file (lots of 0xff bytes)    
                    inbuf = b""
                    with open("plain_ff.txt", "rb") as f: # files with all 0xff bytes
                        inbuf = f.read()

                    # Apply the patch
                    buf = cast(inbuf, wintypes.LPVOID)
                    n = len(inbuf)
                    to_free = []
                    legacy = False
                    try:
                        buf, n = apply_patchfile_to_buffer(buf, n, TMP_FILE, legacy)
                        to_free.append(buf)

                        outbuf = bytes((c_ubyte*n).from_address(buf))
                        #print(outbuf)
                    finally:
                        for buf in to_free:
                            DeltaFree(buf)
                            
                    # apply the xor decryption
                    outbuf = outbuf[:plain_len]
                    plaintext = xorstrings(outbuf, b"meoow")
                    
                    out_msg = bytes(plaintext)
                    try:
                        out_msg = out_msg.decode('utf-8', errors='ignore')
                    except:
                        pass
                    print(out_msg)

if __name__ == "__main__":
    main()
