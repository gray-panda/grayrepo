## LabyREnth CTF 2017
# Threat 5 : Yara 2

We are provided with a text file with instructions and a folder of "malware" samples  

The goal is to come up with 2 yara rules that will catch all the samples in the folder.

This is a similar challenge with Threat Level 2 previously.  
However, this time, the length of the anchor function is unknown.

According to the instruction text files, there are 2 functions that we are looking for.
- There are 6 wildcard "?"'s within one rule.
- There are 158 wildcard "?"'s within the other rule.
- There will be samples that have both anchor functions.
- One anchor function must cover 34 of the 36 samples 
- The other must cover 12 of the 36 samples.

The instruction also specifies the "jmp" rules are not allowed.

I assumed that these functions would be the same length across samples.

My approach is mainly manual eyeballing
- Start with a small sample binary and sort its function list by length.
- Start with the biggest unnamed function and compare it with another sample binary
- Keep going until we find a function where the 2 samples have a similar flow graph and they have the same function length

**genYaraRule_FixedLen()** in my [solution script](soln.php) helps in finding these functions
- Find bytes specified by the $marker input
- Check the byte at $marker's position + function length is "0xc3" ret
	- If it is, I assumed that this is the function i'm looking for.
- Once the function is found, attempt to do a comparsion across all samples, generating a yara rule
- Works best in small binaries with minimal similar functions with similar function lengths

After going through some functions, found the first rule at

```
genYaraRule_FixedLen(0x169, "\x8B\xFF\x55\x8B\xEC\x83\xEC\x14\x53\x56\x57\xE8", $dirname);

Cannot find func for 8b92700bac3150d3456697b64e63d21f8ca4447df57d02c7f90125c3068985d7 
Cannot find func for a81057e06bddc2bfdcd0bae8f3ed101a47e926f3d37a7f0f0378a89049725dc7 
34 samples have this function..
8b ff 55 8b ec 83 ec 14 53 56 57 e8 ?? ?? ff ff 83 65 fc 00 83 3d ?? ?? ?? 00 00 8b d8 0f 85 8e 00 00 00 68 ?? ?? 4? 00 ff 15 ?? ?? ?? 00 8b f8 85 ff 0f 84 2a 01 00 00 8b 35 ?? ?? ?? 00 68 ?? ?? 4? 00 57 ff d6 85 c0 0f 84 14 01 00 00 50 e8 ?? ?? ff ff c7 04 24 ?? ?? 4? 00 57 a3 ?? ?? ?? 00 ff d6 50 e8 ?? ?? ff ff c7 04 24 ?? ?? 4? 00 57 a3 ?? ?? ?? 00 ff d6 50 e8 ?? ?? ff ff c7 04 24 ?? ?? 4? 00 57 a3 ?? ?? ?? 00 ff d6 50 e8 ?? ?? ff ff 59 a3 ?? ?? ?? 00 85 c0 74 14 68 ?? ?? 4? 00 57 ff d6 50 e8 ?? ?? ff ff 59 a3 ?? ?? ?? 00 a1 ?? ?? ?? 00 3b c3 74 4f 39 1d ?? ?? ?? 00 74 47 50 e8 ?? ?? ff ff ff 35 ?? ?? ?? 00 8b f0 e8 ?? ?? ff ff 59 59 8b f8 85 f6 74 2c 85 ff 74 28 ff d6 85 c0 74 19 8d 4d f8 51 6a 0c 8d 4d ec 51 6a 01 50 ff d7 85 c0 74 06 f6 45 f4 01 75 09 81 4d 10 00 00 20 00 eb 39 a1 ?? ?? ?? 00 3b c3 74 30 50 e8 ?? ?? ff ff 59 85 c0 74 25 ff d0 89 45 fc 85 c0 74 1c a1 ?? ?? ?? 00 3b c3 74 13 50 e8 ?? ?? ff ff 59 85 c0 74 08 ff 75 fc ff d0 89 45 fc ff 35 ?? ?? ?? 00 e8 ?? ?? ff ff 59 85 c0 74 10 ff 75 10 ff 75 0c ff 75 08 ff 75 fc ff d0 eb 02 33 c0 5f 5e 5b c9 c3
Wild Count: 158
```

This fit what was given in the instructions text file.

Only 2 samples was not matched by this rule.  
That means the second rule must match both unmatched samples.  
I repeated the same process with these 2 samples for comparison

I found a function (with length 0x26) that only has 6 wildcard characters between these 2 samples  
It also matched 16 samples which does not tally with the hints in the instruction text file.

However, when I tried submitting it to the challenge server, it worked and the flag was returned.  
Not sure if this is by design or a bug.

Similaryly, at the time of writing this write-up, the solution server seems to be down already.

When these 2 rules are submitted in the correct format, the flag is returned.

The flag is **PAN{Pivot!Pivot!Pivot!Pivot!Pivot!Pivot!ShutUp!ShutUp!ShutUp!}**