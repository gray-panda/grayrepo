<?php
$enc = file_get_contents("PANW_Top_Secret_Sauce.jpg.encrypted");
$key = "001c4292df"; // Hash gotten from brutehash.php

// Bruteforce the last byte of the key
for ($i=0; $i<256; $i++){
	$cur = dechex($i);
	while (strlen($cur) < 2) $cur = '0'.$cur;
	$testkey = $key.$cur;
	echo "Trying $testkey \n";
	$plain = rc4($testkey, $enc);
	if (strpos($plain, "JFIF") !== false){
		$fname = "decrypted_".$cur.".jpg";
		echo "Found!! Writing to $fname \n";
		file_put_contents($fname, $plain);
	}
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

// Correct key is "d7" => "001c4292dfd7"
// PAN{1_d0n't_4lw@y5_c@tch_4_v1rus_but_wh3n_1_d0_1_cr@ck_1t}
?>