<?php
// State: 12420 167 127
// Trying 00304fa77f (831fa9176be3c1dc55becaf6af865857) 

// Testing Hashing function works correctly
// Test Mac 0x100400000: 0x000057c8b6290c00  "000c29b6c857"
// (lldb) x/10wx $rax
// 0x1001066a0: 0x00000001 0x000000a0 0x000000e5 0x0000009e
// 0x1001066b0: 0x00000017 0x00000000 0x00000000 0x00000000
// Should be equal to cbe77469bd72304eac703718b3dcdefa
if (count($argv) > 1 && strcmp($argv[1],"test") == 0){
	$testmac = "000c29b6c8";
	echo doHash(hex2bin($testmac))."\n";
	echo "cbe77469bd72304eac703718b3dcdefa\n";
	die();
}

// https://regauth.standards.ieee.org/standards-ra-web/pub/view.html#registries
// https://standards.ieee.org/develop/regauth/oui/oui.csv
//$AppleOUIs = file_get_contents("MAC.CSV");
$AppleOUIs = file_get_contents("oui.csv"); // all valid mac vendor addresses
$lines = explode("\n", $AppleOUIs);
$macs = array();
for ($i=0; $i<count($lines); $i++){
	$line = $lines[$i];
	$parts = explode(",",$line);
	$macs[] = strtolower($parts[1]);
}

//$macs = array();
//$macs[] = "001C42";

$target = "da91e949f4c2e814f811fbadb3c195b8";
// First 3 Bytes Are Vendor Specific, Next 2 Bytes is whole 255 range
$correctMAC = "";
$found = false;
$count = 0;
for ($a=20700; $a<count($macs); $a++){
	for ($b=0; $b<256; $b++){
		for ($c=0; $c<256; $c++){
			$first3 = hex2bin($macs[$a]);
			$MAC = $first3.chr($b).chr($c);

			$hash = doHash($MAC);
			if (strcmp($hash,$target) == 0){
				$found = true;
				$correctMAC = bin2hex($MAC);
				echo "FOUND MAC Address : $correctMAC \n";
				echo "Final State: $a $b $c\n";
				die();
			}

			$count++;
			if ($count % 100000 == 0){
				echo "State: $a $b $c\n";
				echo "Trying ".bin2hex($MAC)." ($hash) \n";
				$count = 0;
			}
			if ($found) break;
		}
		if ($found) break;
	}
	if ($found) break;
}

if (!$found) echo "BruteHash failed...\n";

function doHash($msg){
	$dictionary = array();
	$dictionary[0] = array(0x13,0x9a,0x1b,0xe4,0xf3);
	$dictionary[1] = array(0x8e,0xc7,0x8c,0x3f,0x7a);
	$dictionary[2] = array(0xdc,0x0b,0x42,0xa7,0xf8);
	$dictionary[3] = array(0x6e,0x9f,0x08,0x79,0x17);
	$dictionary[4] = array(0xd6,0xb1,0x33,0x7d,0x67);

	$modRes = array(0,0,0,0,0);
	for ($i=0; $i<5; $i++){
		for($k=0; $k<5; $k++){
			$msgByte = ord($msg[$k]);
			$dictByte = $dictionary[$k][$i];
			//echo "Multiplying 0x".dechex($msgByte)." 0x".dechex($dictByte);
			$modRes[$i] += ($msgByte * $dictByte);
			//echo " => 0x".dechex($modRes[$i])."\n";
			//echo $modRes[$i]." -> ";
		}
		//echo "\n";
		$modRes[$i] = $modRes[$i] % 0xfb;
		//echo "Final $i : 0x".dechex($modRes[$i])."\n";
	}

	$dstr = "";
	for ($i=0; $i<count($modRes); $i++){
		$hex = dechex($modRes[$i]);
		while (strlen($hex) < 2) $hex = '0'.$hex;
		$dstr .= $hex."000000";	
	}
	//var_dump($dstr);

	return md5(hex2bin($dstr));
}

function xor13($msg){
	$out = "";
	$key = "13";
	for($i=0; $i<strlen($msg); $i++){
		$cur = ord($msg[$i]);
		$curkey = ord($key[$i % strlen($key)]);
		$out .= chr($cur ^ $curkey);
	}
	return $out;
}
?>