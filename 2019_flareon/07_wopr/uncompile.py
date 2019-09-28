import uncompyle6
import sys

fpath = sys.argv[1]
with open(fpath+".py", "w") as f:
	uncompyle6.decompile_file(fpath, f)