import itertools

# Rotate functions

def rol8(n, d):
    res = (n << d)|(n >> (8 - d))
    res = res & 0xff
    return res

def ror8(n, d):
    res = (n >> d)|(n << (8 - d))
    res = res & 0xff
    return res

def rol32(n, d):
    res = (n << d)|(n >> (32 - d))
    res = res & 0xffffffff
    return res

def ror32(n, d):
    res = (n >> d)|(n << (32 - d))
    res = res & 0xffffffff
    return res

def solve1():
    # cat1
    print("---cat1---")
    # key[2] rol 4 ; 4 => C
    # key[9] ror 2 ; 1 => L
    # key[d] rol 7 ; b => 1
    # key[f] rol 7 ; b => 1
    key = list("Da4ubicle1ifeb0b")
    key[2] = chr(rol8(ord(key[2]), 4))
    key[9] = chr(ror8(ord(key[9]), 2))
    key[0xd] = chr(rol8(ord(key[0xd]), 7))
    key[0xf] = chr(rol8(ord(key[0xf]), 7))
    print("".join(key))
    print("---------------")
    print("")

##################################

def getXorStream():
    cur = 0x1337
    xorstream = [0] * 16
    for i in range(16):
        cur = ((cur * 0x343fd) + 0x269ec3) % 0x80000000
        tmp = cur
        tmp = cur >> (i%4)*8
        tmp = tmp & 0xff
        xorstream[i] = tmp
    return xorstream

def solve2():
    print("---cat2---")
    enc = bytes.fromhex("59a0 4d6a 23de c024 e264 b159 0772 5c7f")
    xorstream = getXorStream()
    print("Keystream: %s" % xorstream)
    pw = ""
    for i in range(len(enc)):
        tmp = enc[i] ^ xorstream[i]
        pw += chr(tmp)
    print(pw)

#######################################

def get_generator(bytesize):
    res = itertools.product(range(33,127) ,repeat=bytesize)
    for guess in res:
        yield guess

def get_alphanumeric_generator(bytesize):
    alphanumeric = '0123456789' + 'abcdefghijklmnopqrstuvwxyz' + 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    alphanumeric = [ord(x) for x in alphanumeric]
    res = itertools.product(alphanumeric ,repeat=bytesize)
    for guess in res:
        yield guess

def hash1(inputBytes):
    # run for 4 bytes (target 0x7c8df4cb)
    cur = 0x1505
    for x in inputBytes:
        tmp = cur
        cur = (cur << 5) + tmp + x
    return cur & 0xffffffff
        
def hash2(inputBytes):
    # run for 4 byytes (target 0x8b681d82)
    cur = 0
    for x in inputBytes:
        cur = ror32(cur, 0xd)
        cur = cur + x
    return cur

def hash3(inputBytes):
    # run for 8 bytes (target 0x0f910374)
    x = 1
    y = 0
    for z in inputBytes:
        x = (x + z) % 0xfff1
        y = (y + x) % 0xfff1
    return ((y << 0x10) | x) & 0xffffffff

def hash4(inputBytes):
    # run for 16 bytes (target 31f009d2)
    cur = 0x811c9dc5
    for x in inputBytes:
        cur = (cur * 0x1000193) % 0x100000000
        cur = cur ^ x
    return cur & 0xffffffff

def brute(targetNum, hashfunc, bytesize):
    # guess_generator = get_generator(bytesize)
    guess_generator = get_alphanumeric_generator(bytesize)
    correct = []
    for guess in guess_generator:
        # print(guess)
        cur = hashfunc(guess)
        # print(hex(cur))
        if cur == targetNum:
            # print("Hash Matched: %s 0x%x " % (guess, cur))
            gg = "".join([chr(g) for g in guess])
            correct.append(gg)
            # break
    return correct

# Recursive Search Parameters and Output (for hash3)
def sumY(xlist, numchars):
    sum = 0
    for i in range(numchars+1):
        sum += xlist[i]
    return sum

minZ = 48 # '0'
maxZ = 123 # 'z'
alphanumeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 'abcdefghijklmnopqrstuvwxyz' +'0123456789'
alphanumeric = [ord(x) for x in alphanumeric]

maxAscii = 122  # 'z'
minAscii = 48   # '0'
maxX = [1, (maxAscii*1)+1, (maxAscii*2)+1, (maxAscii*3)+1, (maxAscii*4)+1, (maxAscii*5)+1, (maxAscii*6)+1, (maxAscii*7)+1, (maxAscii*8)+1]
maxY = [0, sumY(maxX, 1), sumY(maxX, 2), sumY(maxX, 3), sumY(maxX, 4), sumY(maxX, 5), sumY(maxX, 6), sumY(maxX, 7), sumY(maxX, 8)]
minX = [1, (minAscii*1)+1, (minAscii*2)+1, (minAscii*3)+1, (minAscii*4)+1, (minAscii*5)+1, (minAscii*6)+1, (minAscii*7)+1, (minAscii*8)+1]
minY = [0, sumY(minX, 1), sumY(minX, 2), sumY(minX, 3), sumY(minX, 4), sumY(minX, 5), sumY(minX, 6), sumY(minX, 7), sumY(minX, 8)]

recurseCounter = 0
matchCount = 0

def recurseSearch(X, Y, level, guess, f):
    global minZ, alphanumeric, recurseCounter, maxX, maxY, minX, minY, matchCount

    # print("X: %d Y: %d CurGuess %s Level : %d" % (X, Y, guess, level))
    recurseCounter += 1
    if recurseCounter % 1000000 == 0:
        print("Iterations : %d million (Current %d matches)" % ((recurseCounter // 1000000), matchCount))

    if level == 1:
        # Ending point
        if X != Y or X < minZ or X > maxZ:
            return False # prune the tree
        else:
            candidate = guess + [X-1]
            possible_pw = "".join([chr(a) for a in candidate][::-1])
            # recurse3Candidates.append(possible_pw)
            f.write(possible_pw+"\n")
            matchCount += 1
            return True
    else:
        # Check Min/Max Numbers
        if X > maxX[level] or X < minX[level] or Y > maxY[level] or Y < minY[level]:
            return False # prune the tree
        
        prevY = Y-X
        if prevY < minZ:
            return False # prune the tree
        for Z in alphanumeric:
            nextguess = guess + [Z]
            prevX = X-Z
            if prevX < minZ:
                continue # prune the tree
            res = recurseSearch(prevX, prevY, level-1, nextguess, f)
    

def brute_pw4(pw1, pw2, pw3):
    counter = 0
    for p1 in pw1:
        for p2 in pw2:
            for p3 in pw3:
                counter += 1
                if counter % 1000000 == 0:
                    print("Brute4 Iterations: %d million" % (counter // 1000000))
                curpw  = p1 + p2 + p3
                # print(curpw)
                tmp = hash4([ord(x) for x in curpw])
                if tmp == 0x31f009d2:
                    print("Match Found: %s" % curpw)
                    return

def solve3():
    pw1 = brute(0x7c8df4cb, hash1, 4)
    print("\nHash1 candidates: %s \n" % pw1)
    pw1 = ['Veqz', 'VerY', 'Ves8', 'VfPz', 'VfQY', 'VfR8', 'Vg0Y', 'Vg18', 'WDqz', 'WDrY', 'WDs8', 'WEPz', 'WEQY', 'WER8', 'WF0Y', 'WF18']
    
    pw2 = brute(0x8b681d82, hash2, 4)
    print("\nHash2 candidates: %s \n" % pw2)
    pw2 = ['DumB']

    # pw3 = brute(0x0f910374, hash3, 8)  # Not feasible, search space too big

    # print(hex(hash3([ord(x) for x in "ABCDEFGH"])))
    # print(hex(hash3([ord(x) for x in "4N5VIKBA"])))
    # recurseSearch(0x10b, 0x298, 4, []) # ABCD
    # recurseSearch(0x225, 0x980, 8, []) # ABCDEFGH

    # print("maxX : %s" % maxX)
    # print("maxY : %s" % maxY)
    # print("minX : %s" % minX)
    # # print("minY : %s" % minY)
    # with open("pw3.txt", "w") as outfile:
    #     recurseSearch(0x374, 0xf91, 8, [], outfile) # 0x0f910374

    # with open("pw3.txt", "r") as f:
    #     data = f.read()
    # pw3 = data.split("\n")

    # brute_pw4(pw1, pw2, pw3)

def main():
    # solve1()  # DaCubicleLife101
    # solve2()  # G3tDaJ0bD0neM4te
    solve3()    # VerYDumBpassword

if "__main__" == __name__:
    main()
