<?php
$enc = hex2bin("37E7D8BE7A533025BB38572697266F50F47567BFB0EFA57A65AEAB6673A0A3A1");
$key = file_get_contents('key.bin');
echo strlen($enc)."\n";

$out = "";
for ($i=0; $i<strlen($enc); $i++){
	$tmp = ord($enc[$i]) ^ ord($key[$i]);
	$out .= chr($tmp);
}

echo $out."\n";
?>