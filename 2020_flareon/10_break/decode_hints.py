#x = bytes.fromhex("6f646867676a6a636d68666d6f69706669666d66656e62626267706b70656f696161")
x = "odhggjjcmhfmoipfifmfenbbbgpkpeoiaa"
print(x)

indict = "abcdefghijklmnop"
outdict = "0123456789abcdef"
translation = str.maketrans(indict, outdict)

print(bytes.fromhex("FEHCGBGDGFHCFAGJGEDKCACFGEAA".lower().translate(translation)))
print(bytes.fromhex("GFGMGGFPDAGOFPGBFPHDGIDDGMGGEAGPGOCNGGGMGBHCGFCOGDGPGNAA".lower().translate(translation)))
print(bytes.fromhex("gogphefpgbfpgggbglgffpgggmgbgheagogpcngggmgbhcgfcogdgpgnaa".lower().translate(translation)))
print(bytes.fromhex("HDGNDAGMFPGCGJGOFPGCDBGHFPGIDDDEHCHEEAGOGPCNGGGMGBHCGFCOGDGPGNAA".lower().translate(translation)))

print(bytes.fromhex("emgjglgfcagbcahagigpgfgogjhicmcaejcahcgjhdgfcagghcgpgncahegigfcagbhdgigfhdaa".lower().translate(translation)))
print(bytes.fromhex("ejcagigfgbhccafhgpgmgghcgbgncaebgmhagigbcagjhdcaghgpgpgecagbhecagegpgjgoghcahegigjgoghhdcahhgjhegicagcgjghcagohfgngcgfhchdcoaa".lower().translate(translation)))
print(bytes.fromhex("fegigjhdcagdgigbgmgmgfgoghgfcagjhdcahdgpcagfgbhdhjcagjhecagfhihagmgpgjhehdcagjhehdgfgmggcoaa".lower().translate(translation)))

print(bytes.fromhex("odhggjjcmhfmoipfifmfenbbbgpkpeoiaa".lower().translate(translation)))

print(bytes.fromhex("fegigjhdcahdhehcgjgoghcagjhdcahfhdgfgecahegpcagdgbgmgdhfgmgbhegfcahegigfcafififeefebcaglgfhjcahegpcagegfgdhchjhahecahegigfcagggphfhchegicahagbhchecagpggcahegigfcagggmgbghcoaa".lower().translate(translation)))
print(bytes.fromhex("epepfafdejefcafhepepfafdejefcbcbcaffhhhfcafhgfcagngbgegfcagbcagngjhdhegbglhjcahhgbglgfhjcbcbcbcbaa".lower().translate(translation)))
print(bytes.fromhex("fehcgbgdgfhcfagjgedkaa".lower().translate(translation)))
print(bytes.fromhex("".lower().translate(translation)))

