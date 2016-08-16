.class public Lmx/fill/ez/cups/ezfill/g;
.super Landroid/os/AsyncTask;


# instance fields
.field final synthetic a:Lmx/fill/ez/cups/ezfill/CupsLogin;

.field private final b:Ljava/lang/String; # email input

.field private final c:Ljava/lang/String; # password input


# direct methods
.method constructor <init>(Lmx/fill/ez/cups/ezfill/CupsLogin;Ljava/lang/String;Ljava/lang/String;)V
    .locals 0

    iput-object p1, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    invoke-direct {p0}, Landroid/os/AsyncTask;-><init>()V

    iput-object p2, p0, Lmx/fill/ez/cups/ezfill/g;->b:Ljava/lang/String;

    iput-object p3, p0, Lmx/fill/ez/cups/ezfill/g;->c:Ljava/lang/String;

    return-void
.end method


# virtual methods
.method protected varargs a([Ljava/lang/Void;)Ljava/lang/Boolean; # checks if input email/password matches any of the declared email/password
    .locals 8

    const/4 v7, 0x1

    const/4 v1, 0x0

    const-wide/16 v2, 0x7d0

    :try_start_0
    invoke-static {v2, v3}, Ljava/lang/Thread;->sleep(J)V
    :try_end_0
    .catch Ljava/lang/InterruptedException; {:try_start_0 .. :try_end_0} :catch_0

    invoke-static {}, Lmx/fill/ez/cups/ezfill/CupsLogin;->j()[Ljava/lang/String; # gets string array of emails

    move-result-object v2

    array-length v3, v2

    move v0, v1

    :goto_0
    if-ge v0, v3, :cond_1 # if v0 >= $validcreds.length

    aget-object v4, v2, v0

    const-string v5, ":"

    invoke-virtual {v4, v5}, Ljava/lang/String;->split(Ljava/lang/String;)[Ljava/lang/String; # splits the email and password parts

    move-result-object v4

    aget-object v5, v4, v1 # [0] email part

    iget-object v6, p0, Lmx/fill/ez/cups/ezfill/g;->b:Ljava/lang/String; # email from input

    invoke-virtual {v5, v6}, Ljava/lang/String;->equals(Ljava/lang/Object;)Z # check that both emails are equal

    move-result v5

    if-eqz v5, :cond_0

    aget-object v0, v4, v7 # [1] password part

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/g;->c:Ljava/lang/String; # password from input

    invoke-virtual {v0, v1}, Ljava/lang/String;->equals(Ljava/lang/Object;)Z # check that both passwords are equal

    move-result v0

    invoke-static {v0}, Ljava/lang/Boolean;->valueOf(Z)Ljava/lang/Boolean;

    move-result-object v0

    :goto_1
    return-object v0

    :catch_0
    move-exception v0

    invoke-static {v1}, Ljava/lang/Boolean;->valueOf(Z)Ljava/lang/Boolean;

    move-result-object v0

    goto :goto_1

    :cond_0
    add-int/lit8 v0, v0, 0x1

    goto :goto_0

    :cond_1
    invoke-static {v7}, Ljava/lang/Boolean;->valueOf(Z)Ljava/lang/Boolean;

    move-result-object v0

    goto :goto_1
.end method

.method a(Ljava/lang/String;C)Ljava/lang/String;
    .locals 9 # p1 is password, p2 is email[4]

    const/4 v8, 0x3

    const/4 v7, 0x2

    const/4 v6, 0x1

    const/4 v5, 0x0

    const/4 v4, 0x5

    const/16 v0, 0xa

    new-array v0, v0, [C

    invoke-virtual {p1}, Ljava/lang/String;->toCharArray()[C # convert input password to char array

    move-result-object v1

    array-length v2, v1

    if-le v2, v4, :cond_0 # if password.length <= 5, cond_0

    aget-char v2, v1, v5 # password[0]

    aget-char v3, v1, v4 # password[5]

    invoke-virtual {p0, v2, v3}, Lmx/fill/ez/cups/ezfill/g;->a(CC)Z # this.a(password[0], password[5]), !(p1 ^ p2 == 0x15)

    move-result v2

    if-eqz v2, :cond_1

    # returns password 
    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object p1

    :cond_0
    :goto_0
    return-object p1

    :cond_1
    aget-char v2, v1, v6 # pw[1]

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/g;->a(C)Z # this.a(pw[1]), !((p1 ^ (p1 & 0xf)) == 0x60)

    move-result v2

    if-eqz v2, :cond_2

    # returns password 
    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object p1

    goto :goto_0

    :cond_2
    aget-char v2, v1, v7 # pw[2]

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/g;->b(C)I # this.b(pw[2]), (p1 - 5) ^ 3

    move-result v2

    const/16 v3, 0x73

    if-eq v2, v3, :cond_3 # (pw[2] - 5) ^ 3 == 0x73

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object p1

    goto :goto_0

    :cond_3
    aget-char v2, v1, v8 # pw[3]

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/g;->c(C)I # this.c(pw[3]), p1 * 0x22

    move-result v2

    const/16 v3, 0xdf2

    if-eq v2, v3, :cond_4 # pw[3] * 0x22 == 0xdf2

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object p1

    goto :goto_0

    :cond_4
    const/4 v2, 0x4

    aget-char v2, v1, v2 # pw[4]

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/g;->d(C)Z # this.d(pw[4]), !(p1 == 0x64)

    move-result v2

    if-eqz v2, :cond_5

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object p1

    goto :goto_0

    :cond_5 # vo is a char[10] array
    aput-char p2, v0, v5 # v0[0] = email[4]

    aget-char v2, v1, v5

    aput-char v2, v0, v6 # v0[1] = pw[0]

    aget-char v2, v1, v6

    aput-char v2, v0, v7 # v0[2] = pw[1]

    aget-char v2, v1, v7

    aput-char v2, v0, v8 # v0[3] = pw[2]

    const/4 v2, 0x4

    aget-char v3, v1, v8

    aput-char v3, v0, v2 # v0[4] = pw[3]

    const/4 v2, 0x4

    aget-char v2, v1, v2

    aput-char v2, v0, v4 # v0[5] = pw[4]

    const/4 v2, 0x6

    aget-char v1, v1, v4

    aput-char v1, v0, v2 # v0[6] = pw[5]

    new-instance p1, Ljava/lang/String;

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    invoke-virtual {v1, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a([C)[C # CupsLogin.a([email[4],pw[0],pw[1],pw[2].pw[3].pw[4],pw[5]])

    move-result-object v0

    invoke-direct {p1, v0}, Ljava/lang/String;-><init>([C)V

    goto :goto_0
.end method

.method protected a(Ljava/lang/Boolean;)V
    .locals 3

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    const/4 v1, 0x0

    invoke-static {v0, v1}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Lmx/fill/ez/cups/ezfill/CupsLogin;Lmx/fill/ez/cups/ezfill/g;)Lmx/fill/ez/cups/ezfill/g;

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    const/4 v1, 0x0

    invoke-static {v0, v1}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Lmx/fill/ez/cups/ezfill/CupsLogin;Z)V # some animation stuffs

    invoke-virtual {p1}, Ljava/lang/Boolean;->booleanValue()Z

    move-result v0

    if-eqz v0, :cond_0

    # p1 is true, email/password matches
    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->b:Ljava/lang/String; # email input

    invoke-virtual {v0}, Ljava/lang/String;->toCharArray()[C

    move-result-object v0

    new-instance v1, Ljava/lang/String;

    invoke-direct {v1}, Ljava/lang/String;-><init>()V

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/g;->c:Ljava/lang/String; # password input

    const/4 v2, 0x4

    aget-char v0, v0, v2 #email[4]

    invoke-virtual {p0, v1, v0}, Lmx/fill/ez/cups/ezfill/g;->a(Ljava/lang/String;C)Ljava/lang/String; # this.a(password,email[4]);

    move-result-object v0

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    invoke-virtual {v1, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Ljava/lang/String;)V # settext of a ui element to the string

    :goto_0
    return-void

    :cond_0
    # p1 is false, email/password does not match
    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    invoke-static {v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->d(Lmx/fill/ez/cups/ezfill/CupsLogin;)Landroid/widget/EditText;

    move-result-object v0

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    const v2, 0x7f06001b # error_incorrect_password

    invoke-virtual {v1, v2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->getString(I)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/EditText;->setError(Ljava/lang/CharSequence;)V # set error to error_incorrect_password

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    invoke-static {v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->d(Lmx/fill/ez/cups/ezfill/CupsLogin;)Landroid/widget/EditText;

    move-result-object v0

    invoke-virtual {v0}, Landroid/widget/EditText;->requestFocus()Z # focus on the pw field

    goto :goto_0
.end method

.method a(C)Z # returns !((p1 ^ (p1 & 0xf)) == 0x60)
    .locals 2

    and-int/lit8 v0, p1, 0xf # v0 = p1 & 0xf

    xor-int/2addr v0, p1 # v0 ^= p1

    const/16 v1, 0x60

    if-ne v0, v1, :cond_0

    const/4 v0, 0x0

    :goto_0
    return v0

    :cond_0
    const/4 v0, 0x1

    goto :goto_0
.end method

.method a(CC)Z # returns  !(p1 ^ p2 == 0x15)
    .locals 2

    xor-int v0, p1, p2 # xor 2 input chars

    const/16 v1, 0x15

    if-ne v0, v1, :cond_0

    const/4 v0, 0x0

    :goto_0
    return v0

    :cond_0
    const/4 v0, 0x1

    goto :goto_0
.end method

.method b(C)I # returns (p1 - 5) ^ 3
    .locals 1

    add-int/lit8 v0, p1, -0x5 # vo = p1 - 5

    xor-int/lit8 v0, v0, 0x3 # v0 ^= 3

    return v0
.end method

.method c(C)I # returns p1 * 0x22
    .locals 1

    mul-int/lit8 v0, p1, 0x22

    return v0
.end method

.method d(C)Z # returns !(p1 == 0x64)
    .locals 3

    and-int/lit8 v0, p1, 0xf # v0 = p1 & 0xf

    and-int/lit16 v1, p1, 0xf0 # v1 = p1 & 0xf0

    const/4 v2, 0x4

    if-ne v0, v2, :cond_0 # if (p1 & 0f) != 4

    const/16 v0, 0x60

    if-ne v1, v0, :cond_0 # uf (p1 & 0xf0) != 0x60

    const/4 v0, 0x0

    :goto_0
    return v0

    :cond_0
    const/4 v0, 0x1

    goto :goto_0
.end method

.method protected synthetic doInBackground([Ljava/lang/Object;)Ljava/lang/Object;
    .locals 1

    check-cast p1, [Ljava/lang/Void;

    invoke-virtual {p0, p1}, Lmx/fill/ez/cups/ezfill/g;->a([Ljava/lang/Void;)Ljava/lang/Boolean;

    move-result-object v0

    return-object v0
.end method

.method protected onCancelled()V
    .locals 2

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    const/4 v1, 0x0

    invoke-static {v0, v1}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Lmx/fill/ez/cups/ezfill/CupsLogin;Lmx/fill/ez/cups/ezfill/g;)Lmx/fill/ez/cups/ezfill/g;

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/g;->a:Lmx/fill/ez/cups/ezfill/CupsLogin;

    const/4 v1, 0x0

    invoke-static {v0, v1}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Lmx/fill/ez/cups/ezfill/CupsLogin;Z)V

    return-void
.end method

.method protected synthetic onPostExecute(Ljava/lang/Object;)V
    .locals 0

    check-cast p1, Ljava/lang/Boolean;

    invoke-virtual {p0, p1}, Lmx/fill/ez/cups/ezfill/g;->a(Ljava/lang/Boolean;)V

    return-void
.end method
