.class public Lcom/flare_on/flair/Michael;
.super Landroid/support/v7/app/AppCompatActivity;
.source "Michael.java"

# interfaces
.implements Landroid/view/View$OnClickListener;


# static fields
.field private static final PW_LENGTH:I = 0xc


# instance fields
.field private failCount:I

.field private password:Landroid/widget/EditText;


# direct methods
.method public constructor <init>()V
    .locals 1

    .prologue
    .line 10
    invoke-direct {p0}, Landroid/support/v7/app/AppCompatActivity;-><init>()V

    .line 14
    const/4 v0, 0x0

    iput v0, p0, Lcom/flare_on/flair/Michael;->failCount:I

    return-void
.end method

.method private checkPassword(Ljava/lang/String;)Z # checks for "MYPRSHE__FTW"
    .locals 6
    .param p1, "pw"    # Ljava/lang/String;

    .prologue
    const/16 v5, 0x9

    const/4 v4, 0x7

    const/4 v3, 0x5

    .line 46
    invoke-virtual {p1}, Ljava/lang/String;->isEmpty()Z

    move-result v1

    if-nez v1, :cond_0

    invoke-virtual {p1}, Ljava/lang/String;->length()I

    move-result v1

    const/16 v2, 0xc # pw is 12 char long

    if-eq v1, v2, :cond_2

    .line 47
    :cond_0
    const/4 v0, 0x0

    .line 96
    :cond_1
    :goto_0
    return v0

    .line 51
    :cond_2
    const/4 v0, 0x1

    .line 54
    .local v0, "result":Z
    const-string v1, "M"

    invoke-virtual {p1, v1}, Ljava/lang/String;->startsWith(Ljava/lang/String;)Z # pw[0] = 'M'

    move-result v1

    if-nez v1, :cond_3

    .line 55
    const/4 v0, 0x0

    .line 60
    :cond_3
    const/16 v1, 0x59

    invoke-virtual {p1, v1}, Ljava/lang/String;->indexOf(I)I # pw[1] = "Y"

    move-result v1

    const/4 v2, 0x1

    if-eq v1, v2, :cond_4

    .line 61
    const/4 v0, 0x0

    .line 66
    :cond_4
    const/4 v1, 0x2

    invoke-virtual {p1, v1, v3}, Ljava/lang/String;->substring(II)Ljava/lang/String;

    move-result-object v1

    const-string v2, "PRS"

    invoke-virtual {v1, v2}, Ljava/lang/String;->equals(Ljava/lang/Object;)Z # pw[2-4] = "PRS"

    move-result v1

    if-nez v1, :cond_5

    .line 67
    const/4 v0, 0x0

    .line 72
    :cond_5
    invoke-virtual {p1, v3}, Ljava/lang/String;->codePointAt(I)I # pw[5] = "H"

    move-result v1

    const/16 v2, 0x48

    if-ne v1, v2, :cond_6

    const/4 v1, 0x6

    invoke-virtual {p1, v1}, Ljava/lang/String;->codePointAt(I)I # pw[6] = "E"

    move-result v1

    const/16 v2, 0x45

    if-eq v1, v2, :cond_7

    .line 73
    :cond_6
    const/4 v0, 0x0

    .line 78
    :cond_7
    invoke-virtual {p1, v4}, Ljava/lang/String;->charAt(I)C # pw[7] == pw[8]

    move-result v1

    const/16 v2, 0x8

    invoke-virtual {p1, v2}, Ljava/lang/String;->charAt(I)C

    move-result v2

    if-ne v1, v2, :cond_8

    invoke-virtual {p1, v4, v5}, Ljava/lang/String;->substring(II)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/String;->hashCode()I # pw[7-8].hashCode == 0xbe0

    move-result v1

    const/16 v2, 0xbe0

    if-eq v1, v2, :cond_9

    .line 80
    :cond_8
    const/4 v0, 0x0

    .line 85
    :cond_9
    const-string v1, "FT"

    invoke-virtual {p1, v1}, Ljava/lang/String;->indexOf(Ljava/lang/String;)I # pw[9-10] = "FT"

    move-result v1

    if-eq v1, v5, :cond_a

    .line 86
    const/4 v0, 0x0

    .line 91
    :cond_a
    const/16 v1, 0x57

    invoke-virtual {p1, v1}, Ljava/lang/String;->lastIndexOf(I)I # pw[11] = "W"

    move-result v1

    invoke-virtual {p1}, Ljava/lang/String;->length()I

    move-result v2

    add-int/lit8 v2, v2, -0x1

    if-eq v1, v2, :cond_1

    .line 92
    const/4 v0, 0x0

    goto :goto_0
.end method


# virtual methods
.method public onClick(Landroid/view/View;)V # takes the text from the EditText textbox and pass it to checkPassword function
    .locals 2
    .param p1, "v"    # Landroid/view/View;

    .prologue
    .line 30
    invoke-virtual {p1}, Landroid/view/View;->getId()I

    move-result v1

    packed-switch v1, :pswitch_data_0

    .line 43
    :goto_0
    return-void

    .line 32
    :pswitch_0
    iget-object v1, p0, Lcom/flare_on/flair/Michael;->password:Landroid/widget/EditText;

    invoke-virtual {v1}, Landroid/widget/EditText;->getText()Landroid/text/Editable;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object v0

    .line 33
    .local v0, "pw":Ljava/lang/String;
    invoke-direct {p0, v0}, Lcom/flare_on/flair/Michael;->checkPassword(Ljava/lang/String;)Z

    move-result v1

    if-eqz v1, :cond_0

    .line 35
    invoke-static {p0, v0}, Lcom/flare_on/flair/Util;->flairSuccess(Landroid/app/Activity;Ljava/lang/String;)V

    goto :goto_0

    .line 38
    :cond_0
    iget v1, p0, Lcom/flare_on/flair/Michael;->failCount:I

    invoke-static {p0, v1}, Lcom/flare_on/flair/Util;->flairSadness(Landroid/app/Activity;I)V

    .line 39
    iget v1, p0, Lcom/flare_on/flair/Michael;->failCount:I

    add-int/lit8 v1, v1, 0x1

    iput v1, p0, Lcom/flare_on/flair/Michael;->failCount:I

    goto :goto_0

    .line 30
    :pswitch_data_0
    .packed-switch 0x7f0b006c
        :pswitch_0
    .end packed-switch
.end method

.method protected onCreate(Landroid/os/Bundle;)V
    .locals 2
    .param p1, "savedInstanceState"    # Landroid/os/Bundle;

    .prologue
    .line 19
    invoke-super {p0, p1}, Landroid/support/v7/app/AppCompatActivity;->onCreate(Landroid/os/Bundle;)V

    .line 20
    const v1, 0x7f04001d

    invoke-virtual {p0, v1}, Lcom/flare_on/flair/Michael;->setContentView(I)V

    .line 22
    const v1, 0x7f0b006c

    invoke-virtual {p0, v1}, Lcom/flare_on/flair/Michael;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/Button;

    .line 23
    .local v0, "africaButton":Landroid/widget/Button;
    invoke-virtual {v0, p0}, Landroid/widget/Button;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 25
    const v1, 0x7f0b006b

    invoke-virtual {p0, v1}, Lcom/flare_on/flair/Michael;->findViewById(I)Landroid/view/View;

    move-result-object v1

    check-cast v1, Landroid/widget/EditText;

    iput-object v1, p0, Lcom/flare_on/flair/Michael;->password:Landroid/widget/EditText;

    .line 26
    return-void
.end method
