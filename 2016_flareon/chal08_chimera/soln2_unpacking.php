<?php
$data = file_get_contents('CHIMERA.wtf');

for ($i=0x70; $i>0; $i--){
	$tmp = $i - 1;
	$tmp = $tmp+$tmp;
	
	//$index = $tmp + 0x7d4;
	//$index = $tmp + 0x816;
	$index = $tmp + 0x814;
	addToData($index, $i);
}

function addToData($index, $addval){
	global $data;
	
	$cur = substr($data, $index, 2);
	$cur = strrev($cur); // change order due to endianess
	$tmpval =  (hexdec(bin2hex($cur)) + $addval) & 0xffff;
	$newhex = dechex($tmpval);
	while (strlen($newhex) < 4) $newhex = '0'.$newhex;
	//var_dump($newhex);
	$tmpval = hex2bin($newhex);
	$tmpval = strrev($tmpval); // reverse back for endianess
	
	$data[$index] = $tmpval[0];
	$data[$index+1] = $tmpval[1];
}

file_put_contents('unpacked.wtf', $data);
?>