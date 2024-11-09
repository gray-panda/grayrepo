from Crypto.Cipher import ChaCha20
import base64

ct = [
    bytes.fromhex("f272d54c31860f"),
    bytes.fromhex("3fbd43da3ee325"),
    bytes.fromhex("86dfd7"),
    bytes.fromhex("c50cea1c4aa064c35a7f6e3ab0258441ac1585c36256dea83cac93007a0c3a29864f8e285ffa79c8eb43976d5b587f8f35e699547116"),
    bytes.fromhex("fcb1d2cdbba979c989998c"),
    bytes.fromhex("61490b"),
    bytes.fromhex("ce39da"),
    bytes.fromhex("577011e0d76ec8eb0b8259331def13ee6d86723eac9f0428924ee7f8411d4c701b4d9e2b3793f6117dd30dacba"),
    bytes.fromhex("2cae600b5f32cea193e0de63d709838bd6"),
    bytes.fromhex("a7fd35"),
    bytes.fromhex("edf0fc"),
    bytes.fromhex("802b15186c7a1b1a475daf94ae40f6bb81afcedc4afb158a5128c28c91cd7a8857d12a661acaec"),
    bytes.fromhex("aec8d27a7cf26a17273685"),
    bytes.fromhex("35a44e"),
    bytes.fromhex("2f3917"),
    bytes.fromhex("ed09447ded797219c966ef3dd5705a3c32bdb1710ae3b87fe66669e0b4646fc416c399c3a4fe1edc0a3ec5827b84db5a79b81634e7c3afe528a4da15457b637815373d4edcac2159d056"),
    bytes.fromhex("f5981f71c7ea1b5d8b1e5f06fc83b1def38c6f4e694e3706412eabf54e3b6f4d19e8ef46b04e399f2c8ece8417fa"),
    bytes.fromhex("4008bc"),
    bytes.fromhex("54e41e"),
    bytes.fromhex("f701fee74e80e8dfb54b487f9b2e3a277fa289cf6cb8df986cdd387e342ac9f5286da11ca2784084"),
    bytes.fromhex("5ca68d1394be2a4d3d4d7c82e5"),
    bytes.fromhex("31b6dac62ef1ad8dc1f60b79265ed0deaa31ddd2d53aa9fd9343463810f3e2232406366b48415333d4b8ac336d4086efa0f15e6e59"),
    bytes.fromhex("0d1ec06f36")
]

key = bytes.fromhex("b48f8fa4c856d496acdecd16d9c94cc6b01aa1c0065b023be97afdd12156f3dc")
nonce = bytes.fromhex("3fd480978485d818")

cipher = ChaCha20.new(key=key, nonce=nonce)
for x in ct:
    print(cipher.decrypt(x))

print(base64.b64decode("RDBudF9VNWVfeTB1cl9Pd25fQ3VSdjNzQGZsYXJlLW9uLmNvbQ=="))
