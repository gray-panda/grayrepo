<?php
$crypt = file_get_contents("eps1.7_wh1ter0se_2b007cf0ba9881d954e85eb475d0d5e4.m4v");
$crypt = trim($crypt);
echo $crypt."\n\n";

/*
$dictionary = array();
$dictionary['A'] = 'A';
$dictionary['B'] = 'B';
$dictionary['C'] = 'C';
$dictionary['D'] = 'D';
$dictionary['E'] = 'E';
$dictionary['F'] = 'F';
$dictionary['G'] = 'G';
$dictionary['H'] = 'e';
$dictionary['I'] = 'I';
$dictionary['J'] = 'J';
$dictionary['K'] = 'K';
$dictionary['L'] = 'L';
$dictionary['M'] = 'a';
$dictionary['N'] = 'N';
$dictionary['O'] = 'O';
$dictionary['P'] = 'P';
$dictionary['Q'] = 'Q';
$dictionary['R'] = 'R';
$dictionary['S'] = 'S';
$dictionary['T'] = 'T';
$dictionary['U'] = 'U';
$dictionary['V'] = 'V';
$dictionary['W'] = 'W';
$dictionary['X'] = 'X';
$dictionary['Y'] = 't';
$dictionary['Z'] = 'Z';
*/

$dictionary = array();
$dictionary['A'] = 'i';
$dictionary['B'] = 'B';
$dictionary['C'] = 'f';
$dictionary['D'] = 'D';
$dictionary['E'] = 'b';
$dictionary['F'] = 'o';
$dictionary['G'] = 'G';
$dictionary['H'] = 'e';
$dictionary['I'] = 'l';
$dictionary['J'] = 'v';
$dictionary['K'] = 'h';
$dictionary['L'] = 'L';
$dictionary['M'] = 'a';
$dictionary['N'] = 'r';
$dictionary['O'] = 'u';
$dictionary['P'] = 'd';
$dictionary['Q'] = 'k';
$dictionary['R'] = 'R';
$dictionary['S'] = 'S';
$dictionary['T'] = 'c';
$dictionary['U'] = 's';
$dictionary['V'] = 'w';
$dictionary['W'] = 'm';
$dictionary['X'] = 'n';
$dictionary['Y'] = 't';
$dictionary['Z'] = 'g';

$count = array();
for ($i=ord('A'); $i<=ord('Z'); $i++){
	$count[chr($i)] = 0;
}


$out = '';
for ($i=0; $i<strlen($crypt); $i++){
	$cur = ord($crypt[$i]);
	if ($cur == ord(" ") || $cur == ord(".") || $cur == ord("'") || $cur == ord(',')){
		$out .= chr($cur);
		continue;
	}
	$cur = chr($cur);
	$out .= $dictionary[$cur];
	$count[$cur]++;
}
echo $out . "\n";

foreach ($count as $letter=>$freq){
	echo "$letter : $freq \n";
}
?>