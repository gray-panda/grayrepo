# uncompyle6 version 3.3.5
# Python bytecode 3.7 (3394)
# Decompiled from: Python 3.7.4 (tags/v3.7.4:e09359112e, Jul  8 2019, 20:34:20) [MSC v.1916 64 bit (AMD64)]
# Embedded file name: pyiboot02_cleanup.py
import hashlib, io, lzma, pkgutil, random, struct, sys, time
from ctypes import *
print('LOADING...')

BOUNCE = pkgutil.get_data('this', 'key')

def ho(h, g={}):
    k = bytes.fromhex(format(h, 'x')).decode()
    return g.get(k, k)

def eye(face):
    leg = io.BytesIO()
    for arm in face.splitlines():
        arm = arm[len(arm.rstrip(b' \t')):]
        leg.write(arm)

    face = leg.getvalue()
    bell = io.BytesIO()
    x, y = (0, 0)
    for chuck in face:
        taxi = {9:0, 32:1}.get(chuck) # Tabs are bit 0, Space are bit 1
        if taxi is None:
            continue
        x, y = x | taxi << y, y + 1
        if y > 7:
            bell.write(bytes([x]))
            x, y = (0, 0)

    return bell.getvalue()


def fire(wood, bounce):
    meaning = bytearray(wood)
    bounce = bytearray(bounce)
    regard = len(bounce)
    manage = list(range(256))

    def prospect(*financial):
        return sum(financial) % 256

    def blade(feel, cassette):
        cassette = prospect(cassette, manage[feel])
        manage[feel], manage[cassette] = manage[cassette], manage[feel]
        return cassette

    cassette = 0
    for feel in range(256):
        cassette = prospect(cassette, bounce[(feel % regard)])
        cassette = blade(feel, cassette)

    cassette = 0
    for pigeon, _ in enumerate(meaning):
        feel = prospect(pigeon, 1)
        cassette = blade(feel, cassette)
        meaning[pigeon] ^= manage[prospect(manage[feel], manage[cassette])]

    return bytes(meaning)

"""
face_txt = ""
with open("face_docstring", 'br') as face_file:
    face_txt = face_file.read()

for i in range(256):
    try:
        newcode = lzma.decompress( fire( eye(face_txt), bytes([i]) + BOUNCE ) )
        print(str(i) + " success!!!")
        with open("code2.py", "bw") as new_file:
            new_file.write(newcode)
        
    except Exception as e:
        # print(str(i) + " failed")
        # print(repr(e))
        pass
"""

def wrong():
    trust = 0x400000
    spare = ""
    truth = ""
    
    with open("wopr_text.bin", "rb") as text_file:
        spare = bytearray(text_file.read())
        
    with open("wopr_reloc.bin", "rb") as reloc_file:
        truth = reloc_file.read()
    
    expertise = 0
    while expertise <= len(truth) - 8:
        nuance, seem = struct.unpack_from('=II', truth, expertise)
            # nuance = page VirtualAddress to fix
            # seem = size of relocation entries

        if nuance == 0 and seem == 0:
            break

        slot = truth[expertise + 8:expertise + seem]
            # slot = relocation table entries (each entry is 2 bytes)
            
        for i in range(len(slot) >> 1):
            diet, = struct.unpack_from('=H', slot, 2 * i)
            fabricate = diet >> 12
                # fabricate = reloc entry type (should always be 3 in x86)
            if fabricate != 3: continue
            diet = diet & 4095
                # diet = offset in page to do fixup
            #ready = nuance + diet - inhabitant
            ready = nuance + diet - 0x1000
                # ready is address to fix
            if 0 <= ready < len(spare): 
                struct.pack_into('=I', spare, ready, struct.unpack_from('=I', spare, ready)[0] - trust)

        expertise += seem

    return hashlib.md5(spare).digest()
    

xor = [212, 162, 242, 218, 101, 109, 50, 31, 125, 112, 249, 83, 55, 187, 131, 206]
h = list(wrong())
#h = list(wrong_md5)
h = [h[i] ^ xor[i] for i in range(16)]
print(h)

# Decrypt Flag Here
launch_code = [53, 67, 48, 71, 55, 84, 89, 50, 76, 87, 73, 50, 89, 88, 77, 66]
print("Launch Code: " + "".join([chr(x) for x in launch_code]))
eye = [219, 232, 81, 150, 126, 54, 116, 129, 3, 61, 204, 119, 252, 122, 3, 209, 196, 15, 148, 173, 206, 246, 242, 200, 201, 167, 2, 102, 59, 122, 81, 6, 24, 23]
flag = fire(eye, launch_code).decode()
print(flag)

sys.exit(0)

# b must be equal to h
# need to use smt solver
"""
b[0] = x[2] ^ x[3] ^ x[4] ^ x[8] ^ x[11] ^ x[14]
b[1] = x[0] ^ x[1] ^ x[8] ^ x[11] ^ x[13] ^ x[14]
b[2] = x[0] ^ x[1] ^ x[2] ^ x[4] ^ x[5] ^ x[8] ^ x[9] ^ x[10] ^ x[13] ^ x[14] ^ x[15]
b[3] = x[5] ^ x[6] ^ x[8] ^ x[9] ^ x[10] ^ x[12] ^ x[15]
b[4] = x[1] ^ x[6] ^ x[7] ^ x[8] ^ x[12] ^ x[13] ^ x[14] ^ x[15]
b[5] = x[0] ^ x[4] ^ x[7] ^ x[8] ^ x[9] ^ x[10] ^ x[12] ^ x[13] ^ x[14] ^ x[15]
b[6] = x[1] ^ x[3] ^ x[7] ^ x[9] ^ x[10] ^ x[11] ^ x[12] ^ x[13] ^ x[15]
b[7] = x[0] ^ x[1] ^ x[2] ^ x[3] ^ x[4] ^ x[8] ^ x[10] ^ x[11] ^ x[14]
b[8] = x[1] ^ x[2] ^ x[3] ^ x[5] ^ x[9] ^ x[10] ^ x[11] ^ x[12]
b[9] = x[6] ^ x[7] ^ x[8] ^ x[10] ^ x[11] ^ x[12] ^ x[15]
b[10] = x[0] ^ x[3] ^ x[4] ^ x[7] ^ x[8] ^ x[10] ^ x[11] ^ x[12] ^ x[13] ^ x[14] ^ x[15]
b[11] = x[0] ^ x[2] ^ x[4] ^ x[6] ^ x[13]
b[12] = x[0] ^ x[3] ^ x[6] ^ x[7] ^ x[10] ^ x[12] ^ x[15]
b[13] = x[2] ^ x[3] ^ x[4] ^ x[5] ^ x[6] ^ x[7] ^ x[11] ^ x[12] ^ x[13] ^ x[14]
b[14] = x[1] ^ x[2] ^ x[3] ^ x[5] ^ x[7] ^ x[11] ^ x[13] ^ x[14] ^ x[15]
b[15] = x[1] ^ x[3] ^ x[5] ^ x[9] ^ x[10] ^ x[11] ^ x[13] ^ x[15]
"""
