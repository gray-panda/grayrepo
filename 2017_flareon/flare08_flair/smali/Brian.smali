.class public Lcom/flare_on/flair/Brian;
.super Landroid/support/v7/app/AppCompatActivity;
.source "Brian.java"

# interfaces
.implements Landroid/view/View$OnClickListener;


# instance fields
.field q:Landroid/widget/EditText;

.field private tEr:I


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 14
    invoke-direct {p0}, Landroid/support/v7/app/AppCompatActivity;-><init>()V

    return-void
.end method

.method private asdjfnhaxshcvhuw(Landroid/widget/TextView;Landroid/widget/ImageView;)Ljava/lang/String;
    .locals 9
    .param p1, "d"    # Landroid/widget/TextView;
    .param p2, "p"    # Landroid/widget/ImageView;

    .prologue
    .line 54
    invoke-virtual {p1}, Landroid/widget/TextView;->getCurrentTextColor()I

    move-result v6

    const v7, 0xffff

    and-int v0, v6, v7 # a = TextColor & 0xffff

    .line 55
    .local v0, "a":I
    invoke-virtual {p1}, Landroid/widget/TextView;->getText()Ljava/lang/CharSequence;

    move-result-object v6

    invoke-interface {v6}, Ljava/lang/CharSequence;->toString()Ljava/lang/String;

    move-result-object v6

    const-string v7, " "

    invoke-virtual {v6, v7}, Ljava/lang/String;->split(Ljava/lang/String;)[Ljava/lang/String;

    move-result-object v6  # split string by " "

    const/4 v7, 0x4

    aget-object v5, v6, v7 # z = split[4]

    .line 56
    .local v5, "z":Ljava/lang/String;
    invoke-virtual {p2}, Landroid/widget/ImageView;->getTag()Ljava/lang/Object;

    move-result-object v6

    invoke-virtual {v6}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object v4  # y = ImageView.getTag().toString()

    .line 61
    .local v4, "y":Ljava/lang/String;
    :try_start_0
    invoke-virtual {p0}, Lcom/flare_on/flair/Brian;->getApplicationContext()Landroid/content/Context;

    move-result-object v6

    invoke-virtual {v6}, Landroid/content/Context;->getPackageManager()Landroid/content/pm/PackageManager;

    move-result-object v6

    invoke-virtual {p0}, Lcom/flare_on/flair/Brian;->getApplicationContext()Landroid/content/Context;

    move-result-object v7

    invoke-virtual {v7}, Landroid/content/Context;->getPackageName()Ljava/lang/String;

    move-result-object v7

    const/16 v8, 0x80

    invoke-virtual {v6, v7, v8}, Landroid/content/pm/PackageManager;->getApplicationInfo(Ljava/lang/String;I)Landroid/content/pm/ApplicationInfo;
    :try_end_0
    .catch Landroid/content/pm/PackageManager$NameNotFoundException; {:try_start_0 .. :try_end_0} :catch_0

    move-result-object v3 # ps = pm.getApplicationInfo(pkgName, GET_META_DATA); (0x80)

    .line 67
    .local v3, "ps":Landroid/content/pm/ApplicationInfo;
    iget-object v6, v3, Landroid/content/pm/ApplicationInfo;->metaData:Landroid/os/Bundle; 

    const-string v7, "vdf"

    invoke-virtual {v6, v7}, Landroid/os/Bundle;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v6 # v6 = ps.metaData.getString("vdf")

    invoke-direct {p0, v4, v0, v5, v6}, Lcom/flare_on/flair/Brian;->dfysadf(Ljava/lang/String;ILjava/lang/String;Ljava/lang/String;)Ljava/lang/String;

    # a = TextColor & 0xffff
    # y = ImageView.getTag().toString()
    # z = TextView.getText.split(" ")[4]
    # v6 = ps.metaData.getString("vdf")
    # this.dfysadf(y, a, z, v6)

    move-result-object v2

    .line 69
    .end local v3    # "ps":Landroid/content/pm/ApplicationInfo;
    :goto_0
    return-object v2

    .line 62
    :catch_0
    move-exception v1

    .line 63
    .local v1, "e":Landroid/content/pm/PackageManager$NameNotFoundException;
    invoke-virtual {v1}, Landroid/content/pm/PackageManager$NameNotFoundException;->printStackTrace()V

    .line 64
    const/4 v2, 0x0

    goto :goto_0
.end method

.method private dfysadf(Ljava/lang/String;ILjava/lang/String;Ljava/lang/String;)Ljava/lang/String;
    .locals 4
    .param p1, "t"    # Ljava/lang/String;
    .param p2, "p"    # I
    .param p3, "c"    # Ljava/lang/String;
    .param p4, "y"    # Ljava/lang/String;

    # this.dfysadf(y, a, z, v6)
    # t = ImageView.getTag().toString()     = "hashtag"
    # p = TextColor & 0xffff                = "fefe"
    # c = TextView.getText.split(" ")[4]    = "fajitas"
    # y = ps.metaData.getString("vdf")      = "cov"
    # pw = "hashtag_covfefe_Fajitas!"
    

    .prologue
    .line 73
    const-string v0, "%s_%s%x_%s!"

    const/4 v1, 0x4

    new-array v1, v1, [Ljava/lang/Object;

    const/4 v2, 0x0

    aput-object p1, v1, v2 # v1[0] = "hashtag"

    const/4 v2, 0x1

    aput-object p4, v1, v2 # v1[1] = "cov"

    const/4 v2, 0x2

    invoke-static {p2}, Ljava/lang/Integer;->valueOf(I)Ljava/lang/Integer;

    move-result-object v3

    aput-object v3, v1, v2 # v1[2] = Integer.valueOf(0xfefe);

    const/4 v2, 0x3

    aput-object p3, v1, v2 # v1[3] = "Fajitas"

    invoke-static {v0, v1}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v0 # pw = "hashtag_covfefe_Fajitas"

    return-object v0
.end method

.method private teraljdknh(Ljava/lang/String;Ljava/lang/String;)Z # check string equals
    .locals 1
    .param p1, "v"    # Ljava/lang/String;
    .param p2, "m"    # Ljava/lang/String;

    .prologue
    .line 77
    invoke-virtual {p1, p2}, Ljava/lang/String;->equals(Ljava/lang/Object;)Z

    move-result v0

    return v0
.end method


# virtual methods
.method public onClick(Landroid/view/View;)V
    .locals 4
    .param p1, "v"    # Landroid/view/View;

    .prologue
    .line 33
    invoke-virtual {p1}, Landroid/view/View;->getId()I

    move-result v3

    packed-switch v3, :pswitch_data_0

    .line 51
    :goto_0
    return-void

    .line 35
    :pswitch_0
    iget-object v3, p0, Lcom/flare_on/flair/Brian;->q:Landroid/widget/EditText;

    invoke-virtual {v3}, Landroid/widget/EditText;->getText()Landroid/text/Editable;

    move-result-object v3

    invoke-virtual {v3}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object v2

    .line 37
    .local v2, "x":Ljava/lang/String;
    const v3, 0x7f0b005e

    invoke-virtual {p0, v3}, Lcom/flare_on/flair/Brian;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    .line 38
    .local v0, "erc":Landroid/widget/TextView;
    const v3, 0x7f0b005f # pfdu

    invoke-virtual {p0, v3}, Lcom/flare_on/flair/Brian;->findViewById(I)Landroid/view/View;

    move-result-object v1

    check-cast v1, Landroid/widget/ImageView;

    .line 40
    .local v1, "ofkle":Landroid/widget/ImageView;
    invoke-direct {p0, v0, v1}, Lcom/flare_on/flair/Brian;->asdjfnhaxshcvhuw(Landroid/widget/TextView;Landroid/widget/ImageView;)Ljava/lang/String;

    move-result-object v3

    invoke-direct {p0, v2, v3}, Lcom/flare_on/flair/Brian;->teraljdknh(Ljava/lang/String;Ljava/lang/String;)Z

    move-result v3

    if-eqz v3, :cond_0

    .line 42
    invoke-static {p0, v2}, Lcom/flare_on/flair/Util;->flairSuccess(Landroid/app/Activity;Ljava/lang/String;)V

    goto :goto_0

    .line 45
    :cond_0
    iget v3, p0, Lcom/flare_on/flair/Brian;->tEr:I

    invoke-static {p0, v3}, Lcom/flare_on/flair/Util;->flairSadness(Landroid/app/Activity;I)V

    .line 46
    iget v3, p0, Lcom/flare_on/flair/Brian;->tEr:I

    add-int/lit8 v3, v3, 0x1

    iput v3, p0, Lcom/flare_on/flair/Brian;->tEr:I

    goto :goto_0

    .line 33
    :pswitch_data_0
    .packed-switch 0x7f0b0060
        :pswitch_0
    .end packed-switch
.end method

.method protected onCreate(Landroid/os/Bundle;)V
    .locals 2
    .param p1, "savedInstanceState"    # Landroid/os/Bundle;

    .prologue
    .line 22
    invoke-super {p0, p1}, Landroid/support/v7/app/AppCompatActivity;->onCreate(Landroid/os/Bundle;)V

    .line 23
    const v1, 0x7f04001b

    invoke-virtual {p0, v1}, Lcom/flare_on/flair/Brian;->setContentView(I)V

    .line 25
    const v1, 0x7f0b0060

    invoke-virtual {p0, v1}, Lcom/flare_on/flair/Brian;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/Button;

    .line 26
    .local v0, "r":Landroid/widget/Button;
    invoke-virtual {v0, p0}, Landroid/widget/Button;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 28
    const v1, 0x7f0b0061

    invoke-virtual {p0, v1}, Lcom/flare_on/flair/Brian;->findViewById(I)Landroid/view/View;

    move-result-object v1

    check-cast v1, Landroid/widget/EditText;

    iput-object v1, p0, Lcom/flare_on/flair/Brian;->q:Landroid/widget/EditText;

    .line 29
    return-void
.end method
