<?php
$data = json_encode($_REQUEST);
file_put_contents("recv.data", $data);

$resp = singleXor("orange mocha frappuccino\x00", 0x4d); // requires the terminating null byte
$resp .= "abcdefghijklmnopqrstuvwwy\x00"; // command can hold 0x19 more bytes

echo base64_encode($resp);

function singleXor($msg, $key){
    $out = "";
    for ($i=0; $i<strlen($msg); $i++){
        $tmp = ord($msg[$i]) ^ $key;
        $out .= chr($tmp);
    }
    return $out;
}

// Command is 0x19 bytes long.... hmmm issit some enc key??
/*
really, really, really, ridiculously good looking gifs
*/
?>
