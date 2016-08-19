<?php

echo deobfus("210014050d1c41190c03040a1a0a054a", "ioak")."\n";
echo deobfus("3f1c2533460815352d0e1f543925134b4e3c", "kt@Jf")."\n";
echo deobfus("670d190a04670d190a", "%lka$")."\n";
echo deobfus("43290843414c2b0e1209", "a")."\n";
echo deobfus("7028467e4d4e512e472d05445723422e404505", "$@#^%!")."\n";
echo deobfus("0a2a367533317f0c0a0d73312c7224207f07001820316326372d71", "SECRET_key")."\n";
echo deobfus("2b040c54181a03081f4b125e01171e0e11050611151d1f461e0a085d4c01050b1d1f095802154a1517060445041b0401", "xka1lrjf")."\n";
echo hex2bin("7028467e4d4e512e472d05445723422e404505")."\n";
echo "\n";

$i = "B";
echo "i[0] = B \n";
// Getting i[1-3] with result "DIE"
$key = hex2bin("052d15");
$deob = deobfus(bin2hex("DIE"), $key);
echo "i[1-3] = $deob \n";
$i .= $deob;

$tmp = "OGIJSLKJECEWOI123512312!@#!@$!@#!faosidfjoijoarisfASDJFOJASJDFOAJSf234242zv,noijwasfuzzlfasufohfsaf";
$tt = substr($tmp,84,4);
echo "i[4-7] = $tt \n";
$i .= $tt;
echo "i[9] = $tmp[46] and i[8] = $tmp[16] \n"; 
$i .= $tmp[16]. $tmp[46];
echo "i[10] = $tmp[23] \n";
$i .= $tmp[23];
$i11 = '?';
echo "i[11] = $i11 \n";
$i .= $i11;
echo "i = $i \n";

function deobfus($hexstr, $key){
	$unhex = "";
	for ($i=0; $i<strlen($hexstr); $i+=2){
		$cur = substr($hexstr,$i,2);
		$unhex .= chr(hexdec($cur));
	}
	
	$out = "";
	for ($i=0; $i<strlen($unhex); $i++){
		$out .= chr(ord($unhex[$i]) ^ ord($key[$i % strlen($key)]));
	}
	return $out;
}


?>