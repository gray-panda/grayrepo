xorkey = {}
keystring = "l3rlcps_7r_vb33eehskc3"
start_num = 0x1a8
for i in range(len(keystring)):
    xorkey[start_num + i] = keystring[i]
    
order = [0x1b4, 0x1b5, 0x1ae, 0x1b0, 0x1af, 0x1ae, 0x1ad, 0x1a9, 0x1a8, 0x1ab, 0x1ac, 0x1b9, 0x1b7, 0x1bc, 0x1bb, 0x1bd, 0x1aa, 0x1b2, 0x1b8, 0x1b3, 0x1b6, 0x1aa]


flag = ""
for x in order:
    flag += xorkey[x]
    
print(flag + "@flare-on.com")