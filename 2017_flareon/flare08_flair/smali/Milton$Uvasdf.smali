.class public Lcom/flare_on/flair/Milton$Uvasdf;
.super Ljava/lang/Object;
.source "Milton.java"

# interfaces
.implements Landroid/widget/RatingBar$OnRatingBarChangeListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingClass;
    value = Lcom/flare_on/flair/Milton;
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x1
    name = "Uvasdf"
.end annotation


# instance fields
.field final synthetic this$0:Lcom/flare_on/flair/Milton;


# direct methods
.method public constructor <init>(Lcom/flare_on/flair/Milton;)V
    .locals 0
    .param p1, "this$0"    # Lcom/flare_on/flair/Milton;

    .prologue
    .line 45
    iput-object p1, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onRatingChanged(Landroid/widget/RatingBar;FZ)V
    .locals 5
    .param p1, "vfdg"    # Landroid/widget/RatingBar;
    .param p2, "vbh"    # F (new rating)
    .param p3, "bdfg"    # Z (from user?)

    .prologue
    .line 49
    if-eqz p3, :cond_1

    .line 50
    float-to-double v0, p2

    const-wide/high16 v2, 0x4010000000000000L    # 4.0

    cmpl-double v0, v0, v2

    if-nez v0, :cond_0  # new rating must be 4.0?

    .line 51
    iget-object v0, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    new-instance v1, Ljava/lang/StringBuilder;

    invoke-direct {v1}, Ljava/lang/StringBuilder;-><init>()V

    iget-object v2, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    # getter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v2}, Lcom/flare_on/flair/Milton;->access$000(Lcom/flare_on/flair/Milton;)Ljava/lang/String;

    move-result-object v2 # get_hild

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1 # v1 = hild

    const-string v2, "JP+98sTB4Zt6q8g="

    const/16 v3, 0x38

    const-string v4, "State"

    invoke-static {v2, v3, v4}, Lcom/flare_on/flair/Stapler;->vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String;
    # Decrypt ARC4 (msg = deobfus first 2 arg, key = 3rd arg)

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    # setter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v0, v1}, Lcom/flare_on/flair/Milton;->access$002(Lcom/flare_on/flair/Milton;Ljava/lang/String;)Ljava/lang/String;
    # sets hild to the decrypted string

    .line 52
    iget-object v0, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    new-instance v1, Ljava/lang/StringBuilder;

    invoke-direct {v1}, Ljava/lang/StringBuilder;-><init>()V

    iget-object v2, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    # getter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v2}, Lcom/flare_on/flair/Milton;->access$000(Lcom/flare_on/flair/Milton;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v2, "rh6HkuflHmw5Rw=="

    const/16 v3, 0x60

    const-string v4, "Chile"

    invoke-static {v2, v3, v4}, Lcom/flare_on/flair/Stapler;->vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String;
    # Decrypt ARC4 (msg = deobfus first 2 arg, key = 3rd arg)

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    # setter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v0, v1}, Lcom/flare_on/flair/Milton;->access$002(Lcom/flare_on/flair/Milton;Ljava/lang/String;)Ljava/lang/String;

    .line 53
    iget-object v0, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    new-instance v1, Ljava/lang/StringBuilder;

    invoke-direct {v1}, Ljava/lang/StringBuilder;-><init>()V

    iget-object v2, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    # getter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v2}, Lcom/flare_on/flair/Milton;->access$000(Lcom/flare_on/flair/Milton;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v2, "+BNtTP/6"

    const/16 v3, 0x76

    const-string v4, "eagle"

    invoke-static {v2, v3, v4}, Lcom/flare_on/flair/Stapler;->vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    # setter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v0, v1}, Lcom/flare_on/flair/Milton;->access$002(Lcom/flare_on/flair/Milton;Ljava/lang/String;)Ljava/lang/String;

    .line 54
    iget-object v0, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    new-instance v1, Ljava/lang/StringBuilder;

    invoke-direct {v1}, Ljava/lang/StringBuilder;-><init>()V

    iget-object v2, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    # getter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v2}, Lcom/flare_on/flair/Milton;->access$000(Lcom/flare_on/flair/Milton;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v2, "oLLoI7X/jIp2+w=="

    const/16 v3, 0x21

    const-string v4, "wind"

    invoke-static {v2, v3, v4}, Lcom/flare_on/flair/Stapler;->vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    # setter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v0, v1}, Lcom/flare_on/flair/Milton;->access$002(Lcom/flare_on/flair/Milton;Ljava/lang/String;)Ljava/lang/String;

    .line 55
    iget-object v0, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    new-instance v1, Ljava/lang/StringBuilder;

    invoke-direct {v1}, Ljava/lang/StringBuilder;-><init>()V

    iget-object v2, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    # getter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v2}, Lcom/flare_on/flair/Milton;->access$000(Lcom/flare_on/flair/Milton;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    const-string v2, "w/MCnPD68xfjSCE="

    const/16 v3, 0x94

    const-string v4, "river"

    invoke-static {v2, v3, v4}, Lcom/flare_on/flair/Stapler;->vutfs(Ljava/lang/String;ILjava/lang/String;)Ljava/lang/String;

    move-result-object v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    # setter for: Lcom/flare_on/flair/Milton;->hild:Ljava/lang/String;
    invoke-static {v0, v1}, Lcom/flare_on/flair/Milton;->access$002(Lcom/flare_on/flair/Milton;Ljava/lang/String;)Ljava/lang/String;

    .line 56
    iget-object v0, p0, Lcom/flare_on/flair/Milton$Uvasdf;->this$0:Lcom/flare_on/flair/Milton;

    iget-object v0, v0, Lcom/flare_on/flair/Milton;->r:Landroid/widget/Button;

    const/4 v1, 0x1

    invoke-virtual {v0, v1}, Landroid/widget/Button;->setEnabled(Z)V

    .line 58
    :cond_0
    const/4 v0, 0x0

    invoke-virtual {p1, v0}, Landroid/widget/RatingBar;->setEnabled(Z)V

    .line 60
    :cond_1
    return-void
.end method
