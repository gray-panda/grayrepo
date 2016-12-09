<?php
$dict = file_get_contents("dictionary");

$next = array();
for ($i=0; $i<256; $i++){
	$tmp = $dict[$i+0x1cd];
	
	$hex1 = dechex($i);
	$hex2 = bin2hex($tmp);
	
	if (strcmp($hex1, $hex2) === 0) {
		echo "SAME!!! ";
		echo "$hex1 : $hex2 \n";
		$next[] = $i;
	}
}
echo "\n";

//Possible first byte is 0x3c, 0x7a or 0xf9

echo "flare- : ".bin2hex(tripleSha1("flare-"))."\n";
echo "on.com : ".bin2hex(tripleSha1("on.com"))."\n\n";
echo bin2hex(genTarget(0x3c, $dict))."\n\n";
echo bin2hex(genTarget(0x7a, $dict))."\n\n";
echo bin2hex(genTarget(0xf9, $dict))."\n\n";

//$a = $dict[0x223];
//echo bin2hex($a)."\n"; // shld be 0xbe

function genTarget($startbyte, $dict){
	$target = "";
	
	$tmpindex = $startbyte;
	for ($i=0; $i<0x64; $i++){
		$tmpindex = ($tmpindex + 0x1cd) & 0xfff;
		$target .= $dict[$tmpindex];
	}
	
	return $target;
}

function tripleSha1($input){
	$tmp = sha1($input, true);
	$tmp = sha1($tmp, true);
	$tmp = sha1($tmp, true);
	return $tmp;
}

/*
Finding the correct target hash

SAME!!! 3c : 3c
SAME!!! 7a : 7a
SAME!!! f9 : f9

flare- : 06046b721e18e20b841f497e257753b2314b866c
on.com : cc720842d0884da08e26d9fccb24bc9c27bd254e

3cab2465e955b78e1dc84ab2aad1773641ef6c294a1bf8bd1e91f3593a6ccc9cc9b2d5682e62244f9e6061a36250e1c47e69f0312db4e561528a1fb506046b721e18e20b841f497e257753b2314b866ccc720842d0884da08e26d9fccb24bc9c27bd254e

7afc01ff7c2ae6768ad7281b1025c7d64e9a905fef16ec2a43f5d840efdae1aaaabd7dc3b7670810a4f6f80389125aad77e918db77a466e5ab7db10ffe140ae073bca6e0071d7d1c29a5fa1b73a99a064714505cf92f2fbaeaac1059a5613a3928285b88

f91727f8892e34f2be1786fa115bc4ad621dd4ac92e4de8810744a70338e854adc7803e1eab7094138772f47a05e778af70a1f1d5c8674b6fa63f4127cb25b5598ea410086a995d0c41770b46414599bee613d1a1a64e064c31b9222f70566b9d6939c52

Therefore, correct hash is 3cab2465e955b78e1dc84ab2aad1773641ef6c294a1bf8bd1e91f3593a6ccc9cc9b2d5682e62244f9e6061a36250e1c47e69f0312db4e561528a1fb506046b721e18e20b841f497e257753b2314b866ccc720842d0884da08e26d9fccb24bc9c27bd254e
*/
?>