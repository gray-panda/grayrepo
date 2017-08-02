<?php
$key = "Pal0aLtoN3TwOrks";

$data = file_get_contents('payload/assets/checkerx'); // x86 version
$plain = openssl_decrypt($data, "aes-128-ecb", $key, OPENSSL_RAW_DATA);
file_put_contents('libchecker_x86.so',$plain);

$data = file_get_contents('payload/assets/checker'); // arm version
$plain = openssl_decrypt($data, "aes-128-ecb", $key, OPENSSL_RAW_DATA);
file_put_contents('libchecker_arm.so',$plain);
?>