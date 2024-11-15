import struct

def decode_str(data, key):
    output = b""
    for x in data:
        output += struct.pack("<I", x ^ key)
    return output
    
def main():
    data = []
    #data.append([key, data...])
    data.append([0x1EC648, 0x5F2CB53F, 0x6430F47B, 0x1EAA24])
    data.append([0x646BA0F9, 0xA19C592, 0x5658CC9C, 0x807C4D7, 0x646BA0F9])
    data.append([0x56153B70, 0x21795303, 0x787C4B11, 0x56795714])
    data.append([0xBF13611, 0x79944564, 0x6FDF0422, 0xBF15A7D])
    data.append([0x9149617, 0x6571FE64, 0x2726A57B, 0x978FA73])
    data.append([0x2689C001, 0x47FFA460, 0x14BAA971, 0x4AE5A42F, 0x2689C001])
    data.append([0x1D9C81A7, 0x71F8F5C9, 0x71F8AFCB, 0x1D9C81CB])
    data.append([0xE03FAF1, 0x77719993, 0x6A2D8E81, 0xE03969D])
    data.append([0x274FE437, 0x57369654, 0x97DD743, 0x27238853])
    data.append([0x6E0FD6E2, 0x1C6AA597, 0x4079B887, 0x6E63BA86])
    
    data.append([0x56153B70, 0x24745716, 0x387A1615, 0x3B7A585E, 0x56153B70])
    data.append([0x1EC648, 0x642FF22C, 0x397AA570, 0x302EA070, 0x342EF42A, 0x3026FF2D, 0x3827FF78, 0x3878A52D, 0x6529F47C, 0x1EC648])
    
    data.append([0x646BA0F9, 0x80ED0AA, 0x3C2E8E95, 0x646BA0BC])
    
    data.append([0x2689C001, 0x45E8AE68, 0x43FFA975, 0x2689C033])
    data.append([0x9149617, 0x6A75F87E, 0x6C62FF63, 0x9149617])
    
    data.append([0x1EC648, 0x53C605, 0x7AC665, 0x33C62C, 0x67C631, 0x67C631, 0x1EC648])
    
    data.append([0x1D9C81A7, 0x38B2F282, 0x1D9C81D4])
    data.append([0x7484C069, 0x6E5AC0F, 0x1AEBED0C, 0x19EBA347, 0x7484C069])
    
    data.append([0x7484C069, 0x6E5AC0F, 0x1AEBED0C, 0x19EBA347, 0x7484C069])
    
    data.append([0x121D3709, 0x667B585A, 0x776F567E, 0x71747A55, 0x7D6E587B, 0x3741436F, 0x121D377A])
    data.append([0x3C082FDF, 0x486E408C, 0x597A4EA8, 0x5F616283, 0x537B40AD, 0x3C085BB9])
    
    data.append([0x56153B70, 0x56503B31, 0x56153B23])
    data.append([0x0BF13611, 0x0B93365E, 0x0B94367B, 0x0B853672, 0x0B94365D, 0x0B96367F, 0x0B993665, 0x0BF13611])
    data.append([0x2689C001, 0x26E1C042, 0x26E0C060, 0x26E0C06F, 0x26EEC06F, 0x26E6C04C, 0x26ECC065, 0x26CBC042, 0x2689C042])
    data.append([0x9149617, 0x97C9654, 0x97D9676, 0x97D9679, 0x9739679, 0x97B965A, 0x9719673, 0x9149617])
    
    for cur in data:
        print(decode_str(cur[1:], cur[0]).decode().strip())
    
    
if __name__ == "__main__":
    main()