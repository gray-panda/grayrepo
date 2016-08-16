<?php
$key = array(ord('M'), ord('4'), ord('z'), ord('3'), ord('C'), ord('u'), ord('b'), ord('3'));
$msg1 = array(0x1d, 0x75, 0x34, 0x48, 0x4, 0x46, 0x16, 0x6c);
$msg2 = array(0x1e, 0x57, 0x12, 0x2, 0x25, 0x42, 0x1b, 0x4e);

$out = "";
for ($i=0; $i<8; $i++){
	$tmp = $msg1[$i] ^ $key[$i];
	$out .= chr($tmp);
}
for ($i=0; $i<8; $i++){
	$tmp = $msg2[$i] ^ $key[$i];
	$out .= chr($tmp);
}
echo $out."\n";
?>