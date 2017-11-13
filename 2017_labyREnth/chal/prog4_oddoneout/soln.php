<?php
// Level 1
$count = 1;
$url = "http://oott.panspacedungeon.com:16000/play/new/None";
$json = json_decode(doCurl($url), true);
if (checkFlag($json)) die();
$sessionid = $json['session'];
$challenge = $json['challenge'];
$rendered = $json['rendered'];
$status = $json['status'];
$flag = $json['flag'];
echo $status."\n";
echo $rendered."\n";
$solve = solveSameDifferent($challenge);

// Subsequent Levels
while (empty($flag)){
	echo "Answering Qn $count: $solve\n";
	$count++;
	$url = "http://oott.panspacedungeon.com:16000/play/".$sessionid."/".$solve;
	$json = json_decode(doCurl($url), true);
	$sessionid = $json['session'];
	$challenge = $json['challenge'];
	$rendered = $json['rendered'];
	$status = $json['status'];
	$flag = $json['flag'];
	echo $status."\n";
	echo $rendered."\n";
	$solve = solveChallenge($challenge);
}

echo "FLAG: $flag \n";

function doCurl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$resp = curl_exec($ch);
	curl_close($ch);
	return $resp;
}

function checkFlag($json){
	if (!empty($json['flag'])){
		echo "FLAG: ".$json['flag'];
		return false;
	}
}

function solveChallenge($chal){
	// Check challenge type
	$check = $chal[0]['values'];
	if (count($check) < 2){
		// 1 Value column only
		if (strpos($check[0],'.') !== false) return solveIP($chal);
		else return solvePrime($chal);
	}
	else{
		// 2 Value columns, check 2nd value format
		if (strpos($check[0], "EAX") !== false) return solveEAX($chal);
		else{
			if (isAlphabet($check[1])) return solveSameDifferent($chal);
			else if (isDigits($check[1])) return solveCRC32($chal);
			else if (isHexString($check[1])){
				$check2 = $chal[1]['values'];
				if (strlen($check[1]) == 32 && strlen($check2[1]) == 32) return solveMD5($chal);
				else if (strlen($check[1]) == 64) return solveSha256($chal);
				else if (strlen($check[1]) == 96) return solveSHA384($chal);
				else return solveSingleXor($chal);	
			} 
			else return solveBase64RC4($chal);
		}
	}
}

function solveSameDifferent($chal){
	// Either 
	// 9 same and 1 different pairs of text OR
	// 1 same and 9 different pairs of text
	// Provide the ID of the 1 same or 1 different pair
	echo "Solving SameDifferent \n";
	$same = 0;
	$sameIDs = array();
	$different = 0;
	$differentIDs = array();
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];
		if (strcmp($values[0], $values[1]) == 0) {
			$same++;
			$sameIDs[] = $id;
		}
		else {
			$different++;
			$differentIDs[] = $id;
		}
	}

	if ($same == 1) return $sameIDs[0];
	else return $differentIDs[0];
}

function solvePrime($chal){
	echo "Solving Prime\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		if (isPrime($values[0])) return $id;
	}
}

function solveIP($chal){
	echo "Solving IP\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$ip = $values[0];
		$octets = explode('.',$ip);
		for ($k=0; $k<count($octets); $k++){
			$octet = intval($octets[$k]);
			if ($octet > 255) return $id;
		}
	}
}

function solveSingleXor($chal){
	echo "Solving Single Xor\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$msg = $values[0];
		$enc = $values[1];
		$key = 0xff;
		$test = "";
		for ($k=0; $k<strlen($msg); $k++){
			$test .= chr($key ^ ord($msg[$k]));
		}
		$test = bin2hex($test);
		//echo "Comparing $test with $enc \n";
		if (strcmp($test, $enc) != 0) {return $id;}
	}
}

function solveSHA256($chal){
	echo "Solving SHA256\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$hash = hash('sha256',$values[0]);
		if (strcmp($hash, $values[1]) != 0) return $id;
	}
}

function solveSHA384($chal){
	echo "Solving SHA384\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$hash = hash('sha384',$values[0]);
		if (strcmp($hash, $values[1]) != 0) return $id;
	}
}

function solveMD5($chal){
	echo "Solving MD5\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$hash = md5($values[0]);
		if (strcmp($hash, $values[1]) != 0) return $id;
	}
}

function solveBase64RC4($chal){
	echo "Solving RC4/Base64\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$enc = base64_encode(rc4($values[0], $values[0]));
		if (strcmp($enc, $values[1]) != 0) return $id;
	}
}

function solveCRC32($chal){
	echo "Solving CRC32\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$hash = crc32($values[0]).'';
		if (strcmp($hash, $values[1]) != 0) return $id;
	}
	return 1;
}

function solveEAX($chal){
	echo "Solving EAX\n";
	for ($i=0; $i<count($chal); $i++){
		$cur = $chal[$i];
		$values = $cur['values'];
		$id = $cur['id'];

		$left = explode(' == ', $values[0])[1];
		file_put_contents('tmp', hex2bin($values[1]));
		$cmd = "C:\\Users\\ggg\\Desktop\\labyrenth2017\\prog04\\shellcode_launcher.exe -i tmp > output";
		exec($cmd);
		$result = file_get_contents("output");
		$result = explode("\n", $result);
		$ret = trim($result[1]);
		while (strlen($ret) < 8) $ret = '0'.$ret;
		$ret = '0x'.strtoupper($ret);
		if (strcmp($left, $ret) != 0) return $id;
	}
}

function isAlphabet($str){
	for ($i=0; $i<strlen($str); $i++){
		$cur = ord($str[$i]);
		if ($cur < 0x61 || $cur > 0x7a) return false;
	}
	return true;
}

function isDigits($str){
	for ($i=0; $i<strlen($str); $i++){
		$cur = ord($str[$i]);
		if ($cur < 0x30 || $cur > 0x39) return false;
	}
	return true;
}

function isHexString($str){
	for ($i=0; $i<strlen($str); $i++){
		$cur = ord($str[$i]);
		if ($cur < 0x30 || (($cur > 0x39) && ($cur < 0x61)) || ($cur > 0x66)) return false;
	}
	return true;
}

function isPrime($num){
	for ($i=2; $i<256; $i++){
		if ($num % $i == 0) return false;
	}
	return true;
}

function rc4($key, $str) {
	$s = array();
	for ($i = 0; $i < 256; $i++) {
		$s[$i] = $i;
	}
	$j = 0;
	for ($i = 0; $i < 256; $i++) {
		$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
	}
	$i = 0;
	$j = 0;
	$res = '';
	for ($y = 0; $y < strlen($str); $y++) {
		$i = ($i + 1) % 256;
		$j = ($j + $s[$i]) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
		$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
	}
	return $res;
}

/*
Solving RC4/Base64
Answering Qn 128: 11
Oh look at you, winning all the things.

Solving Prime
FLAG: PAN{8a1f7919eda0bd55db89d2eff45f420d84ec67c3715ab0c53bc8db7b1762cd54}
*/
?>