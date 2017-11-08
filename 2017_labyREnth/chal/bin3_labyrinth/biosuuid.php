<?php
$target = "_V`J[N)UJKb[NW]Q";
$str = "";
$out = "";
for ($i=0; $i<strlen($target); $i++){
	$cur = ord($target[$i]) - 9;
	$tmphex = dechex($cur);
	if (strlen($tmphex) < 2) $tmphex = '0'.$tmphex;
	$out .= $tmphex;
	if ($i==7) $out .= '-';
	else $out .= ' ';

	$str .= chr($cur);
}
echo $out." ($str) \n"; 

// reference for VMWARE Hypervisor commands https://sites.google.com/site/chitchatvmback/backdoor
?>