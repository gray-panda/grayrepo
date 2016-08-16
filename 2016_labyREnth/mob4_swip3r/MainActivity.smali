.class public Lru/labyrenth/swiping/swip3r/MainActivity;
.super Landroid/app/Activity;

# interfaces
.implements Landroid/view/GestureDetector$OnGestureListener;


# instance fields
.field a:I

.field b:I

.field c:I

.field d:I

.field e:I

.field f:I

.field g:I

.field h:I

.field i:I

.field j:I

.field k:I

.field l:I

.field m:I

.field n:Z

.field private o:Landroid/view/GestureDetector;

.field private p:Landroid/widget/ImageView;


# direct methods
.method static constructor <clinit>()V
    .locals 1

    const-string v0, "swiipiin"

    invoke-static {v0}, Ljava/lang/System;->loadLibrary(Ljava/lang/String;)V

    return-void
.end method

.method public constructor <init>()V
    .locals 1

    const/4 v0, 0x0

    invoke-direct {p0}, Landroid/app/Activity;-><init>()V

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    iput-boolean v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->n:Z

    return-void
.end method


# virtual methods
.method public a(I)Ljava/lang/String;
    .locals 4

    const/16 v0, 0x19

    new-array v2, v0, [I

    fill-array-data v2, :array_0

    new-instance v1, Ljava/lang/String;

    invoke-direct {v1}, Ljava/lang/String;-><init>()V

    const/4 v0, 0x0

    :goto_0
    array-length v3, v2

    if-ge v0, v3, :cond_0

    new-instance v3, Ljava/lang/StringBuilder;

    invoke-direct {v3}, Ljava/lang/StringBuilder;-><init>()V

    invoke-virtual {v3, v1}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    aget v3, v2, v0

    xor-int/2addr v3, p1

    int-to-char v3, v3

    invoke-static {v3}, Ljava/lang/String;->valueOf(C)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v1, v3}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    add-int/lit8 v0, v0, 0x1

    goto :goto_0

    :cond_0
    return-object v1

    nop

    :array_0
    .array-data 4
        0xb17e
        0xb124
        0xb17b
        0xb172
        0xb14a
        0xb125
        0xb173
        0xb151
        0xb174
        0xb14a
        0xb172
        0xb125
        0xb177
        0xb179
        0xb17c
        0xb17b
        0xb166
        0xb13b
        0xb13b
        0xb13b
        0xb17e
        0xb17c
        0xb17b
        0xb171
        0xb174
    .end array-data
.end method

.method public onBackPressed()V
    .locals 0

    invoke-virtual {p0}, Lru/labyrenth/swiping/swip3r/MainActivity;->finish()V

    return-void
.end method

.method protected onCreate(Landroid/os/Bundle;)V
    .locals 2

    invoke-super {p0, p1}, Landroid/app/Activity;->onCreate(Landroid/os/Bundle;)V

    const v0, 0x7f04001c

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->setContentView(I)V

    new-instance v0, Landroid/view/GestureDetector;

    invoke-direct {v0, p0, p0}, Landroid/view/GestureDetector;-><init>(Landroid/content/Context;Landroid/view/GestureDetector$OnGestureListener;)V

    iput-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->o:Landroid/view/GestureDetector;

    const v0, 0x7f0c0055

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/ImageView;

    iput-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    const v1, 0x7f02004e

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setImageResource(I)V

    const v0, 0x7f0c0058

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    invoke-virtual {p0}, Lru/labyrenth/swiping/swip3r/MainActivity;->wel()Ljava/lang/String;

    move-result-object v1

    invoke-static {v1, v1}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I # added by G

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    return-void
.end method

.method public onDown(Landroid/view/MotionEvent;)Z
    .locals 1

    const/4 v0, 0x0

    return v0
.end method

.method public onFling(Landroid/view/MotionEvent;Landroid/view/MotionEvent;FF)Z
    .locals 10

    const v6, 0x7f02004b

    const/4 v5, 0x4

    const v3, 0x7f0c0056

    const/4 v4, 0x0

    const/4 v9, 0x1

    const/high16 v0, 0x42480000 # 50.0

    invoke-virtual {p1}, Landroid/view/MotionEvent;->getY()F

    move-result v1

    invoke-virtual {p2}, Landroid/view/MotionEvent;->getY()F

    move-result v2

    sub-float/2addr v1, v2

    cmpl-float v1, v1, v0 # (p1.y - p2.y) ? 50.0

    if-lez v1, :cond_4

    # (p1.y - p2.y) > 50.0, SWIPE UP
    const-string v0, "SWIPE UP" # added by G
    invoke-static {v0, v0}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I # added by G

    const v0, 0x7f0c0058

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, ""

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I # this.a = 0;

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    if-nez v0, :cond_0

    # if (this.a == 0) 
    iget-boolean v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->n:Z 

    if-nez v0, :cond_0

    # if (this.a == 0) && (this.n == false) 
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    const v1, 0x7f020052

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setImageResource(I)V

    iput v9, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I # this.a = 1

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I # this.c = 0

    iput v5, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->g:I # this.g = 4

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I # this.h = 0

    iput-boolean v9, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->n:Z # this.n = true

    const/16 v0, 0x9

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->d:I # this.d = 9

    :cond_0
    iget-boolean v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->n:Z

    if-nez v0, :cond_1

    # if (this.n == false)
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    const v1, 0x7f020052

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setImageResource(I)V

    const/16 v0, 0xc

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I # this.a = 0xc

    const/16 v0, 0xd

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->i:I # this.i = 0xd

    const/16 v0, 0x2e

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I # this.f = 0x2e

    const/16 v0, 0x37

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->e:I # this.e = 0x37

    iput v5, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->d:I # this.d = 5

    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I # v1 = this.h

    iget v2, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->j:I # v2 = this.j

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I # v3 = this.b

    iget v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I # v4 = this.f

    iget v5, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I # v5 = this.l

    iget v6, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->i:I # v6 = this.i

    iget v7, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->e:I # v7 = this.e

    iget v8, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I # v8 = this.k

    move-object v0, p0

    # well(v1...v8)
    invoke-virtual/range {v0 .. v8}, Lru/labyrenth/swiping/swip3r/MainActivity;->well(IIIIIIII)Ljava/lang/String;

    move-result-object v1

    #added by G
    const-string v0, "UP-well-1"
    invoke-static {v0, v1}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I
    #added by G

    const v0, 0x7f0c0057

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    :cond_1
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->j:I

    const v1, 0xf001

    if-ne v0, v1, :cond_3

    # if (this.j == 0xf001)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I 

    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    add-int/lit8 v1, v1, 0xc # this.l + 0xc

    if-ne v0, v1, :cond_3

    # (this.j == 0xf001) && (this.b == this.l + 0xc)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I

    const v1, 0xb115

    if-ne v0, v1, :cond_2

    # if (this.k == 0xb115)
    const/16 v0, 0x8

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    sub-int/2addr v0, v1

    add-int/lit8 v0, v0, -0xa

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    :cond_2
    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    iget v2, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->j:I

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    iget v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I

    iget v5, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    iget v6, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->i:I

    iget v7, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->e:I

    iget v8, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I

    move-object v0, p0

    invoke-virtual/range {v0 .. v8}, Lru/labyrenth/swiping/swip3r/MainActivity;->well(IIIIIIII)Ljava/lang/String;

    move-result-object v1

    #added by G
    const-string v0, "UP-well-2"
    invoke-static {v0, v1}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I
    #added by G

    const v0, 0x7f0c0057

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    :cond_3
    :goto_0
    return v9

    :cond_4
    invoke-virtual {p2}, Landroid/view/MotionEvent;->getY()F

    move-result v1

    invoke-virtual {p1}, Landroid/view/MotionEvent;->getY()F

    move-result v2

    sub-float/2addr v1, v2

    cmpl-float v1, v1, v0 # (p2.y-p1.y) ? 50.0

    if-lez v1, :cond_7

    # (p2.y-p1.y) > 50.0, SWIPE DOWN
    const-string v0, "SWIPE DOWN" # added by G
    invoke-static {v0, v0}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I # added by G

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    if-ne v0, v9, :cond_5

    # if (this.c == 1)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    const/4 v1, 0x2

    if-ne v0, v1, :cond_5

    # if (this.c == 1) && (this.a == 2)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->d:I

    if-ne v0, v5, :cond_3

    # if (this.d == 4)
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    const v1, 0x7f020050

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setImageResource(I)V

    const/4 v0, 0x2

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    const/4 v0, 0x3

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    const v0, 0xf411

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I

    const/16 v0, 0x38

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    add-int/lit8 v0, v0, -0x28

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->i:I

    goto :goto_0

    :cond_5
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->d:I

    const/16 v1, 0x9

    if-ne v0, v1, :cond_6

    # if (this.d == 9)
    const/16 v0, 0xa

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    iput-boolean v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->n:Z

    const/16 v0, 0x33

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    invoke-virtual {v0, v6}, Landroid/widget/ImageView;->setImageResource(I)V

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    add-int/lit8 v0, v0, 0x1

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-virtual {p0, v3}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, "0oo0oopps!: %d"

    new-array v2, v9, [Ljava/lang/Object;

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-static {v3}, Ljava/lang/Integer;->valueOf(I)Ljava/lang/Integer;

    move-result-object v3

    aput-object v3, v2, v4

    invoke-static {v1, v2}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    goto :goto_0

    :cond_6
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    invoke-virtual {v0, v6}, Landroid/widget/ImageView;->setImageResource(I)V

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    add-int/lit8 v0, v0, 0x1

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-virtual {p0, v3}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, "0oo0oopps!: %d"

    new-array v2, v9, [Ljava/lang/Object;

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-static {v3}, Ljava/lang/Integer;->valueOf(I)Ljava/lang/Integer;

    move-result-object v3

    aput-object v3, v2, v4

    invoke-static {v1, v2}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    goto/16 :goto_0

    :cond_7
    invoke-virtual {p1}, Landroid/view/MotionEvent;->getX()F

    move-result v1

    invoke-virtual {p2}, Landroid/view/MotionEvent;->getX()F

    move-result v2

    sub-float/2addr v1, v2

    cmpl-float v1, v1, v0 # (p1.x - p2.x) ? 50.0

    if-lez v1, :cond_9

    # (p1.x - p2.x) > 50.0, SWIPE LEFT
    const-string v0, "SWIPE LEFT" # added by G
    invoke-static {v0, v0}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I # added by G

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    if-ne v0, v9, :cond_8

    # if (this.a == 1)
    iget-boolean v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->n:Z

    if-eqz v0, :cond_8

    # if (this.a == 1) && (this.n == true)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->g:I

    if-ne v0, v5, :cond_3

    # if (this.g == 4)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    if-nez v0, :cond_3

    # if (this.g == 4) && (this.h == 0)
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    const v1, 0x7f020051

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setImageResource(I)V

    iput v9, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    const/4 v0, 0x2

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    const/4 v0, 0x7

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    iput v5, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->d:I

    goto/16 :goto_0

    :cond_8
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    invoke-virtual {v0, v6}, Landroid/widget/ImageView;->setImageResource(I)V

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    add-int/lit8 v0, v0, 0x1

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-virtual {p0, v3}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, "0oo0oopps!: %d"

    new-array v2, v9, [Ljava/lang/Object;

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-static {v3}, Ljava/lang/Integer;->valueOf(I)Ljava/lang/Integer;

    move-result-object v3

    aput-object v3, v2, v4

    invoke-static {v1, v2}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    goto/16 :goto_0

    :cond_9
    invoke-virtual {p2}, Landroid/view/MotionEvent;->getX()F

    move-result v1

    invoke-virtual {p1}, Landroid/view/MotionEvent;->getX()F

    move-result v2

    sub-float/2addr v1, v2

    cmpl-float v0, v1, v0 # (p2.x - p1.x) ? 50.0

    if-lez v0, :cond_d

    # (p2.x - p1.x) > 50.0, SWIPE RIGHT
    const-string v0, "SWIPE RIGHT" # added by G
    invoke-static {v0, v0}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I # added by G

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    const/4 v1, 0x2

    if-ne v0, v1, :cond_a

    # if (this.c == 2)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    const/4 v1, 0x3

    if-ne v0, v1, :cond_a

    # if (this.c == 2) && (this.a == 3)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I

    const v1, 0xf411

    if-ne v0, v1, :cond_3

    # if (this.f == 0xf411)
    const v0, 0xf001

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->j:I

    const v0, 0xb115

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I

    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    const v1, 0x7f02004c

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setImageResource(I)V

    invoke-virtual {p0, v3}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, ""

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    const v0, 0x7f0c0057

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I

    invoke-virtual {p0, v1}, Lru/labyrenth/swiping/swip3r/MainActivity;->a(I)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    const/16 v0, 0x14d

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    iput v9, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    add-int/2addr v0, v1

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->e:I

    const/16 v0, 0x13

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    goto/16 :goto_0

    :cond_a
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    const/16 v1, 0x33

    if-eq v0, v1, :cond_b

    # if (this.a != 0x33)
    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    const/4 v1, 0x7

    if-ne v0, v1, :cond_c

    # if (this.a == 0x33) || (this.l == 7)
    :cond_b
    const/16 v0, 0x2d

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I

    const/16 v0, 0xde

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    const v0, 0xbabe

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I

    iget v1, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->h:I

    iget v2, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->j:I

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->b:I

    iget v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I

    iget v5, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->l:I

    iget v6, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->i:I

    iget v7, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->e:I

    iget v8, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->k:I

    move-object v0, p0

    invoke-virtual/range {v0 .. v8}, Lru/labyrenth/swiping/swip3r/MainActivity;->well(IIIIIIII)Ljava/lang/String;

    move-result-object v1

    #added by G
    const-string v0, "RIGHT-well"
    invoke-static {v0, v1}, Landroid/util/Log;->d(Ljava/lang/String;Ljava/lang/String;)I
    #added by G

    const v0, 0x7f0c0057

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    goto/16 :goto_0

    :cond_c
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    invoke-virtual {v0, v6}, Landroid/widget/ImageView;->setImageResource(I)V

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->c:I

    iput v4, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->a:I

    const/16 v0, 0x9

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->f:I

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    add-int/lit8 v0, v0, 0x1

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-virtual {p0, v3}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, "0oo0oopps!: %d"

    new-array v2, v9, [Ljava/lang/Object;

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-static {v3}, Ljava/lang/Integer;->valueOf(I)Ljava/lang/Integer;

    move-result-object v3

    aput-object v3, v2, v4

    invoke-static {v1, v2}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    goto/16 :goto_0

    :cond_d
    # finished handling swiping
    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->p:Landroid/widget/ImageView;

    invoke-virtual {v0, v6}, Landroid/widget/ImageView;->setImageResource(I)V

    iget v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    add-int/lit8 v0, v0, 0x1

    iput v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-virtual {p0, v3}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    const-string v1, "0oo0oopps!: %d"

    new-array v2, v9, [Ljava/lang/Object;

    iget v3, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->m:I

    invoke-static {v3}, Ljava/lang/Integer;->valueOf(I)Ljava/lang/Integer;

    move-result-object v3

    aput-object v3, v2, v4

    invoke-static {v1, v2}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    goto/16 :goto_0
.end method

.method public onLongPress(Landroid/view/MotionEvent;)V
    .locals 5

    new-instance v0, Ljava/lang/String;

    invoke-direct {v0}, Ljava/lang/String;-><init>()V

    const-string v1, "aHR0cHM6Ly8=" # https://

    const-string v2, "Z29vLmds" # goo.gl

    const-string v3, "VmdtVVV5" # VgmUUy

    # https://goo.gl/VgmUUy

    const v0, 0x7f0c0059

    invoke-virtual {p0, v0}, Lru/labyrenth/swiping/swip3r/MainActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    new-instance v4, Ljava/lang/StringBuilder;

    invoke-direct {v4}, Ljava/lang/StringBuilder;-><init>()V

    invoke-virtual {v4, v1}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v4, "+"

    invoke-virtual {v1, v4}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v2, "+"

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1, v3}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v2, "\n"

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    const/4 v2, 0x0

    new-array v2, v2, [Ljava/lang/Object;

    invoke-static {v1, v2}, Ljava/lang/String;->format(Ljava/lang/String;[Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    return-void
.end method

.method public onScroll(Landroid/view/MotionEvent;Landroid/view/MotionEvent;FF)Z
    .locals 1

    const/4 v0, 0x0

    return v0
.end method

.method public onShowPress(Landroid/view/MotionEvent;)V
    .locals 0

    return-void
.end method

.method public onSingleTapUp(Landroid/view/MotionEvent;)Z
    .locals 1

    const/4 v0, 0x0

    return v0
.end method

.method public onTouchEvent(Landroid/view/MotionEvent;)Z
    .locals 1

    iget-object v0, p0, Lru/labyrenth/swiping/swip3r/MainActivity;->o:Landroid/view/GestureDetector;

    invoke-virtual {v0, p1}, Landroid/view/GestureDetector;->onTouchEvent(Landroid/view/MotionEvent;)Z

    move-result v0

    return v0
.end method

.method public native wel()Ljava/lang/String;
.end method

.method public native well(IIIIIIII)Ljava/lang/String;
.end method
