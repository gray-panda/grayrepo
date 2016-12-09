<?php
// http://crypto.stackexchange.com/questions/24546/rc4-is-it-possible-to-find-the-key-if-we-know-the-plaintext-and-ciphertext
// Recover 2nd Plaintext if RC4 key is used twice and 1 pair of plaintext/ciphertext is known
$m1 = file_get_contents("imgur_vnUziJP.png");	// message1
$c1 = file_get_contents("binaryData/Int3lIns1de_t3stImgurvnUziJP.bin"); // crypt1
$c2 = file_get_contents("binaryData/class_25.bin"); // crypt2

// recover the keystream
$keystream = "";
for($i=0; $i<strlen($m1); $i++){
	$tmp = ord($m1[$i]) ^ ord($c1[$i]);
	$keystream .= chr($tmp);
}

// Use the keystream to decrypt 2nd crypt
$m2 = '';
for ($i=0; $i<strlen($c2); $i++){
	$tmp = ord($c2[$i]) ^ ord($keystream[$i]);
	$m2 .= chr($tmp);
}

$outfile = "intelsecrets.txt";
file_put_contents($outfile, $m2);
echo "IntelSecrets saved to $outfile \n";

// Extract x (key2) and y (substitution array);
$tmppos = strpos($m2, "x:");
$tmp = substr($m2,$tmppos+3);
$tmppos = strpos($tmp, " ");
$key2 = substr($tmp,0,$tmppos); // key2 (x)
$tmppos = strpos($m2, "y:");
$tmp = substr($m2,$tmppos+3);
$chars = explode(',',$tmp); // substitution (y)
echo "Dictionary RC4 key (x) is $key2 \n";
echo "Output (y) Length is ".count($chars)."\n";

$dict = array();
$order = array(36,37,38,39,45,47,49,51,53,54,40,44,43,42,41,52,50,48,46,55,6,5,10,9,8,7,14,13,12,11,17,16,15,21,20,19,18,24,23,22,29,28,27,26,33,32,31,30,35,34);
for ($i=0; $i<count($order); $i++){
	if ($i % 5 == 0) echo "Decrypting $i"."/".count($order)."...\n";
	$cur = $order[$i];
	$fname = "binaryData/class_".$cur.".bin";
	$dict[] = rc4Salted(file_get_contents($fname), $key2);
}

$out = "";
for ($i=0; $i<count($chars); $i++){
	$pair = explode(':', $chars[$i]);
	$curDict = $dict[$pair[0]];
	$out .= $curDict[$pair[1]];
}

$outfile = 'out.swf';
file_put_contents($outfile, $out);
echo "Output SWF saved to $outfile...\n";

function rc4Salted($msg, $key){
	$salt = substr($msg,0,16);
	//echo "SALT: $salt \n";
	$msg = substr($msg,16);
	$pw = md5($key.$salt);
	//echo "PW: $pw \n";
	
	// perform rc4 here
	$sbox = array();
	for ($i=0; $i<256; $i++){
		$sbox[$i] = $i;
	}
	
	$tmp = 0;
	for ($i=0; $i<256; $i++){
		$tmp = ($tmp + $sbox[$i] + ord($pw[$i%strlen($pw)])) & 0xff;
		$tmp2 = $sbox[$i];
		$sbox[$i] = $sbox[$tmp];
		$sbox[$tmp] = $tmp2;
	}
	
	$tmpindex = 0;
	$tmp = 0;
	$out = '';
	for ($i=0; $i<strlen($msg); $i++){
		$tmpindex = ($tmpindex + 1) & 0xff;
		$tmp = ($tmp + $sbox[$tmpindex]) & 0xff;
		$tmp2 = $sbox[$tmpindex];
		$sbox[$tmpindex] = $sbox[$tmp];
		$sbox[$tmp] = $tmp2;
		$out .= chr(ord($msg[$i]) ^ $sbox[($sbox[$tmpindex] + $sbox[$tmp]) & 0xff]);
	}
	return $out;
}
?>
