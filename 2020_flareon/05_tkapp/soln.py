import hashlib

def decode(pw):
    out = b""
    for c in pw:
        tmp = c ^ 83
        out += bytes([tmp])
    return out

def main():
    pw = bytes([62,38,63,63,54,39,59,50,39])
    pw = decode(pw)  # from UnlockPage.OnLoginButtonClicked
    print("Password: %s" % pw)
    
    step = b"magic" # From PedDataUpdate
    desc = b"water" # From IndexPage_CurrentPageChanged
    note = b"keep steaks for dinner"
    
    combined = pw + note + step + desc
    print("Combined string: %s" % combined)
    c_hash = hashlib.sha256(combined).digest()
    #print(c_hash)
    
    target_hash = bytes([50,148,76,233,110,199,228,72,114,227,78,138,93,189,189,147,159,70,66,223,123,137,44,73,101,235,129,16,181,139,104,56])
    #print(target_hash)
    
    if c_hash != target_hash:
        print("Hash mismatch, terminating...")
        return
        
    print("Hash Matched! Combined string is correct")
    
    key_string = b""
    key_string = bytes([desc[2], pw[6], pw[4], note[4], note[0], note[17], note[18], note[16], note[11], note[13], note[12], note[15], step[4], pw[6], desc[1], pw[2], pw[2], pw[4], note[18], step[2], pw[4], note[5], note[4], desc[0], desc[3], note[15], note[8], desc[4], desc[3], note[4], step[2], note[13], note[18], note[18], note[8], note[4], pw[0], pw[7], note[0], pw[4], note[11], pw[6], pw[4], desc[4], desc[3]])
    print("Key: %s" % key_string)
    
    
if __name__ == "__main__":
    main()

    