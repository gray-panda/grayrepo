
def xorstr(s1, msglen, s2):
    out = ""
    for i in range(msglen):
        tmp = s1[i] ^ s2[i]
        out += chr(tmp)
    return out

def main():
    key1 = b"nPTnaGLkIqdcQwvieFQKGcTGOTbfMjDNmvibfBDdFBhoPaBbtfQuuGWYomtqTFqvBSKdUMmciqKSGZaosWCSoZlcIlyQpOwkcAgw "
    key2 = b"KglPFOsQDxBPXmclOpmsdLDEPMRWbMDzwhDGOyqAkVMRvnBeIkpZIhFznwVylfjrkqprBPAdPuaiVoVugQAlyOQQtxBNsTdPZgDH "

    enc1 = bytes.fromhex("380E023B193B1B341B0C233E3308114239121E73")
    print(xorstr(key2, 0x14, enc1))

    enc2 = bytes.fromhex("2323332C0E3F64490A1E0A042316021A446608243211742C2A2D420F3E50640D5D041B1716360305342009086321240E151434581A29793A0000565854")
    print(xorstr(key1, 0x3d, enc2))

if __name__ == "__main__":
    main()
