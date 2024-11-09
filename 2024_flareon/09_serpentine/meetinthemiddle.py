import itertools

def left1(E, Y, A, I):
    tmp = ((E * 0xEF7A8C) + 0x9d865d8d) & 0xffffffffffffffff
    tmp2 = Y * 0x45b53c
    tmp = (tmp - tmp2 + 0x18baee57) & 0xffffffffffffffff
    tmp2 = A * 0xE4CF8B
    tmp = (tmp - tmp2 - 0x913fbbde) & 0xffffffffffffffff
    tmp2 = I * 0xf5c990
    tmp = (tmp - tmp2 + 0x6bfaa656) & 0xffffffffffffffff
    return tmp

def right1(U, Q, M, Three):
    tmp = 0xffffffff81647a79 ^ 0x5c911d23
    tmp2 = Three * 0xe21d3d
    tmp = (tmp ^ tmp2 ^ 0x5a6f68be) & 0xffffffffffffffff
    tmp2 = M * 0x773850
    tmp = ((tmp ^ tmp2) + 0xca2804b1) & 0xffffffffffffffff
    tmp2 = Q * 0x9a17b8
    tmp = (tmp ^ tmp2 ^ 0x61e3db3b) & 0xffffffffffffffff
    tmp2 = U * 0x733178
    tmp = (tmp ^ tmp2) & 0xffffffffffffffff
    return tmp

def left2(R, F, V, B):
    tmp = ((R * 0x99aa81) - 0x74edea51) & 0xffffffffffffffff
    tmp2 = F * 0x4aba22
    tmp = ((tmp ^ tmp2) + 0x598015bf) & 0xffffffffffffffff
    tmp2 = V * 0x91a68a
    tmp = (tmp ^ tmp2 ^ 0x6df18e52) & 0xffffffffffffffff
    tmp2 = B * 0x942fde
    tmp = ((tmp ^ tmp2) + 0x15c825ee) & 0xffffffffffffffff
    return tmp

def right2(N, Four, Z, J):
    tmp = (0xe1148bae - 0x921122d3) & 0xffffffffffffffff
    tmp2 = J * 0xaf71d6
    tmp = (tmp - tmp2 + 0xe66d523e) & 0xffffffffffffffff
    tmp2 = Z * 0xe44f6a
    tmp = ((tmp ^ tmp2) - 0x798bd018) & 0xffffffffffffffff
    tmp2 = Four * 0xd7e52f
    tmp = (tmp + tmp2 - 0xd5682b64) & 0xffffffffffffffff
    tmp2 = N * 0xfe2fbe
    tmp = (tmp + tmp2) & 0xffffffffffffffff
    return tmp

def left3(K, Five, O, W):
    tmp = ((K * 0x48c500) - 0x8fdaa1bc) & 0xffffffffffffffff
    tmp2 = Five * 0x152887
    tmp = ((tmp - tmp2) + 0x65f04e48) & 0xffffffffffffffff
    tmp2 = O * 0xaa4247
    tmp = ((tmp - tmp2) ^ 0x3d63ec69) & 0xffffffffffffffff
    tmp2 = W * 0x38d82d
    tmp = ((tmp ^ tmp2) ^ 0x872eca8f) & 0xffffffffffffffff
    return tmp

def right3(One, C, S, G):
    tmp = (0xfffffffdf3ba3f0d + 0xc9ac5c5d) & 0xffffffffffffffff
    tmp2 = G * 0x69c573
    tmp = (tmp - tmp2 + 0x6deaa90b) & 0xffffffffffffffff
    tmp2 = S * 0x9ef3e7
    tmp = ((tmp ^ tmp2) ^ 0xee380db3) & 0xffffffffffffffff
    tmp2 = C * 0x254def
    tmp = (tmp - tmp2 - 0x803dbdcf) & 0xffffffffffffffff
    tmp2 = One * 0xf120ac
    tmp = (tmp ^ tmp2) & 0xffffffffffffffff
    return tmp

def left4(L, Six, X, H):
    tmp = ((L * 0x67dda4) + 0xf4753afc) & 0xffffffffffffffff
    tmp2 = Six * 0x5bb860
    tmp = ((tmp + tmp2) ^ 0xc1d47fc9) & 0xffffffffffffffff
    tmp2 = X * 0xab0ce5
    tmp = ((tmp ^ tmp2) + 0x544ff977) & 0xffffffffffffffff
    tmp2 = H * 0x148e94
    tmp = ((tmp + tmp2) - 0x9cb3e419) & 0xffffffffffffffff
    return tmp

def right4(P, D, Two, T):
    tmp = (0xffffffffef6412a2 - 0x4a5d7b48) & 0xffffffffffffffff
    tmp2 = T * 0xd3468d
    tmp = ((tmp - tmp2) ^ 0xa61f9208) & 0xffffffffffffffff
    tmp2 = Two * 0xa8a511
    tmp = ((tmp + tmp2) ^ 0x4e3633f7) & 0xffffffffffffffff
    tmp2 = D * 0xfb9de1
    tmp = ((tmp ^ tmp2) + 0xadc62064) & 0xffffffffffffffff
    tmp2 = P * 0x9e06ae
    tmp = (tmp + tmp2) & 0xffffffffffffffff
    return tmp

def left5(a1, a2, a3, a4):
    tmp = ((a1 * 0x640ba9) + 0x516c7a5c) & 0xffffffffffffffff
    tmp2 = a2 * 0xf1d9e5
    tmp = ((tmp - tmp2) + 0x8b424d6b) & 0xffffffffffffffff
    tmp2 = a3 * 0xd3e2f8
    tmp = ((tmp + tmp2) + 0x3802be78) & 0xffffffffffffffff
    tmp2 = a4 * 0xb558ce
    tmp = ((tmp + tmp2) - 0x33418c8e) & 0xffffffffffffffff
    return tmp

def right5(a5, a6, a7, a8):
    tmp = (0x100e79080 + 0xd2cb3108) & 0xffffffffffffffff
    tmp2 = a8 * 0x8e354e
    tmp = ((tmp - tmp2) ^ 0xd8376e57) & 0xffffffffffffffff
    tmp2 = a7 * 0xe0c507
    tmp = ((tmp + tmp2) ^ 0x1fc22df6) & 0xffffffffffffffff
    tmp2 = a6 * 0xb8fa61
    tmp = ((tmp - tmp2) ^ 0xe050b170) & 0xffffffffffffffff
    tmp2 = a5 * 0x2f03a7
    tmp = (tmp + tmp2) & 0xffffffffffffffff
    return tmp

def get_generator():
    res = itertools.product(range(33,127) ,repeat=4)
    for guess in res:
        yield guess

def meetinthemiddle(leftfunc, rightfunc, matchfname):
    left_generator = get_generator()
    right_generator = get_generator()

    left_results = {}
    right_results = {}
    counter = 0

    print("Generating Left using %s" % leftfunc.__name__)
    for guess in left_generator:
        counter += 1
        if counter % 10000000 == 0:
            print("%s %d" % ("Still generating left", counter))
        tmp_left = leftfunc(guess[0], guess[1], guess[2], guess[3])
        left_results[tmp_left] = guess

    print("Generating Right using %s" % rightfunc.__name__)
    for guess in right_generator:
        counter += 1
        if counter % 10000000 == 0:
            print("%s %d" % ("Still generating right", counter))
        tmp_right = rightfunc(guess[0], guess[1], guess[2], guess[3])
        right_results[tmp_right] = guess

    print("Matching...")
    with open(matchfname, "w") as matchfile:
        for left_sum, left_guess in left_results.items():
            counter += 1
            if counter % 10000000 == 0:
                print("%s %d" % ("Still matching", counter))
            if left_sum in right_results:
                right_guess = right_results[left_sum]
                total_guess = left_guess + right_guess
                outchars = ""
                for x in total_guess:
                    outchars += chr(x)
                # print("Match Found: \"%s\"" % outchars)
                matchfile.write(outchars+"\n")

    print("Done")

def main():
    # meetinthemiddle(left1, right1, "matches1.txt")
    meetinthemiddle(left2, right2, "matches2.txt")
    # meetinthemiddle(left3, right3, "matches3.txt")
    # meetinthemiddle(left4, right4, "matches4.txt")
    # meetinthemiddle(left5, right5, "matches5.txt")

if "__main__" == __name__:
    main()
