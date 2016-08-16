.class public Lmx/fill/ez/cups/ezfill/CupsLogin;
.super Landroid/support/v7/a/u;

# interfaces
.implements Landroid/app/LoaderManager$LoaderCallbacks;


# static fields
.field private static final l:[Ljava/lang/String;


# instance fields
.field private m:Lmx/fill/ez/cups/ezfill/g;

.field private n:Landroid/widget/AutoCompleteTextView; # email input

.field private o:Landroid/widget/EditText; # password input

.field private p:Landroid/view/View;

.field private q:Landroid/view/View;


# direct methods
.method static constructor <clinit>()V
    .locals 3

    const/16 v0, 0x11

    new-array v0, v0, [Ljava/lang/String;

    const/4 v1, 0x0

    const-string v2, "foo@example.com:hello"

    aput-object v2, v0, v1

    const/4 v1, 0x1

    const-string v2, "bar@example.com:world"

    aput-object v2, v0, v1

    const/4 v1, 0x2

    const-string v2, "tetris@nintendo.com:barre11$"

    aput-object v2, v0, v1

    const/4 v1, 0x3

    const-string v2, "drltchie@bell.com:c4lif3!!"

    aput-object v2, v0, v1

    const/4 v1, 0x4

    const-string v2, "ash@pokemon.com:master0"

    aput-object v2, v0, v1

    const/4 v1, 0x5

    const-string v2, "wozMan@free.com:apple1"

    aput-object v2, v0, v1

    const/4 v1, 0x6

    const-string v2, "pescobar@coca.com:thuglife"

    aput-object v2, v0, v1

    const/4 v1, 0x7

    const-string v2, "lisa@app13.com:stev0j0bs"

    aput-object v2, v0, v1

    const/16 v1, 0x8

    const-string v2, "chewy@cool.com:things"

    aput-object v2, v0, v1

    const/16 v1, 0x9

    const-string v2, "ccups@reisfun.net:h20isgood"

    aput-object v2, v0, v1

    const/16 v1, 0xa

    const-string v2, "solo@starwars.com:reds0lo"

    aput-object v2, v0, v1

    const/16 v1, 0xb

    const-string v2, "dacoach@bears.com:shuffle"

    aput-object v2, v0, v1

    const/16 v1, 0xc

    const-string v2, "pack3rh4ter@bears.com:th3ysuck"

    aput-object v2, v0, v1

    const/16 v1, 0xd

    const-string v2, "bill@wind0z.ru:h4cker1"

    aput-object v2, v0, v1

    const/16 v1, 0xe

    const-string v2, "mario@nintendo.jp:i<3princess"

    aput-object v2, v0, v1

    const/16 v1, 0xf

    const-string v2, "donkey@k0n.go:barre11$"

    aput-object v2, v0, v1

    const/16 v1, 0x10

    const-string v2, "dritchie@bell.com:c4lif3!"

    aput-object v2, v0, v1

    sput-object v0, Lmx/fill/ez/cups/ezfill/CupsLogin;->l:[Ljava/lang/String;

    return-void
.end method

.method public constructor <init>()V
    .locals 1

    invoke-direct {p0}, Landroid/support/v7/a/u;-><init>()V

    const/4 v0, 0x0

    iput-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->m:Lmx/fill/ez/cups/ezfill/g;

    return-void
.end method

.method static synthetic a(Lmx/fill/ez/cups/ezfill/CupsLogin;Lmx/fill/ez/cups/ezfill/g;)Lmx/fill/ez/cups/ezfill/g;
    .locals 0

    iput-object p1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->m:Lmx/fill/ez/cups/ezfill/g;

    return-object p1
.end method

.method private a(Ljava/util/List;)V
    .locals 2

    new-instance v0, Landroid/widget/ArrayAdapter;

    const v1, 0x109000a

    invoke-direct {v0, p0, v1, p1}, Landroid/widget/ArrayAdapter;-><init>(Landroid/content/Context;ILjava/util/List;)V

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    invoke-virtual {v1, v0}, Landroid/widget/AutoCompleteTextView;->setAdapter(Landroid/widget/ListAdapter;)V

    return-void
.end method

.method static synthetic a(Lmx/fill/ez/cups/ezfill/CupsLogin;)V
    .locals 0

    invoke-direct {p0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->m()V

    return-void
.end method

.method static synthetic a(Lmx/fill/ez/cups/ezfill/CupsLogin;Z)V
    .locals 0

    invoke-direct {p0, p1}, Lmx/fill/ez/cups/ezfill/CupsLogin;->b(Z)V

    return-void
.end method

.method static synthetic b(Lmx/fill/ez/cups/ezfill/CupsLogin;)Landroid/view/View;
    .locals 1

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->q:Landroid/view/View;

    return-object v0
.end method

.method private b(Z)V
    .locals 8
    .annotation build Landroid/annotation/TargetApi;
        value = 0xd
    .end annotation

    const/high16 v4, 0x3f800000

    const/4 v3, 0x0

    const/16 v1, 0x8

    const/4 v2, 0x0

    sget v0, Landroid/os/Build$VERSION;->SDK_INT:I

    const/16 v5, 0xd

    if-lt v0, v5, :cond_4

    invoke-virtual {p0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->getResources()Landroid/content/res/Resources;

    move-result-object v0

    const/high16 v5, 0x10e0000

    invoke-virtual {v0, v5}, Landroid/content/res/Resources;->getInteger(I)I

    move-result v5

    iget-object v6, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->q:Landroid/view/View;

    if-eqz p1, :cond_0

    move v0, v1

    :goto_0
    invoke-virtual {v6, v0}, Landroid/view/View;->setVisibility(I)V

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->q:Landroid/view/View;

    invoke-virtual {v0}, Landroid/view/View;->animate()Landroid/view/ViewPropertyAnimator;

    move-result-object v0

    int-to-long v6, v5

    invoke-virtual {v0, v6, v7}, Landroid/view/ViewPropertyAnimator;->setDuration(J)Landroid/view/ViewPropertyAnimator;

    move-result-object v6

    if-eqz p1, :cond_1

    move v0, v3

    :goto_1
    invoke-virtual {v6, v0}, Landroid/view/ViewPropertyAnimator;->alpha(F)Landroid/view/ViewPropertyAnimator;

    move-result-object v0

    new-instance v6, Lmx/fill/ez/cups/ezfill/d;

    invoke-direct {v6, p0, p1}, Lmx/fill/ez/cups/ezfill/d;-><init>(Lmx/fill/ez/cups/ezfill/CupsLogin;Z)V

    invoke-virtual {v0, v6}, Landroid/view/ViewPropertyAnimator;->setListener(Landroid/animation/Animator$AnimatorListener;)Landroid/view/ViewPropertyAnimator;

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->p:Landroid/view/View;

    if-eqz p1, :cond_2

    :goto_2
    invoke-virtual {v0, v2}, Landroid/view/View;->setVisibility(I)V

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->p:Landroid/view/View;

    invoke-virtual {v0}, Landroid/view/View;->animate()Landroid/view/ViewPropertyAnimator;

    move-result-object v0

    int-to-long v6, v5

    invoke-virtual {v0, v6, v7}, Landroid/view/ViewPropertyAnimator;->setDuration(J)Landroid/view/ViewPropertyAnimator;

    move-result-object v0

    if-eqz p1, :cond_3

    :goto_3
    invoke-virtual {v0, v4}, Landroid/view/ViewPropertyAnimator;->alpha(F)Landroid/view/ViewPropertyAnimator;

    move-result-object v0

    new-instance v1, Lmx/fill/ez/cups/ezfill/e;

    invoke-direct {v1, p0, p1}, Lmx/fill/ez/cups/ezfill/e;-><init>(Lmx/fill/ez/cups/ezfill/CupsLogin;Z)V

    invoke-virtual {v0, v1}, Landroid/view/ViewPropertyAnimator;->setListener(Landroid/animation/Animator$AnimatorListener;)Landroid/view/ViewPropertyAnimator;

    :goto_4
    return-void

    :cond_0
    move v0, v2

    goto :goto_0

    :cond_1
    move v0, v4

    goto :goto_1

    :cond_2
    move v2, v1

    goto :goto_2

    :cond_3
    move v4, v3

    goto :goto_3

    :cond_4
    iget-object v3, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->p:Landroid/view/View;

    if-eqz p1, :cond_5

    move v0, v2

    :goto_5
    invoke-virtual {v3, v0}, Landroid/view/View;->setVisibility(I)V

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->q:Landroid/view/View;

    if-eqz p1, :cond_6

    :goto_6
    invoke-virtual {v0, v1}, Landroid/view/View;->setVisibility(I)V

    goto :goto_4

    :cond_5
    move v0, v1

    goto :goto_5

    :cond_6
    move v1, v2

    goto :goto_6
.end method

.method private b(Ljava/lang/String;)Z
    .locals 1

    const/16 v0, 0x40

    invoke-static {v0}, Ljava/lang/String;->valueOf(C)Ljava/lang/String;

    move-result-object v0

    invoke-virtual {p1, v0}, Ljava/lang/String;->contains(Ljava/lang/CharSequence;)Z

    move-result v0

    return v0
.end method

.method static synthetic c(Lmx/fill/ez/cups/ezfill/CupsLogin;)Landroid/view/View;
    .locals 1

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->p:Landroid/view/View;

    return-object v0
.end method

.method private c(Ljava/lang/String;)Z
    .locals 2

    invoke-virtual {p1}, Ljava/lang/String;->length()I

    move-result v0

    const-string v1, "4"

    invoke-static {v1}, Ljava/lang/Integer;->parseInt(Ljava/lang/String;)I

    move-result v1

    if-le v0, v1, :cond_0

    const/4 v0, 0x1

    :goto_0
    return v0

    :cond_0
    const/4 v0, 0x0

    goto :goto_0
.end method

.method static synthetic d(Lmx/fill/ez/cups/ezfill/CupsLogin;)Landroid/widget/EditText;
    .locals 1

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText;

    return-object v0
.end method

.method static synthetic j()[Ljava/lang/String;
    .locals 1

    sget-object v0, Lmx/fill/ez/cups/ezfill/CupsLogin;->l:[Ljava/lang/String;

    return-object v0
.end method

.method private k()V # inits the loader
    .locals 3

    invoke-direct {p0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->l()Z

    move-result v0

    if-nez v0, :cond_0

    :goto_0
    return-void

    :cond_0
    invoke-virtual {p0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->getLoaderManager()Landroid/app/LoaderManager;

    move-result-object v0

    const/4 v1, 0x0

    const/4 v2, 0x0

    invoke-virtual {v0, v1, v2, p0}, Landroid/app/LoaderManager;->initLoader(ILandroid/os/Bundle;Landroid/app/LoaderManager$LoaderCallbacks;)Landroid/content/Loader;

    goto :goto_0 
.end method

.method private l()Z # checks and asks from Contacts permission
    .locals 4

    const/4 v0, 0x1

    const/4 v1, 0x0

    sget v2, Landroid/os/Build$VERSION;->SDK_INT:I

    const/16 v3, 0x17

    if-ge v2, v3, :cond_1

    :cond_0
    :goto_0
    return v0

    :cond_1
    const-string v2, "android.permission.READ_CONTACTS"

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->checkSelfPermission(Ljava/lang/String;)I

    move-result v2

    if-eqz v2, :cond_0

    const-string v2, "android.permission.READ_CONTACTS"

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->shouldShowRequestPermissionRationale(Ljava/lang/String;)Z

    move-result v2

    if-eqz v2, :cond_2

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    const v2, 0x7f06001f

    const/4 v3, -0x2

    invoke-static {v0, v2, v3}, Landroid/support/design/widget/Snackbar;->a(Landroid/view/View;II)Landroid/support/design/widget/Snackbar;

    move-result-object v0

    const v2, 0x104000a

    new-instance v3, Lmx/fill/ez/cups/ezfill/c;

    invoke-direct {v3, p0}, Lmx/fill/ez/cups/ezfill/c;-><init>(Lmx/fill/ez/cups/ezfill/CupsLogin;)V

    invoke-virtual {v0, v2, v3}, Landroid/support/design/widget/Snackbar;->a(ILandroid/view/View$OnClickListener;)Landroid/support/design/widget/Snackbar;

    :goto_1
    move v0, v1

    goto :goto_0

    :cond_2
    new-array v0, v0, [Ljava/lang/String;

    const-string v2, "android.permission.READ_CONTACTS"

    aput-object v2, v0, v1

    invoke-virtual {p0, v0, v1}, Lmx/fill/ez/cups/ezfill/CupsLogin;->requestPermissions([Ljava/lang/String;I)V

    goto :goto_1 
.end method

.method private m()V # validates email/password input and starts executes asynctask 'g'
    .locals 8

    const/4 v4, 0x0

    const/4 v0, 0x0

    const/4 v3, 0x1

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->m:Lmx/fill/ez/cups/ezfill/g;

    if-eqz v1, :cond_0

    :goto_0
    return-void

    :cond_0
    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    invoke-virtual {v1, v0}, Landroid/widget/AutoCompleteTextView;->setError(Ljava/lang/CharSequence;)V

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText;

    invoke-virtual {v1, v0}, Landroid/widget/EditText;->setError(Ljava/lang/CharSequence;)V

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView; # email input

    invoke-virtual {v1}, Landroid/widget/AutoCompleteTextView;->getText()Landroid/text/Editable;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object v5

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText; # password input

    invoke-virtual {v1}, Landroid/widget/EditText;->getText()Landroid/text/Editable;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/Object;->toString()Ljava/lang/String;

    move-result-object v6

    invoke-static {v6}, Landroid/text/TextUtils;->isEmpty(Ljava/lang/CharSequence;)Z

    move-result v1

    if-nez v1, :cond_4

    invoke-direct {p0, v6}, Lmx/fill/ez/cups/ezfill/CupsLogin;->c(Ljava/lang/String;)Z # checks password length is more than 4

    move-result v1

    if-nez v1, :cond_4

    # password is either empty or length <= 4
    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText; 

    const v2, 0x7f06001d # error_invalid_password

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->getString(I)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Landroid/widget/EditText;->setError(Ljava/lang/CharSequence;)V # sets error to error_invalid_password

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText;

    move v2, v3

    :goto_1
    invoke-static {v5}, Landroid/text/TextUtils;->isEmpty(Ljava/lang/CharSequence;)Z # checks if email is empty

    move-result v7

    if-eqz v7, :cond_2

    # email is empty
    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView; #email input

    const v2, 0x7f06001a # error_field_required

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->getString(I)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Landroid/widget/AutoCompleteTextView;->setError(Ljava/lang/CharSequence;)V # sets error to error_field_required

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    move v2, v3

    :cond_1
    :goto_2
    if-eqz v2, :cond_3

    invoke-virtual {v1}, Landroid/view/View;->requestFocus()Z

    goto :goto_0

    :cond_2 # email is not empty
    invoke-direct {p0, v5}, Lmx/fill/ez/cups/ezfill/CupsLogin;->b(Ljava/lang/String;)Z # this.b(email) , checks if email contains char '@'

    move-result v7

    if-nez v7, :cond_1

    # email does not contains char '@'
    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    const v2, 0x7f06001c # error_invalid_email

    invoke-virtual {p0, v2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->getString(I)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Landroid/widget/AutoCompleteTextView;->setError(Ljava/lang/CharSequence;)V # sets error to error_invalid_email

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    move v2, v3

    goto :goto_2

    :cond_3
    invoke-direct {p0, v3}, Lmx/fill/ez/cups/ezfill/CupsLogin;->b(Z)V # do some animation stuffs

    new-instance v1, Lmx/fill/ez/cups/ezfill/g;

    invoke-direct {v1, p0, v5, v6}, Lmx/fill/ez/cups/ezfill/g;-><init>(Lmx/fill/ez/cups/ezfill/CupsLogin;Ljava/lang/String;Ljava/lang/String;)V

    iput-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->m:Lmx/fill/ez/cups/ezfill/g;

    iget-object v1, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->m:Lmx/fill/ez/cups/ezfill/g;

    new-array v2, v3, [Ljava/lang/Void;

    check-cast v0, Ljava/lang/Void;

    aput-object v0, v2, v4

    invoke-virtual {v1, v2}, Lmx/fill/ez/cups/ezfill/g;->execute([Ljava/lang/Object;)Landroid/os/AsyncTask;

    goto :goto_0

    :cond_4
    move-object v1, v0

    move v2, v4

    goto :goto_1
.end method


# virtual methods
.method public a(Landroid/content/Loader;Landroid/database/Cursor;)V
    .locals 2

    new-instance v0, Ljava/util/ArrayList;

    invoke-direct {v0}, Ljava/util/ArrayList;-><init>()V

    invoke-interface {p2}, Landroid/database/Cursor;->moveToFirst()Z

    :goto_0
    invoke-interface {p2}, Landroid/database/Cursor;->isAfterLast()Z

    move-result v1

    if-nez v1, :cond_0

    const/4 v1, 0x0

    invoke-interface {p2, v1}, Landroid/database/Cursor;->getString(I)Ljava/lang/String;

    move-result-object v1

    invoke-interface {v0, v1}, Ljava/util/List;->add(Ljava/lang/Object;)Z

    invoke-interface {p2}, Landroid/database/Cursor;->moveToNext()Z

    goto :goto_0

    :cond_0
    invoke-direct {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Ljava/util/List;)V

    return-void
.end method

.method a(Ljava/lang/String;)V
    .locals 1

    const v0, 0x7f0c0070

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    invoke-virtual {v0, p1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    return-void
.end method

.method a([C)[C
    .locals 9

    const/4 v1, 0x0

    const/16 v0, 0x25

    new-array v3, v0, [I

    fill-array-data v3, :array_0

    array-length v0, v3

    new-array v4, v0, [C

    array-length v5, v3

    array-length v6, p1

    move v2, v1

    move v0, v1

    :goto_0
    if-ge v2, v5, :cond_2

    aget v7, v3, v2

    add-int/lit8 v7, v7, -0x2

    aget-char v8, p1, v0

    add-int/lit8 v8, v8, -0x13

    add-int/lit8 v8, v8, 0x56

    xor-int/2addr v7, v8

    shr-int/lit8 v7, v7, 0x2

    add-int/lit8 v0, v0, 0x1

    if-eq v0, v6, :cond_0

    aget-char v8, p1, v0

    if-nez v8, :cond_1

    :cond_0
    move v0, v1

    :cond_1
    int-to-char v7, v7

    aput-char v7, v4, v2

    add-int/lit8 v2, v2, 0x1

    goto :goto_0

    :cond_2
    return-object v4

    :array_0
    .array-data 4
        0x1c5
        0x1af
        0x199
        0x156
        0x13e
        0x125
        0x1cc
        0x111
        0x17f
        0x171
        0x176
        0x1d2
        0x105
        0x17c
        0x201
        0x10b
        0x12d
        0x10a
        0x136
        0x1b5
        0x104
        0x145
        0x17b
        0x14d
        0x1c6
        0x15e
        0x159
        0x1cc
        0x125
        0x12f
        0x121
        0x122
        0x1b6
        0x175
        0x108
        0x135
        0x15f
    .end array-data
.end method

.method protected onCreate(Landroid/os/Bundle;)V
    .locals 2

    invoke-super {p0, p1}, Landroid/support/v7/a/u;->onCreate(Landroid/os/Bundle;)V

    const v0, 0x7f040019

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->setContentView(I)V

    const v0, 0x7f0c006c

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/AutoCompleteTextView;

    iput-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->n:Landroid/widget/AutoCompleteTextView;

    invoke-direct {p0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->k()V

    const v0, 0x7f0c006d

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/EditText;

    iput-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText;

    iget-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->o:Landroid/widget/EditText;

    new-instance v1, Lmx/fill/ez/cups/ezfill/a;

    invoke-direct {v1, p0}, Lmx/fill/ez/cups/ezfill/a;-><init>(Lmx/fill/ez/cups/ezfill/CupsLogin;)V

    invoke-virtual {v0, v1}, Landroid/widget/EditText;->setOnEditorActionListener(Landroid/widget/TextView$OnEditorActionListener;)V

    const v0, 0x7f0c006f

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/Button;

    new-instance v1, Lmx/fill/ez/cups/ezfill/b;

    invoke-direct {v1, p0}, Lmx/fill/ez/cups/ezfill/b;-><init>(Lmx/fill/ez/cups/ezfill/CupsLogin;)V

    invoke-virtual {v0, v1}, Landroid/widget/Button;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    const v0, 0x7f0c006a

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->findViewById(I)Landroid/view/View;

    move-result-object v0

    iput-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->q:Landroid/view/View;

    const v0, 0x7f0c0069

    invoke-virtual {p0, v0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->findViewById(I)Landroid/view/View;

    move-result-object v0

    iput-object v0, p0, Lmx/fill/ez/cups/ezfill/CupsLogin;->p:Landroid/view/View;

    return-void
.end method

.method public onCreateLoader(ILandroid/os/Bundle;)Landroid/content/Loader;
    .locals 7

    new-instance v0, Landroid/content/CursorLoader;

    sget-object v1, Landroid/provider/ContactsContract$Profile;->CONTENT_URI:Landroid/net/Uri;

    const-string v2, "data"

    invoke-static {v1, v2}, Landroid/net/Uri;->withAppendedPath(Landroid/net/Uri;Ljava/lang/String;)Landroid/net/Uri;

    move-result-object v2

    sget-object v3, Lmx/fill/ez/cups/ezfill/f;->a:[Ljava/lang/String;

    const-string v4, "mimetype = ?"

    const/4 v1, 0x1

    new-array v5, v1, [Ljava/lang/String;

    const/4 v1, 0x0

    const-string v6, "vnd.android.cursor.item/email_v2"

    aput-object v6, v5, v1

    const-string v6, "is_primary DESC"

    move-object v1, p0

    invoke-direct/range {v0 .. v6}, Landroid/content/CursorLoader;-><init>(Landroid/content/Context;Landroid/net/Uri;[Ljava/lang/String;Ljava/lang/String;[Ljava/lang/String;Ljava/lang/String;)V

    return-object v0
.end method

.method public synthetic onLoadFinished(Landroid/content/Loader;Ljava/lang/Object;)V
    .locals 0

    check-cast p2, Landroid/database/Cursor;

    invoke-virtual {p0, p1, p2}, Lmx/fill/ez/cups/ezfill/CupsLogin;->a(Landroid/content/Loader;Landroid/database/Cursor;)V

    return-void
.end method

.method public onLoaderReset(Landroid/content/Loader;)V
    .locals 0

    return-void
.end method

.method public onRequestPermissionsResult(I[Ljava/lang/String;[I)V
    .locals 2

    if-nez p1, :cond_0

    array-length v0, p3

    const/4 v1, 0x1

    if-ne v0, v1, :cond_0

    const/4 v0, 0x0

    aget v0, p3, v0

    if-nez v0, :cond_0

    invoke-direct {p0}, Lmx/fill/ez/cups/ezfill/CupsLogin;->k()V

    :cond_0
    return-void
.end method
