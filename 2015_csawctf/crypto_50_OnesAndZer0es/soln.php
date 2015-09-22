<?php
$data = file_get_contents("eps1.1_ones-and-zer0es_c4368e65e1883044f3917485ec928173.mpeg");
$data = trim($data);

$numchars = strlen($data) / 8;
$out = "";
for ($i=0; $i<$numchars; $i++){
	$cur = substr($data,0,8);
	$cur = bindec($cur);
	$out .= chr($cur);
	$data = substr($data,8);
}
echo $out."\n";

?>