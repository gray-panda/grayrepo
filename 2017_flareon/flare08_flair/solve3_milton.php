<?php
$msg = "";
$msg .= doARC4("JP+98sTB4Zt6q8g=", 0x38, "State");
$msg .= doARC4("rh6HkuflHmw5Rw==", 0x60, "Chile");
$msg .= doARC4("+BNtTP/6", 0x76, "eagle");
$msg .= doARC4("oLLoI7X/jIp2+w==", 0x21, "wind");
$msg .= doARC4("w/MCnPD68xfjSCE=", 0x94, "river");
echo $msg."\n";
echo sha1($msg)."\n";

// ARC4 is the same as RC4
function doARC4($obmsg, $obkey, $arc4key){
	$enc = staple_drdfg($obmsg, $obkey);
	return rc4($arc4key, $enc);
}

function staple_drdfg($enc, $key){
	$tmp = base64_decode($enc);
	$out = "";
	for ($i=0; $i<strlen($tmp); $i++){
		$out .= chr(ord($tmp[$i]) ^ $key);
	}
	return $out;
}

function rc4($key, $str) {
	$s = array();
	for ($i = 0; $i < 256; $i++) {
		$s[$i] = $i;
	}
	$j = 0;
	for ($i = 0; $i < 256; $i++) {
		$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
	}
	$i = 0;
	$j = 0;
	$res = '';
	for ($y = 0; $y < strlen($str); $y++) {
		$i = ($i + 1) % 256;
		$j = ($j + $s[$i]) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
		$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
	}
	return $res;
}
?>