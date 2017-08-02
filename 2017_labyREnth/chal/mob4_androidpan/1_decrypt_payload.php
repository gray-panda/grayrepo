<?php
$key = strrev("%&wNaPOtLa0lAP0G");

$data = file_get_contents('payload.bin');

$methods = openssl_get_cipher_methods();
for($i=0; $i<count($methods); $i++){
	// echo $methods[$i]."\n";
	// $plain = openssl_decrypt($data, $methods[i], $key, OPENSSL_RAW_DATA);
	// echo $plain."\n";
}
$plain = openssl_decrypt($data, "aes-128-ecb", $key, OPENSSL_RAW_DATA);
file_put_contents('payload.zip',$plain);
?>