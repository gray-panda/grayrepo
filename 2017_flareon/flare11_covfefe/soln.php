<?php
/*
At offset 3A74
7F 00 00 00 
8A 5E 03 00 
13 DF 02 00 
8E F5 02 00 
9E C8 02 00 
1B 39 03 00 
8D C8 02 00 
9B F5 02 00 
9C 6D 03 00 
16 66 03 00 
A0 40 03 00 
9B D7 02 00 
9E C8 02 00 
0C DF 02 00 
8D 6D 03 00 
0A EE 02 00 
FF 31 03 00 

9C 0E 00 00 
01 00 00 00 
*/

$enc = array();
$enc[0] = 0x35e8a;
$enc[1] = 0x2df13;
$enc[2] = 0x2f58e;
$enc[3] = 0x2c89e;
$enc[4] = 0x3391b;
$enc[5] = 0x2c88d;
$enc[6] = 0x2f59b;
$enc[7] = 0x36d9c;
$enc[8] = 0x36616;
$enc[9] = 0x340a0;
$enc[10] = 0x2d79b;
$enc[11] = 0x2c89e;
$enc[12] = 0x2df0c;
$enc[13] = 0x36d8d;
$enc[14] = 0x2ee0a;
$enc[15] = 0x331ff;

$plain = "";
for ($i=0; $i<count($enc); $i++){
	$plain .= decrypt($enc[$i]);
}
echo $plain."\n";

function decrypt($num){
	$p1 = ($num >> 7)/15;
	$p2 = ~($num) & 0x7f;
	
	return chr($p1).chr($p2);
}
// subleq_and_reductio_ad_absurdum@flare-on.com
?>