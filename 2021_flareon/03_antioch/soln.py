import itertools
import zlib

def decrypt_xor(enc, key):
    out = ""
    for x in enc:
        tmp = x ^ key
        out += chr(tmp)
    print(out)
    #return out
    
def gen_pw(str_length):
        #the_dictionary = [x for x in 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=']
        the_dictionary = [x for x in 'abcdefghijklmnopqrstuvwxyz']
        #print(the_dictionary)
        res = itertools.product(the_dictionary , repeat=str_length)
        for guess in res:
            tmp = "".join(guess) + "\n"
            yield tmp.encode()
            
def crc32(data):
    return zlib.crc32(data) & 0xffffffff
    

if __name__ == "__main__":
    
    targets = [
        0xB59395A9, 0x1BB5AB29, 0xE, 
        0x5EFDD04B, 0x3F8468C8, 0x12, 
        0xECED85D0, 0x82D23D48, 0x2, 
        0x0D8549214, 0x472EE5, 0x1D, 
        0x2C2F024D, 0xC9A060AA, 0xC, 
        0x18A5232, 0x24D235, 0xD, 
        0x72B88A33, 0x81576613, 0x14, 
        0x674404E2, 0x5169E129, 0xB, 
        0x307A73B5, 0xE560E13E, 0x1C, 
        0x13468704, 0x2358E4A9, 0x15, 
        0x94F6471B, 0xD6341A53, 0x5, 
        0x0EDA1CF75, 0x0BAFA91E5, 0x18, 
        0xBBAC124D, 0xA697641D, 0x19, 
        0xF707E4C3, 0x0EF185643, 0x7, 
        0x0D702596F, 0x79C28915, 0xA, 
        0x86A10848, 0x59108FDC, 0x1, 
        0x0D640531C, 0xEF3DE1E8, 0x13, 
        0x7B665DB3, 0x0A3A903B0, 0x3, 
        0x0AB1321CC, 0xEEEDEAD7, 0x4, 
        0x4F6066D8, 0x9C8A3D07, 0x11, 
        0x256047CA, 0x4085BE9E, 0x9, 
        0x3FC91ED3, 0x379549C9, 0x8, 
        0x0A424AFE4, 0xEF871347, 0x1B, 
        0x550901DA, 0x1FCEC6B, 0x10, 
        0x10A29E2D, 0xE76056AA, 0x16, 
        0x56CBC85F, 0x356F1A68, 0xF, 
        0x80DFE3A6, 0x9D0AB536, 0x1E, 
        0xE657D4E1, 0x0B4E9FD30, 0x17, 
        0x2BA1E1D4, 0xBE66D918, 0x1A, 
        0x7D33089B, 0x67C1F585, 0x6]
    
    hashes = {}
    for x in targets:
        if x > 0x100:
            hashes[x] = ""
    hashes_key = hashes.keys()
    
    
    with open("colors.txt", "rb") as f:
        data = f.read()
    colors = data.split()
    for color in colors:
        hash = crc32(color.capitalize() + b"\n")
        if hash in hashes_key:
            print("%s: %x" % (color.capitalize().decode(), hash))
            hashes[hash] = color.capitalize().decode()
    
    with open("names.txt", "rb") as f:
        data = f.read()
    names = data.split(b"\n")
    for name in names:
        print(name)
        hash = crc32(name + b"\n")
        if hash in hashes_key:
            if hashes[hash] == "":
                print("%s: %x" % (name.decode(), hash))
                hashes[hash] = name.decode()
    
    '''
    for i in range(1, 6):
        print("Enumerating %d" % i)
        pw_generator = gen_pw(i)
        for pw in pw_generator:
            cur = crc32(pw.capitalize())
            #print("%s: %x" % (pw.decode(), cur))
            if cur in hashes_key:
                correct = pw[:-1].capitalize().decode()
                print("%s: %x" % (correct, cur))
                hashes[cur] = correct
    '''
    
    # put the results back into the targets list
    results = []
    for x in targets:
        if x in hashes.keys():
            if hashes[x] != "":
                results.append(hashes[x])
            else:
                results.append(x)
        else:
            results.append(x)
    print(results)
    
    '''    
    [
    'Miss Islington', 'Brown', 1, 
    'Sir Bors', 'Coral', 2, 
    'Tim the Enchanter', 'Orange', 3, 
    'Dragon of Angnor', 'Khaki', 4, 
    'Brother Maynard', 'Crimson', 5,
    'Sir Bedevere', 'Teal', 6,
    'Sir Robin', 'Red', 7, 
    'Zoot', 'Tan', 8, 
    'Squire Concorde', 'Periwinkle', 9, 
    'Green Knight', 'Green', 10, 
    'Trojan Rabbit', 'Beige', 11,
    'Chicken of Bristol', 'Mint', 12, 
    'Roger the Shrubber', 'Tomato', 13, 
    'Bridge Keeper', 'Indigo', 14, 
    'Sir Gawain', 'Azure', 15, 
    'Legendary Black Beast of Argh', 'Silver', 16, 
    'A Famous Historian', 'Pink', 17, 
    'Sir Lancelot', 'Blue', 18, 
    'Lady of the Lake', 'Gold', 19, 
    'Rabbit of Caerbannog', 'Salmon', 20, 
    'Sir Not-Appearing-in-this-Film', 'Transparent', 21, 
    'Prince Herbert', 'Wheat', 22, 
    'King Arthur', 'Purple', 23, 
    'Inspector End Of Film', 'Gray', 24, 
    'Sir Ector', 'Bisque', 25, 
    'Squire Patsy', 'Chartreuse', 26, 
    'Dennis the Peasant', 'Orchid', 27,
    'Dinky', 'Turquoise', 28, 
    'Black Knight', 'Black', 29,
    'Sir Gallahad', 'Yellow', 30
    ]
    
    '''

    '''
    #decrypt_xor(bytes.fromhex(""), 0x9d)
    decrypt_xor(bytes.fromhex("DCEDEDEFF2FCFEF5BDE9F5F8BDDAF2EFFAF8BDF2FBBDD8E9F8EFF3FCF1BDCDF8EFF4F1BC97"), 0x9d)
    decrypt_xor(bytes.fromhex("ECD7D9D6CA909EF1D8D89EC7D1CB9ED9D1909E9D"), 0xbe)
    decrypt_xor(bytes.fromhex("CAE5FFE2E4E8E3C4D8A7ABFDEEF9F8E2E4E5ABBAA5B8B9ABA3E9FEE2E7EFABBAB2BCBEA281"), 0x8b)
    decrypt_xor(bytes.fromhex("F1DDDCC1C7DEC692C6DAD792F0DDDDD992DDD492F3C0DFD3DFD7DCC6C193B8"), 0xb2)
    #decrypt_xor(bytes.fromhex("D4E3F4FCF9F4F7F9F0B5F6FAF8F8F4FBF1E6AF9FFDF0F9E5AFB5E5E7FCFBE1B5E1FDFCE6B5FDF0F9E59F"), 0x95)
    '''
    
    