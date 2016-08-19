<?php
$label1 = "xRgWTqWr7ipEjFBfESrOiaYFu9i9Jml3Q171"; // U8pblvDZuAh8GY.Label1.Caption
$tag = "BZb+NKtmD9XQ6uQAgJsuvvudb7tZgoD/RCJX"; // U8pblvDZuAh8GY.Tag

$pn1 = base64_decode($label1);
$pn1 = singleByteXor($pn1, 32); // U8pblvDZuAh8GY.ScrollHeight
$pn1 = singleByteXor($pn1, 44); // U8pblvDZuAh8GY.HelpContextId
echo "PN1 is $pn1 \n";

$pn2 = base64_decode(strrev($tag));
$pn2 = stringXor($pn2, $pn1);
$pn2 = singleByteXor($pn2, 85); // U8pblvDZuAh8GY.Zoom
$pn2 = singleByteXor($pn2, 144); // U8pblvDZuAh8GY.ScrollWidth
echo "PN2 is $pn2 \n";

function singleByteXor($msg, $key){
	$out = "";
	for ($i=0; $i<strlen($msg); $i++){
		$out .= chr(ord($msg[$i]) ^ $key);
	}
	return $out;
}

function stringXor($msg1, $msg2){
	$out = "";
	for ($i=0; $i<strlen($msg1); $i++){
		$out .= chr(ord($msg1[$i]) ^ ord($msg2[$i%strlen($msg2)]));
	}
	return $out;
}
?>