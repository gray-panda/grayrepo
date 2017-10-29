<?php
$maps = array();
$maps[0] = 0x0008087808087800;
$maps[1] = 0x008888f888888800;
$maps[2] = 0x7e8181f10101817e;
$maps[3] = 0xf090909090000000;
$maps[4] = 0x0000f8102040f800;
$maps[5] = 0x0000000905070907;
$maps[6] = 0x7010701070000000;
$maps[7] = 0x0006090808083e00;
$maps[8] = 0x1028444444000000;
$maps[9] = 0x0c1212120c000000;
$maps[10] = 0x0000000000000000;

/*
for ($i=0; $i<count($maps); $i++){
	echo "Map ".($i+1)."\n";
	echo printMap($maps[$i])."\n";
}
die();
*/

$correctorder = array(9, 1, 2, 7, 3, 5, 6, 5, 8, 0, 2, 3, 5, 6, 1, 4);
for ($i=0; $i<count($correctorder); $i++){
	$index = $correctorder[$i];
	echo "Map ".($index+1)."\n";
	echo printMap($maps[$index])."\n";
}

$key = "OHGJURERVFGUREHZ";

//Do Rot13
$out = "";
for ($i=0; $i<strlen($key); $i++){
	$cur = ord($key[$i]) - 13;
	if ($cur < ord('A')) $cur += 26;
	$out .= chr($cur);
}

echo "Key is $out\n";
echo "Enter this key in the program's Coordinate input\n";
//  very nicely done!  here have this key:  y0u__sUnK_mY__P3Wp3w_b04t@flare-on.com

function printMap($map){
	$mapstr = decbin($map);
	while (strlen($mapstr) < 64) $mapstr = '0'.$mapstr;
	$themap = str_split($mapstr,8);
	
	$out = "  1 2 3 4 5 6 7 8\n";
	$row = ord('A');
	for ($i=7; $i>= 0; $i--){
		$line = $themap[$i];
		$line = strrev($line);
		
		$out .= chr($row)." ";
		for ($k=0; $k<strlen($line); $k++){
			$cur = ord($line[$k]);
			if ($cur == ord('1')) $out .= "X ";
			else $out .= "  ";
		}
		$out .= "\n";
		$row++;
	}
	return $out;
}

// breakpoint at *0x403C0D

// FHGuzREJVO
?>