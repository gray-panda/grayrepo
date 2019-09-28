<?php

$dict = array();
$charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
for ($i=0; $i<64; $i++){
    $dict[($i*4) >> 2] = $charset[$i];
}

$enc = hex2bin("7070B2AC01D25E610AA72AA8081C861AE845C829B2F3A11E00");
$binstr = "";
for ($i = 0; $i < strlen($enc); $i++){
    $tmp = decbin(ord($enc[$i]));
    while (strlen($tmp) < 8){
        $tmp = '0'.$tmp;
    }
    $binstr .= $tmp;
}
echo $binstr."\n";

$key_parts = str_split($binstr, 6);
$key = "";
for ($i=0; $i<32; $i++){
    $cur = $key_parts[$i];
    echo $cur."\n";
    $cur = bindec($cur);
    $key .= $dict[$cur];
}
echo $key."\n";

echo base64_encode($enc)."\n\n"
?>