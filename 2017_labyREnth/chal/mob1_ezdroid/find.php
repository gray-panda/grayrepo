<?php
$maxLong = "9223372036854775807";
$minLong = "-9223372036854775808";
$modbase = bcpow("2","64");
$target = "17206538691";

// |---Max Long---|---Min Long---|---Target-42---|
$overflow = bcsub(bcadd(bcsub($target,$minLong),"1"),"42");
$overflow = bcadd($overflow, $maxLong);
echo "Overflow: $overflow \n";
$end = false;
$i = 0;
//while(true){
for ($i=0; $i<100; $i++){
	$mul = bcmul($modbase, $i.'');
	$val = bcadd($mul, $overflow);
	
	$remainder = bcmod($val, "-37");
	$quotient = bcdiv($val, "-37");
	$qlen = strlen($quotient);
	//echo "$i: Testing $val... ($quotient R $remainder) [$qlen] \n";
	// Check if it is divisable by 37
	if (strcmp($remainder, "0") == 0){
		// Test it
		$quotient = bcdiv($val,"-37");
		$p3 = getP3($quotient);
		$p3len = strlen($quotient);
		echo "\t$i: $p3 ($quotient : $p3len) \n";
	}
}

function getP3($d){
	$pos = array(14,3,14,11,5,4,14,13,19,6,14,13,14,1,14,14,14,1,14,11,5,13);
	$part3 = "";
	for ($i=0; $i<count($pos); $i++){
		$part3 .= $d[$pos[$i]];
	}
	//var_dump($part3);
	$p3 = "";
	for ($i=0; $i<strlen($part3); $i+=2){
		$p3 .= chr(hexdec(substr($part3,$i,2)));
	}
	return $p3;
	//echo "Part 3: $p3 \n";
}
?>