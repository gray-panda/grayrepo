## LabyREnth CTF 2017
# Programming 4 : Odd One Out

The challenge instructs us to connect to http://oott.panspacedungeon.com:16000/play/new/None to play a game

The challenge server will present us with a table of values.  
We have to analyze this table and select the row which is the "odd one out"

After fiddling with it for awhile, I figured out that there are 9 types of questions it could ask.  
Below lists the 9 types of questions and how to identify them

**1. Same or Different**
- Set of values will all either be different or same except for one.
- Select the odd one out.

```
Example
+----+----------+----------+
| id | value_0  | value_1  |
+----+----------+----------+
| 1  | jessica  | jessica  |
| 2  | nascar   | nascar   |
| 3  | cruises  | cruises  |
| 4  | stick    | stick    |
| 5  | lesser   | lesser   |
| 6  | sharing  | largely  |
| 7  | gallery  | gallery  |
| 8  | feeds    | feeds    |
| 9  | lyric    | lyric    |
| 10 | criteria | criteria |
+----+----------+----------+
```

**2. MD5**
- value_1 are all 32 characters hex string
- Plain md5 hash (Find the wrong one)

```
Example
+----+----------+----------------------------------+
| id | value_0  | value_1                          |
+----+----------+----------------------------------+
| 1  | mentor   | 23cbeacdea458e9ced9807d6cbe2f4d6 |
| 2  | julia    | c2e285cb33cecdbeb83d2189e983a8c0 |
| 3  | norton   | 1b7d9167ab164f30fa0d1e47497faef3 |
| 4  | stocks   | 4cd2f69083364d323a3a238fe68e0332 |
| 5  | jungle   | 5d991220a07e65eb7ab854341691ca7d |
| 6  | signing  | 2ce57483d3426adb2daa5718f54c0fee |
| 7  | analysis | 3b671c883959a8ef434b85a104c293d4 |
| 8  | regular  | af37d08ae228a87dc6b265fd1019c97d |
| 9  | examines | dc31b306d361a9972e3999333c9c4540 |
| 10 | seemed   | 7757cc400c1d2ae98b57cbaa95e28b05 |
| 11 | knives   | 858516ad0e7ab6c8a320f478df62b30c |
| 12 | linked   | d48e37bc19b9fe2c72923c30fd7a4152 |
| 13 | learners | 3ae41b8284357212ee59d8e6279e2b0a |
+----+----------+----------------------------------+
```

**3. SHA-256**
- value_1 are all 64 characters hex string
- Plain sha256 hash (Find the wrong one)

```
Example
+----+-------------------+------------------------------------------------------------------+
| id | value_0           | value_1                                                          |
+----+-------------------+------------------------------------------------------------------+
| 1  | custom-methods    | de794542d82403f1356bda379b414aa6571caaade9149acc26db1ca79ca265e4 |
| 2  | college-narrow    | 66ca0d6dacd70244445290b6ac1c650bb4e12e5816b78e956e0871a78c3ca094 |
| 3  | illegal-toward    | 1e3e8b6f605d00162625d7a2d8ec097b8317dde31b263601abae675a24b27d3e |
| 4  | begun-retired     | fafa43bf14d705289e7eb26573165134f7e1422cd817acc834b025b07d8fda5d |
| 5  | assess-counters   | 949d4d3084b574c6d39ed178671f0f417b0f6bb72c23a2b582e13ddeabb38af7 |
| 6  | resolved-richards | 5e02389432a87cf8b86554f7a2a3fbda0164f8e49a8a40d4c064b7f9874a6f6c |
| 7  | particle-acquired | a6b4af43e09bf361cd9094505c425f854f3d281572b144595e129e8074f6d965 |
| 8  | nicole-sterling   | c3d9d322f82f4dab737483e1acecb9e2e2bfc230f9b3189099b9ab23a64713b6 |
| 9  | interval-courier  | 2747dd739f0bd87211c523d134bfe39d784ee46acfee97e822a4527a6afe615a |
| 10 | seller-focused    | ec1b2d95c33aa0e337ae3bad3a881ed122ef2635384c7cdb9d8e0af3e291d235 |
| 11 | rachel-varied     | 070afb88dfa90a27fb85a4a6e9181e1608ab77483b6b2b79899fa052cea74def |
| 12 | studied-origins   | 320c731b2ef6dcd8134f7a11fe89ab82e538b65bdfa84ccff62dcb7ba48a34b8 |
+----+-------------------+------------------------------------------------------------------+
```

**4. SHA-358**
- value_1 are all 96 characters hex string
- Plain sha358 hashes (Find the wrong one)

```
Example
+----+----------------+--------------------------------------------------------------------------------------------------+
| id | value_0        | value_1                                                                                          |
+----+----------------+--------------------------------------------------------------------------------------------------+
| 1  | reducingkelly  | cdc8a71aee33727df0bae458dbdeba7c396b86e772eed0d44881454d37b7101665b561f609354e3498fb8dbf5a58eb69 |
| 2  | seedsadvise    | 25054d17ae1bcbc49c8d0c5b0f0ef76705d625e271dc0725fb4a736f6b62d96d68b821f2a83e4da2d5ed14143e061fa6 |
| 3  | camerasbearing | 2876c7c239386644528162fa813765a6c0d00f7d9e84624acd354be180a83b04be3cd6e8ed21f54c99e70fa2efbc2361 |
| 4  | monkeykings    | 6dfe708ae99f4753f84f325ce8010852bc497a3e93459b0431a3ece7b176c5e50a7dde5b00cf9593310b8080fef76b2a |
| 5  | watchaffect    | ad0364877da007f98f7ab120ad1d64de5b739c0ebd8fa3eb8c747125877dc9c138027a77657f6ceb636bfdea813016bb |
| 6  | roughlyoccur   | 4dfbcaa86420452a8c9a192aab9c3bb1efda8f45af40b006a6c9b6536c832208cb119a26ad55ddb512d436ee9b33e4de |
| 7  | effectsebooks  | 9a03d77979f68b8a42e9cb8bffc8e881f0bb12be4f61bde5407350d7251ef629d58fccff7de20a3b4ae93384ab71ba8c |
| 8  | havingunity    | 8ed537cc88c3c58face8ca3fc202f2becff07ae948219b9df2c490bd9f194b726d90946c08813f2a0d3c03bfb18dac27 |
| 9  | denselimit     | b1697218c85b670f03bc02ff57d3fe39f665857a141431aa28f9a46a9a8347a9f7eee8b91cadf6e1638fc05cd98486df |
| 10 | sprintsupports | 10d5a77c814cd183091c938c32f9c124ca876fdd2a04b4640b1c1a78b6a5404f53be459403ee281103448c375f97216f |
+----+----------------+--------------------------------------------------------------------------------------------------+
```

**5. CRC32**
- value_1 are all digits
- Plain CRC32 (Find the wrong one)

```
Example
+----+--------------------------+------------+
| id | value_0                  | value_1    |
+----+--------------------------+------------+
| 1  | protect elegant normal   | 1705654595 |
| 2  | attach browsing thailand | 561409779  |
| 3  | graphs threats white     | 3380991893 |
| 4  | midnight cedar saver     | 1231574426 |
| 5  | william offices brake    | 579257113  |
| 6  | sperm hoping celtic      | 2781591694 |
| 7  | honda menus prague       | 2003767855 |
| 8  | guess squad inkjet       | 3284993013 |
| 9  | tsunami improve speaker  | 3564193871 |
| 10 | newly naples today       | 3880992716 |
+----+--------------------------+------------+
```

**6. Base64/RC4**
- value_1 are base64 strings
- value_0 is encrypted using RC4 with itself as the key
	- the encrypted result is then base64-encoded (Find the wrong one)

```
Example
+----+---------------------------+--------------------------------------+
| id | value_0                   | value_1                              |
+----+---------------------------+--------------------------------------+
| 1  | shipped_choices_walking   | DOPB48Tu/o6u1EHsWH2eKv8yMOIBDdE=     |
| 2  | edited_tribal_sprint      | QqFqImMQIQUk+Eu5l3sXsSuShB0=         |
| 3  | subtle_checkout_detector  | xCKznUC7xZYQP6LiicyhMJYC3w0Ofo6t     |
| 4  | smile_button_floppy       | RA5iKxU+Ef/cA5vVNgEPPTHVpQ==         |
| 5  | comfort_cottages_wishlist | 3Ze5omxiBELxNAZSskE8M5bG0X39tHVf1w== |
| 6  | releases_surely_montana   | kRf71nJQSBHLbd/WrxboQRfDOsKSqn4=     |
| 7  | treasury_madrid_artwork   | N6ZyGCZLjik4XC2DIfFYMoZaMSL5c6s=     |
| 8  | honors_rabbit_defend      | J2Ff40cfYUmZCCbvv+7Btzry1dw=         |
| 9  | outside_yamaha_answers    | vbSuGE/7olR/uWXPYPRlAelknCenaQ==     |
| 10 | gaming_advice_veteran     | ENQJBVjtB/ug2RYVFEX2SC00Nrgy         |
+----+---------------------------+--------------------------------------+
```

**7. SingleByteXor**
- value_1 are variable length hex strings
- value_0 is encrypted with a single byte xor key "0xff"
	- Result is then transformed into a hex string (Find the wrong one)

```
Example
+----+---------+----------------+
| id | value_0 | value_1        |
+----+---------+----------------+
| 1  | firms   | 99968d928c     |
| 2  | uniform | 8a919699908d92 |
| 3  | secured | 8c9a9c8a8d9a9b |
| 4  | firefox | 99968d9a999087 |
| 5  | specify | 8c8f9a9c969986 |
| 6  | armor   | 9e8d92908d     |
| 7  | marilyn | a1adbea5a0b5a2 |
| 8  | grown   | 988d908891     |
| 9  | seating | 8c9a9e8b969198 |
| 10 | bound   | 9d908a919b     |
| 11 | inter   | 96918b9a8d     |
| 12 | radical | 8d9e9b969c9e93 |
| 13 | could   | 9c908a939b     |
| 14 | spanish | 8c8f9e91968c97 |
+----+---------+----------------+
```

**8. IP**
- There is 1 invalid IP (with an octet more than 255)
- Find the invalid one

```
Example
+----+-----------------+
| id | value           |
+----+-----------------+
| 1  | 236.247.108.71  |
| 2  | 125.245.209.141 |
| 3  | 165.105.211.93  |
| 4  | 228.193.60.187  |
| 5  | 20.172.109.176  |
| 6  | 65.101.229.138  |
| 7  | 90.274.105.243  |
| 8  | 196.9.26.38     |
| 9  | 92.229.68.111   |
| 10 | 11.229.228.191  |
| 11 | 244.19.174.135  |
| 12 | 20.185.153.225  |
| 13 | 191.222.159.127 |
| 14 | 120.234.128.93  |
+----+-----------------+
```

*9. Shellcode*
- value_0 contains the string "EAX == *"
- value_1 contains shellcode in a hex string
	- They perform a variety of assembly instructions (x86)
	- The EAX value at the end of the instructions is equal to that in value_0
	- Find the wrong one

```
Example
+----+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------+
| id | value_0           | value_1                                                                                                                                        |
+----+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------+
| 1  | EAX == 0x184B0ABD | 5356558bec4bebffc3b88129155633d2bbc4b26cd4f7f38bf281f6b995360a8bd681c2854e27bc8bc233d2b958862b67f7f18bf28bc6c95e5bc3                           |
| 2  | EAX == 0x2E7C2D82 | 5356558becb85d65383d33d2bb7c565cdff7f38bca81e9cbbe0aa18bd181c2f1ee67218bc233d2b90168198ff7f18bf28bc6c95e5bc3                                   |
| 3  | EAX == 0xEC357783 | 53558becb9ecf0322e81e94bbed80d81f122456fcc8bd18bc2c95bc3                                                                                       |
| 4  | EAX == 0xB13FF3BE | 5657558becbfc8932f6281c7ec58d11f81ef06e186528bf781f6d0b07dd98bd681f2888df56b8bca8bc1c95f5ec3                                                   |
| 5  | EAX == 0x2217C10F | 5657558becb98d51a81a81e9f0b7899381e90d5019878bc133d2beba841f0ff7f68bf281f651bf32318bfe81c73040d8408bd781f2fef707508bc2c95f5ec3                 |
| 6  | EAX == 0x927C2C5D | 5657558becba93c95a4e4febffc781ea202ed67e81f22eb7f85d8bc2c95f5ec3                                                                               |
| 7  | EAX == 0x72494016 | 53558becba01f3d7f381eaef6b1af4b9e69b747881f188d10f6d788481f204c7f48d8bca8bc1bb688a008081f3abb1544c790cc95bc3                                   |
| 8  | EAX == 0xB84DAE18 | 5357558becba3ef31da581f26d131da781f24b4e4dba8bc2c95f5bc3                                                                                       |
| 9  | EAX == 0x37573FB2 | 5357558becbb885cf79b81c3542c021281f3096068738bc33567d7c6e98bc88bc1c95f5bc3                                                                     |
| 10 | EAX == 0x324748B2 | 535657558becb82a90fcf035dda7efc12d123026398bf881ef2ed729faba76d0f62681f29943424778cb8bf781c618061eee8bde81eb1dee99b98bfb8bc7c95f5e5bc3         |
| 11 | EAX == 0x00520F6D | 5657558becb88cefc79033d2be6c774810f7f68bca81c1c5ee74f98bf181c63e3985c38bc633d2be0c8f4528f7f681c299bb9e418bc233d2bf1f3d6f43f7f78bf28bc6c95f5ec3 |
+----+-------------------+------------------------------------------------------------------------------------------------------------------------------------------------+
```

### Evaluating shellcode

The shellcode question is hardest to solve as we need to interpret this shellcode and pseudo-execute it to get the EAX value

I downloaded the [shellcode-launcher](https://github.com/clinicallyinane/shellcode_launcher) project  
I made some modification so it will print out the return value "EAX" after the function call
- Changed the return type of void_func_ptr to DWORD instead of void

```c
typedef DWORD(*void_func_ptr)(void);
```

- Call the shellcode and print out the return value (which is "EAX")

```c
void_func_ptr callLoc = (void_func_ptr)(buffer);
DWORD fk = callLoc();
printf("%08x\n", fk);
```

I compiled it into an [exe](shellcode_launcher.exe).  

Usage

```
shellcode_launcher.exe -i shellcode.bin > output
	- -i specifies an input file. Save the binary form of the shellcode in this file
	- Pipes output into an output file. This makes it easier to read the results back in PHP
```

Do note that this exe is not perfect.  
Sometimes, it interprets the shellcode differently from what the challenge server expects

I wrote the [solution script](soln.php) which will talk to the challenge server, compute and answer all these questions.  
Obviously, this script can only run on Windows as it depends on an "exe" file.

The flag is revealed after answering 128 questions correctly in a row

As of the writing of this article, the challenge server seems to be down.  

The flag is **PAN{8a1f7919eda0bd55db89d2eff45f420d84ec67c3715ab0c53bc8db7b1762cd54}**