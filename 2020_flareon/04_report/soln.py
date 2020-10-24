def rigmarole(instr):
    print("rigmarole %s" % instr)
    i = 0
    out = ""
    while i < len(instr):
        c1 = instr[i:i+2]
        c2 = instr[i+2:i+4]
        cc = int(c1,16) - int(c2, 16)
        out += chr(cc)
        # print("%s %s" % (c1, c2))
        i += 4
        
    return out
    
def canoodle(haystack, start_offset, num_bytes, key):
    i = start_offset
    counter = 0
    out = b""
    while i < len(haystack):
        if counter >= num_bytes:
            break
        
        tmp = int(haystack[i:i+2], 16) ^ key[counter % len(key)]
        out += bytes([tmp])
        
        counter += 1
        i += 4
        
    return out

def main():    
    data = "9655B040B64667238524D15D6201.B95D4E01C55CC562C7557405A532D768C55FA12DD074DC697A06E172992CAF3F8A5C7306B7476B38.C555AC40A7469C234424.853FA85C470699477D3851249A4B9C4E.A855AF40B84695239D24895D2101D05CCA62BE5578055232D568C05F902DDC74D2697406D7724C2CA83FCF5C2606B547A73898246B4BC14E941F9121D464D263B947EB77D36E7F1B8254.853FA85C470699477D3851249A4B9C4E.9A55B240B84692239624.CC55A940B44690238B24CA5D7501CF5C9C62B15561056032C468D15F9C2DE374DD696206B572752C8C3FB25C3806.A8558540924668236724B15D2101AA5CC362C2556A055232AE68B15F7C2DC17489695D06DB729A2C723F8E5C65069747AA389324AE4BB34E921F9421.CB55A240B5469B23.AC559340A94695238D24CD5D75018A5CB062BA557905A932D768D15F982D.D074B6696F06D5729E2CAE3FCF5C7506AD47AC388024C14B7C4E8F1F8F21CB64".split(".")

    print(data)
    for i in range(len(data)):
        print("%d: %s" % (i, rigmarole(data[i])))
        
    with open("hugestream.bin", "rb") as f:
        huge = f.read()
    
    mp3filename = "stomp.mp3"
    xorkey = b"\x11\x22\x33\x44\x55\x66\x77\x88\x99\xaa\xbb\xcc\xdd\xee"
    mp3 = canoodle(huge, 0, 168667, xorkey)
    with open(mp3filename, "wb") as f:
        f.write(mp3)
    print("MP3 written to %s" % mp3filename)
    
    
    key2 = b"FLARE-ON"[::-1]
    try2 = canoodle(huge, 2, 285729, key2)
    file2 = "v.png"
    with open(file2, "wb") as f:
        f.write(try2)
    print("PNG written to %s" % file2)
    
if __name__ == "__main__":
    main()
