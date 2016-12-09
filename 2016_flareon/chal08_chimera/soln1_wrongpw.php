<?php
echo decode("0E13110C5E14035D060B1551F90507070D4BF80EFDF2F7FCF007")."\n";

function decode($encstr){
	$enc = hex2bin($encstr);
	$sum = 0;
	$out = "";
	for ($i=0; $i<strlen($enc); $i++){
		$tmp = ord($enc[$i]) ^ 0x7a;
		$tmp = $tmp - $i;
		$sum += $tmp;
		$out .= chr($tmp);
	}
	
	//echo $out."\n";
	//$sum = dechex($sum);
	//echo "Sum : 0x".$sum." \n\n";

	//echo bin2hex($out)."\n";
	return $out;
}
?>