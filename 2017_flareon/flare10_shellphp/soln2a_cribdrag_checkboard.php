<?php
$d = base64_decode('SDcGHg1feVUIEhsbDxFhIBIYFQY+VwMWTyAcOhEYAw4VLVBaXRsKADMXTWxrSH4ZS1IiAgA3GxYUQVMvBFdVTysRMQAaQUxZYTlsTg0MECZSGgVcNn9AAwobXgcxHQRBAxMcWwodHV5EfxQfAAYrMlsCQlJBAAAAAAAAAAAAAAAAAFZhf3ldEQY6FBIbGw8RYlAxGEE5PkAOGwoWVHgCQ1BGVBdRCAAGQVQ2Fk4RX0gsVxQbHxdKMU8ABBU9MUADABkCGHdQFQ4TXDEfW0VDCkk0XiNcRjJxaDocSFgdck9CTgpPDx9bIjQKUW1NWwhERnVeSxhEDVs0LBlIR0VlBjtbBV4fcBtIEU8dMVoDACc3ORNPI08SGDZXA1pbSlZzGU5XVV1jGxURHQoEK0x+a11bPVsCC1FufmNdGxUMGGE=');

/*
(22) Testing 0 with 13
[0:9] "kl3(cTB-
[1:10] x0#9xMFg9
[3:12] luyGDzw~8
[4:13] f%WUanzr;
[7:16]
<title>R
*/
// Actual keylength should be 26
for ($k=12; $k<64; $k++){
	$lines = str_split($d,$k);
	$numlines = count($lines);
	$c1 = $lines[0];
	for ($i=1; $i<$numlines; $i++){
		$c2 = $lines[$i];
		echo "\n($k) Testing 0 with $i\n";
		cribdrag($c1, $c2, '</script>');
	}
	echo "----------------------------------------------------\n";
	fgets(fopen("php://stdin","r"));
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