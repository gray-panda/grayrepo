import marshal, imp

f=open('PYTHONSCRIPT','rb')
f.seek(17)  # Skip the header, Header size is 28 = 17+11 bytes for characters, l i b r a r y . z i p 

ob=marshal.load(f)

for i in range(0,len(ob)):
    open(str(i)+'.pyc','wb').write(imp.get_magic() + '\0'*4 + marshal.dumps(ob[i]))

f.close()