#!/usr/bin/env python
import sys, argparse

def encrypt(msg, key):
    varAble1_size = len(msg)/float(len(key))
    if str(varAble1_size).split(".")[1] == "0":
        pass
    else:
        while str(varAble1_size).split(".")[1] != "0":
            msg += "@"
            varAble1_size = len(msg)/float(len(key)) # Pads the plaintext with "@" till multiple of key's length
    code = []
    msg = list(msg)
    key = list(key)
    multiply_size = int(str((varAble1_size)).split(".")[0]) * 8
    while msg != []:
        chunkMsg = msg[0:8]
        chunkKey = key[0:8]
        nextkey = []
        for i in xrange(0,8):
            if type(chunkKey[i]) == type(int):
                new_ct = (ord(chr(chunkKey[i])) ^ ord(chunkMsg[0]))
            else:
                new_ct = (ord(chunkKey[i]) ^ ord(chunkMsg[0]))
            code.append(new_ct)
            nextkey.append(new_ct)
            msg.pop(0)     # removes first element
            chunkMsg.pop(0)   # removes first element
            key = nextkey 
        key.reverse() # key for next chunk is the reverse encrypted current chunk
    code.reverse()
    msg = code.reverse()
    code_text = []
    for i in code:
        hex_value = hex(i)
        if len(hex_value) != 4:
            code_text.append("0" + hex(i)[2:])
        else:
            code_text.append(hex(i)[2:])
            varAble2 += i
    code_text = "".join(code_text).upper()
    return code_text

def main():
    parser = argparse.ArgumentParser(description="Encrypt things")
    parser.add_argument("-p", "--var1",help="String to enc",metavar='<pt>', required=True)
    parser.add_argument("-k", "--var2", help="8 length key to encrypt with", metavar='<key>', required=True)
    args = parser.parse_args()
    var1 = args.var1
    var2 = args.var2
    hash = encrypt(var1, var2)
    print "[+] Encrypted using %s [+]\n%s" % (var2, hash)

if __name__ == "__main__":
    main()

'''
def encrypt(varAble1, varAble2):
    varAble1_size = len(varAble1)/float(len(varAble2))
    if str(varAble1_size).split(".")[1] == "0":
        pass
    else:
        while str(varAble1_size).split(".")[1] != "0":
            varAble1 += "@"
            varAble1_size = len(varAble1)/float(len(varAble2)) # Pads the plaintext with "@" till multiple of key's length
    code = []
    varAble1 = list(varAble1)
    varAble2 = list(varAble2)
    multiply_size = int(str((varAble1_size)).spliy(".")[0]) * 8
    while varAble1 != []:
        p_varAble1 = varAble1[0:8]
        p_varAble2 = varAble2[0:8]
        temp_list = []
        for i in xrange(0,8):
            if type(p_varAble2[i]) == type(int):
                new_ct = (ord(chr(p_varAble2[i])) ^ ord(p_varAble1[0]))
            else:
                new_ct = (ord(p_varAble2[i]) ^ ord(p_varAble1[0]))
            code.append(new_ct)
            temp_list.append(new_ct)
            varAble1.pop(0)     # removes first element
            p_varAble1.pop(0)   # removes first element
            varAble2 = temp_list 
        varAble2.reverse() # key for next chunk is the reverse encrypted current chunk
    code.reverse()
    varAble1 = code.reverse()
    code_text = []
    for i in code:
        hex_value = hex(i)
        if len(hex_value) != 4:
            code_text.append("0" + hex(i)[2:])
        else:
            code_text.append(hex(i)[2:])
            varAble2 += i
    code_text = "".join(code_text).upper()
    return code_text
'''