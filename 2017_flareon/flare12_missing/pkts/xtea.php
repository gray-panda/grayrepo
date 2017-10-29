<?php
function xteaDecrypt($chunk, $k){
	$x = $chunk[0];
	$y = $chunk[1];
	$delta = 0x9e3779b9;
	$sum = 0xc6ef3720;
	for ($i=0; $i<32; $i++){
		$tmpy = add(leftshift($x,4) ^ rightshift($x,5), $x) ^ add($sum, $k[rightshift($sum,11) & 3]);
		$y = sub($y,$tmpy);
		$sum = sub($sum,$delta);
		$tmpx = add(leftshift($y,4) ^ rightshift($y,5), $y) ^ add($sum, $k[$sum & 3]);
		$x = sub($x,$tmpx);
		
		//echo "$i: X = ".dechex($x)." Y = ".dechex($y)." Sum = ".dechex($sum)."\n";
	}
	return array($x,$y);
}

//32-bit arithmetic
function leftshift($num, $places){
	return ($num << $places) & 0xffffffff;
}

function rightshift($num, $places){
	return logical_right_shift($num, $places) & 0xffffffff;
}

function add($num1, $num2){
	return ($num1 + $num2) & 0xffffffff;
}

function sub($num1, $num2){
	return ($num1 - $num2) & 0xffffffff;
}

function logical_right_shift($int, $shft){
	return ($int >> $shft) & ( PHP_INT_MAX >> ($shft - 1));
}
?>