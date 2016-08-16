<?php
/*
Key is a 7 character string
[0] = email[4]
[1-6] = pw[0-5]
where pw must satisfy
pw[0] ^ pw[5] == 0x15
pw[1] ^ (pw[1] & 0xf) == 0x60
(pw[2]-5) ^ 3 == 0x73		==>	pw[2] = 0x75 (u)
pw[3] * 0x22 = 0xdf2		==>	pw[3] = 0x69 (i)
pw[4] == 0x64				==> pw[4] = 0x64 (d)

Have to brute force 4 chars to meet the above conditions	
*/

for ($pw0=0x20; $pw0<0x7f; $pw0++){
	for ($pw5=0x20; $pw5<0x7f; $pw5++){
		if (($pw0 ^ $pw5) != 0x15) continue;
		for ($pw1=0x20; $pw1<0x7f; $pw1++){
			if (($pw1 ^ ($pw1 & 0xf)) != 0x60) continue;
			for ($email4=0x20; $email4<0x7f; $email4++){
				$key = chr($email4).chr($pw0).chr($pw1)."uid".chr($pw5);
				$res = decrypt($key);
				if (strpos($res, "PAN") !== false){
					echo "FOUND! $res ($key) \n";
				}
			}
		}
	}
}

function decrypt($key){
	$enc = array(453, 431, 409, 342, 318, 293, 460, 273, 383, 369, 374, 466, 261, 380, 513, 267, 301, 266, 310, 437, 260, 325, 379, 333, 454, 350, 345, 460, 293, 303, 289, 290, 438, 373, 264, 309, 351);
	$out = "";
	for ($i=0; $i<count($enc); $i++){
		$cur = $enc[$i] - 2;
		$k = ord($key[$i % strlen($key)]);
		$k += (0x56-0x13);

		$cur = $cur ^ $k;
		$cur = logicalShiftRight($cur,2);
		if ($cur > 255) return false;
		$out .= chr($cur);
	}
	return $out;
}

function logicalShiftRight($val,$shift) {
    if ($val >= 0) { 
        return bindec(decbin($val>>$shift)); //simply right shift for positive number
    }

    $bin = decbin($val>>$shift);
    $bin = substr($bin, $shift); // zero fill on the left side
    return bindec($bin);
}

// flag is PAN{da_cups_is_halfEmpty_||_halfFull}
?>