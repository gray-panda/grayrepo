# This script requires Python 3.8 to run
# in particular the modular inverse feature pow(x,-1,m)

h1 = int("480022d87d1823880d9e4ef56090b54001d343720dd77cbc5bc5692be948236c", 16)
h2 = int("c10357c7a53fa2f1ef4a5bf03a2d156039e7a57143000c8d8f45985aea41dd31", 16)
h3 = int("d036c5d4e7eda23afceffbad4e087a48762840ebb18e3d51e4146f48c04697eb", 16)
h4 = int("d1cc3447d5a9e1e6adae92faaea8770db1fab16b1568ea13c3715f2aeba9d84f", 16)
print("h1: %d" % h1) # 32566765593893417529351190622059002539699972486181200418200317431379135046508
print("h2: %d" % h2) # 87302286152129012315768956895021811229194890355730814061380683967744348118321
print("h3: %d" % h3) # 94177847630781348927145754531427408195050340748733546028257255715312033503211
print("h4: %d" % h4) # 94894182982585115752273641869831161604229729487611399267972930833928751274063

"""
All numbers are big numbers
Let
	powmod signature be powmod(base, exponential, modulo)
	rand() reads 0x20 bytes from /dev/urandom
	x is our input (0x18 bytes long)

h1 = "480022d87d1823880d9e4ef56090b54001d343720dd77cbc5bc5692be948236c"
h2 = "c10357c7a53fa2f1ef4a5bf03a2d156039e7a57143000c8d8f45985aea41dd31"
h3 = "d036c5d4e7eda23afceffbad4e087a48762840ebb18e3d51e4146f48c04697eb"
h4 = "d1cc3447d5a9e1e6adae92faaea8770db1fab16b1568ea13c3715f2aeba9d84f"

rand = rand() % h4

c1 = powmod(h1, rand, h4)
Checks c1 == h1 

bbb = powmod(h2, rand, h4)
c3 = (x * bbb) % h4
Checks c3 == h3

Can solve for x?

Easiest solution for c1 == h1 is for rand to be 1,
Therefore,
	bbb = h2 (mod h4)
	c3 = h2(x) (mod h4)
	
It can be re-written as

	h2(x) = c3 (mod h4)
	
	we can solve x using multiplicative inverse of modulo numbers
	
	h2(x) * inv(h2) == c3 * inv(h2) (mod h4)
	x == c3 * inv(h2) (mod h4)
"""

print("Thanks to a new feature in Python 3.8")
print("inv(h2) = pow(h2, -1, h4)")
h2inv = pow(h2, -1, h4)
print("inv(h2) = %d" % h2inv)

x = (h3 * h2inv) % h4
print("x: %d" % x)
x = hex(x)[2:]
print("hex(x): %s" % x)
print(bytes.fromhex(x)[::-1])