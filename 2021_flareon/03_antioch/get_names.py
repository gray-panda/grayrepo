# Get names from json files

import os
import json

directory = os.fsencode("antioch")

output = b""
    
for file in os.listdir(directory):
    layername = os.fsdecode(file).encode()
    dir2 = directory + b"/" + layername
    if os.path.isdir(dir2):
        for file2 in os.listdir(dir2):
            filename = os.fsdecode(file2).encode()
            #print(filename)
            if filename == b"json": 
                with open(dir2 + b"/" + filename) as f:
                    data = f.read()
                jdata = json.loads(data)
                if "author" in jdata.keys():
                    print(jdata['author'])
                    output += jdata['author'].encode() + b"\n"
                continue
            else:
                continue
                
with open("names.txt", "wb") as f:
    f.write(output)

print("Done")