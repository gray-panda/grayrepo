<?php
$dirname = 'yara_samples/';
$rule1 = genYaraRule_FixedLen(0x169, "\x8B\xFF\x55\x8B\xEC\x83\xEC\x14\x53\x56\x57\xE8", $dirname); // Done, 1 of them
//$rule2 = genYaraRule_FixedLen(0xf, "\x8b\xff\x55\x8b\xec\x8b\x45\x08\xa3", $dirname);
//$rule2 = genYaraRule_FixedLen(0x26, "\x8b\xff\x56\xb8", $dirname);
$rule2 = "8B FF 56 B8 ?0 ?? 40 00 BE ?0 ?? 40 00 57 8B F8 3B C6 73 0F 8B 07 85 C0 74 02 FF D0 83 C7 04 3B FE 72 F1 5F 5E C3";

//genYaraRule_FixedLen(0xe9, "\x55\x8b\xec", $dirname);
//die();

$solution = "rule yara_challenge
{
	strings:
		\$yara_challenge01 = { $rule1 }
		\$yara_challenge02 = { $rule2 }
	condition:
		 1 of them 
}";
echo $solution."\n";


$url = "34.208.93.211";
$port = "8082";
$readsize = 8192;

$sock = fsockopen($url, $port);
if ($sock === false){
	echo "socket_connect failed...\n";
	socket_close($sock);
	die();
}

fwrite($sock, $solution, strlen($solution));
fflush($sock);

$data = fread($sock, $readsize);
echo $data."\n";
$data = fread($sock, $readsize);
echo $data."\n";

function genYaraRule_FixedLen($funclen, $marker, $dirname){
	$dir = scandir($dirname);
	$codes = array();
	$success = 0;
	foreach($dir as $fname){
		if (strcmp($fname, '.') == 0 || strcmp($fname,'..') == 0) continue;

		$data = file_get_contents($dirname.$fname);
		$found = false;
		$tmppos = 0;
		while ($tmppos !== false){
			$tmppos = strpos($data, $marker, $tmppos+1);
			if (strcmp($data[$tmppos+$funclen-1], "\xc3") == 0){
				$found = true;
				$codes[] = substr($data,$tmppos,$funclen);
				$success++;
				break;
			}
			if ($tmppos === false){
				echo "Cannot find func for $fname \n";
			}
		}
	}
	echo "$success samples have this function..\n";

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
	echo $rule."\n";

	$tmprule = str_replace(' ', '', $rule);
	$wildCount = 0;
	for($i=0; $i<strlen($tmprule); $i++){
		if (strcmp($tmprule[$i], '?') == 0) $wildCount++;
	}
	echo "Wild Count: $wildCount\n";

	return $rule;
}

//SUCCESS! KEY IS: PAN{Pivot!Pivot!Pivot!Pivot!Pivot!Pivot!ShutUp!ShutUp!ShutUp!}
?>