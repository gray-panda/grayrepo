q = 0xc90102faa48f18b5eac1f76bb40a1b9fb0d841712bbe3e5576a7a56976c2baeca47809765283aa078583e1e65172a3fd # or p (modulus)
a = 0xa079db08ea2470350c182487b50f7707dd46a58a1d160ff79297dcc9bfad6cfc96a81c4a97564118a40331fe0fc1327f
b = 0x9f939c02a7bd7fc263a4cce416f4c575f28d0c1315c4f0c282fca6709a5f9f7f9c251c9eede9eb1baa31602167fa5380
gx = 0x087b5fe3ae6dcfb0e074b40f6208c8f6de4f4f0679d6933796d3b9bd659704fb85452f041fff14cf0e9aa7e45544f9d8
gy = 0x127425c1d330ed537663e87459eaa1b1b53edfe305f6a79b184b3180033aab190eb9aa003e02e9dbf6d593c5e3b08182

n = 30937339651019945892244794266256713890440922455872051984762505561763526780311616863989511376879697740787911484829297

from tinyec.ec import SubGroup, Curve
import hashlib

field = SubGroup(p=q, g=(gx, gy), n=n, h=1)
curve = Curve(a=a, b=b, field=field, name='wutf')
# print('curve:', curve)

Alice_priv = 0x7ed85751e7131b5eaf5592718bef79a9
Alice_public = Alice_priv * curve.g
print("Alice public key")
print("%x %x" % (Alice_public.x, Alice_public.y))
print("")

Bob_public = Alice_public
Bob_public.x = 0xb3e5f89f04d49834de312110ae05f0649b3f0bbe2987304fc4ec2f46d6f036f1a897807c4e693e0bb5cd9ac8a8005f06
Bob_public.y = 0x85944d98396918741316cd0109929cb706af0cca1eaf378219c5286bdc21e979210390573e3047645e1969bdbcb667eb
shared_key = Alice_priv * Bob_public
print("Shared Secret")
print("%x %x" % (shared_key.x, shared_key.y))
print("")

print("SHA512 Hash")
print(hashlib.sha512(shared_key.x.to_bytes(0x30, "big")).hexdigest())
print("")
# b48f8fa4c856d496acdecd16d9c94cc6b01aa1c0065b023be97afdd12156f3dc3fd480978485d8183c090203b6d384c20e853e1f20f88d1c5e0f86f16e6ca5b2
# this is then used to instantiate the chacha20 cipher