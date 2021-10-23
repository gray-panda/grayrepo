import itertools
import binascii
import hashlib

flotsam = {"3": "DFWEyEW", "4": "PXopvM", "13": "BGgsuhn"}
jetsam = {"7": "newaui", "10": "HwdwAZ", "11": "SLdkv"}

initial = bytes.fromhex("9625A4A9A3969A909FAFE538F9819E16F9CBE4A4878F8FBAD29DA7D1FCA3A800")
target_md5 = "6c5215b12a10e936f8de1e42083ba184"

def gen_flotsam():
    choices = ['3', '4', '13']
    for x in itertools.product(choices, repeat=5):
        yield x
        
        
def gen_jetsam():
    choices = ['7', '10', '11']
    for y in itertools.product(choices, repeat=3):
        yield y
        
def gen_md5_input(flot, jet):
    global initial
    md5_input = b""
    for i in range(31):
        tmp = initial[i] ^ ord(flot[i % len(flot)])
        tmp = (tmp - ord(jet[i % 0x11])) & 0xff
        md5_input += bytes([tmp])
    return md5_input
        
        
flotsam_generator = gen_flotsam()
for flot in flotsam_generator:
    jetsam_generator = gen_jetsam()
    for jet in jetsam_generator:
    
        ff = ""
        for f in flot:
            ff += flotsam[f]
            
        jj = ""
        for j in jet:
            jj += jetsam[j]
            
        if len(jj) < 0x11:
            continue
            
        #print("%s : %s" % (ff, jj))
        val = gen_md5_input(ff, jj) # binascii.hexlify(val)
        md5ed = hashlib.md5(val).hexdigest()
        print("%s : %s = %s" % (ff, jj, md5ed))
        if md5ed == target_md5:
            print("Found")
            exit()
            
            
'''
PXopvMDFWEyEWBGgsuhnPXopvMDFWEyEW : SLdkvnewauiHwdwAZ = 6c5215b12a10e936f8de1e42083ba184

PXopvM DFWEyEW BGgsuhn PXopvM DFWEyEW 4 3 13 4 3

SLdkv newaui HwdwAZ 11 7 10

s1gn_my_gu357_b00k@flare-on.com
'''