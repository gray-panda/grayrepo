<?php
$a = array(20,22,100,23,21,99,100,103,24,24,25,96,25,103,16,21,16,24,22,17,98,103,103,16,23,18,103,24,17,99,96,18);
$b = array(97,93,64,64,75,19,18,107,93,71,18,84,83,91,94,87,86,18,74,98,18,18,102,64,75,18,115,85,83,91,92,19);
$g = array(113,96,111,90,77,21,67,88,83,16,79,22,73,126,82,21,88,91,126,89,17,83,16,82,126,21,76,21,91,16,79,70,92);
$c = 137;
$d = 50;

echo count($a)." ".count($b)." ".count($g)."\n";
echo "sZA is [".szA($a)."]\n";

for ($i=1; $i<256; $i++){
	echo "$i : ".szB($i, $g)."\n";
}
// Found flag 168 : PAN{l4byr1n7h_s4yz_x0r1s_4m4z1ng}


function szA($barray){
	global $b, $d;
	
	$out = array();
	for ($i=0; $i<count($barray); $i++){
		$out[] = $b[$i] ^ $d;
	}
	
	$ret = "";
	for ($i=0; $i<count($out); $i++){
		$ret .= chr($out[$i]);
	}
	
	return $ret;
}

function szB($dummy2, $barray){
	global $c;
	
	$out = array();
	for ($i=0; $i<count($barray); $i++){
		$out[] = $barray[$i] ^ ($c ^ $dummy2);
	}
	
	$ret = "";
	for ($i=0; $i<count($out); $i++){
		$ret .= chr($out[$i]);
	}
	return $ret;
}
?>
