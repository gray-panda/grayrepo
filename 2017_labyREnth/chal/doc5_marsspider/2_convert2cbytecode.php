<?php
$code = file_get_contents('rawx86');

$out = "";
for ($i=0; $i<strlen($code); $i++){
	$cur = dechex(ord($code[$i]));
	//echo $cur;
	if (strlen($cur) < 2) $cur = '0'.$cur;
	$out .= "\\x".$cur;
}
echo $out;
?>