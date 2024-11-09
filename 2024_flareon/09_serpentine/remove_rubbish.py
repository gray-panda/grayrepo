# Remember to convert the input phase file to UTF-8 encoding
FILENAME = "phase1.txt"
OUTPUT_FNAME = "phase1-good.txt"


with open(FILENAME, "r") as f:
    data = f.read()

lines = data.split("\n\n")

with open(OUTPUT_FNAME, "w") as outfile:
    todiscard = False
    for line in lines:
        tmp = line.split(": ")
        if len(tmp) == 1:
            outfile.write(line)
            continue

        cur = tmp[1]
        if not todiscard:
            if cur.startswith("call "):
                outfile.write(line + "\n")
                todiscard = True
                continue
            elif cur.startswith("mov dword ptr [rip -"):
                todiscard = True
                continue

        if todiscard:
            if cur.startswith("pop rax,"):
                outfile.write("...\n")
                todiscard = False
                continue
            elif cur.startswith("ret ,"):
                outfile.write("...\n")
                todiscard = False
                continue
            elif cur.startswith("push rax"):
                outfile.write("xxx\n")
                outfile.write(line+"\n")
                continue

        if not todiscard:
            outfile.write(line + "\n")
