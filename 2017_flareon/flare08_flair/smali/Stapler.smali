.class public Lcom/flare_on/flair/Stapler;
.super Ljava/lang/Object;
.source "Stapler.java"


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 13
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method

.method static drdfg(Ljava/lang/String;I)[B  # string deobfuscator: base64-decode and single byte xor
    .locals 6
    .param p0, "vsdf"    # Ljava/lang/String;
    .param p1, "kFt"    # I

    .prologue
    .line 33
    const/4 v2, 0x0

    .line 35
    .local v2, "in":[B
    :try_start_0
    const-string v4, "UTF-8"

    invoke-virtual {p0, v4}, Ljava/lang/String;->getBytes(Ljava/lang/String;)[B

    move-result-object v4

    const/4 v5, 0x0

    invoke-static {v4, v5}, Landroid/util/Base64;->decode([BI)[B  # base64 decode
    :try_end_0
    .catch Ljava/io/UnsupportedEncodingException; {:try_start_0 .. :try_end_0} :catch_0

    move-result-object v2

    .line 39
    :goto_0
    array-length v4, v2

    new-array v3, v4, [B

    .line 40
    .local v3, "vSdf":[B
    const/4 v1, 0x0

    .local v1, "i":I
    :goto_1
    array-length v4, v2

    if-ge v1, v4, :cond_0

    .line 41
    aget-byte v4, v2, v1

    xor-int/2addr v4, p1

    int-to-byte v4, v4

    aput-byte v4, v3, v1

    .line 40
    add-int/lit8 v1, v1, 0x1

    goto :goto_1

    .line 36
    .end local v1    # "i":I
    .end local v3    # "vSdf":[B
    :catch_0
    move-exception v0

    .line 37
    .local v0, "e":Ljava/io/UnsupportedEncodingException;
    invoke-virtual {v0}, Ljava/io/UnsupportedEncodingException;->printStackTrace()V

    goto :goto_0

    .line 43
    .end local v0    # "e":Ljava/io/UnsupportedEncodingException;
    .restart local v1    # "i":I
    .restart local v3    # "vSdf":[B
    :cond_0
    return-object v3
.end method

.method static iemm(Ljava/lang/String;)Ljava/lang/String; # dictionary swap
    .locals 8
    .param p0, "fGLJ"    # Ljava/lang/String;

    .prologue
    .line 56
    const-string v0, " !\"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~"

    .line 58
    .local v0, "eUe":Ljava/lang/String;
    const-string v5, "Zcj30d9jroqAN2mtzayVK0awaVTLnoXVcsjl9ujUAd22JiI9xfhqEW1BbkG3LsgQRoStjh+Eb6wTD4BwD9Kypa5ggXfHLWmFjFgERViV+5IRU4RbUPDUwYTivhsdZnA="

    const/16 v6, 0x11

    const-string v7, "for"

    invoke-static {v5, v6, v7}, Lcom/flare_on/flair/Stapler;->vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String;

    move-result-object v3 # v3 = "s+_m;a\>q$AOJl8i|4Fzp#2XZn/V^'cUw1"M*]hYDuWo`-C~=t 5%&N:603QKEb<{eIxRHgL)S,T!d.9"

    .line 60
    .local v3, "sxGK":Ljava/lang/String;
    invoke-virtual {p0}, Ljava/lang/String;->length()I

    move-result v5

    new-array v4, v5, [C

    .line 61
    .local v4, "zhE":[C
    const/4 v2, 0x0

    .local v2, "sqNOOwyN":I
    :goto_0
    invoke-virtual {p0}, Ljava/lang/String;->length()I

    move-result v5 # v5 = input.length();

    if-ge v2, v5, :cond_0

    .line 62
    add-int/lit8 v5, v2, 0x1 # v2++

    invoke-virtual {p0, v2, v5}, Ljava/lang/String;->substring(II)Ljava/lang/String; # extract 1 char from input

    move-result-object v5 # v5 = input[i]

    invoke-virtual {v3, v5}, Ljava/lang/String;->indexOf(Ljava/lang/String;)I

    move-result v1 # find the index inside the jumbled string

    .line 63
    .local v1, "sHFp":I
    invoke-virtual {v0, v1}, Ljava/lang/String;->charAt(I)C

    move-result v5

    aput-char v5, v4, v2

    .line 61
    add-int/lit8 v2, v2, 0x1

    goto :goto_0

    .line 65
    .end local v1    # "sHFp":I
    :cond_0
    new-instance v5, Ljava/lang/String;

    invoke-direct {v5, v4}, Ljava/lang/String;-><init>([C)V

    return-object v5
.end method

.method static neapucx(Ljava/lang/String;)[B  # hex2binary
    .locals 7
    .param p0, "bro"    # Ljava/lang/String;

    .prologue
    const/16 v6, 0x10

    .line 69
    invoke-virtual {p0}, Ljava/lang/String;->length()I

    move-result v1

    .line 70
    .local v1, "kon":I
    rem-int/lit8 v3, v1, 0x2  # v3 = input.length() % 2

    const/4 v4, 0x1

    if-ne v3, v4, :cond_1  # input string length must be multiple of 2

    .line 71
    const/4 v0, 0x0

    .line 78
    :cond_0
    return-object v0

    .line 73
    :cond_1
    div-int/lit8 v3, v1, 0x2 # v3 = input.length() / 2

    new-array v0, v3, [B

    .line 74
    .local v0, "ce":[B
    const/4 v2, 0x0

    .local v2, "vdsfv":I
    :goto_0
    if-ge v2, v1, :cond_0

    .line 75
    div-int/lit8 v3, v2, 0x2

    invoke-virtual {p0, v2}, Ljava/lang/String;->charAt(I)C

    move-result v4

    invoke-static {v4, v6}, Ljava/lang/Character;->digit(CI)I

    move-result v4

    shl-int/lit8 v4, v4, 0x4

    add-int/lit8 v5, v2, 0x1

    .line 76
    invoke-virtual {p0, v5}, Ljava/lang/String;->charAt(I)C

    move-result v5

    invoke-static {v5, v6}, Ljava/lang/Character;->digit(CI)I

    move-result v5

    add-int/2addr v4, v5

    int-to-byte v4, v4

    aput-byte v4, v0, v3

    .line 74
    add-int/lit8 v2, v2, 0x2

    goto :goto_0
.end method

.method static poserw([B)[B # do sha1
    .locals 5
    .param p0, "intr"    # [B
    .annotation system Ldalvik/annotation/Throws;
        value = {
            Ljava/io/UnsupportedEncodingException;,
            Ljava/security/NoSuchAlgorithmException;
        }
    .end annotation

    .prologue
    .line 48
    new-instance v2, Ljava/lang/String;

    const-string v3, "JT43W0c="

    const/16 v4, 0x76

    invoke-static {v3, v4}, Lcom/flare_on/flair/Stapler;->drdfg(Ljava/lang/String;I)[B # base64-decode and single byte xor

    move-result-object v3  # will return "SHA-1"

    const-string v4, "UTF-8"

    invoke-direct {v2, v3, v4}, Ljava/lang/String;-><init>([BLjava/lang/String;)V

    invoke-static {v2}, Ljava/security/MessageDigest;->getInstance(Ljava/lang/String;)Ljava/security/MessageDigest;

    move-result-object v0

    .line 49
    .local v0, "sdfgr":Ljava/security/MessageDigest;
    invoke-virtual {v0, p0}, Ljava/security/MessageDigest;->update([B)V

    .line 50
    invoke-virtual {v0}, Ljava/security/MessageDigest;->digest()[B

    move-result-object v1

    .line 52
    .local v1, "tgh":[B
    return-object v1
.end method

.method static vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String; # Decrypt ARC4 (msg = deobfus first 2 arg, key = 3rd arg)
    .locals 9
    .param p0, "fTgb"    # Ljava/lang/String;
    .param p1, "dopr"    # I
    .param p2, "vsdS"    # Ljava/lang/String;

    .prologue
    .line 18
    :try_start_0
    new-instance v2, Ljavax/crypto/spec/SecretKeySpec;

    invoke-virtual {p2}, Ljava/lang/String;->getBytes()[B

    move-result-object v5

    new-instance v6, Ljava/lang/String;

    const-string v7, "0cLTpA=="

    const/16 v8, 0x90

    invoke-static {v7, v8}, Lcom/flare_on/flair/Stapler;->drdfg(Ljava/lang/String;I)[B  

    move-result-object v7 # "ARC4"

    const-string v8, "UTF-8"

    invoke-direct {v6, v7, v8}, Ljava/lang/String;-><init>([BLjava/lang/String;)V

    invoke-direct {v2, v5, v6}, Ljavax/crypto/spec/SecretKeySpec;-><init>([BLjava/lang/String;)V 
    # v2 = SecretKeySpec.init(p2, "ARC4"); p2 = key

    .line 20
    .local v2, "ksdFg":Ljavax/crypto/spec/SecretKeySpec;
    new-instance v5, Ljava/lang/String;

    const-string v6, "BBcGcQ=="

    const/16 v7, 0x45

    invoke-static {v6, v7}, Lcom/flare_on/flair/Stapler;->drdfg(Ljava/lang/String;I)[B

    move-result-object v6 # "ARC4"

    const-string v7, "UTF-8"

    invoke-direct {v5, v6, v7}, Ljava/lang/String;-><init>([BLjava/lang/String;)V

    invoke-static {v5}, Ljavax/crypto/Cipher;->getInstance(Ljava/lang/String;)Ljavax/crypto/Cipher;

    move-result-object v4 # v4 = Cipher.getInstance("ARC4")

    .line 21
    .local v4, "vaTg":Ljavax/crypto/Cipher;
    const/4 v5, 0x2

    invoke-virtual {v4, v5, v2}, Ljavax/crypto/Cipher;->init(ILjava/security/Key;)V
    # v4 = Cipher.getInstance("ARC4").init(0x2, SecretKeySpec.init(p2, "ARC4"))

    .line 23
    invoke-static {p0, p1}, Lcom/flare_on/flair/Stapler;->drdfg(Ljava/lang/String;I)[B # deobfus the first 2 arguments

    move-result-object v1

    .line 24
    .local v1, "fhaKd":[B
    invoke-virtual {v4, v1}, Ljavax/crypto/Cipher;->doFinal([B)[B

    move-result-object v3

    .line 25
    .local v3, "rkCx":[B
    new-instance v5, Ljava/lang/String;

    const-string v6, "UTF-8"

    invoke-direct {v5, v3, v6}, Ljava/lang/String;-><init>([BLjava/lang/String;)V
    :try_end_0
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_0

    .line 29
    .end local v1    # "fhaKd":[B
    .end local v2    # "ksdFg":Ljavax/crypto/spec/SecretKeySpec;
    .end local v3    # "rkCx":[B
    .end local v4    # "vaTg":Ljavax/crypto/Cipher;
    :goto_0
    return-object v5

    .line 26
    :catch_0
    move-exception v0

    .line 27
    .local v0, "e":Ljava/lang/Exception;
    invoke-virtual {v0}, Ljava/lang/Exception;->printStackTrace()V

    .line 29
    const/4 v5, 0x0

    goto :goto_0
.end method
