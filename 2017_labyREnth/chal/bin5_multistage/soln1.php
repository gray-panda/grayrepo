<?php
$enc = 'mY0dKWWn0[EN\XZhdE:0N\W0ZQSE{gYN\0LQJ0QY0WZaSXKa~W0JNKORNOKW0VWJ]Tigf0QYV0SO]Z~0SE0N\W0jgdgifa{u0QKN]U]RWK0fQWVQZOJ0UXK0n]id0k]ihz0XU0bKgNg0QN0nYXzzhJ9';
$plain = "";
$hexstr = "";
$dictionary = createTranslationArray();

for($i=0; $i<strlen($enc); $i++){
	$cur = ord($enc[$i]);
	$res = $dictionary[$cur];
	$hex = dechex($res);
	$plain .= chr($res);
	$hexstr .= $hex." ";
}
echo $plain."\n";
//echo $hexstr."\n";


function createTranslationArray(){
	$out = array();
	for ($i=0x20; $i<0x7f; $i++){
		$tmp = $i >> 1;
		$key = $i ^ $tmp;
		//echo "$i ^ $tmp = $key \n";
		$out[$key] = $i;
	}
	return $out;
}
?>