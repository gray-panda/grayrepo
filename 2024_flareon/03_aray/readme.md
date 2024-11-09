## Flare-On CTF 2024
# Challenge 03 : array

```
And now for something completely different. 
I'm pretty sure you know how to write Yara rules, but can you reverse them?

7zip archive password: flare
```

We are provided a 7zip file with a yara rule  
We have to reverse the yara rule to see what it is matching against

I wrote a short python script to extract all the rules from this yara file

```python
data = 'HUGE CHUNK of RULES'
parts = data.split(" and ")

for x in range(len(parts)):
    print("%d : %s" % (x, parts[x]))
```

Many of these rules are actually redundant.  
I manually went through these rules and got the flag, focusing on rules that gives you exact values

The CRC32/SHA256/MD5 hashing is done only on 2 bytes  
Therefore it is possible to brute-force these values

```python
def brutecrc32_2bytes(targetnum):
    print("Bruteforce CRC32 for 0x%x" % targetnum)
    for x in range(65536):
        if zlib.crc32(x.to_bytes(2,"big")) == targetnum:
            print("Possible Candidate: 0x%x" % x)

def brutesha256_2bytes(targethash):
    print("Bruteforce SHA256 for %s" % targethash)
    for x in range(65536):
        if hashlib.sha256(x.to_bytes(2, "big")).hexdigest() == targethash:
            print("Possible Candidate: 0x%x" % x)

def brutemd5_2bytes(targethash):
    print("Bruteforce MD5 for %s" % targethash)
    for x in range(65536):
        if hashlib.md5(x.to_bytes(2, "big")).hexdigest() == targethash:
            print("Possible Candidate: 0x%x" % x)
```

Here is my [helper script](soln.py) that I used to help me keep track of everything

```
$ python .\soln.py
rule fl?reon { strings: $f = "1RuleADayK33p$Malw4r3Aw4y@flare-on.com" condition: $f }
```

The flag is **1RuleADayK33p$Malw4r3Aw4y@flare-on.com**