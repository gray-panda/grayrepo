import zlib
import hashlib

soln = ["?"] * 85  # 0 : filesize == 85

soln[58] = 122-25   # 4 : uint8(58) + 25 == 122

# 10 : uint32(52) ^ 425706662 == 1495724241 (uint32(52) == 0x40793477)
soln[52] = 0x77 
soln[53] = 0x34
soln[54] = 0x79
soln[55] = 0x40

# 28 : uint32(17) - 323157430 == 1412131772 (uint32(17) == 0x676E6972)
soln[17] = 0x72
soln[18] = 0x69
soln[19] = 0x6e
soln[20] = 0x67

# 29 : hash.crc32(8, 2) == 0x61089c5c Possible Candidate: 0x7265
soln[8] = 0x72
soln[9] = 0x65

# 35 : hash.crc32(34, 2) == 0x5888fc1b Possible Candidate: 0x6541
soln[34] = 0x65
soln[35] = 0x41

soln[36] = 72-4   # 37 : uint8(36) + 4 == 72
soln[27] = 40^21  # 56 : uint8(27) ^ 21 == 40

# 78 : uint32(59) ^ 512952669 == 1908304943 (uint32(59) == 0x6F2D6572)
soln[59] = 0x72
soln[60] = 0x65
soln[61] = 0x2d
soln[62] = 0x6f

soln[65] = 70+29    # 91 : uint8(65) - 29 == 70
soln[45] = 104^9  # 108 : uint8(45) ^ 9 == 104

# 140 : uint32(28) - 419186860 == 959764852 (uint32(28) == 52312220)
soln[28] = 0x20
soln[29] = 0x22
soln[30] = 0x31
soln[31] = 0x52

soln[74] = 116-11   # 141 : uint8(74) + 11 == 116

# 144 : hash.crc32(63, 2) == 0x66715919 Possible Candidate: 0x6e2e
soln[63] = 0x6e
soln[64] = 0x2e

# 158 : hash.sha256(14, 2) == "403d5f23d149670348b147a15eeb7010914701a7e99aad2e43f90cfa0325c76f" Possible Candidate: 0x2073
soln[14] = 0x20
soln[15] = 0x73

# 224 : hash.sha256(56, 2) == "593f2d04aab251f60c9e4b8bbc1e05a34e920980ec08351a18459b2bc7dbf2f6" Possible Candidate: 0x666c
soln[56] = 0x66
soln[57] = 0x6c

soln[75] = 86+30    # 244 : uint8(75) - 30 == 86

# 249 : uint32(66) ^ 310886682 == 849718389 (0x20226D6F)
soln[66] = 0x6f
soln[67] = 0x6d
soln[68] = 0x22
soln[69] = 0x20

# 251 : uint32(10) + 383041523 == 2448764514 (0x7B206E6F)
soln[10] = 0x6f
soln[11] = 0x6e
soln[12] = 0x20
soln[13] = 0x7b

# 280 : uint32(37) + 367943707 == 1228527996 (0x334B7961)
soln[37] = 0x61
soln[38] = 0x79
soln[39] = 0x4b
soln[40] = 0x33

# 286 : uint32(22) ^ 372102464 == 1879700858 (0x6624203A)
soln[22] = 0x3a
soln[23] = 0x20
soln[24] = 0x24
soln[25] = 0x66

soln[2] = 119-11    # 313 : uint8(2) + 11 == 119

# 318 : hash.md5(0, 2) == "89484b14b36a8d5329426a3d944d2983" Possible Candidate: 0x7275
soln[0] = 0x72
soln[1] = 0x75

# 322 : uint32(46) - 412326611 == 1503714457 (0x7234776C)
soln[46] = 0x6c
soln[47] = 0x77
soln[48] = 0x34
soln[49] = 0x72

# 324 : hash.crc32(78, 2) == 0x7cab8d64 Possible Candidate: 0x6e3a
soln[78] = 0x6e
soln[79] = 0x3a

# 358 : uint32(70) + 349203301 == 2034162376 (0x646E6F63)
soln[70] = 0x63
soln[71] = 0x6f
soln[72] = 0x6e
soln[73] = 0x64

# 373 : hash.md5(76, 2) == "f98ed07a4d5f50f7de1410d905f1477f" Possible Candidate: 0x696f
soln[76] = 0x69
soln[77] = 0x6f

# 390 : uint32(80) - 473886976 == 69677856 (0x20662420)
soln[80] = 0x20
soln[81] = 0x24
soln[82] = 0x66
soln[83] = 0x20

# 411 : uint32(3) ^ 298697263 == 2108416586 (0x6C662065)
soln[3] = 0x65
soln[4] = 0x20
soln[5] = 0x66
soln[6] = 0x6c

soln[21] = 94+21    # 412 : uint8(21) - 21 == 94
soln[16] = 115^7    # 417 : uint8(16) ^ 7 == 115

# 437 : uint32(41) + 404880684 == 1699114335 (0x4D247033)
soln[41] = 0x33
soln[42] = 0x70
soln[43] = 0x24
soln[44] = 0x4d

# 449 : hash.md5(50, 2) == "657dae0913ee12be6fb2a6f687aae1c7" Possible Candidate: 0x3341
soln[50] = 0x33
soln[51] = 0x41

soln[26] = 25+7     # 458 : uint8(26) - 7 == 25

# 490 : hash.md5(32, 2) == "738a656e8e8ec272ca17cd51e12f558b" Possible Candidate: 0x756c
soln[32] = 0x75
soln[33] = 0x6c

soln[84] = 128-3    # 510 : uint8(84) + 3 == 128

def printsoln(soln):
    out = ""
    for x in soln:
        if x != "?":
            out += chr(x)
        else:
            out += x
    print(out)

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

if "__main__" == __name__:
    printsoln(soln) # 1RuleADayK33p$Malw4r3Aw4y@flare-on.com

    # brutecrc32_2bytes(0x61089c5c)
    # brutecrc32_2bytes(0x5888fc1b)
    # brutecrc32_2bytes(0x66715919)
    # brutecrc32_2bytes(0x7cab8d64)
    
    # brutesha256_2bytes("403d5f23d149670348b147a15eeb7010914701a7e99aad2e43f90cfa0325c76f")
    # brutesha256_2bytes("593f2d04aab251f60c9e4b8bbc1e05a34e920980ec08351a18459b2bc7dbf2f6")

    # brutemd5_2bytes("89484b14b36a8d5329426a3d944d2983")
    # brutemd5_2bytes("f98ed07a4d5f50f7de1410d905f1477f")
    # brutemd5_2bytes("657dae0913ee12be6fb2a6f687aae1c7")
    # brutemd5_2bytes("738a656e8e8ec272ca17cd51e12f558b")