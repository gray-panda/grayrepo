<?php
$d = base64_decode('SDcGHg1feVUIEhsbDxFhIBIYFQY+VwMWTyAcOhEYAw4VLVBaXRsKADMXTWxrSH4ZS1IiAgA3GxYUQVMvBFdVTysRMQAaQUxZYTlsTg0MECZSGgVcNn9AAwobXgcxHQRBAxMcWwodHV5EfxQfAAYrMlsCQlJBAAAAAAAAAAAAAAAAAFZhf3ldEQY6FBIbGw8RYlAxGEE5PkAOGwoWVHgCQ1BGVBdRCAAGQVQ2Fk4RX0gsVxQbHxdKMU8ABBU9MUADABkCGHdQFQ4TXDEfW0VDCkk0XiNcRjJxaDocSFgdck9CTgpPDx9bIjQKUW1NWwhERnVeSxhEDVs0LBlIR0VlBjtbBV4fcBtIEU8dMVoDACc3ORNPI08SGDZXA1pbSlZzGU5XVV1jGxURHQoEK0x+a11bPVsCC1FufmNdGxUMGGE=');

$crib = "";
$p1 = 0; // which 2 parts to compare
$p2 = 1; // which 2 parts to compare
$splitlen = 12;
if (!empty($argv[1])) $crib = $argv[1];
if (!empty($argv[2])) $splitlen = $argv[2];
if (!empty($argv[3])) $p1 = $argv[3];
if (!empty($argv[4])) $p2 = $argv[4];


$splitlen = 26; // 22
$p1 = 0;		// 0
$p2 = 11;		// 13
$crib = "<html>\r\n<title>Raytraced ";

$lines = str_split($d,$splitlen);
echo "Number of ciphertexts: ".count($lines)."\n";

$criblen = strlen($crib);
if (isset($lines[$p1])) $c1 = $lines[$p1];
else {echo "Error $p1 out of range\n";die();}
if (isset($lines[$p2])) $c2 = $lines[$p2];
else {echo "Error $p2 out of range\n";die();}
$xored = $c1 ^ $c2;

//echo bin2hex($xored)."\n";

for ($i=0; $i<strlen($xored)-$criblen; $i++){
	$tmp = substr($xored,$i,$criblen) ^ $crib;
	if (isAsciiStr($tmp)){
		$end = $i + $criblen;
		echo "[$i:$end] $tmp\n";
	}
}

function cribdrag($c1, $c2, $crib){
	$criblen = strlen($crib);
	$xored = $c1 ^ $c2;

	for ($i=0; $i<strlen($xored)-$criblen; $i++){
		$tmp = substr($xored,$i,$criblen) ^ $crib;
		if (isAsciiStr($tmp)){
			$end = $i + $criblen;
			echo "[$i:$end] $tmp\n";
		}
	}
}

function isAsciiStr($input){
	$allAscii = true;
	for ($i=0; $i<strlen($input); $i++){
		$cur = substr($input,$i,1);
		$cur = ord($cur);
		if ($cur > 0x7e){
			//echo "Not Ascii: $cur\n";
			$allAscii = false;
			break;
		}
		if ($cur < 0x20){
			if ($cur == 0xa) continue;
			if ($cur == 0xd) continue;
			//echo "Not Ascii: $cur\n";
			$allAscii  = false;
			break;
		}
	}
	return $allAscii;
}
?>