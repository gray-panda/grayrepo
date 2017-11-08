<?php
$fibonacci = genFibonnaciNumbers(0x40); // Does not matter if it overflows, continue using the values
//printFibonacci($fibonacci);
//die();

$targets = array();
$targets[] = "1a6d";
$targets[] = "6197ecb";
$targets[] = "9de8d6d";
$targets[] = "bdd96882";
$targets[] = "148add";
$targets[] = "9de8d6d";
$targets[] = "bdd96882";
$targets[] = "148add";
$targets[] = "29cea5dd";
$targets[] = "35c7e2";
$targets[] = "5704e7";
$targets[] = "15a419a2";
$targets[] = "6d73e55f";
$targets[] = "35c7e2";
$targets[] = "8cccc9";
$targets[] = "8cccc9";
$targets[] = "9de8d6d";


$out = "";
for ($i=0; $i<count($targets); $i++){
	$cur = $targets[$i];
	$fibnum = getFibonnaciSequenceID($fibonacci, $cur);
	if ($fibnum === false){
		echo "GOT ERROR!!! ".dechex($cur)." \n";
		die();
	}
	$out .= chr($fibnum + 0x40);
}
echo $out."\n";

function genFibonnaciNumbers($n){
	$nums = array();
	$nums[0] = 0;
	$nums[1] = 1;
	for ($i=2; $i<$n; $i++){
		$nums[$i] = ($nums[$i-1] + $nums[$i-2]) & 0xffffffff;
	}
	return $nums;
}

function getFibonnaciSequenceID($fib, $target){
	for ($i=0; $i<count($fib); $i++){
		//if ($target == ($fib[$i] & 0xffffffff)){ // ignore the overflow
		if (strcmp($target,dechex($fib[$i])) == 0){
			return $i;
		}
	}
	return false;
}

function printFibonacci($fib){
	for ($i=0; $i<count($fib); $i++){
		echo "$i: ".dechex($fib[$i])."\n";
	}
}
?>