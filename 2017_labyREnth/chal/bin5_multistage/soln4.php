<?php
// Implementing the FNV1a Fowler Hash Algorithm
// http://www.isthe.com/chongo/tech/comp/fnv/index.html

$validchars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
$dictionary = array();
for ($i=0; $i<strlen($validchars); $i++){
	$curhash = fnv1a(64,$validchars[$i]);
	$dictionary[$curhash] = $validchars[$i];
}

$targets = array();
$targets[] = "af64084c86023750";
$targets[] = "af63f84c86021c20";
$targets[] = "af63fb4c86022139";
$targets[] = "af64024c86022d1e";
$targets[] = "af640f4c86024335";
$targets[] = "af63f84c86021c20";
$targets[] = "af63f84c86021c20";
$targets[] = "af63da4c8601e926";
$targets[] = "af64084c86023750";
$targets[] = "af63f84c86021c20";
$targets[] = "af63fb4c86022139";
$targets[] = "af64024c86022d1e";
$targets[] = "af640f4c86024335";
$targets[] = "af63f84c86021c20";
$targets[] = "af63f84c86021c20";
$targets[] = "af63da4c8601e926";
$targets[] = "af64084c86023750";
$targets[] = "af63f84c86021c20";
$targets[] = "af63fb4c86022139";
$targets[] = "af64024c86022d1e";
$targets[] = "af640f4c86024335";
$targets[] = "af63f84c86021c20";
$targets[] = "af63f84c86021c20";
$targets[] = "af63e54c8601fbd7";
$targets[] = "af64044c86023084";
$targets[] = "af63f84c86021c20";
$targets[] = "af64074c8602359d";
$targets[] = "af63fc4c860222ec";
$targets[] = "af64084c86023750";
$targets[] = "af63ad4c86019caf";
$targets[] = "af64084c86023750";
$targets[] = "af63af4c8601a015";
$targets[] = "af63fe4c86022652";
$targets[] = "af64034c86022ed1";
$targets[] = "af63fc4c860222ec";
$targets[] = "af640c4c86023e1c";
$targets[] = "af640c4c86023e1c";
$targets[] = "af64084c86023750";
$targets[] = "af63a84c86019430";
$targets[] = "af63f84c86021c20";
$targets[] = "af640c4c86023e1c";
$targets[] = "af640e4c86024182";
$targets[] = "af63fc4c860222ec";
$targets[] = "af63fa4c86021f86";
$targets[] = "af64094c86023903";
$targets[] = "af63e14c8601f50b"; 
$targets[] = "af64144c86024bb4";
$targets[] = "af63af4c8601a015";
$targets[] = "af63fe4c86022652";
$targets[] = "af64034c86022ed1";
$targets[] = "af63fc4c860222ec";
$targets[] = "af640c4c86023e1c";
$targets[] = "af640c4c86023e1c";
$targets[] = "af64084c86023750";
$targets[] = "af63a84c86019430";
$targets[] = "af63f84c86021c20";
$targets[] = "af640c4c86023e1c";
$targets[] = "af640e4c86024182";
$targets[] = "af63fc4c860222ec";
$targets[] = "af64144c86024bb4";
$targets[] = "af64094c86023903";
$targets[] = "af63ac4c86019afc";
$targets[] = "af64044c86023084";
$targets[] = "af63da4c8601e926";
$targets[] = "af64084c86023750";
$targets[] = "af63f84c86021c20";
$targets[] = "af63fb4c86022139";
$targets[] = "af64024c86022d1e";
$targets[] = "af640f4c86024335";
$targets[] = "af63f84c86021c20";
$targets[] = "af63f84c86021c20";
$targets[] = "af63b04c8601a1c8";

$b64enc = "";
for ($i=0; $i<count($targets); $i++){
	$target = $targets[$i];
	$b64enc .= $dictionary[$target];
}
echo $b64enc."\n";
echo custom_base64_decode($b64enc)."\n";

function fnv1a($bitsize, $msg){
	$offsetbasis = 0;
	$fnvprime = 0;
	if ($bitsize == 64){
		$offsetbasis = bchexdec("cbf29ce484222325"); // 14695981039346656037
		$fnvprime = bchexdec("100000001b3"); // 1099511628211
	}
	else{
		echo "Bitsize unsupported\n";
		return false;
	}
	
	$hash = $offsetbasis;
	for ($i=0; $i<strlen($msg); $i++){
		$cur = ord($msg[$i]).'';
		//echo bcdechex($hash)."\n";
		$hash = bcxor($hash,$cur);
		//echo bcdechex($hash)."\n";
		$hash = bcmul($hash,$fnvprime);
		//echo bcdechex($hash)."\n";
		$hash = bcand($hash, bchexdec("ffffffffffffffff"));
		//echo bcdechex($hash)."\n";
	}
	return bcdechex($hash);
}

function custom_base64_decode($msg){
	$default = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	$custom = "PANDEFGHIJKLMCOBQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	$tmp = strtr($msg,$custom,$default);
	return base64_decode($tmp);
}

function bchexdec($hex) {
	if(strlen($hex) == 1) {
		return hexdec($hex);
	} else {
		$remain = substr($hex, 0, -1);
		$last = substr($hex, -1);
		return bcadd(bcmul(16, bchexdec($remain)), hexdec($last));
	}
}

function bcdechex($dec) {
	$last = bcmod($dec, 16);
	$remain = bcdiv(bcsub($dec, $last), 16);

	if($remain == 0) {
		return dechex($last);
	} else {
		return bcdechex($remain).dechex($last);
	}
}

// From http://www.recfor.net/jeans/?itemid=813
function bcand($a,$b){
	return _bc($a,$b,'&');
}
function bcor($a,$b){
	return _bc($a,$b,'|');
}
function bcxor($a,$b){
	return _bc($a,$b,'^');
}
function _bc($a,$b,$mode){
	$a=(string)$a;
	$b=(string)$b;
	$res='0';
	$op='1';
	while($a!='0' || $b!='0'){
		$aa=(int)bcmod($a,'65536');
		$a=bcsub($a,$aa);
		$a=bcdiv($a,'65536');
		$bb=(int)bcmod($b,'65536');
		$b=bcsub($b,$bb);
		$b=bcdiv($b,'65536');
		switch($mode){
			case '&':
				$temp=$aa & $bb;
				break;
			case '|':
				$temp=$aa | $bb;
				break;
			case '^':
				$temp=$aa ^ $bb;
				break;
			default:
				exit(__FILE__.__LINE__);
		}
		$temp=bcmul((string)$temp,$op);
		$res=bcadd($res,$temp);
		$op=bcmul($op,'65536');
	}
	return $res;
}
?>