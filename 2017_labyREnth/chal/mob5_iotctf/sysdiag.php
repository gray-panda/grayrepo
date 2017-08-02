<?php
$token = base64_decode("b3dxYnF9dmdmSGdhZzNMZg=");
$key = "\x16\x12\x02\x4e\x1d\x12\x04\x03";

$first8 = substr($token,0,8);
$out = "";
for ($i=0; $i<strlen($first8); $i++){
	$tmp = ord($first8[$i]) ^ ord($key[$i]);
	$out .= chr($tmp);
}
$out .= "uanw8u96";
echo $out."\n";
?>