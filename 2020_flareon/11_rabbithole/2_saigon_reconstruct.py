#!/usr/bin/env python3
import argparse
import struct
from datetime import datetime

MZ_HEADER = bytes.fromhex(
    '4d5a90000300000004000000ffff0000'
    'b8000000000000004000000000000000'
    '00000000000000000000000000000000'
    '00000000000000000000000080000000'
    '0e1fba0e00b409cd21b8014ccd215468'
    '69732070726f6772616d2063616e6e6f'
    '742062652072756e20696e20444f5320'
    '6d6f64652e0d0d0a2400000000000000'
)

def main():
    parser = argparse.ArgumentParser(description="Shellcode to PE converter for the Saigon malware family.")
    parser.add_argument("sample")
    args = parser.parse_args()

    with open(args.sample, "rb") as f:
        data = bytearray(f.read())

    if data.startswith(b'MZ'):
        lfanew = struct.unpack_from('=I', data, 0x3c)[0]
        print('This is already an MZ/PE file.')
        return
    elif not data.startswith(b'\xe9'):
        print('Unknown file type.')
        return

    struct.pack_into('=I', data, 0, 0x00004550)
    if data[5] == 0x01:
        struct.pack_into('=H', data, 4, 0x14c)
    elif data[5] == 0x86:
        struct.pack_into('=H', data, 4, 0x8664)
    else:
        print('Unknown architecture.')
        return

    # file alignment
    struct.pack_into('=I', data, 0x3c, 0x200)

    optional_header_size, _ = struct.unpack_from('=HH', data, 0x14)
    magic, _, _, size_of_code = struct.unpack_from('=HBBI', data, 0x18)
    print('Magic:', hex(magic))
    print('Size of code:', hex(size_of_code))

    base_of_code, base_of_data = struct.unpack_from('=II', data, 0x2c)

    if magic == 0x20b:
        # base of data, does not exist in PE32+
        if size_of_code & 0x0fff:
            tmp = (size_of_code & 0xfffff000) + 0x1000
        else:
            tmp = size_of_code
        base_of_data = base_of_code + tmp

    print('Base of code:', hex(base_of_code))
    print('Base of data:', hex(base_of_data))

    data[0x18 + optional_header_size : 0x1000] = b'\0' * (0x1000 - 0x18 - optional_header_size)

    size_of_header = struct.unpack_from('=I', data, 0x54)[0]

    data_size = 0x3000
    pos = data.find(struct.pack('=IIIII', 3, 5, 7, 11, 13))
    if pos >= 0:
        data_size = pos - base_of_data

    section = 0
    struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
        b'.text',
        size_of_code, base_of_code,
        base_of_data - base_of_code, size_of_header,
        0, 0,
        0, 0,
        0x60000020
    )
    section += 1
    struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
        b'.rdata',
        data_size, base_of_data,
        data_size, size_of_header + base_of_data - base_of_code,
        0, 0,
        0, 0,
        0x40000040
    )
    section += 1
    struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
        b'.data',
        0x1000, base_of_data + data_size,
        0x1000, size_of_header + base_of_data - base_of_code + data_size,
        0, 0,
        0, 0,
        0xc0000040
    )

    if magic == 0x20b:
        section += 1
        struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
            b'.pdata',
            0x1000, base_of_data + data_size + 0x1000,
            0x1000, size_of_header + base_of_data - base_of_code + data_size + 0x1000,
            0, 0,
            0, 0,
            0x40000040
        )
        section += 1
        struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
            b'.bss',
            0x1600, base_of_data + data_size + 0x2000,
            len(data[base_of_data + data_size + 0x2000:]), size_of_header + base_of_data - base_of_code + data_size + 0x2000,
            0, 0,
            0, 0,
            0xc0000040
        )
    else:
        section += 1
        struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
            b'.bss',
            0x1000, base_of_data + data_size + 0x1000,
            0x1000, size_of_header + base_of_data - base_of_code + data_size + 0x1000,
            0, 0,
            0, 0,
            0xc0000040
        )
        section += 1
        struct.pack_into('=8sIIIIIIHHI', data, 0x18 + optional_header_size + 0x28 * section,
            b'.reloc',
            0x2000, base_of_data + data_size + 0x2000,
            len(data[base_of_data + data_size + 0x2000:]), size_of_header + base_of_data - base_of_code + data_size + 0x2000,
            0, 0,
            0, 0,
            0x40000040
        )

    header = MZ_HEADER + data[:size_of_header - len(MZ_HEADER)]
    pe = bytearray(header + data[0x1000:])
    with open(args.sample + '.dll', 'wb') as f:
        f.write(pe)

    lfanew = struct.unpack_from('=I', pe, 0x3c)[0]
    timestamp = struct.unpack_from('=I', pe, lfanew + 8)[0]
    print('PE timestamp:', datetime.utcfromtimestamp(timestamp).isoformat())

 

if __name__ == "__main__":
    main()