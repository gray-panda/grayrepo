## CSAW CTF 2015
# Crypto 50 : whiter0se

First of all, ignore the file extension of the file and just open it in a text editor.

It contain a ASCII string

```
EOY XF, AY VMU M UKFNY TOY YF UFWHYKAXZ EAZZHN. UFWHYKAXZ ZNMXPHN. UFWHYKAXZ EHMOYACOI. VH'JH EHHX CFTOUHP FX VKMY'U AX CNFXY FC OU. EOY VH KMJHX'Y EHHX IFFQAXZ MY VKMY'U MEFJH OU.
```

This is encrypted using the substitution cipher

Using letter-frequency analysis (![soln.php](soln.php)), it will eventually decrypt to 

```
but no, it was a short cut to something bigger. something grander. something beautiful. we've been focused on what's in front of us. but we haven't been looking at what's above us.
```

Flag is the entire string "**but no, it was a short cut to something bigger. something grander. something beautiful. we've been focused on what's in front of us. but we haven't been looking at what's above us.**""
