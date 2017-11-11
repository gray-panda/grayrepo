## LabyREnth CTF 2017
# Threat 2 : Yara 1

We are provided with a text file with instructions and a folder of "malware" samples

The goal is to come up with a contiguous yara rule that will catch all the samples in the folder.

I am not familiar with yara rules and only managed to solve this when PAN released the hints video.  
The video mentioned that the target function size is 298 bytes (0x12a) long.

Looking through a few of these binaries in IDA Pro, each binary has only 1 function with such length.

I wrote [soln.php](soln.php) which will go through each binary and find this function
- Looking for the start "53 56" and checking that at offset 0x12a is "C3" (ret)

Once all the functions has been found, the script will go through each function's hex string and compare them.
- If there is difference in the character, the wildcard '?' is added to the rule.
- If not, that character is added to the rule

I uploaded the [resulting rule](soln.yara) which has 308 wild characters.  
This is in line with the hint given in the instruction text file.

Once the rule has been formed, the script will also submit the solution to the challenge server

Unfortunately, at the time of writing this write-up, the challenge server seems to be down already.

If the submitted rule is correct, the flag is returned

The flag is **PAN{AllByMyself}**