from ctypes import *

chaldll = cdll.LoadLibrary("flareon2016challenge.dll")

for ordinal in range(1,49):
	res = chaldll[ordinal]()
	print str(ordinal) + " : " + str(res)