<?php
/*
i is "BAdPuzzl3r!?"
c.tostring ?? "Virtual"[5] = "a"
text is "No" for "Nokia"
@string is MainPage.varStore.varA[6] UTF-8 encoded 7th byte of MrBurns.jpg
string key = i + c.ToString() + text + @string; 

BAdPuzzl3r!?aNoJ
*/
$burns = file_get_contents("MrBurns.jpg");
$img = file_get_contents("Garbage.jpg");

$key = "BAdPuzzl3r!?"."a"."No".$burns[6];
$keylen = strlen($key);
echo "$key ($keylen) \n";
$res = xorOffset($img,$key);
file_put_contents("flag.jpg", $res);

// flag is PAN{Th4t's_My_S3cr3t_N0boDy_Def34ts_th3_HOUNDS}

function xorOffset($data, $key){
	$num = 171;
	$out = '';
	for ($i=0; $i<strlen($data); $i++){
		$curkey = (ord($key[$i % strlen($key)]) + $num) & 0xff;
		$out .= chr(ord($data[$i]) ^ $curkey);
		$num = ($num + 1) % 256;
	}
	return $out;
}
?>