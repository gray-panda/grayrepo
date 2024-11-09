import socket
import time

# Define the host and port
HOST = '0.0.0.0'  # Listen on all interfaces
PORT = 1337

# Create a TCP/IP socket
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as server_socket:
    server_socket.bind((HOST, PORT))
    server_socket.listen()

    print(f"Listening on port {PORT}...")

    while True:
        # Wait for a connection
        client_socket, addr = server_socket.accept()
        with client_socket:
            print(f"Connected by {addr}")

            # Prepare the data to send
            data_32_bytes = bytes.fromhex("8D EC 91 12 EB 76 0E DA 7C 7D 87 A4 43 27 1C 35 D9 E0 CB 87 89 93 B4 D9 04 AE F9 34 FA 21 66 D7")  # 32 bytes of data
            data_12_bytes = bytes.fromhex("11 11 11 11 11 11 11 11 11 11 11 11")  # 12 bytes of data
            data_4_bytes = bytes.fromhex("20")    # 4 bytes of data

            encfile = "/home/geep/Desktop/flare2024/05_sshd/encflag"
            print(len(encfile))

            # Send the data in the specified order
            print("sending 1")
            client_socket.sendall(data_32_bytes)
            time.sleep(2)

            print("sending 2")
            client_socket.sendall(data_12_bytes)
            time.sleep(2)

            print("sending 3")
            client_socket.sendall(data_4_bytes)
            time.sleep(2)

            print("sending 4")
            client_socket.sendall(b"/home/geep/Desktop/flare2024/05_sshd/encflag")
            print("Sent data")

            # Receive a message from the client
            received_data = client_socket.recv(1024)  # Adjust buffer size as needed
            print("Receive 1: %s" % received_data)
            # Receive a message from the client
            received_data = client_socket.recv(1024)  # Adjust buffer size as needed
            print("Receive 2: %s" % received_data)

