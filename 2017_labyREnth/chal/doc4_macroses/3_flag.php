<?php
$enc = array(111,84,77,89,203,150,116,89,197,72,226,100,165,245,146,10,32,226,162,246,203,54,22,38,170,176,140,251,246,148,213,97,164,250,125,242,13,162,250,33,239,104,38,74,167,183,133,3,72,255,131,105,228,81,164,202,212,207,231,172,100,156,197,237,45,87,182,196,77);
$key = "TheFileIsCorrupted \n";
$dec = "";
$encstr = "";
for ($i=0; $i<count($enc); $i++){
	$encstr .= chr($enc[$i]);
}

$res = ourseahorse($encstr, $key);
echo $res."\n";


function ourseahorse($msg, $key){
	$s = array();
	$k = array();
	$klen = strlen($key);
	
	for ($i=0; $i<256; $i++){
		$s[$i] = $i;
		$k[$i] = ord(substr($key,($i % $klen),1));
	}
	
	$j = 0;
	for ($i=0; $i<256; $i++){
		$j = ($j + $k[$i] + $s[$i]) % 256;
		$tmp = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $tmp;
	}
	
	$x = 0;
	$y = 0;
	for ($i=1; $i<=3072; $i++){
		$x = ($x + 1) % 256;
		$y = ($y + $s[$x]) % 256;
		$tmp = $s[$x];
		$s[$x] = $s[$y];
		$s[$y] = $tmp;
	}
	
	$out = array();
	$out = "";
	for ($i=0; $i<strlen($msg); $i++){
		$x = ($x + 1) % 256;
		$y = ($y + $s[$x]) % 256;
		$tmp = $s[$x];
		$s[$x] = $s[$y];
		$s[$y] = $tmp;
		
		$out .= chr($s[($s[$x] + $s[$y]) % 256] ^ ord($msg[$i]));
	}
	
	return $out;
	// PAN{681ebc6c79d1a1d4a035943f4f12bdf0488ad1822976b1809b015ae06e335817}
}
?>