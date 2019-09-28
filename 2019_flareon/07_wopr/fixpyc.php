<?php
//$header = hex2bin("03f30d0a00000000");
$header = hex2bin("420d0d0a000000000000000000000000"); // Python 3 pyc?
// $timestamp = hex2bin("00000000");
$fn = $argv[1];
$data = file_get_contents($fn);
//$data = $header.$timestamp.$data;
$data = $header.$data;
file_put_contents($fn.'.pyc', $data);
?>