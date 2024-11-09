import itertools

def readMatches(fname):
    with open(fname, "r") as f:
        data = f.read()
    lines = data.split("\n")
    if len(lines[len(lines)-1]) == 0:
        lines = lines[0:-1]
    return lines

def writeKeysToFile(validkeys, fname):
    with open(fname, "w") as f:
        for x in validkeys:
            f.write(x+"\n")

def batch1(E, Y, A, I, U, Q, M, Three, debug = False):
    tmp = ((E * 0xEF7A8C) + 0x9d865d8d) & 0xffffffffffffffff
    if debug:
        print("E mul = %x" % tmp)
    tmp2 = Y * 0x45b53c
    if debug:
        print("Y mul = %x" % tmp2)
    tmp = (tmp - tmp2 + 0x18baee57) & 0xffffffffffffffff
    if debug:
        print("EY = %x" % tmp)
    tmp2 = A * 0xE4CF8B
    if debug:
        print("A mul = %x" % tmp2)
    tmp = (tmp - tmp2 - 0x913fbbde) & 0xffffffffffffffff
    if debug:
        print("EYA = %x" % tmp)
    tmp2 = I * 0xf5c990
    if debug:
        print("I mul = %x" % tmp2)
    tmp = (tmp - tmp2 + 0x6bfaa656) & 0xffffffffffffffff
    if debug:
        print("EYAI = %x" % tmp)
    tmp2 = U * 0x733178
    if debug:
        print("U mul = %x" % tmp2)
    tmp = (tmp ^ tmp2 ^ 0x61e3db3b)
    if debug:
        print("EYAIU = %x" % tmp)
    tmp2 = Q * 0x9a17b8
    if debug:
        print("Q mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) - 0xca2804b1) & 0xffffffffffffffff
    if debug:
        print("EYAIUQ = %x" % tmp)
    tmp2 = M * 0x773850
    if debug:
        print("M mul = %x" % tmp2)
    tmp = (tmp ^ tmp2 ^ 0x5a6f68be)
    if debug:
        print("EYAIUQM = %x" % tmp)
    tmp2 = Three * 0xe21d3d
    if debug:
        print("3 mul = %x" % tmp2)
    tmp = (tmp ^ tmp2 ^ 0x5c911d23)
    if debug:
        print("EYAIUQM3 = %x" % tmp)
    return (tmp - 0xffffffff81647a79) & 0xffffffffffffffff

def batch2(R, F, V, B, N, Four, Z, J, debug=False):
    tmp = ((R * 0x99aa81) - 0x74edea51) & 0xffffffffffffffff
    if debug:
        print("R mul = %x" % tmp)
    tmp2 = F * 0x4aba22
    if debug:
        print("F mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) + 0x598015bf) & 0xffffffffffffffff
    if debug:
        print("RF = %x" % tmp)
    tmp2 = V * 0x91a68a
    if debug:
        print("V mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) ^ 0x6df18e52) & 0xffffffffffffffff
    if debug:
        print("RFV = %x" % tmp)
    tmp2 = B * 0x942fde
    if debug:
        print("B mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) + 0x15c825ee) & 0xffffffffffffffff
    if debug:
        print("RFVB = %x" % tmp)
    tmp2 = N * 0xfe2fbe
    if debug:
        print("N mul = %x" % tmp2)
    tmp = (tmp - tmp2 + 0xd5682b64) & 0xffffffffffffffff
    if debug:
        print("RFVBN = %x" % tmp)
    tmp2 = Four * 0xd7e52f
    if debug:
        print("4 mul = %x" % tmp2)
    tmp = ((tmp - tmp2) + 0x798bd018) & 0xffffffffffffffff
    if debug:
        print("RFVBN4 = %x" % tmp)
    tmp2 = Z * 0xe44f6a
    if debug:
        print("Z mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) - 0xe66d523e) & 0xffffffffffffffff
    if debug:
        print("RFVBN4Z = %x" % tmp)
    tmp2 = J * 0xaf71d6
    if debug:
        print("J mul = %x" % tmp2)
    tmp = (tmp + tmp2 + 0x921122d3) & 0xffffffffffffffff
    if debug:
        print("RFVBN4ZJ = %x" % tmp)
    return (tmp - 0xe1148bae) & 0xffffffffffffffff

def batch3(K, Five, O, W, One, C, S, G, debug=False):
    tmp = ((K * 0x48c500) - 0x8fdaa1bc) & 0xffffffffffffffff
    if debug:
        print("K mul = %x" % tmp)
    tmp2 = Five * 0x152887
    if debug:
        print("5 mul = %x" % tmp2)
    tmp = ((tmp - tmp2) + 0x65f04e48) & 0xffffffffffffffff
    if debug:
        print("K5 = %x" % tmp)
    tmp2 = O * 0xaa4247
    if debug:
        print("O mul = %x" % tmp2)
    tmp = ((tmp - tmp2) ^ 0x3d63ec69) & 0xffffffffffffffff
    if debug:
        print("K5O = %x" % tmp)
    tmp2 = W * 0x38d82d
    if debug:
        print("W mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) ^ 0x872eca8f) & 0xffffffffffffffff
    if debug:
        print("K5OW = %x" % tmp)
    tmp2 = One * 0xf120ac
    if debug:
        print("1 mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) + 0x803dbdcf) & 0xffffffffffffffff
    if debug:
        print("K5OW1 = %x" % tmp)
    tmp2 = C * 0x254def
    if debug:
        print("C mul = %x" % tmp2)
    tmp = ((tmp + tmp2) ^ 0xee380db3) & 0xffffffffffffffff
    if debug:
        print("K5OW1C = %x" % tmp)
    tmp2 = S * 0x9ef3e7
    if debug:
        print("S mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) - 0x6deaa90b) & 0xffffffffffffffff
    if debug:
        print("K5OW1CS = %x" % tmp)
    tmp2 = G * 0x69c573
    if debug:
        print("G mul = %x" % tmp2)
    tmp = (tmp + tmp2 - 0xc9ac5c5d) & 0xffffffffffffffff
    if debug:
        print("K5OW1CSG = %x" % tmp)
    return (tmp - 0xfffffffdf3ba3f0d) & 0xffffffffffffffff

def batch4(L, Six, X, H, P, D, Two, T, debug=False):
    tmp = ((L * 0x67dda4) + 0xf4753afc) & 0xffffffffffffffff
    if debug:
        print("L mul = %x" % tmp)
    tmp2 = Six * 0x5bb860
    if debug:
        print("6 mul = %x" % tmp2)
    tmp = ((tmp + tmp2) ^ 0xc1d47fc9) & 0xffffffffffffffff
    if debug:
        print("L6 = %x" % tmp)
    tmp2 = X * 0xab0ce5
    if debug:
        print("X mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) + 0x544ff977) & 0xffffffffffffffff
    if debug:
        print("L6X = %x" % tmp)
    tmp2 = H * 0x148e94
    if debug:
        print("H mul = %x" % tmp2)
    tmp = ((tmp + tmp2) - 0x9cb3e419) & 0xffffffffffffffff
    if debug:
        print("L6XH = %x" % tmp)
    tmp2 = P * 0x9e06ae
    if debug:
        print("P mul = %x" % tmp2)
    tmp = ((tmp - tmp2) - 0xadc62064) & 0xffffffffffffffff
    if debug:
        print("L6XHP = %x" % tmp)
    tmp2 = D * 0xfb9de1
    if debug:
        print("D mul = %x" % tmp2)
    tmp = ((tmp ^ tmp2) ^ 0x4e3633f7) & 0xffffffffffffffff
    if debug:
        print("L6XHPD = %x" % tmp)
    tmp2 = Two * 0xa8a511
    if debug:
        print("2 mul = %x" % tmp2)
    tmp = ((tmp - tmp2) ^ 0xa61f9208) & 0xffffffffffffffff
    if debug:
        print("L6XHPD2 = %x" % tmp)
    tmp2 = T * 0xd3468d
    if debug:
        print("T mul = %x" % tmp2)
    tmp = (tmp + tmp2 + 0x4a5d7b48) & 0xffffffffffffffff
    if debug:
        print("L6XHPD2T = %x" % tmp)
    return (tmp - 0xffffffffef6412a2) & 0xffffffffffffffff

def batch5(a1, a2, a3, a4, a5, a6, a7, a8):
    tmp = ((a1 * 0x640ba9) + 0x516c7a5c) & 0xffffffffffffffff
    tmp2 = a2 * 0xf1d9e5
    tmp = ((tmp - tmp2) + 0x8b424d6b) & 0xffffffffffffffff
    tmp2 = a3 * 0xd3e2f8
    tmp = ((tmp + tmp2) + 0x3802be78) & 0xffffffffffffffff
    tmp2 = a4 * 0xb558ce
    tmp = ((tmp + tmp2) - 0x33418c8e) & 0xffffffffffffffff
    tmp2 = a5 * 0x2f03a7
    tmp = ((tmp - tmp2) ^ 0xe050b170) & 0xffffffffffffffff
    tmp2 = a6 * 0xb8fa61
    tmp = ((tmp + tmp2) ^ 0x1fc22df6) & 0xffffffffffffffff
    tmp2 = a7 * 0xe0c507
    tmp = ((tmp - tmp2) ^ 0xd8376e57) & 0xffffffffffffffff
    tmp2 = a8 * 0x8e354e
    tmp = (tmp + tmp2 - 0xd2cb3108) & 0xffffffffffffffff
    return (tmp - 0x100e79080) & 0xffffffffffffffff

def batch6(a1, a2, a3, a4, a5, a6, a7, a8):
    tmp = ((a1 * 0xa9b448) ^ 0x9f938499) & 0xffffffffffffffff
    tmp2 = a2 * 0x906550
    tmp = ((tmp + tmp2) + 0x407021af) & 0xffffffffffffffff
    tmp2 = a3 * 0xaa5ad2
    tmp = ((tmp ^ tmp2) ^ 0x77cf83a7) & 0xffffffffffffffff
    tmp2 = a4 * 0xc49349
    tmp = ((tmp ^ tmp2) ^ 0x3067f4e7) & 0xffffffffffffffff
    tmp2 = a5 * 0x314f8e
    tmp = ((tmp + tmp2) + 0xcd975f3b) & 0xffffffffffffffff
    tmp2 = a6 * 0x81968b
    tmp = ((tmp ^ tmp2) + 0x893d2e0b) & 0xffffffffffffffff
    tmp2 = a7 * 0x5ffbac
    tmp = ((tmp - tmp2) ^ 0xf3378e3a) & 0xffffffffffffffff
    tmp2 = a8 * 0xf63c8e
    tmp = (tmp - tmp2 - 0x1c1d882b) & 0xffffffffffffffff
    return (tmp - 0x28e5eb48d) & 0xffffffffffffffff

def batch7(a1, a2, a3, a4, a5, a6, a7, a8):
    tmp = ((a1 * 0xa6edf9) ^ 0x77c58017) & 0xffffffffffffffff
    tmp2 = a2 * 0xe87bf4
    tmp = ((tmp - tmp2) - 0x999bd740) & 0xffffffffffffffff
    tmp2 = a3 * 0x19864d
    tmp = ((tmp - tmp2) - 0x41884bed) & 0xffffffffffffffff
    tmp2 = a4 * 0x901524
    tmp = ((tmp + tmp2) ^ 0x247bf095) & 0xffffffffffffffff
    tmp2 = a5 * 0xc897cc
    tmp = ((tmp ^ tmp2) ^ 0xeff7eea8) & 0xffffffffffffffff
    tmp2 = a6 * 0x731197
    tmp = ((tmp ^ tmp2) + 0x67a0d262) & 0xffffffffffffffff
    tmp2 = a7 * 0x5f591c
    tmp = ((tmp + tmp2) + 0x316661f9) & 0xffffffffffffffff
    tmp2 = a8 * 0x579d0e
    tmp = (tmp + tmp2 - 0x3427fa1c) & 0xffffffffffffffff
    return (tmp - 0x900d744b) & 0xffffffffffffffff

def checkKeys(matchFname, batchfunc):
    print("Sanity Checking %s against %s" % (matchFname, batchfunc.__name__))
    lines = readMatches(matchFname) 
    counter = 0
    for x in lines:
        guess = [ord(x[0]), ord(x[1]), ord(x[2]), ord(x[3]), ord(x[4]), ord(x[5]), ord(x[6]), ord(x[7])]
        tmp = batchfunc(guess[0], guess[1], guess[2], guess[3], guess[4], guess[5], guess[6], guess[7])
        counter += 1
        if tmp != 0:
            print("Wrong guess!!")
            print(guess)
            print("----------")
    print("Key Checks Done. Checked %d keys" % counter)

def getValidKeys(initialKey, positions, matchFname):
    template = list(initialKey)
    output = []

    lines = readMatches(matchFname) 
    for x in lines:
        guess = [ord(x[0]), ord(x[1]), ord(x[2]), ord(x[3]), ord(x[4]), ord(x[5]), ord(x[6]), ord(x[7])]
        for i in range(8):
            template[positions[i]] = chr(guess[i])
        # print("".join(template))
        output.append("".join(template))
    return output

def match15():
    # Pass the results of matches1 into batch5, valid candidates should return 0 as well
    # Take care to rearrange the input into the correct order/position
    # m1_pos = [4, 24, 0, 8, 20, 16, 12, 28]
    # m5_pos = [12, 0, 28, 24, 8, 16, 20, 4]
    m1 = readMatches("matches1.txt")
    combine_matches = []
    for x in m1:
        tmp = batch5(ord(x[6]), ord(x[2]), ord(x[7]), ord(x[1]), ord(x[3]), ord(x[5]), ord(x[4]), ord(x[0]))
        if tmp == 0:
            print("Match Found!")
            print(x)
            combine_matches.append(x)
    return combine_matches

def match26():
    # Pass the results of matches2 into batch6, valid candidates should return 0 as well
    # Take care to rearrange the input into the correct order/position
    # m2_pos = [17, 5, 21, 1, 13, 29, 25, 9]
    # m6_pos = [17, 5, 13, 29, 9, 21, 25, 1]
    m1 = readMatches("matches2.txt")
    combine_matches = []
    for x in m1:
        tmp = batch6(ord(x[0]), ord(x[1]), ord(x[4]), ord(x[5]), ord(x[7]), ord(x[2]), ord(x[6]), ord(x[3]))
        if tmp == 0:
            print("Match Found!")
            print(x)
            combine_matches.append(x)
    return combine_matches

def match37():
    # Pass the results of matches3 into batch7, valid candidates should return 0 as well
    # Take care to rearrange the input into the correct order/position
    # m3_pos = [10, 30, 14, 22, 26, 2, 18, 6]
    # m7_pos = [22, 18, 2, 6, 10, 14, 30, 26]
    m1 = readMatches("matches3.txt")
    combine_matches = []
    for x in m1:
        tmp = batch7(ord(x[3]), ord(x[6]), ord(x[5]), ord(x[7]), ord(x[0]), ord(x[2]), ord(x[1]), ord(x[4]))
        if tmp == 0:
            print("Match Found!")
            print(x)
            combine_matches.append(x)
    return combine_matches

def main():
    # sanity checks
    # print(hex(batch1(ord("E"), ord("Y"), ord("A"), ord("I"), ord("U"), ord("Q"), ord("M"), ord("3"), False))) # shld return 0xa91e7aa
    # print(hex(batch1(36, 119, 35, 119, 81, 61, 114, 43, True))) # shld return 0xa91e7aa
    # print(hex(batch2(ord("R"), ord("F"), ord("V"), ord("B"), ord("N"), ord("4"), ord("Z"), ord("J"), False))) # shld return 0x32fed13f
    # print(hex(batch3(ord("K"), ord("5"), ord("O"), ord("W"), ord("1"), ord("C"), ord("S"), ord("G"), False))) # shld return 0x54f51e8b
    # print(hex(batch4(ord("L"), ord("6"), ord("X"), ord("H"), ord("P"), ord("D"), ord("2"), ord("T"), False))) # shld return 0xd088f284
    # print(hex(batch5(ord("0"), ord("2"), ord("D"), ord("1"), ord("p"), ord("E"), ord("O"), ord("4")))) # shld return 0xffffffffae88f5c4
    # print(hex(batch6(ord("L"), ord("v"), ord("G"), ord("e"), ord("q"), ord("e"), ord("p"), ord("0")))) # shld return 0x1ec612c
    # print(hex(batch7(ord("K"), ord("K"), ord("P"), ord("g"), ord("E"), ord("V"), ord("8"), ord("9")))) # shld return 0xffffffff800a8f0e

    # checkKeys("matches1.txt", batch1)
    # valid1 = getValidKeys("ABCDEFGHIJKLMNOPQRSTUVWXYZ123456", [4, 24, 0, 8, 20, 16, 12, 28], "matches1.txt")
    # writeKeysToFile(valid1, "validKeys1.txt")

    # checkKeys("matches2.txt", batch2)
    # valid2 = getValidKeys("2BCD4FGHpJKL0NOPERSTOVWX1Z12D456", [17, 5, 21, 1, 13, 29, 25, 9], "matches2.txt")
    # writeKeysToFile(valid2, "validKeys2.txt")

    # checkKeys("matches3.txt", batch3)
    # valid3 = getValidKeys("20CD4vGHpqKL0GOPELSTOeWX1p12De56", [10, 30, 14, 22, 26, 2, 18, 6], "matches3.txt")
    # writeKeysToFile(valid3, "validKeys3.txt")

    # checkKeys("matches4.txt", batch4)
    # valid4 = getValidKeys("20PD4vgHpqEL0GVPELKTOeKX1p92De86", [11, 31, 23, 7, 15, 3, 27, 19], "matches4.txt")
    # writeKeysToFile(valid4, "validKeys4.txt")

    # Matching between Phase 1 and 5
    # m15 = match15()
    # print(m15)
    # writeKeysToFile(m15, "matches1_5.txt")
    # print(getValidKeys("20P14vgopqEI0GVzELKROeKh1p9uDe89", [4, 24, 0, 8, 20, 16, 12, 28], "matches1_5.txt"))
    # print("") # $0P1lvgo5qEIeGVzoLKRgeKhdp9uve89

    # Matching between Phase 2 and 6
    # m26 = match26()
    # writeKeysToFile(m26, "matches2_6.txt")
    # print(getValidKeys("$0P1lvgo5qEIeGVzoLKRgeKhdp9uve89", [17, 5, 21, 1, 13, 29, 25, 9], "matches2_6.txt"))
    # print("") # $$P1lwgo5_EIepVzovKRg_Khd_9uvi89

    # Matching between Phase 3 and 7
    # m37 = match37()kIep_z
    # writeKeysToFile(m37, "matches3_7.txt")
    # print(getValidKeys("$$P1lwgo5_EIepVzovKRg_Khd_9uvi89", [10, 30, 14, 22, 26, 2, 18, 6], "matches3_7.txt"))
    # print("") # $$_1lwao5_kIep_zov1Rg_ahd_muvin9

    # Generate final candidates for last phase
    finalcand = getValidKeys("$$_1lwao5_kIep_zov1Rg_ahd_muvin9", [11, 31, 23, 7, 15, 3, 27, 19], "matches4.txt")
    writeKeysToFile(finalcand, "zFinalCandidates.txt")

if "__main__" == __name__:
    main()