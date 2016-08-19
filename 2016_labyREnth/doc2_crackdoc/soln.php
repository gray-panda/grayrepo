<?php
$encout = "171,184,42,184,88,26,47,154,20,219,203,130,52,19,180,214,156,94,186,74,30,248,119,235,139,130,175,141,179,197,8,204,252";
$key = "General Vidal";

$enc = "";
$parts = explode(",", $encout);
for ($i=0; $i<count($parts); $i++){
	$cur = intval($parts[$i]);
	$enc .= chr($cur);
}
$dec = crypto($enc, $key);
$dec = substr($dec,0,-1);
$plain = '';
$parts = explode(",", $dec);
for ($i=0; $i<count($parts); $i++){
	$cur = intval($parts[$i]);
	$plain .= chr($cur);
}
echo $plain."\n";

// flag is PAN{L4$t_Night_@f@iry_Vizited_M3}

function crypto($msg, $key){
	$s = array();
	$k = array();
	$keylen = strlen($key);

	for ($i=0; $i<256; $i++){
		$s[$i] = $i;
		$k[$i] = ord(substr($key, ($i % $keylen), 1));
	}

	$j = 0;
	for ($i=0; $i<256; $i++){
		$j = ($j + $k[$i] + $s[$i]) % 256;
		$temp = $s[$i]; //swap
        $s[$i] = $s[$j]; 
        $s[$j] = $temp;
	}

	$x = 0;
	$y = 0;
	for ($i=1; $i<=3072; $i++){
		$x = ($x+1) % 256;
		$y = ($y + $s[$x]) % 256;
		$temp = $s[$x];
		$s[$x] = $s[$y];
		$s[$y] = $temp;
	}

	$ret = "";
	for ($i=0; $i<strlen($msg); $i++){
		$x = ($x+1) % 256;
		$y = ($y + $s[$x]) % 256;
		$temp = $s[$x];
		$s[$x] = $s[$y];
		$s[$y] = $temp;

		$ret .= ($s[($s[$x] + $s[$y]) % 256] ^ ord(substr($msg, $i, 1))) . ",";
	}
	return $ret;
}
?>