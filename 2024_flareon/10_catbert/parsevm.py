def getCatVMInstructions(fname):
    with open(fname, "rb") as f:
        data = f.read()
    return data

def bytesToString(thebytes):
    out = ""
    for b in thebytes:
        out += "%02x " % b
    return out

def cat2words(ip, catbytes, msg):
    return "%04x: %10s %s" % (ip, bytesToString(catbytes), msg)

def parseVM(cat):
    vmlen = len(cat)
    ip = 0 # instruction pointer

    while ip < vmlen:
        cur = cat[ip]

        if cur == 1:
            operand = cat[ip+1:ip+3]
            catbytes = cat[ip:ip+3]
            msg = "push %x%x" % (operand[0], operand[1])
            line = cat2words(ip, catbytes, msg)
            ip += 2
        elif cur == 5:
            msg = "pop, push ldm [xx]"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 6:
            msg = "pop 2, stm [xx] = yy"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 9:
            msg = "pop 2, add them, push res"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0xd:
            msg = "pop 2, multiply them, push res"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0xe:
            operand = cat[ip+1:ip+3]
            catbytes = cat[ip:ip+3]
            msg = "jmp to %02x%02x" % (operand[0], operand[1])
            line = cat2words(ip, catbytes, msg)
            ip += 2
        elif cur == 0x10:
            operand = cat[ip+1:ip+3]
            catbytes = cat[ip:ip+3]
            msg = "jmp to %02x%02x if TOS == False" % (operand[0], operand[1])
            line = cat2words(ip, catbytes, msg)
            ip += 2
        elif cur == 0x11:
            msg = "pop 2, cmp == , push result"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x12:
            msg = "pop 2, cmp < , push result"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x14:
            msg = "pop 2, cmp > , push result"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x18:
            msg = "return"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x19:
            msg = "pop into validpw (must be 1 to continue)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x1a:
            msg = "pop, TOS ^ pop value (xor)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x1b:
            msg = "pop, TOS | pop value (or)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x1c:
            msg = "pop, TOS & pop value (and)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x1d:
            msg = "pop, TOS % pop value (modulo)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x1e:
            msg = "pop, TOS << pop value (shl)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x1f:
            msg = "pop, TOS >> pop value (shr)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x21:
            msg = "pop, TOS rotright 32bits pop value (ror32)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x24:
            msg = "pop, TOS rotleft 8bits pop value (rol8)"
            line = cat2words(ip, [cat[ip]], msg)
        elif cur == 0x25:
            msg = "pop, TOS rotright 8bits pop value (ror8)"
            line = cat2words(ip, [cat[ip]], msg)
        else:
            print("Unknown Instruction at ip 0x%x (0x%x)" % (ip, cur))
            break
        
        print(line)
        ip += 1
        
def main():
    cat1 = getCatVMInstructions("cat1vm.bin")
    parseVM(cat1)

    # cat2 = getCatVMInstructions("cat2vm.bin")
    # parseVM(cat2)

    # cat3 = getCatVMInstructions("cat3vm.bin")
    # parseVM(cat3)


if "__main__" == __name__:
    main()