<?php
$binary = array("000000","000001","000010","000011","000100","000101","000110","000111","001000","001001","001010","001011","001100","001101","001110","001111","010000","010001","010010","010011","010100","010101","010110","010111","011000","011001","011010","011011","011100","011101","011110","011111","100000","100001","100010","100011","100100","100101","100110","100111","101000","101001","101010","101011","101100","101101","101110","101111","110000","110001","110010","110011","110100","110101","110110","110111","111000","111001","111010","111011","111100","111101","111110","111111");

// Create xorkeys (2 possible sets, choose to use 1)
$xorkeys1 = array(82,77,65);
$xorkeys2 = array(77,65,82);
$xorkeys = $xorkeys2;

// Create Dictionary (2 possible set, can be used straight or reversed hence 4 possible ways)
$enc1 = "111,49,83,6,61,53,73,91,1,128,57,8,110,111,101,114,101,40,99,90,60,113,112,70,11,116,71,77,123,32,110,5,52,106,28,20,106,111,47,93,82,31,27,109,38,56,118,6,96,37,32,94,42,118,118,9,56,94,103,43,12,3,123,128";
$enc2 = "31,1,109,69,0,116,109,97,4,5,116,87,91,85,96,91,3,123,12,118,3,124,111,23,81,101,22,80,2,12,15,7,124,10,66,111,101,70,85,118,66,25,106,18,16,72,11,71,30,22,120,7,70,2,119,19,2,106,9,79,25,72,3,11";
//$dict = xorDict(strrev($enc2))."\n";
//$dict = xorDict_orig("5/4/2017 12:57:53 AM".$enc1);
$dict = xorDict_orig("3/24/2017 10:17:12 AM".$enc2);
echo "Dict: $dict\n";

$enc = file_get_contents("MarsSpider_Contract.doc");
$enc = substr($enc,(0x41c6c-29-0xae)-1,2156);
//echo $enc."\n";

$plain = "";
for ($i=0 ;$i<strlen($enc); $i+=4){
	$cur = substr($enc,$i,4);
	
	$tmp1 = "";
	for ($k=0; $k<4; $k++){
		if (ord($cur[$k]) == 61){ // "="s
			$tmp1 .= "00000000";
		}
		else{
			$pos = strpos($dict,$cur[$k]);
			$tmp1 .= $binary[$pos];
		}
	}
	
	$val = array(128,64,32,16,8,4,2,1);
	
	$part1 = substr($tmp1,18,6) . substr($tmp1,6,2);
	$tmp = 0;
	for ($p=0; $p<strlen($part1); $p++){
		if (ord($part1[$p]) == 0x31) $tmp += $val[$p];
	}
	$plain .= chr($tmp ^ $xorkeys[0]);
	
	$part2 = substr($tmp1,8,8);
	$tmp = 0;
	for ($p=0; $p<strlen($part2); $p++){
		if (ord($part2[$p]) == 0x31) $tmp += $val[$p];
	}
	$plain .= chr($tmp ^ $xorkeys[1]);
	
	$part3 = substr($tmp1,16,2).substr($tmp1,0,6);
	$tmp = 0;
	for ($p=0; $p<strlen($part3); $p++){
		if (ord($part3[$p]) == 0x31) $tmp += $val[$p];
	}
	$plain .= chr($tmp ^ $xorkeys[2]);
}

//echo $plain."\n";
file_put_contents("594f54.bat",$plain);

function xorDict($timestamp, $input){
	//$msg = substr($input,21,195);
	$msg = $input; 
	echo $msg."\n";
	$key = substr($timestamp,0,9);
	echo $key."\n";
	$msgparts = explode(',',$msg);
	$out = "";
	
	for ($i=0; $i<count($msgparts); $i++){
		$cur = (int) $msgparts[$i];
		//echo $cur."\n";
		$xored = $cur ^ ord($key[($i % strlen($key))]);
		$out .= chr($xored);
	}
	
	return $out;
}

function xorDict_orig($input){
	$msg = substr($input,21,195);
	echo $msg."\n";
	$key = substr($input,0,9);
	echo $key."\n";
	$msgparts = explode(',',$msg);
	$out = "";
	
	for ($i=0; $i<count($msgparts); $i++){
		$cur = (int) $msgparts[$i];
		//echo $cur."\n";
		$xored = $cur ^ ord($key[($i % strlen($key))]);
		$out .= chr($xored);
	}
	
	return $out;
}
?>