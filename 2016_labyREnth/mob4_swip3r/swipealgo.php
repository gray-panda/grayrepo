<?php
$a = 0;
$b = 0;
$c = 0;
$d = 0;
$e = 0;
$f = 0;
$g = 0;
$h = 0;
$i = 0;
$j = 0;
$k = 0;
$l = 0;
$m = 0;
$n = false;

swipeUp();
swipeLeft();
swipeDown();
swipeRight();
swipeUp();

// flag is PAN{jAr3d_sayz_'swwip3r_!NO!_swipp11nn'}

function swipeUp(){
	global $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n;

	if (($a == 0) && ($n == false)){
		$a = 1;
		$c = 0;
		$g = 4;
		$h = 0;
		$n = true;
		$d = 9;
	}

	if ($n == false){
		$a = 0xc; // 12
		$i = 0xd; // 13
		$f = 0x2e; // 46
		$e = 0x37; // 55
		$d = 5;
		$msg = well($h, $j, $b, $f, $l, $i, $e, $k);
		setText($msg);
	}

	if (($j == 0xf001) && ($b == ($l + 0xc))){
		if ($k == 0xb115){
			$l = 8;
			$b -= 18;
		}
		$msg = well($h, $j, $b, $f, $l, $i, $e, $k);
		setText($msg);
	}
	return true;
}

function swipeDown(){
	global $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n;

	if (($c == 1) && ($a == 2)){
		if ($d == 4){
			$c = 2;
			$a = 3;
			$f = 0xf411;
			$h = 0x38;
			$i = $h - 0x28;
			return true;
		}
		else return true;
	}

	if ($d == 9){
		$a = 10;
		$n = false;
		$a = 0x33;
		$m += 1;
		fail($m);
		return true;
	}

	$c = 0;
	$a = 0;
	$m += 1;
	fail($m);
	return true;
}

function swipeLeft(){
	global $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n;

	if (($a == 1) && ($n == true)){
		if (($g == 4) && ($h == 0)){
			$c = 1;
			$a = 2;
			$l = 7;
			$d = 4;
			return true;
		}
		else return true;
	}
	//cond_8
	$c = 0;
	$a = 0;
	$m += 1;
	fail($m);
	return true;
}

function swipeRight(){
	global $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n;

	if (($c == 2) && ($a == 3)){
		if ($f == 0xf411){
			$j = 0xf001;
			$k = 0xb115;
			$msg = decode($k);
			setText($msg);

			$h = 0x14d;
			$e = $h + 1;
			$b = 0x13;
			return true;
		}
		else return true;
	}
	else {
		// cond_a
		if (($a == 0x33) || ($l == 7)){
			// cond_b
			$f = 0x2d;
			$h = 0xde;
			$k = 0xbabe;
			$msg = well($h, $j, $b, $f, $l, $i, $e, $k);
			setText($msg);
			return true;
		}
		// cond_c
		$c = 0;
		$a = 0;
		$f = 9;
		$m += 1;
		fail($m);
		return true;
	}
}

function swipeNoWhere(){
	global $m;

	$m += 1;
	fail($m);
	return true;
}

function decode($num){
	$enc = array(0xb17e,0xb124,0xb17b,0xb172,0xb14a,0xb125,0xb173,0xb151,0xb174,0xb14a,0xb172,0xb125,0xb177,0xb179,0xb17c,0xb17b,0xb166,0xb13b,0xb13b,0xb13b,0xb17e,0xb17c,0xb17b,0xb171,0xb174);
	$out = "";
	for ($i=0; $i<count($enc); $i++){
		$tmp = $enc[$i] ^ $num;
		$out .= chr($tmp);
	}
	return $out;
}

function well($a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8){
 echo "Welling...Try it on a real device/emulator \n";
}

function setText($msg){
	echo "Setting Text: $msg \n";
}

function fail($counter){
 echo "FAIL $counter \n";
}
?>