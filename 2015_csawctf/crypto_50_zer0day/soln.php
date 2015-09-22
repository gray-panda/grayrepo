<?php
$data = file_get_contents("eps1.9_zer0-day_b7604a922c8feef666a957933751a074.avi");

$parts = explode('\n', $data);
for ($i=0; $i<count($parts); $i++){
	$cur = $parts[$i];
	echo base64_decode($cur)."\n";
}
?>