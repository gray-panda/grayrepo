<?php
// Think will only work on 64-bit PHP

function logical_right_shift( $int , $shft ) {
    return ( $int >> $shft )   //Arithmetic right shift
        & ( PHP_INT_MAX >> ( $shft - 1 ) );   //Deleting unnecessary bits
}

/*
// Test values
$tmp = -0x3e17d5ff;
var_dump($tmp);
echo decbin($tmp)."\n";
$tmp = logical_right_shift($tmp,5);
var_dump($tmp);
echo decbin($tmp)."\n";
$tmp = $tmp & 0xff;
var_dump($tmp);
echo decbin($tmp)."\n";
*/

// Part 1
$part1 = array(); // length 13
$t = -0x3e17d5ff;
$part1[0] = logical_right_shift($t, 5) & 0xff;
$t = -0x6f337c25;
$part1[1] = logical_right_shift($t, 9) & 0xff;
$t = -0x758fd8eb;
$part1[2] = logical_right_shift($t, 7) & 0xff;
$t = -0x6a11e8f5;
$part1[3] = logical_right_shift($t, 0x12) & 0xff;
$t = 0x1437c994;
$part1[4] = logical_right_shift($t, 2) & 0xff;
$t = 0x66dc17a9;
$part1[5] = logical_right_shift($t, 4) & 0xff;
$t = -0x68f40a22;
$part1[6] = logical_right_shift($t, 0xd) & 0xff;
$t = -0x66fa8bb9;
$part1[7] = logical_right_shift($t, 0x16) & 0xff;
$t = -0x28d6c83d;
$part1[8] = logical_right_shift($t, 0x14) & 0xff;
$t = 0x65b7d404;
$part1[9] = logical_right_shift($t, 0xf) & 0xff;
$t = 0x2d28160f;
$part1[10] = logical_right_shift($t, 0x15) & 0xff;
$t = -0x3a66df7e;
$part1[11] = logical_right_shift($t, 0xe) & 0xff;
$t = -0x275a0b1a;
$part1[12] = logical_right_shift($t, 0xc) & 0xff;

$p1 = "";
for ($i=0; $i<count($part1); $i++){
	$p1 .= chr($part1[$i]);
}
echo "Part 1: $p1 \n";

// Part 2
$part2 = "";
$part2 .= '3'; // "two plus one"
$part2 .= '2'; // "one plus one"
$part2 .= '7'; // "five plus two"
$part2 .= '3'; // "three plus zero"
$part2 .= '7'; // "nine minus two"
$part2 .= '4'; // "two plus two"
$part2 .= '6'; // "three plus three"
$part2 .= '1'; // "eleven minus ten"
$part2 .= '7'; // "negative two plus nine"
$part2 .= '2'; // "one plus one"
$part2 .= '7'; // "five plus two"
$part2 .= '4'; // "three plus one"

$p2 = "";
for ($i=0; $i<strlen($part2); $i+=2){
	$p2 .= chr(hexdec(substr($part2,$i,2)));
}
$p2 .= "_";
echo "Part 2: $p2 \n";

// Part 3

/*
$t = "72657031616365746831732121";
$p3 = "";
for ($i=0; $i<strlen($t); $i+=2){
	$p3 .= chr(hexdec(substr($t,$i,2)));	
}
echo $p3."\n"; // rep1aceth1s!!
*/

$maxLong = "9223372036854775807";
$minLong = "-9223372036854775808";
$modbase = bcpow("2","64");
$target = "17206538691";

// |---Max Long---|---Min Long---|---Target-42---|
$overflow = bcsub(bcadd(bcsub($target,$minLong),"1"),"42"); // overflowed amount
$overflow = bcadd($overflow, $maxLong); // add max long -> == multiplication result
//echo "Overflow: $overflow \n";
for ($i=0; $i<37; $i++){
	$mul = bcmul($modbase, $i.'');
	$val = bcadd($mul, $overflow);
	
	$remainder = bcmod($val, "-37");
	$quotient = bcdiv($val, "-37");
	$qlen = strlen($quotient);
	//echo "$i: Testing $val... ($quotient R $remainder) [$qlen] \n";
	// Check if it is divisable by 37
	if (strcmp($remainder, "0") == 0){
		$quotient = bcdiv($val,"-37");
		$p3 = getP3($quotient);
		$p3len = strlen($quotient);
		//echo "\t$i: $p3 ($quotient : $p3len) \n";
	}
}
echo "Part 3: $p3 \n";

$flag = $p1.$p2.$p3."}";
echo "Flag: $flag \n";

function getP3($d){
	$pos = array(14,3,14,11,5,4,14,13,19,6,14,13,14,1,14,14,14,1,14,11,5,13);
	$part3 = "";
	for ($i=0; $i<count($pos); $i++){
		$part3 .= $d[$pos[$i]];
	}
	$p3 = "";
	for ($i=0; $i<strlen($part3); $i+=2){
		$p3 .= chr(hexdec(substr($part3,$i,2)));
	}
	return $p3;
}
?>
