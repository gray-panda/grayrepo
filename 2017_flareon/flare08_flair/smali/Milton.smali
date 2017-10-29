.class public Lcom/flare_on/flair/Milton;
.super Landroid/support/v7/app/AppCompatActivity;
.source "Milton.java"

# interfaces
.implements Landroid/view/View$OnClickListener;


# annotations
.annotation system Ldalvik/annotation/MemberClasses;
    value = {
        Lcom/flare_on/flair/Milton$Uvasdf;
    }
.end annotation


# instance fields
.field private hild:Ljava/lang/String;

.field pexu:Landroid/widget/EditText;

.field r:Landroid/widget/Button;

.field rb:Landroid/widget/RatingBar;

.field private rtgb:I


# direct methods
.method public constructor <init>()V
    .locals 1

    .prologue
    .line 21
    invoke-direct {p0}, Landroid/support/v7/app/AppCompatActivity;-><init>()V

    .line 24
    const-string v0, ""

    iput-object v0, p0, Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;

    .line 29
    const/4 v0, 0x0

    iput v0, p0, Lcom/flare_on/flair/Milton;->rtgb:I

    return-void
.end method

.method static synthetic access$000(Lcom/flare_on/flair/Milton;)Ljava/lang/String; # get_hild
    .locals 1
    .param p0, "x0"    # Lcom/flare_on/flair/Milton;

    .prologue
    .line 21
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;

    return-object v0
.end method

.method static synthetic access$002(Lcom/flare_on/flair/Milton;Ljava/lang/String;)Ljava/lang/String; # set_hild
    .locals 0
    .param p0, "x0"    # Lcom/flare_on/flair/Milton;
    .param p1, "x1"    # Ljava/lang/String;

    .prologue
    .line 21
    iput-object p1, p0, Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;

    return-object p1
.end method

.method private breop(Ljava/lang/String;)Z # compares hex2bin($input) with sha1($hild)
    .locals 4
    .param p1, "l"    # Ljava/lang/String;

    .prologue
    const/4 v2, 0x0

    .line 89
    invoke-static {p0}, Lcom/flare_on/flair/Milton;->checkDebuggable(Landroid/content/Context;)Z

    move-result v3

    if-eqz v3, :cond_0  # anti-debugger check?

    .line 104
    :goto_0
    return v2

    .line 94
    :cond_0
    invoke-static {p1}, Lcom/flare_on/flair/Stapler;->neapucx(Ljava/lang/String;)[B  # hex2binary

    move-result-object v1

    .line 98
    .local v1, "rt":[B
    :try_start_0
    invoke-direct {p0}, Lcom/flare_on/flair/Milton;->nbsadf()[B # do sha1($hild)

    move-result-object v3

    invoke-static {v1, v3}, Ljava/util/Arrays;->equals([B[B)Z
    :try_end_0
    .catch Ljava/io/UnsupportedEncodingException; {:try_start_0 .. :try_end_0} :catch_0
    .catch Ljava/security/NoSuchAlgorithmException; {:try_start_0 .. :try_end_0} :catch_1

    move-result v2

    goto :goto_0

    .line 99
    :catch_0
    move-exception v0

    .line 100
    .local v0, "e":Ljava/io/UnsupportedEncodingException;
    invoke-virtual {v0}, Ljava/io/UnsupportedEncodingException;->printStackTrace()V

    goto :goto_0

    .line 102
    .end local v0    # "e":Ljava/io/UnsupportedEncodingException;
    :catch_1
    move-exception v0

    .line 103
    .local v0, "e":Ljava/security/NoSuchAlgorithmException;
    invoke-virtual {v0}, Ljava/security/NoSuchAlgorithmException;->printStackTrace()V

    goto :goto_0
.end method

.method private nbsadf()[B # sha1($hild)
    .locals 2
    .annotation system Ldalvik/annotation/Throws;
        value = {
            Ljava/io/UnsupportedEncodingException;,
            Ljava/security/NoSuchAlgorithmException;
        }
    .end annotation

    .prologue
    .line 112
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;

    const-string v1, "UTF-8"

    invoke-virtual {v0, v1}, Ljava/lang/String;->getBytes(Ljava/lang/String;)[B

    move-result-object v0

    invoke-static {v0}, Lcom/flare_on/flair/Stapler;->poserw([B)[B # do sha1

    move-result-object v0

    return-object v0
.end method

.method public static checkDebuggable(Landroid/content/Context;)Z # trsbd
    .locals 1
    .param p0, "context"    # Landroid/content/Context;

    .prologue
    .line 116
    invoke-virtual {p0}, Landroid/content/Context;->getApplicationContext()Landroid/content/Context;

    move-result-object v0

    invoke-virtual {v0}, Landroid/content/Context;->getApplicationInfo()Landroid/content/pm/ApplicationInfo;

    move-result-object v0

    iget v0, v0, Landroid/content/pm/ApplicationInfo;->flags:I

    # FLAG_ALLOW_BACKUP = 0x8000
    # FLAG_SUPPORTS_RTL = 0x400000
    # flag should be 0x40800000

    and-int/lit8 v0, v0, 0x2 # checking for flag 0x2 (FLAG_DEBUGGABLE)

    if-eqz v0, :cond_0

    const/4 v0, 0x1

    :goto_0
    return v0

    :cond_0
    const/4 v0, 0x0

    goto :goto_0
.end method

.method private vbdrt()V # init $hild and ratingbar
    .locals 2

    .prologue
    .line 82
    const-string v0, ""

    iput-object v0, p0, Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String; # hild = ""

    .line 83
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->r:Landroid/widget/Button;

    const/4 v1, 0x0

    invoke-virtual {v0, v1}, Landroid/widget/Button;->setEnabled(Z)V

    .line 84
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->rb:Landroid/widget/RatingBar;

    const/4 v1, 0x0

    invoke-virtual {v0, v1}, Landroid/widget/RatingBar;->setRating(F)V # set rating to 0

    .line 85
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->rb:Landroid/widget/RatingBar;

    const/4 v1, 0x1

    invoke-virtual {v0, v1}, Landroid/widget/RatingBar;->setEnabled(Z)V # enables rating bar

    .line 86
    return-void
.end method


# virtual methods
.method public onClick(Landroid/view/View;)V # success if breop returns true, if fail, calls vbdrt
    .locals 2
    .param p1, "v"    # Landroid/view/View;

    .prologue
    .line 65
    invoke-virtual {p1}, Landroid/view/View;->getId()I

    move-result v1

    packed-switch v1, :pswitch_data_0

    .line 79
    :goto_0
    return-void

    .line 67
    :pswitch_0
    iget-object v1, p0, Lcom/flare_on/flair/Milton;->pexu:Landroid/widget/EditText;

    invoke-virtual {v1}, Landroid/widget/EditText;->getText()Landroid/text/Editable;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object v0

    .line 68
    .local v0, "rsk":Ljava/lang/String;
    invoke-direct {p0, v0}, Lcom/flare_on/flair/Milton;->breop(Ljava/lang/String;)Z # compares hex2bin($input) with sha1($hild)

    move-result v1

    if-eqz v1, :cond_0

    .line 70
    invoke-static {p0, v0}, Lcom/flare_on/flair/Util;->flairSuccess(Landroid/app/Activity;Ljava/lang/String;)V

    goto :goto_0

    .line 73
    :cond_0
    invoke-direct {p0}, Lcom/flare_on/flair/Milton;->vbdrt()V # init $hild and ratingbar

    .line 74
    iget v1, p0, Lcom/flare_on/flair/Milton;->rtgb:I

    invoke-static {p0, v1}, Lcom/flare_on/flair/Util;->flairSadness(Landroid/app/Activity;I)V

    .line 75
    iget v1, p0, Lcom/flare_on/flair/Milton;->rtgb:I

    add-int/lit8 v1, v1, 0x1

    iput v1, p0, Lcom/flare_on/flair/Milton;->rtgb:I

    goto :goto_0

    .line 65
    nop

    :pswitch_data_0
    .packed-switch 0x7f0b006f
        :pswitch_0
    .end packed-switch
.end method

.method protected onCreate(Landroid/os/Bundle;)V
    .locals 2
    .param p1, "savedInstanceState"    # Landroid/os/Bundle;

    .prologue
    .line 33
    invoke-super {p0, p1}, Landroid/support/v7/app/AppCompatActivity;->onCreate(Landroid/os/Bundle;)V

    .line 34
    const v0, 0x7f04001e

    invoke-virtual {p0, v0}, Lcom/flare_on/flair/Milton;->setContentView(I)V

    .line 36
    const v0, 0x7f0b006f

    invoke-virtual {p0, v0}, Lcom/flare_on/flair/Milton;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/Button;

    iput-object v0, p0, Lcom/flare_on/flair/Milton;->r:Landroid/widget/Button;

    .line 37
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->r:Landroid/widget/Button;

    invoke-virtual {v0, p0}, Landroid/widget/Button;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 39
    const v0, 0x7f0b0070

    invoke-virtual {p0, v0}, Lcom/flare_on/flair/Milton;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/RatingBar;

    iput-object v0, p0, Lcom/flare_on/flair/Milton;->rb:Landroid/widget/RatingBar;

    .line 40
    iget-object v0, p0, Lcom/flare_on/flair/Milton;->rb:Landroid/widget/RatingBar;

    new-instance v1, Lcom/flare_on/flair/Milton$Uvasdf;

    invoke-direct {v1, p0}, Lcom/flare_on/flair/Milton$Uvasdf;-><init>(Lcom/flare_on/flair/Milton;)V

    invoke-virtual {v0, v1}, Landroid/widget/RatingBar;->setOnRatingBarChangeListener(Landroid/widget/RatingBar$OnRatingBarChangeListener;)V

    .line 42
    const v0, 0x7f0b006b

    invoke-virtual {p0, v0}, Lcom/flare_on/flair/Milton;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/EditText;

    iput-object v0, p0, Lcom/flare_on/flair/Milton;->pexu:Landroid/widget/EditText;

    .line 43
    return-void
.end method
