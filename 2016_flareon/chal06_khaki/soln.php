<?php
/**
Use Py2Exe Binary Editor to un-py2exe the executable
 - Will give library.zip, PYTHON27.DLL, PYTHONSCRIPT
Run extractpyc.py to extract pyc files from PYTHONSCRIPT
 - Outputs file 0.pyc, 1.pyc, 2.pyc
Use Easy Python Decompiler to decompile these 3 pyc files
 - 2.pyc fails to decompile
 - 0.pyc and 1.pyc does not seem interesting

Looking at 2.pyc in hexedit reveals strings that we see when we run khaki.exe
2.pyc is important!!

Tried various decompilers, but still fail.

Let's try disassembling instead of decompiling
 - Found a python disassembling script (disasm.py)
 - Run it against 2.pyc
  - Save it to 2.dis
  
Upon inspection, the pyc is obfuscated with lots of useless codes
 - not sure if these codes are causing the decompilers to fail
 - Remove these useless codes and the assembly will look interesting
  - Examples of inserted useless code (All these basically does nothing)
   - LOAD CONSTANT 0, POP_TOP
   - ROT 2, ROT 2
   - ROT 3, ROT 3, ROT 3
   - NOP
  
Disassembly with useless codes removed are 2edit.dis
   
Flag is 1mp0rt3d_pygu3ss3r@flare-on.com
**/

//$passhex = bin2hex(singleByteXor66("shameless plug\n"));
$tmp = "312a232f272e27313162322e372548"; // Single Byte Xor 66 with String "shameless plug\n"

//valid guess count is from 2 to 25
for ($count=2; $count<=25; $count++){
	$win_msg = "Wahoo, you guessed it with $count guesses\n";
	//var_dump($win_msg);
	$pw = $win_msg.$tmp;
	//$pw = $passhex.$win_msg;
	//$pw = binaryAdd($win_msg, $tmp);
	//var_dump($pw);
	$key = md5($pw,true);
	$plain = decrypt($key);
	echo "$count : $plain \n";
	
	if (strpos($plain, "flare") !== false) {
		echo "FLAG FOUND : $plain \n";
		break;
	}
}

function singleByteXor66($msg){
	$out = '';
	for ($i=0; $i<strlen($msg); $i++){
		$cur = ord($msg[$i]);
		$out .= chr($cur ^ 66);
	}
	return $out;
}

function decrypt($key){
	$enc = [67,139,119,165,232,86,207,61,79,67,45,58,230,190,181,74,65,148,71,243,246,67,142,60,61,92,58,115,240,226,171];
	$out = "";
	for ($i=0; $i<count($enc); $i++){
		$curkey = $key[$i % strlen($key)];
		$out .= chr($enc[$i] ^ ord($curkey));
	}
	return $out;
}

function binaryAdd($str1, $str32){
	$out = '';
	for ($i=0; $i<30; $i++){
		$cur = (ord($str1[$i]) + ord($str32[$i])) & 0xff;
		$out .= chr($cur);
	}
	for ($i=30; $i<strlen($str1); $i++){
		$out .= $str1[$i];
	}
	return $out;
}
?>