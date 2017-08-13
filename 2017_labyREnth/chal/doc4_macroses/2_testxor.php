<?php
$raw = file_get_contents('macroses.doc');

// Change the combinations of these offsets
$offset = 0;
//$offset += 500;
$offset += 1337;
$offset += 81175;

$data = substr($raw,$offset); // May have off by 1 here!
$data = str_replace("\n","",$data);
$data = substr($data,0,78508);

$dec = base64_decode($data);

// Brute XOR key!
for ($k=1; $k<256; $k++){
	echo "Testing Key $k...\n";
	$tmp = "";
	for ($i=0; $i<strlen($dec); $i++){
		$cur = ord($dec[$i]);
		$tmp .= chr($cur ^ $k);
	}
	
	if (ord($tmp[0]) == 0xd0 && ord($tmp[1]) == 0xcf) {
		echo "Found!! Offset $offset Key $k \n"; // Checking for .doc file header (0xd0cf)
	}
	$fn = "xor_".$offset."_0/$k";
	file_put_contents($fn, $tmp);
}
?>
