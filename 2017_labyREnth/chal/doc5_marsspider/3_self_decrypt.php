<?php
$raw = file_get_contents('rawx86');
$enc = substr($raw,0x4d);

$out = substr($raw,0,0x4d);

for ($i=0; $i<strlen($enc); $i+=2){
	$w1 = substr($enc,$i,2);
	$w2 = substr($enc,$i+2,2);
	$xored = $w1 ^ $w2;
	$out .= $xored;
}

file_put_contents('decrypted_x86',$out);

function getWord($input){
	$bytes = substr($input,0,2);
	$bytes = strrev($bytes);
	return $bytes;
}

function advancePtr($input){
	return substr($input,2);
}
?>