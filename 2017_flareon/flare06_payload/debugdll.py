from ctypes import *
import time

time.sleep(10) # Attach debugger before the dll is loaded
chaldll = cdll.LoadLibrary("payload.dll")
chaldll[1]()