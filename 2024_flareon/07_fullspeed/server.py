import socket
import time
import struct

def xorbytes(msg, key):
    out = b""
    for x in range(len(msg)):
        out += (msg[x] ^ key[x % len(key)]).to_bytes(1,"big")
    return out

# Define the host and port
HOST = '0.0.0.0'  # Have to listen on 192.168.56.103
PORT = 31337

key1 = b"\x13\x37\x13\x37"

# Create a TCP/IP socket
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as server_socket:
    server_socket.bind((HOST, PORT))
    server_socket.listen()

    print(f"Listening on port {PORT}...")

    while True:
        # Wait for a connection
        client_socket, addr = server_socket.accept()
        with client_socket:
            print(f"Connected by {addr}\n")

            # Receive a message from the client
            received_data = client_socket.recv(1024)  # Adjust buffer size as needed
            print("Receive 1 (Len 0x%x): %s" % (len(received_data), received_data.hex()))
            print("Decrypted : %s\n" % xorbytes(received_data, key1).hex())

            # Receive a message from the client
            received_data = client_socket.recv(1024)  # Adjust buffer size as needed
            print("Receive 2 (Len 0x%x): %s" % (len(received_data), received_data.hex()))
            print("Decrypted : %s\n" % xorbytes(received_data, key1).hex())

            # senddata1 = b"\x52\x76\x52\x76" * 12 # 0x41414141 ^ 0x13371337
            senddata1 = bytes.fromhex("a0d2eba817e38b03cd063227bd32e353880818893ab02378d7db3c71c5c725c6bba0934b5d5e2d3ca6fa89ffbb374c31") # replay
            # senddata1 = xorbytes(bytes.fromhex("c90102faa48f18b5eac1f76bb40a1b9fb0d841712bbe3e5576a7a56976c2baeca47809765283aa078583e1e65172a3fd"), key1)
            client_socket.sendall(senddata1)
            print("Sent %d bytes (%s)" % (len(senddata1), senddata1))
            print("Decrypted : %s\n" % xorbytes(senddata1, key1).hex())
            time.sleep(2)

            # senddata2 = b"\x51\x75\x51\x75" * 12 # 0x42424242 ^ 0x13371337
            senddata2 = bytes.fromhex("96a35eaf2a5e0b430021de361aa58f8015981ffd0d9824b50af23b5ccf16fa4e323483602d0754534d2e7a8aaf8174dc" + "f272d54c31860f") # replay 
            # senddata2 = xorbytes(bytes.fromhex("c90102faa48f18b5eac1f76bb40a1b9fb0d841712bbe3e5576a7a56976c2baeca47809765283aa078583e1e65172a3fd"), key1)
            client_socket.sendall(senddata2)
            print("Sent %d bytes (%s)" % (len(senddata2), senddata2))
            print("Decrypted : %s\n" % xorbytes(senddata2[0:0x30], key1).hex())
            print("Decrypted Extra: %s\n" % xorbytes(senddata2[0x30:], key1).hex())
            time.sleep(2)

            # senddata3 = bytes.fromhex("f272d54c31860f")
            # client_socket.sendall(senddata3)
            # print("Sent %d bytes (%s)" % (len(senddata3), senddata3))
            # print("Decrypted : %s\n" % xorbytes(senddata3, key1).hex())
            # time.sleep(2)

            # Receive a message from the client
            received_data = client_socket.recv(1024)  # Adjust buffer size as needed
            print("Receive 3 (Len 0x%x): %s" % (len(received_data), received_data.hex()))

