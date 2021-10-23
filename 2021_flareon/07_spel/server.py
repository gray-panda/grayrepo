import socket
import sys

def my_send(mysock, msg):
    print("> Sending %s" % msg)
    mysock.send(msg)
    
def my_recv(mysock, mylen):
    msg = mysock.recv(mylen)
    print("< Received %s" % msg)
    return msg

# Create a TCP/IP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Bind the socket to the port
server_address = ('127.0.0.1', 888)
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

        # Receive the data in small chunks and retransmit it
        
        data = my_recv(connection, 1)
        if data == b"@":
            my_send(connection, b"flare-on.com")
        
        data = my_recv(1024)
        '''
        data = my_recv(connection, 1)
        if data == b"#":
            my_send(connection, b"A" * 0x200)
            
        data = my_recv(1024)
        print(data)
        '''
        
    except:
        print("Exception!")
    finally:
        # Clean up the connection
        connection.close()
        
'''
"@" - "exe"
"#" - 0x200 bytes of shellcode

"@" - "run"
"&" - 0x200 bytes of shellcode

"@" - "flare-on.com"
sets stuff into win registry (way to flag)
'''