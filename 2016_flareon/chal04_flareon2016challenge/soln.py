from ctypes import *
import time

chaldll = cdll.LoadLibrary("flareon2016challenge.dll")
ordinal = 30 # starting point is 30 because there is no function that returns 30
while True:
	tmp = chaldll[ordinal]()
	print str(ordinal) + " : " + str(tmp)
	ordinal = tmp
	
	if ordinal == 51:
		chaldll[51]()
		break

#time.sleep(30)
#chaldll[50]()
chaldll[50](0x1B8, 0x1F4)
chaldll[50](0x1B8, 0x1F4)
chaldll[50](0x1B8, 0x1F4)
chaldll[50](0x15D, 0x15E)
chaldll[50](0x20B, 0x96)
chaldll[50](0x1B8, 0x1F4)
chaldll[50](0x15D, 0x15E)
chaldll[50](0x20B, 0x96)
chaldll[50](0x1B8, 0x3E8)
chaldll[50](0x293, 0x1F4)
chaldll[50](0x293, 0x1F4)
chaldll[50](0x293, 0x1F4)
chaldll[50](0x2BA, 0x15E)
chaldll[50](0x20B, 0x96)
chaldll[50](0x19F, 0x1F4)
chaldll[50](0x15D, 0x15E)
chaldll[50](0x20B, 0x96)
chaldll[50](0x1B8, 0x3E8)

# flag is f0ll0w_t3h_3xp0rts@flare-on.com