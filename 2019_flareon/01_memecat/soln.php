<?php
// stage 1 is "RAINBOW"

$enc = hex2bin('03').' '.'&'.'$'.'-'.hex2bin('1e02').' '.'/'.'/'.'.'.'/';
$out = "";
for ($i=0; $i<strlen($enc); $i++){
	$tmp = ord($enc[$i]) ^ ord("A");
	$out .= chr($tmp);
}
echo $out;
// stage 2 is "Bagel_Cannon"

// Flag is Kitteh_save_galixy@flare-on.com
?>