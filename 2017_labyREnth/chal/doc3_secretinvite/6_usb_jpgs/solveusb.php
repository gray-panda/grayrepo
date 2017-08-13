<?php
$data = file_get_contents("280.jpg");
$out = "";
for ($i=0; $i<strlen($data); $i++){
	$cur = ord($data[$i]);
	$out .= chr($cur ^ 0x21);
}
file_put_contents('280_dec.jpg',$out);
?>