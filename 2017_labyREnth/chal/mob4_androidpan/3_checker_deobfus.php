<?php
//echo decodeStrings("+`]p]+`]p]+_ki*l]js*_pb+*gau")."\n";

echo decodeStrings2(".eXuX.eXuX.Znl/iXov/Zug./a`ed./m`[ZadZbdk")."\n";
echo decodeStrings2(".eXuX.eXuX.Znl/iXov/Zug./bdp")."\n";
echo decodeStrings2("(6")."\n";
echo decodeStrings2("+(")."\n";
echo decodeStrings2("((")."\n";
echo decodeStrings2("kn/iknetZu/oXld")."\n";
echo decodeStrings2("jeb")."\n";
echo decodeStrings2(".edw.hdlt^i`id")."\n";
echo decodeStrings2(".iknZ.$e.juXu")."\n";
//echo decodeStrings2("")."\n";
echo "\n\n";

$enc = "3;:j>99j2??38=9n3o:i?:;9>><<9<28i>>j>;hoi<>;om>=2njiiojm9hi:;23=";
$keys = array(23,21,17,11);
for ($i=0; $i<count($keys); $i++){
	$curkey = $keys[$i];
	echo $curkey.": ".singleXor($enc,$curkey)."\n";
}

function decodeStrings($input){
	$out = "";
	for ($i=0; $i<strlen($input); $i++){
		$cur = ord($input[$i]);
		$tmp = ($cur + 0x4) & 0xff;
		$out .= chr($tmp);
	}
	return $out;
}

function decodeStrings2($input){
	$out = "";
	for ($i=0; $i<strlen($input); $i++){
		$cur = ord($input[$i]);
		$tmp = ($cur ^ 0x5) & 0xff;
		$tmp = ($tmp + 0x4) & 0xff;
		$out .= chr($tmp);
	}
	return $out;
}

function singleXor($input, $key){
	$out = "";
	for ($i=0; $i<strlen($input); $i++){
		$cur = ord($input[$i]);
		$tmp = $cur ^ $key;
		$out .= chr($tmp);
	}
	return $out;
}
?>