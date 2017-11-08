<?php
$out = "Laby"; // figured out from 1.bin
echo $out."\n";

// figuring out 2.bin
function rightShiftXor($val){
	$tmp = $val >> 1;
	$tmp = $tmp ^ $val;
	return $tmp;
}

$rightshiftxor_Dictionary = array();
for ($i=0x20; $i<128; $i++){
	$tmpval = rightShiftXor($i);
	$rightshiftxor_Dictionary[$tmpval] = $i;
}

$targets = array();
$targets[] = 0x4a;
$targets[] = 0x5c;
$targets[] = 0x57;
$targets[] = 0x5a;
$targets[] = 0x5a;

for ($i=0; $i<count($targets); $i++){
	$cur = $targets[$i];
	$out .= chr($rightshiftxor_Dictionary[$cur]);
}
echo $out."\n";

// figuring out 3.bin (4chars)
function xorAndMultiply($val){
	$tmp = $val.'';
	$tmp = bcxor($tmp, bchexdec("811c9dc5"));
	$tmp = bcmul($tmp, bchexdec("1000193"));
	$tmp = bcand($tmp, bchexdec("ffffffff"));
	return $tmp;
}

$xorMultiply_dictionary = array();
for ($i=0x20; $i<128; $i++){
	$tmpval = bcdechex(xorAndMultiply($i));
	$xorMultiply_dictionary[$tmpval] = $i;
}

$targets = array();
$targets[] = "e60c2c52";
$targets[] = "ea0c329e";
$targets[] = "e10c2473";
$targets[] = "e00c22e0";
for ($i=0; $i<count($targets); $i++){
	$cur = $targets[$i];
	$out .= chr($xorMultiply_dictionary[$cur]);
}
echo $out."\n";

// figuring out 3.bin (5th char)
function oddXor($val){
	$xored = 0xffffffff ^ $val;
	for ($i=0; $i<8; $i++){
		//echo "$i: ".dechex($xored)."\n";
		$tmp = $xored;
		$xored = logical_right_shift($xored,1);
		//echo "\tShift Right: ".dechex($xored)."\n";
		$tmp = $tmp & 1;
		//echo "\tAnd: ".dechex($tmp)."\n";
		$tmp = (0 - $tmp) & 0xffffffff;
		//echo "\tNegate: ".dechex($tmp)."\n"; 
		$tmp = $tmp & 0xedb88320;
		//echo "\tAndVal: ".dechex($tmp)."\n";
		$xored = $tmp ^ $xored;
	}
	
	$xored = $xored ^ 0x4c11db7;
	//echo "Final Xor: ".dechex($xored)."\n";
	$xored = (~$xored) & 0xffffffff;
	//echo "Final Not: ".dechex($xored)."\n";
	return $xored;
}

$oddxor_dictionary = array();
for ($i=0x20; $i<128; $i++){
	$tmpval = dechex(oddXor($i));
	$oddxor_dictionary[$tmpval] = $i;
}

$target = "eac016eb";
$out .= chr($oddxor_dictionary[$target]);
echo $out."\n";

// figuring out 3.bin (6th char) (last char)
// uses same algo as 2.bin
$out .= chr($rightshiftxor_Dictionary[0x29]);
echo "Done: ".$out."\n";

function logical_right_shift( $int , $shft ) {
    return ( $int >> $shft )   //Arithmetic right shift
        & ( PHP_INT_MAX >> ( $shft - 1 ) );   //Deleting unnecessary bits
}

function checkInput_0($val){
	// 0x4c 'L' satisfy
	$tmp = $val ^ 0x59;
	$tmp = $tmp * 3;
	return $tmp == 0x3f;
}

function checkInput_1($val){
	// 0x61 'a' satisfy
	$tmp = $val ^ 0xcb;
	$tmp = $tmp * 6;
	return $tmp == 0x3fc;
}

function checkInput_2($val){
	// 0x62 'b' satisfy
	$tmp = $val ^ 0x44;
	$tmp = $tmp << 2;
	$tmp = $tmp ^ 0x4c;
	return $tmp == 0xd4;
}

function checkInput_3($val){
	// 0x79 'y' satisfy
	$tmp = $val * 8;
	$tmp = $tmp - $val;
	$tmp = $tmp ^ 0x301;
	return $tmp == 0x4e;
}

function bchexdec($hex) {
	if(strlen($hex) == 1) {
		return hexdec($hex);
	} else {
		$remain = substr($hex, 0, -1);
		$last = substr($hex, -1);
		return bcadd(bcmul(16, bchexdec($remain)), hexdec($last));
	}
}

function bcdechex($dec) {
	$last = bcmod($dec, 16);
	$remain = bcdiv(bcsub($dec, $last), 16);

	if($remain == 0) {
		return dechex($last);
	} else {
		return bcdechex($remain).dechex($last);
	}
}

// From http://www.recfor.net/jeans/?itemid=813
function bcand($a,$b){
	return _bc($a,$b,'&');
}
function bcor($a,$b){
	return _bc($a,$b,'|');
}
function bcxor($a,$b){
	return _bc($a,$b,'^');
}
function _bc($a,$b,$mode){
	$a=(string)$a;
	$b=(string)$b;
	$res='0';
	$op='1';
	while($a!='0' || $b!='0'){
		$aa=(int)bcmod($a,'65536');
		$a=bcsub($a,$aa);
		$a=bcdiv($a,'65536');
		$bb=(int)bcmod($b,'65536');
		$b=bcsub($b,$bb);
		$b=bcdiv($b,'65536');
		switch($mode){
			case '&':
				$temp=$aa & $bb;
				break;
			case '|':
				$temp=$aa | $bb;
				break;
			case '^':
				$temp=$aa ^ $bb;
				break;
			default:
				exit(__FILE__.__LINE__);
		}
		$temp=bcmul((string)$temp,$op);
		$res=bcadd($res,$temp);
		$op=bcmul($op,'65536');
	}
	return $res;
}
?>