<?php
$enc1 = hex2bin('38E14A1B0C1A46460A96297373A46903001BA8F8B82416D609CB'); // from 0x7ac

// recover stage 1
$enc2 = "";
for ($i=0; $i<strlen($enc1); $i++){
	$cur = ord($enc1[$i]);
	if ($i == 0){
		$enc2 .= chr($cur ^ 0xc5);
	}
	else{
		$prev = ord($enc1[$i-1]);
		$enc2 .= chr($cur ^ $prev);
	}
}

//echo bin2hex($enc2)."\n";
$dict = hex2bin('FF157420400089EC5DC34246C063862AAB08BF8C4C25193192B0AD14A2B667DD39D85F3F7B5CC2B2F62E759B6194CFCE6A9850F25BF045300E38EB3B6C667F243DDF8897B9B3F1CB83991A0DEFB103559E9A7A10E036E8D3E432C17807B76BC770C92CA091356DFE735EF4A4D9DB4369F58DEE447D48B5DC4B02A1E3D2A6213E2FA3D7BB845AFB8F121C4128C576599CF73306270A0BAF71164AE99F4F6FE20FBE2BE756D553792D641795A7BD7C1D5893A565F81813EABCE5F3370496A81E012982513C681F8EDA8A05227249FA87A95462C6AA09B4FDD6D1AC8511473A9DE64D1BCC528023FCED8B7E60CD6E57BADEAECAC4770C4ED4D0C8E1B8F926908134'); //from 0x461
$plain = "";

for ($i=strlen($enc2)-1; $i>=0; $i--){
	$cur = ord($enc2[$i]);
	if ($i == strlen($enc2)-1){
		// first run
		$index = rol(0x97,3);
	}
	else{
		$next = ord($enc2[$i+1]);
		$index = rol($next,3);
	}
	$tmp = ord($dict[$index]);
	$xorkey = ord($dict[$tmp]);
	$plain .= chr($cur ^ $xorkey);
}

echo strrev($plain)."\n";
// flag is retr0_hack1ng@flare-on.com

function rol($value, $numleft){ // byte size rotate left
	if ($numleft < 0 || $numleft > 8) {echo "ROTATE LEFT FAIL";return false;}
	return ((($value << $numleft) | ($value >> (8-$numleft))) & 0xFF);
}

function ror($value, $numright){ // byte size rotate right
	if ($numright < 0 || $numright > 8) {echo "ROTATE RIGHT FAIL";return false;}
	return ((($value >> $numright) | ($value << (8-$numright))) & 0xFF);
}
?>