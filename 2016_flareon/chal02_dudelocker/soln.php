<?php
$enc = file_get_contents("BusinessPapers.doc");
$iv = md5("businesspapers.doc", true);
$pw = deriveKey("thosefilesreallytiedthefoldertogether", 256);
echo "Key is ".bin2hex($pw)."\n";
echo "IV is ".bin2hex($iv)."\n";

$plain = openssl_decrypt($enc, "aes-256-cbc", $pw, OPENSSL_RAW_DATA||OPENSSL_ZERO_PADDING, $iv);

if ($plain === false){
	echo openssl_error_string();
}

file_put_contents("decrypted", $plain);
// flag is cl0se_t3h_f1le_0n_th1s_0ne@flare-on.com

function deriveKey($password, $keysize){
	$basedata = sha1($password, true);
	$buffer1 = "";
	$buffer2 = "";
	
	for ($i=0; $i<64; $i++){
		$buffer1 .= chr(0x36);
		$buffer2 .= chr(0x5c);
		if ($i < strlen($basedata)){
			$buffer1[$i] = $buffer1[$i] ^ $basedata[$i];
			$buffer2[$i] = $buffer2[$i] ^ $basedata[$i];
		}
	}
	
	$b1 = sha1($buffer1, true);
	$b2 = sha1($buffer2, true);
	$outbuff = $b1.$b2;
	return substr($outbuff,0,($keysize/8));
}
?>