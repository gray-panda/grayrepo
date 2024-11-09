// Decompiled by library.dedaub.com
// 2024.08.29 21:32 UTC
// Compiled using the solidity compiler version 0.8.26





function function_selector() public payable { 
    revert();
}

function testStr(string str) public payable { 
    require(4 + (msg.data.length - 4) - 4 >= 32);
    require(str <= uint64.max);
    require(4 + str + 31 < 4 + (msg.data.length - 4));
    require(str.length <= uint64.max, Panic(65)); // failed memory allocation (too much memory)
    v0 = new bytes[](str.length);
    require(!((v0 + ((str.length + 31 & 0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe0) + 32 + 31 & 0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe0) > uint64.max) | (v0 + ((str.length + 31 & 0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe0) + 32 + 31 & 0xffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffe0) < v0)), Panic(65)); // failed memory allocation (too much memory)
    require(str.data + str.length <= 4 + (msg.data.length - 4));
    CALLDATACOPY(v0.data, str.data, str.length);
    v0[str.length] = 0;
    if (v0.length == 17) {
        require(0 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
        v1 = v0.data;
        if (bytes1(v0[0] >> 248 << 248) == 0x6700000000000000000000000000000000000000000000000000000000000000) {
            require(1 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
            if (bytes1(v0[1] >> 248 << 248) == 0x6900000000000000000000000000000000000000000000000000000000000000) {
                require(2 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                if (bytes1(v0[2] >> 248 << 248) == 0x5600000000000000000000000000000000000000000000000000000000000000) {
                    require(3 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                    if (bytes1(v0[3] >> 248 << 248) == 0x3300000000000000000000000000000000000000000000000000000000000000) {
                        require(4 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                        if (bytes1(v0[4] >> 248 << 248) == 0x5f00000000000000000000000000000000000000000000000000000000000000) {
                            require(5 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                            if (bytes1(v0[5] >> 248 << 248) == 0x4d00000000000000000000000000000000000000000000000000000000000000) {
                                require(6 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                if (bytes1(v0[6] >> 248 << 248) == 0x3300000000000000000000000000000000000000000000000000000000000000) {
                                    require(7 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                    if (bytes1(v0[7] >> 248 << 248) == 0x5f00000000000000000000000000000000000000000000000000000000000000) {
                                        require(8 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                        if (bytes1(v0[8] >> 248 << 248) == 0x7000000000000000000000000000000000000000000000000000000000000000) {
                                            require(9 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                            if (bytes1(v0[9] >> 248 << 248) == 0x3400000000000000000000000000000000000000000000000000000000000000) {
                                                require(10 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                                if (bytes1(v0[10] >> 248 << 248) == 0x7900000000000000000000000000000000000000000000000000000000000000) {
                                                    require(11 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                                    if (bytes1(v0[11] >> 248 << 248) == 0x4c00000000000000000000000000000000000000000000000000000000000000) {
                                                        require(12 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                                        if (bytes1(v0[12] >> 248 << 248) == 0x3000000000000000000000000000000000000000000000000000000000000000) {
                                                            require(13 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                                            if (bytes1(v0[13] >> 248 << 248) == 0x3400000000000000000000000000000000000000000000000000000000000000) {
                                                                require(14 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                                                if (bytes1(v0[14] >> 248 << 248) == 0x6400000000000000000000000000000000000000000000000000000000000000) {
                                                                    require(15 < v0.length, Panic(50)); // access an out-of-bounds or negative index of bytesN array or slice
                                                                    if (bytes1(v0[15] >> 248 << 248) == 0x2100000000000000000000000000000000000000000000000000000000000000) {
                                                                        v2 = v3.data;
                                                                        v4 = bytes20(0x5324eab94b236d4d1456edc574363b113cebf09d000000000000000000000000);  // this is the correct address!!
                                                                        if (v3.length < 20) {
                                                                            v4 = v5 = bytes20(v4);
                                                                        }
                                                                        v6 = v7 = v4 >> 96;
                                                                    } else {
                                                                        v6 = v8 = 0;
                                                                    }
                                                                } else {
                                                                    v6 = v9 = 0xce89026407fb4736190e26dcfd5aa10f03d90b5c;
                                                                }
                                                            } else {
                                                                v6 = v10 = 0x506dffbcdaf9fe309e2177b21ef999ef3b59ec5e;
                                                            }
                                                        } else {
                                                            v6 = v11 = 0x26b1822a8f013274213054a428bdbb6eba267eb9;
                                                        }
                                                    } else {
                                                        v6 = v12 = 0xf7fc7a6579afa75832b34abbcf35cb0793fce8cc;
                                                    }
                                                } else {
                                                    v6 = v13 = 0x83c2cbf5454841000f7e43ab07a1b8dc46f1cec3;
                                                }
                                            } else {
                                                v6 = v14 = 0x632fb8ee1953f179f2abd8b54bd31a0060fdca7e;
                                            }
                                        } else {
                                            v6 = v15 = 0x3bd70e10d71c6e882e3c1809d26a310d793646eb;
                                        }
                                    } else {
                                        v6 = v16 = 0xe2e3dd883af48600b875522c859fdd92cd8b4f54;
                                    }
                                } else {
                                    v6 = v17 = 0x4b9e3b307f05fe6f5796919a3ea548e85b96a8fe;
                                }
                            } else {
                                v6 = v18 = 0x6371b88cc8288527bc9dab7ec68671f69f0e0862;
                            }
                        } else {
                            v6 = v19 = 0x53fbb505c39c6d8eeb3db3ac3e73c073cd9876f8;
                        }
                    } else {
                        v6 = v20 = 0x84abec6eb54b659a802effc697cdc07b414acc4a;
                    }
                } else {
                    v6 = v21 = 0x87b6cf4edf2d0e57d6f64d39ca2c07202ab7404c;
                }
            } else {
                v6 = v22 = 0x53387f3321fd69d1e030bb921230dfb188826aff;
            }
        } else {
            v6 = v23 = 0x40d3256eb0babe89f0ea54edaa398513136612f5;
        }
    } else {
        v6 = v24 = 0x76d76ee8823de52a1a431884c2ca930c5e72bff3;
    }
    MEM[MEM[64]] = address(v6);
    return address(v6);
}

// Note: The function selector is not present in the original solidity code.
// However, we display it for the sake of completeness.

function function_selector( function_selector) public payable { 
    MEM[64] = 128;
    require(!msg.value);
    if (msg.data.length >= 4) {
        if (0x5684cff5 == function_selector >> 224) {
            testStr(string);
        }
    }
    fallback();
}
