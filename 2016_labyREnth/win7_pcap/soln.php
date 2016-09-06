<?php
/* Dictionary to encode messages
00DFA000  71 74 67 4A 59 4B 61 38 79 35 4C 34 66 6C 7A 4D  qtgJYKa8y5L4flzM  
00DFA010  51 2F 42 73 47 70 53 6B 48 49 6A 68 56 72 6D 33  Q/BsGpSkHIjhVrm3  
00DFA020  4E 43 41 69 39 63 62 65 58 76 75 77 44 78 2B 52  NCAi9cbeXvuwDx+R  
00DFA030  36 64 4F 37 5A 50 45 6E 6F 32 31 54 30 55 46 57  6dO7ZPEno21T0UFW  

Example for "abcd"
00CA4318  48 53 35 69 49 71 3D 3D  HS5iIq==

01275A18  49 71 54 4B 63 69 79 4B 6D 55 49 37 72 61 43 76  IqTKciyKmUI7raCv  
01275A28  56 6E 5A 3D 00 FD FD FD AB AB AB AB AB AB AB AB  VnZ=.ýýý««««««««  

PADDINGPADDINGPADDINGPADDINGPADDINGPADDINGPADDINGPADDINGP
PAN{did_1_mention_th0se_pupp3ts_fr34ked_m3_out_recent1y?}
PADDINGPADDINGPADDINGhibobPADDINGPADDINGPADDINGPAD      4.
W)Vj
*/

$keystr = "AWildKeyAppears!";
$key = array();
$key[] = convStr2Int(substr($keystr,0,4));
$key[] = convStr2Int(substr($keystr,4,4));
$key[] = convStr2Int(substr($keystr,8,4));
$key[] = convStr2Int(substr($keystr,12,4));

//$enc = "B6XGLACYYUdwodupUtF0geaE5NKnf5gTiKxgwfWCJdi8Iq/b36ShdY/gs18m2VwpkTJPmg03FDpavvJF3EcAX8SUkrbpI1T61ZGKnrbD9gkf79eqi4giA4uKYEv9O/Iw3Godkhd0tB9e1ojQgW4307/OSTtWIzyEVhHbqkV694+fSZLD7FYMa80QYJQ5JRV/B6XGLACYYUdwodupUtF0geaE5NKnf5gT/Ycz/Ptt/q==";
//$enc = "HS5iIq==";
//$enc = "IqTKciyKmUI7raCvVnZ=";

/*
$enc = encrypt("PAN{wtfisthis}");
echo $enc."\n";
$msg = decrypt($enc);
echo $msg."\n";
*/
$data = "B6XGLACYYUdwodupUtF0geaE5NKnf5gTiKxgwfWCJdi8Iq/b36ShdY/gs18m2VwpkTJPmg03FDpavvJF3EcAX8SUkrbpI1T61ZGKnrbD9gkf79eqi4giA4uKYEv9O/Iw3Godkhd0tB9e1ojQgW4307/OSTtWIzyEVhHbqkV694+fSZLD7FYMa80QYJQ5JRV/B6XGLACYYUdwodupUtF0geaE5NKnf5gT/Ycz/Ptt/q==";
echo decrypt(customb64_decode($data));

function encrypt($msg){
	if (strlen($msg) < 8) return $msg;
	
	$i = 0;
	$enc = "";
	while ($i<strlen($msg)){
		$cur = substr($msg,$i,8);
		$enc .= encrypt8bytes($cur);
		$i += 8;
	}
	
	$i -= 8;
	if ($i < strlen($msg)-1){
		$enc .= substr($msg,$i);
	}
	return $enc;
}

function encrypt8bytes($msg){
	global $key;
	if (strlen($msg) !== 8) return false;
	
	$b1 = convStr2Int(substr($msg,0,4)); // ebp-50
	$b2 = convStr2Int(substr($msg,4,4)); // ebp-5c
	$keyindex = 0; // ebp-68
	$seed = 0x9e3769b9; // ebp-44
	$i = 0; //ebp-8
	//echo dechex($b1) . " " . dechex($b2) . "\n";
	while ($i<0x20){
		$eax = (($b2 << 4) & 0xffffffff) ^ (logicalRightShift($b2,5) & 0xffffffff);
		$eax = ($eax + $b2) & 0xffffffff;
		$esi = ($keyindex + $key[$keyindex & 3]) & 0xffffffff;
		$eax ^= $esi;
		$b1 = ($eax + $b1) & 0xffffffff;
		
		$keyindex = ($keyindex + $seed + 0x1000) & 0xffffffff; // keyindex is constant regardless of msg
		//echo "keyindex : ".dechex($keyindex)."\n";
		
		$eax = (($b1 << 4) & 0xffffffff) ^ (logicalRightShift($b1,5) & 0xffffffff);
		$eax = ($eax + $b1) & 0xffffffff;
		$esi = ($keyindex + $key[logicalRightShift($keyindex,0xb) & 3]) & 0xffffffff;
		$eax ^= $esi;
		$b2 = ($eax + $b2) & 0xffffffff;
		//echo dechex($b1) . " " . dechex($b2) . "\n";
		$i++;
	}
	
	// Reverse the bytes in each 4 bytes
	$out = "";
	
	$tmp = dechex($b1);
	$outtmp = "";
	while (strlen($tmp) < 8) $tmp = '0'.$tmp;
	for ($i=0; $i<strlen($tmp); $i+=2){
		$cur = substr($tmp,$i,2);
		$outtmp .= chr(hexdec($cur));
	}
	$out = strrev($outtmp);
	
	$tmp = dechex($b2);
	$outtmp = "";
	while (strlen($tmp) < 8) $tmp = '0'.$tmp;
	for ($i=0; $i<strlen($tmp); $i+=2){
		$cur = substr($tmp,$i,2);
		$outtmp .= chr(hexdec($cur));
	}
	$out .= strrev($outtmp);
	
	return $out;
}

function decrypt($enc){
	if (strlen($enc) < 8) return $enc;
	
	$i = 0;
	$msg = "";
	while ($i<strlen($enc)){
		$cur = substr($enc,$i,8);
		$msg .= decrypt8bytes($cur);
		$i += 8;
	}
	
	$i -= 8;
	if ($i < strlen($enc)-1){
		$msg .= substr($enc,$i);
	}
	return $msg;
}

function decrypt8bytes($enc){
	global $key;
	if (strlen($enc) !== 8) return false;
	
	$keyindex = array();
	$keyindex[0] = hexdec("9e3779b9");
	$keyindex[1] = hexdec("3c6ef372");
	$keyindex[2] = hexdec("daa66d2b");
	$keyindex[3] = hexdec("78dde6e4");
	$keyindex[4] = hexdec("1715609d");
	$keyindex[5] = hexdec("b54cda56");
	$keyindex[6] = hexdec("5384540f");
	$keyindex[7] = hexdec("f1bbcdc8");
	$keyindex[8] = hexdec("8ff34781");
	$keyindex[9] = hexdec("2e2ac13a");
	$keyindex[10] = hexdec("cc623af3");
	$keyindex[11] = hexdec("6a99b4ac");
	$keyindex[12] = hexdec("8d12e65");
	$keyindex[13] = hexdec("a708a81e");
	$keyindex[14] = hexdec("454021d7");
	$keyindex[15] = hexdec("e3779b90");
	$keyindex[16] = hexdec("81af1549");
	$keyindex[17] = hexdec("1fe68f02");
	$keyindex[18] = hexdec("be1e08bb");
	$keyindex[19] = hexdec("5c558274");
	$keyindex[20] = hexdec("fa8cfc2d");
	$keyindex[21] = hexdec("98c475e6");
	$keyindex[22] = hexdec("36fbef9f");
	$keyindex[23] = hexdec("d5336958");
	$keyindex[24] = hexdec("736ae311");
	$keyindex[25] = hexdec("11a25cca");
	$keyindex[26] = hexdec("afd9d683");
	$keyindex[27] = hexdec("4e11503c");
	$keyindex[28] = hexdec("ec48c9f5");
	$keyindex[29] = hexdec("8a8043ae");
	$keyindex[30] = hexdec("28b7bd67");
	$keyindex[31] = hexdec("c6ef3720");
	
	$b1 = convStr2Int(substr($enc,0,4));
	$b2 = convStr2Int(substr($enc,4,4));

	$i = 0x1f;
	$kindex = $keyindex[$i];
	//echo dechex($b1) . " " . dechex($b2) . "\n";
	while ($i >= 0){
		$eax = (($b1 << 4) & 0xffffffff) ^ (logicalRightShift($b1,5) & 0xffffffff);
		$eax = ($eax + $b1) & 0xffffffff;
		$esi = ($kindex + $key[logicalRightShift($kindex,0xb) & 3]) & 0xffffffff;
		$eax ^= $esi;
		if ($b2 < $eax) { // trick to add 0x100000000 in 32bit systems
			$tmp = 0xffffffff - $eax;
			$b2 = ($b2 + $tmp + 1) & 0xffffffff;
			//$b2 += 0x100000000;
		}
		else $b2 = ($b2 - $eax) & 0xffffffff;
		
		if ($i > 0) $kindex = $keyindex[$i-1];
		else $kindex = 0;
		
		$eax = (($b2 << 4) & 0xffffffff) ^ (logicalRightShift($b2,5) & 0xffffffff);
		$eax = ($eax + $b2) & 0xffffffff;
		$esi = ($kindex + $key[$kindex & 3]) & 0xffffffff;
		$eax ^= $esi;
		if ($b1 < $eax) {
			$tmp = 0xffffffff - $eax;
			$b1 = ($b1 + $tmp + 1) & 0xffffffff;
			//$b1 += 0x100000000;
		}
		else $b1 = ($b1 - $eax) & 0xffffffff;
		//echo dechex($b1) . " " . dechex($b2) . "\n";
		
		$i--;
	}
	
	// Reverse the bytes in each 4 bytes
	$out = "";
	
	$tmp = dechex($b1);
	$outtmp = "";
	while (strlen($tmp) < 8) $tmp = '0'.$tmp;
	for ($i=0; $i<strlen($tmp); $i+=2){
		$cur = substr($tmp,$i,2);
		$outtmp .= chr(hexdec($cur));
	}
	$out = strrev($outtmp);
	
	$tmp = dechex($b2);
	$outtmp = "";
	while (strlen($tmp) < 8) $tmp = '0'.$tmp;
	for ($i=0; $i<strlen($tmp); $i+=2){
		$cur = substr($tmp,$i,2);
		$outtmp .= chr(hexdec($cur));
	}
	$out .= strrev($outtmp);
	
	return $out;
}

function uglyEncrypt8bytes($msg){
	global $key;
	if (strlen($msg) !== 8) return false;
	
	$b1 = convStr2Int(substr($msg,0,4)); // ebp-50
	//$b1 = pack("i", substr($msg,0,4));
	$b2 = convStr2Int(substr($msg,4,4)); // ebp-5c
	$keyindex = 0; // ebp-68
	$seed = 0x9e3769b9; // ebp-44
	$i = 0; //ebp-8
	//echo dechex($b1) . " " . dechex($b2) . "\n";
	while ($i<0x20){
		$eax = ($b2 << 4) & 0xffffffff;
		//echo "eax : ".dechex($eax)."\n";
		$ecx = logicalRightShift($b2,5) & 0xffffffff;
		//echo "ecx : ".dechex($ecx)."\n";
		$eax ^= $ecx;
		//echo "eax : ".dechex($eax)."\n";
		$eax = ($eax + $b2) & 0xffffffff;
		//echo "eax : ".dechex($eax)."\n";
		
		$esi = ($keyindex + $key[$keyindex & 3]) & 0xffffffff;
		//echo "esi : ".dechex($esi)."\n";
		$eax ^= $esi;
		//echo "eax : ".dechex($eax)."\n";
		$eax = ($eax + $b1) & 0xffffffff;
		//echo "eax : ".dechex($eax)."\n";
		$b1 = $eax;
		//echo "b1 : ".dechex($b1)."\n";
		
		$keyindex = ($keyindex + $seed + 0x1000) & 0xffffffff;
		//echo "keyindex : ".dechex($keyindex)."\n\n";
		
		$eax = ($b1 << 4) & 0xffffffff;		
		//echo "eax : ".dechex($eax)."\n";
		$ecx = logicalRightShift($b1,5) & 0xffffffff;
		//echo "ecx : ".dechex($ecx)."\n";
		$eax ^= $ecx;
		//echo "eax : ".dechex($eax)."\n";
		$eax = ($eax + $b1) & 0xffffffff;
		//echo "eax : ".dechex($eax)."\n";
		
		$edx = logicalRightShift($keyindex,0xb) & 3;
		//echo "edx : ".dechex($edx)."\n";
		$esi = ($keyindex + $key[$edx]) & 0xffffffff;
		//echo "esi : ".dechex($esi)."\n";
		$eax ^= $esi;
		//echo "eax : ".dechex($eax)."\n";
		$eax = ($eax + $b2) & 0xffffffff;
		//echo "eax : ".dechex($eax)."\n";
		$b2 = $eax;
		//echo "b2 : ".dechex($b2)."\n";
		
		//echo dechex($b1) . " " . dechex($b2) . "\n\n";
		$i++;
	}
	
	$out = "";
	$outtmp = "";
	$tmp = dechex($b1);
	while (strlen($tmp) < 8) $tmp = '0'.$tmp;
	for ($i=0; $i<strlen($tmp); $i+=2){
		$cur = substr($tmp,$i,2);
		$outtmp .= chr(hexdec($cur));
	}
	$out = strrev($outtmp);
	$tmp = dechex($b2);
	while (strlen($tmp) < 8) $tmp = '0'.$tmp;
	for ($i=0; $i<strlen($tmp); $i+=2){
		$cur = substr($tmp,$i,2);
		$outtmp .= chr(hexdec($cur));
	}
	$out .= strrev($outtmp);
	
	return $out;
}

function convStr2Int($str){
	if (strlen($str) !== 4) return false;
	
	$out = 0;
	$b1 = ord($str[3]) << 24;
	$b2 = ord($str[2]) << 16;
	$b3 = ord($str[1]) << 8;
	$b4 = ord($str[0]);
	$out = $b1 | $b2 | $b3 | $b4;
	return $out;
}

function get6bits($byte){
	// binary string should not be more than 6 bits long
	if ($byte == -1) return "000000";
	$bin = decbin($byte);
	if (strlen($bin) > 6) {
		echo "BINARY STRING MORE THAN LENGTH 6!! $bin\n";
		die();
	}
	while (strlen($bin) < 6) $bin = '0'.$bin;
	return $bin;
}

function customb64_decode($str){
	$dict = "qtgJYKa8y5L4flzMQ/BsGpSkHIjhVrm3NCAi9cbeXvuwDx+R6dO7ZPEno21T0UFW";
	if (strlen($str) % 4 !== 0) return false; // string length must by multiples of fours
	
	$ret = "";
	for ($i=0; $i<strlen($str); $i+=4){
		$cur = substr($str,$i,4);
		$b1 = substr($cur,0,1);
		$b2 = substr($cur,1,1);
		$b3 = substr($cur,2,1);
		$b4 = substr($cur,3,1);
		$b1pos = strpos($dict, $b1);
		$b2pos = strpos($dict, $b2);
		if (strcmp($b3,'=') === 0) $b3pos = -1; 
		else $b3pos = strpos($dict, $b3);
		if (strcmp($b4,'=') === 0) $b4pos = -1;
		else $b4pos = strpos($dict, $b4);
		if ($b1pos === false || $b2pos === false || $b3pos === false || $b4pos === false){
			echo "CANNOT FIND IN DICT!! $b1pos $b2pos $b3pos $b4pos\n";
			die();
		}
		$b1bits = get6bits($b1pos);
		$b2bits = get6bits($b2pos);
		$b3bits = get6bits($b3pos);
		$b4bits = get6bits($b4pos);
		$dword = $b1bits.$b2bits.$b3bits.$b4bits;

		$out1 = chr(bindec(substr($dword,0,8)));
		$out2 = chr(bindec(substr($dword,8,8)));
		$out3 = chr(bindec(substr($dword,16,8)));
		$ret .= $out1.$out2.$out3;
	}
	return $ret;
}

function customb64_encode($str){
	$dict = "qtgJYKa8y5L4flzMQ/BsGpSkHIjhVrm3NCAi9cbeXvuwDx+R6dO7ZPEno21T0UFW";
	
	$out = "";
	$parts = str_split($str,3);
	for ($i=0; $i<count($parts); $i++){
		$part = $parts[$i];
		$b1 = decbin(ord(substr($part,0,1)));
		$b2 = decbin(ord(substr($part,1,1)));
		$b3 = decbin(ord(substr($part,2,1)));
		while (strlen($b1) < 8) $b1 = '0'.$b1;
		while (strlen($b2) < 8) $b2 = '0'.$b2;
		while (strlen($b3) < 8) $b3 = '0'.$b3;
		$all = $b1.$b2.$b3;
		
		for ($k=0; $k<strlen($all); $k+=6){
			$cur = bindec(substr($all,$k,6));
			$out .= $dict[$cur];
		}
	}
	
	// If any of the last 2 chars are 'q' (0), replace with =
	$last = substr($out,-1);
	if (strcmp($last, $dict[0]) === 0) $out[strlen($out)-1] = '=';
	$last2nd = substr($out,-2,1);
	if (strcmp($last2nd, $dict[0]) === 0) $out[strlen($out)-2] = '=';
	
	return $out;
}

function logicalRightShift($val, $shift){
	if ($val >= 0) return $val >> $shift;
	$bin = decbin($val>>$shift);
	$bin = substr($bin, $shift);
	return bindec($bin);
}
?>