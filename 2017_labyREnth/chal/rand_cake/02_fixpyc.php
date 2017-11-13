<?php
$header = hex2bin("03f30d0a");
$timestamp = hex2bin("00000000");
$fn = $argv[1];
$data = file_get_contents($fn);
$data = $header.$timestamp.$data;
file_put_contents($fn.'.pyc', $data);
?>