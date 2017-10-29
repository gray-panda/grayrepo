<?php
// Just focus on the function at 0x536 that does the xoring
$enc = "\xb5\xb5\x86\xb4\xf4\xb3\xf1\xb0\xb0\xf1\xed\x80\xbb\x8f\xbf\x8d\xc6\x85\x87\xc0\x94\x81\x8c";

for ($i=1; $i<256; $i++){
	$dec = decrypt($enc, $i);
	if (strpos($dec, "@") !== false){
		echo "$i: $dec \n";
	}
}


function decrypt($enc, $key){
	$out = "";
	for ($i=0; $i<strlen($enc); $i++){
		$tmp = ord($enc[$i]) ^ $key;
		$tmp = ($tmp + $i) & 0xff;
		$out .= chr($tmp);
	}
	return $out;
}
?>