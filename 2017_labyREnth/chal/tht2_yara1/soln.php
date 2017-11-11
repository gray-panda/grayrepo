<?php
/*
Made use of the hints video
Mentioned that the target function size is 298 bytes (0x12a) long
Each binary has only 1 function with such length.

The script below will go through each binary and find this function
	- Looking for the start "53 56" and checking that at offset 0x12a is "C3" (ret)

Once all the functions has been found, go through each function's hex string and compare them.
	- If there is difference in the character, the wildcard '?' is added to the rule.
	- If not, that character is added to the rule

Once the rule has been formed, form the solution and submit it to the challenge server
If correct, the flag is printed.
*/
$dirname = 'labyrenth/';
$dir = scandir($dirname);
$funclen = 0x12a;

$codes = array();
foreach($dir as $fname){
	if (strcmp($fname, '.') == 0 || strcmp($fname,'..') == 0) continue;

	$data = file_get_contents($dirname.$fname);
	$found = false;
	$tmppos = 0;
	while (!$found){
		$tmppos = strpos($data,"\x53\x56", $tmppos+1);
		if (strcmp($data[$tmppos+$funclen-1], "\xc3") == 0){
			$found = true;
			$codes[] = substr($data,$tmppos,$funclen);
			break;
		}
		if ($tmppos === false){
			echo "Cannot find func for $fname \n";
			die();
		}
	}
}

$rule = "";
for ($i=0; $i<$funclen*2; $i++){
	if ($i != 0 && $i % 2 == 0) $rule .= ' ';
	$prev = false;
	$cur = false;
	$same = true;
	foreach ($codes as $code){
		$hex = bin2hex($code);
		if (strlen($hex) % 2 == 1) $hex = '0'.$hex;	

		$cur = $hex[$i];
		if ($prev == false){
			$prev = $cur;
			continue;
		}
		
		if (ord($cur) != ord($prev)){
			$rule .= '?';
			$same = false;
			break;
		}
	}

	if ($same){
		$rule .= $cur;
	}
}
//echo $rule."\n";

$tmprule = str_replace(' ', '', $rule);
$wildCount = 0;
for($i=0; $i<strlen($tmprule); $i++){
	if (strcmp($tmprule[$i], '?') == 0) $wildCount++;
}
echo "Wild Count: $wildCount\n";

$solution = "rule yara_challenge
{
	strings:
		\$yara_challenge = { $rule }
	condition:
		 all of them 
}";
//echo $solution."\n";


$url = "52.42.81.161";
$port = "8082";
$readsize = 8192;

$sock = fsockopen($url, $port);
if ($sock === false){
	echo "socket_connect failed...\n";
	socket_close($sock);
	die();
}

fwrite($sock, $solution);

$data = fread($sock, $readsize);
if ($data === false){
	echo "socket_read failed...\n";
	socket_close($sock);
	die();
}

echo $data."\n";
//SUCCESS! KEY IS: PAN{AllByMyself}
?>