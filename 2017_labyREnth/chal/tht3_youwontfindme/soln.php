<?php
$enc = strrev(hex2bin("642C740D0C297E3A5E1B4D6A70346C24175D56485F7F2B3C0E1F1C6D716F3C2013095B405B2C2F385D491C62763930231A560E13507879390B414E36216B327C1A065E42022C2032"));
//echo $enc."\n";

//$enc = strrev($enc); // reversed twice, therefore not reversed.

// Since key must be 8 char long, split the string into 8 char strings
$crypted = array();
for ($i=0; $i<strlen($enc); $i+=8){
	$crypted[] = substr($enc,$i,8);
}

for ($i=0; $i<count($crypted); $i++){
	$cur = bin2hex($crypted[$i]);
	echo $cur."\n";
}

// recover chunks 1 till end
$key = "";
$out = array();
for ($i=count($crypted)-1; $i > 0; $i--){
	$key = strrev($crypted[$i-1]);
	$out[$i] = xorString($crypted[$i], $key);
}
var_dump($out);

// recover chunk 0
// Assuming first 4 char is 'PAN{'
echo xorString($crypted[0], "PAN{aaaa")."\n";

$chunk0 = xorString($crypted[0], "babytoby");
echo bin2hex($chunk0)." ($chunk0)\n";
$out[0] = $chunk0;

for ($i=0; $i<count($out); $i++){
	echo $out[$i];
}
echo "\n";

function xorString($msg, $key){
	$out = "";
	for ($i=0; $i<strlen($msg); $i++){
		$out .= chr(ord($msg[$i]) ^ ord($key[$i]));
	}
	return $out;
}
?>