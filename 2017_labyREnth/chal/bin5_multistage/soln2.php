<?php
/*
Extract Key using StegSolve (DataExtractor) (Easy way)
	- Bit 0 of RGB
	
$target = "d2fea7286d3754f84eb55da4d030d72a4de9ee079a526087619227c2b62aa86f";
echo "Target: $target\n";
$testmsg = "aaaabbbb";
echo hash("sha256",$testmsg)."\n";
$test2 = "Did you think that I have used JPEG to store this flag?";
echo hash("sha256",$test2)."\n";
*/
$imgfile = "level2.png";
$size = getimagesize($imgfile);
$width = $size[0];
$height = $size[1];
$img = imagecreatefrompng($imgfile);

$out = "";
for ($y=0; $y<$height; $y++){
	for ($x=0; $x<$width; $x++){
		$cur = dechex(imagecolorat($img,$x,$y));
		while (strlen($cur) < 6) $cur = '0'.$cur;
		$r = hexdec(substr($cur,0,2));
		$g = hexdec(substr($cur,2,2));
		$b = hexdec(substr($cur,4,2));
		if ($r % 2 == 0) $out .= '0';
		else $out .= '1';
		if ($g % 2 == 0) $out .= '0';
		else $out .= '1';
		if ($b % 2 == 0) $out .= '0';
		else $out .= '1';
	}
}

//echo $out."\n";
$key = "";
for ($i=0; $i<strlen($out); $i+=8){
	$cur = bindec(substr($out,$i,8));
	$key .= chr($cur);
}
echo substr($key,0,80)."\n"; // the key is in the first few bytes
?>