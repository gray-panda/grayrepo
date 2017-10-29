<?php
$dir = "out_forward/";
$files = scandir($dir);
$data = "";
$count = 0;
$incomplete = false;
foreach ($files as $file){
	if (strcmp($file, '.') === 0) continue;
	if (strcmp($file, '..') === 0) continue;
	
	$count++;
	$fullpath = $dir.$file;
	$tmp = file_get_contents($fullpath);
	$data .= $tmp;
}

$out = "";
$bytecount = 0;
while (strlen($data) > 0){
	$magic = substr($data,0,4);
	if (strcmp($magic,"2017") !== 0){
			echo "ERROR: Magic $magic (0x".dechex($bytecount).")\n";
			die();
	}
	
	$headerlen = unpack('V',substr($data,8,4))[1];
	$framelen = unpack('V',substr($data,12,4))[1];
	$totallen = $headerlen + $framelen;
	
	$out .= substr($data, 0, $totallen);
	$data = substr($data,$totallen);
	$bytecount += $totallen;
	
	$nextpos = strpos($data, "2017");
	$data = substr($data,$nextpos);
	$bytecount += $nextpos;
}

file_put_contents("forwardedpkts", $out);
?>