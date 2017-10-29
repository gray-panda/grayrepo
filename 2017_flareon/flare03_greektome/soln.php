<?php
//$bytes = hex2bin("33E1C49911068116F0329FC49117068114F0068115F1C4911A06811BE2068118F2068119F106811EF0C4991FC4911C06811DE6068162EF068163F2068160E3C49961068166BC068167E6068164E80681659D06816AF2C4996B068168A9068169EF06816EEE06816FAE06816CE306816DEF068172E90681737C6A006A2B684820");

$bytes = hex2bin("33E1C49911068116F0329FC49117068114F0068115F1C4911A06811BE2068118F2068119F106811EF0C4991FC4911C06811DE6068162EF068163F2068160E3C49961068166BC068167E6068164E80681659D06816AF2C4996B068168A9068169EF06816EEE06816FAE06816CE306816DEF068172E90681737C");

//for ($i=ord('0'); $i<= ord('~'); $i++){
for ($i=0; $i<= 255; $i++){
	$dec = doDecrypt($bytes, $i);
	$hash = doHash($dec);
	echo "$i: ".dechex($hash)." (0xfb5e)\n";
	if ($hash == 0xfb5e){
		echo "Found $i: ".dechex($hash)." (0xfb5e)\n";
		echo bin2hex($dec)."\n";
		break;
	}
}

// Copy the output bytes and overwrite 0x79 bytes from offset 0x27c of the binary
// Throw into IDA Pro to see the flag
//  et_tu_brute_force@flare-on.com

/* Testing codes
echo strlen($bytes)."\n";
// Do "Decryption"
$dec = doDecrypt($bytes,ord('a'));
echo bin2hex($dec)."\n";
// Do Hashing (Correct Hash is 0xfb5e) ('a' hash should be 0xd1f6)
$hash = doHash($dec);
echo dechex($hash)."\n";
*/
function doDecrypt($enc, $key){
	$out = "";
	
	for ($i=0; $i<strlen($enc); $i++){
		$cur = ord($enc[$i]);
		$tmp = $cur ^ $key;
		$tmp = ($tmp + 0x22) & 0xff;
		$out .= chr($tmp);
	}
	
	return $out;
}

function doHash($msg){
	// Hashes 20 byte chunks
	//  Maintans 2 sum 
	//   x = 0xff + cumulative sum of input chars
	//   y = 0xff + cumulative sum of x
	
	// At the end of every 20 byte chunks, reset x and y
	//  x = (1st byte of x) + (2nd byte of x)
	//  y = (1st byte of y) + (2nd byte of y)
	
	// At the end of the hashing algo, return result as a word (yx)
	//  y is the higher order byte, x is the lower order byte (this is the output hash)

	$x = 0xff; // sum1
	$y = 0xff; // sum2
	
	$msglen = strlen($msg);
	while($msglen > 0){
		$cur20 = substr($msg,0,20);
		for ($i=0; $i<strlen($cur20); $i++){
			$cur = ord($cur20[$i]);
			$x += $cur;
			$y += $x;
		}
		
		$x1 = $x & 0xff;
		$x2 = ($x >> 8) & 0xff;
		$x = $x1+$x2;
		
		$y1 = $y & 0xff;
		$y2 = ($y >> 8) & 0xff;
		$y = $y1+$y2;
		
		if (strlen($msg) <= 20) break;
		$msg = substr($msg,20);
		$msglen = strlen($msg);
	}	
	
	$result = ($y << 8) | $x;
	return $result;
}
?>