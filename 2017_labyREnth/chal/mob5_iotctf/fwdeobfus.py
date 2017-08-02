import sys
l1_opy_ = sys.version_info[0] == 2
l1ll_opy_ = 2048
l111l_opy_ = 7

def l1l1l_opy_(ll_opy_):
    l1111_opy_ = ord(ll_opy_[-1])
    l1llll_opy_ = ll_opy_[:-1]
    l111_opy_ = l1111_opy_ % len(l1llll_opy_)
    l1lll_opy_ = l1llll_opy_[:l111_opy_] + l1llll_opy_[l111_opy_:]
    if l1_opy_:
        l11l_opy_ = unicode().join([ unichr(ord(char) - l1ll_opy_ - (l1ll1_opy_ + l1111_opy_) % l111l_opy_) for l1ll1_opy_, char in enumerate(l1lll_opy_) ])
    else:
        l11l_opy_ = str().join([ chr(ord(char) - l1ll_opy_ - (l1ll1_opy_ + l1111_opy_) % l111l_opy_) for l1ll1_opy_, char in enumerate(l1lll_opy_) ])
    return l11l_opy_

if __name__ == "__main__":
	print l1l1l_opy_(u'\u0826\u0834\u0872\u086f\u0868\u086b\u0871\u0843\u0827\u0800')
	print l1l1l_opy_(u'\u082c\u087b\u0874\u0867\u082f\u083b\u082b\u0801')
	print l1l1l_opy_(u'\u0828\u082f\u0875\u0863\u086e\u0869\u0864\u0876\u0868\u0870\u0876\u0872\u0843\u0827\u0802')
	print l1l1l_opy_(u'\u0827\u0876\u0876\u0869\u0831\u083d\u082d\u0803')
	print l1l1l_opy_(u'\u0828\u0848\u086c\u0870\u086a\u0826\u084e\u0870\u0876\u0823\u084a\u0874\u087b\u086e\u0865\u083c\u0823\u0829\u0878\u082d\u0804')
	print l1l1l_opy_(u'\u0824\u0868\u0867\u086d\u0875\u0820\u0828\u0827\u0876\u082b\u0825\u0882\u0820\u0844\u0851\u0851\u0858\u084a\u0854\u0854\u0860\u084e\u0848\u0852\u084c\u085a\u0848\u083e\u0827\u0867\u0824\u082a\u0879\u0822\u0805')
	print l1l1l_opy_(u'\u082a\u0833\u087a\u0879\u0872\u0830\u0875\u0865\u086d\u0873\u0835\u0864\u086f\u0875\u0866\u0870\u086e\u086b\u086e\u0875\u0829\u0806')
	print l1l1l_opy_(u'\u0826\u086a\u0869\u0868\u0870\u0822\u082a\u0829\u0878\u082d\u0820\u087d\u0822\u0846\u0853\u0853\u085a\u0845\u084f\u0856\u0862\u0850\u084a\u0854\u0847\u0855\u084a\u0840\u0829\u0869\u0826\u0825\u0874\u0824\u0807')
	print l1l1l_opy_(u'\u082c\u0835\u0873\u0863\u086b\u0871\u0833\u0878\u087f\u0873\u0865\u086b\u0864\u086b\u082c\u0808')
	print l1l1l_opy_(u'\u082d\u0827\u0809')