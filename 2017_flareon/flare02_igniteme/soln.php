<?php
$enc = hex2bin("0D2649452A1778442B6C5D5E45122F172B446F6E56095F454773260A0D1317484201404D0C0269");
$xorkey = 0x04;

$out = "";
for ($i=0x26; $i>=0; $i--){
	$cur = ord($enc[$i]);
	$tmp = $cur ^ $xorkey;
	$xorkey = $tmp;
	$out .= chr($tmp);
}

$out = strrev($out);
echo $out."\n";
// R_y0u_H0t_3n0ugH_t0_1gn1t3@flare-on.com
?>