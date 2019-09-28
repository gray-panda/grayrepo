from struct import *

with open("artifacts\\876.dmp", "rb") as dmpfile:
    data = dmpfile.read()

bmp_header = bytes('BM6', 'utf-8')
done = 0
i = 0
count = 0
while not done:
    try:
        i = data.index(bmp_header, i);
    except ValueError:
        print("Done")
        done = 1
        break
    
    # size = unpack('i', data[i+2:i+6])[0]
    size = 2359350
    bmp_data = data[i:i+size]
    print("%d" % size)
    with open("out\\bmp" + str(count) + ".bmp", "wb") as outfile:
        outfile.write(bmp_data)
        print("Written %d bmp file from index %d " % (count, i))
        count += 1
    
    i = i + size
    if count > 100:
        break