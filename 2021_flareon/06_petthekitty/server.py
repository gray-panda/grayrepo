import socket
import sys

# Create a TCP/IP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Bind the socket to the port
server_address = ('127.0.0.1', 1337)
print('starting up on %s port %s' % server_address)
sock.bind(server_address)

# Listen for incoming connections
sock.listen(1)

while True:
    # Wait for a connection
    print('waiting for a connection')
    connection, client_address = sock.accept()

    try:
        print(client_address)

        # Receive the data and print it
        data = connection.recv(1024)
        print(data)
    except:
        print("Exception!")
    finally:
        # Clean up the connection
        connection.close()