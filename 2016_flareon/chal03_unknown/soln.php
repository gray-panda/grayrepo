<?php
/*
Rename binary to extraspecial.exe before debugging :)
- filename will affect some kind of IV, which will affect the below stuffs
- filename guessed from IDA asking for extraspecial.pdb

Hashed stuff (extraspecial.exe)
004181C0  2F 3E 61 EE 45 EB 79 DE 3D 2F 1B AF D7 BB 47 87  />aîEëyÞ=/.¯×»G.  
004181D0  9C C4 9A 73 AE F5 A4 C9 C1 C5 32 46 24 9B 02 A0  .Ä.s®õ¤ÉÁÅ2F$..   
004181E0  59 50 16 D6 51 94 B7 A6 BA 23 9D E7 CE 92 AE 8A  YP.ÖQ.·¦º#.çÎ.®.  
004181F0  18 1A 99 85 99 58 E0 FE 94 79 0C 43 6F F3 B9 1A  .....Xàþ.y.Coó¹.  
00418200  81 24 C4 70 CF 27 BD 05 6F 6E FF C4 7C 84 77 5A  .$ÄpÏ'½.onÿÄ|.wZ  
00418210  B3 77 92 DD FF 3C 84 25 44 A9 DC 5F 96 28 E4 8E  ³w.Ýÿ<.%D©Ü_.(ä.  
00418220  C7 61 E9 2A DA 31 77 A7 00 00 00 00 00 00 00 00  Çaé*Ú1w§........  
*/

$flag = "";
$tmp = brute('`FLARE On!', intval(0xee613e2f)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('aFLARE On!', intval(0xde79eb45)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('bFLARE On!', intval(0xaf1b2f3d)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('cFLARE On!', intval(0x8747bbd7)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('dFLARE On!', intval(0x739ac49c)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('eFLARE On!', intval(0xc9a4f5ae)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('fFLARE On!', intval(0x4632c5c1)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('gFLARE On!', intval(0xa0029b24)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('hFLARE On!', intval(0xd6165059)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('iFLARE On!', intval(0xa6b79451)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('jFLARE On!', intval(0xe79d23ba)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('kFLARE On!', intval(0x8aae92ce)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('lFLARE On!', intval(0x85991a18)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('mFLARE On!', intval(0xfee05899)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('nFLARE On!', intval(0x430c7994)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('oFLARE On!', intval(0x1ab9f36f)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('pFLARE On!', intval(0x70c42481)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('qFLARE On!', intval(0x05bd27cf)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('rFLARE On!', intval(0xc4ff6e6f)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('sFLARE On!', intval(0x5a77847c)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('tFLARE On!', intval(0xdd9277b3)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('uFLARE On!', intval(0x25843cff)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('vFLARE On!', intval(0x5fdca944)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('wFLARE On!', intval(0x8ee42896)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('xFLARE On!', intval(0x2ae961c7)); if ($tmp !== false) $flag .= $tmp;
$tmp = brute('yFLARE On!', intval(0xa77731da)); if ($tmp !== false) $flag .= $tmp;

echo "Flag : $flag \n";
// flag is Ohs0pec1alpwd@flare-on.com

function brute($str, $target){
	$res = 0;
	
	for ($i=0x20; $i<=0x7f; $i++){
		$input = chr($i).$str;
		$tmp = hashString($input);
		if (strcmp($tmp, $target) == 0){
			$res = chr($i);
			break;
		}
	}
	
	if ($res !== 0) return $res;
	else {
		echo "FAIL ".dechex($target)."\n";
		return false;
	}
}

function hashString($data){
	$res = 0;
	for ($i=0; $i<strlen($data); $i++){
		$cur = ord($data[$i]);
		
		$res = ($res * 0x25) & 0xffffffff;
		$res = ($res + $cur) & 0xffffffff;
	}
	
	return $res;
}

//echo encodeString("abcd")."\n"; // 0x004d1382
//echo encodeString('eon\\03\\unknown')."\n"; // 0x5e4a3af5
//echo encodeString("abcdefghijklmnopqrstuvwxyz")."\n"; // 0x9d1ddd53
?>