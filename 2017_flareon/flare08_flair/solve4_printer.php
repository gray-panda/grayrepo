<?php
/*
echo staple_vutfs("Zcj30d9jroqAN2mtzayVK0awaVTLnoXVcsjl9ujUAd22JiI9xfhqEW1BbkG3LsgQRoStjh+Eb6wTD4BwD9Kypa5ggXfHLWmFjFgERViV+5IRU4RbUPDUwYTivhsdZnA=", 0x11, "for")."\n";
// s+_m;a\>q$AOJl8i|4Fzp#2XZn/V^'cUw1"M*]hYDuWo`-C~=t 5%&N:603QKEb<{eIxRHgL)S,T!d.9

echo staple_iemm("e.RP9SR8x9.GH.G8M9.GHkG")."\n";
echo staple_iemm("LHG1@@!SxeGS9.M9.GHkG")."\n";
echo staple_iemm("LHG1@@!SxeGS9.u.g9")."\n";
echo staple_iemm("e.RP9SR8x9.GH.G8@d81@@!SxeGS9.u.g9")."\n";
echo staple_iemm("g!eLv")."\n";
echo "\n";
echo staple_iemm("Gv@H")."\n";
echo "\n";
echo staple_iemm(",e}e8S98*eGeu.@yG5GPHed")."\n";
echo staple_iemm(",e}e8S98u.@yG5GPHed")."\n";
echo staple_iemm("e.RP9SR8x9.GH.G8PHv81vvHG-e.eLHP")."\n";
echo staple_iemm("9@H.")."\n";
echo staple_iemm("PHeR")."\n";
echo staple_iemm("PHeRu.G")."\n";
echo staple_iemm(",e}e8yGS!8Dev)-e@")."\n";
echo staple_iemm("@yG")."\n";
echo staple_iemm("PHeR\"(GH")."\n";
echo staple_iemm("PHeR5)9PG")."\n";
echo staple_iemm(",e}e8yGS!8Dev)-e@")."\n";
echo staple_iemm("vSBH")."\n";
echo staple_iemm("LHG")."\n";
echo staple_iemm(",e}e8yGS!81PPe(v")."\n";
echo staple_iemm("H?ye!v")."\n";
echo "\n";
*/

$hashmap = readAsset("tspe");
$correct = "";
for ($i=0; $i<count($hashmap); $i++){
	$correct .= $hashmap[$i];
}
echo $correct."\n";
echo sha1($correct)."\n";

function readAsset($name){
	$data = file_get_contents($name);
	$data = substr($data,8);
	$len = substr($data,0,4);
	$len = unpack("N", $len)[1];
	$data = substr($data,4);

	echo "Length: ".$len." \n";
	$out = array();
	for ($i=0; $i<$len; $i+=3){
		$key = substr($data, $i, 2);
		$key = unpack("n",$key)[1];
		$val = substr($data, $i+2, 1);
		$out[$key] = $val;
	}

	return $out;
}

// ARC4 is the same as RC4
function staple_vutfs($obmsg, $obkey, $arc4key){
	$enc = staple_drdfg($obmsg, $obkey);
	return rc4($arc4key, $enc);
}

function staple_drdfg($enc, $key){
	$tmp = base64_decode($enc);
	$out = "";
	for ($i=0; $i<strlen($tmp); $i++){
		$out .= chr(ord($tmp[$i]) ^ $key);
	}
	return $out;
}

function staple_iemm($msg){
	$normal = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
	$dict 	= 's+_m;a\\>q$AOJl8i|4Fzp#2XZn/V^\'cUw1"M*]hYDuWo`-C~=t 5%&N:603QKEb<{eIxRHgL)S,T!d.9@?PvGy}[k(B7rjf';

	$out = "";
	for ($i=0; $i<strlen($msg); $i++){
		$cur = $msg[$i];
		$tmp = strpos($dict, $cur);
		$out .= $normal[$tmp];
	}

	return $out;
}

function rc4($key, $str) {
	$s = array();
	for ($i = 0; $i < 256; $i++) {
		$s[$i] = $i;
	}
	$j = 0;
	for ($i = 0; $i < 256; $i++) {
		$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
	}
	$i = 0;
	$j = 0;
	$res = '';
	for ($y = 0; $y < strlen($str); $y++) {
		$i = ($i + 1) % 256;
		$j = ($j + $s[$i]) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
		$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
	}
	return $res;
}

?>