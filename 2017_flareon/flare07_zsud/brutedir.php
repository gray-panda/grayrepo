<?php

$enc = trim(file_get_contents("start.txt"));

$valid = array('n','s','e','w','u','d');
$valid = array_reverse($valid);
$done = false;

$dir = "";
$msg = "";

while (!$done){
	$parts = explode(" ", $enc);
	$e = $parts[count($parts)-1]; // $e is the last part
	$msg .= $parts[count($parts)-2] . " ";
	
	if (strlen($dir) < 13){}
	else{
		$valid = array();
		for ($z=ord('a'); $z<=ord('z'); $z++){
			$valid[] = chr($z);
		}
	}
	
	for ($i=0; $i<count($valid); $i++){
		$k = $dir.$valid[$i];
		echo "Trying $k\n";
		$res = tryDecrypt($k, $e);
		//var_dump($res);
		if ($res == false){
			if ($i == count($valid) - 1){
				// Ending condition (Fail)
				echo "Finished...\n";
				$done = true;
			}
		}
		else{
			$dir .= $valid[$i];
			echo "Direction: $dir \n";
			echo "Message: $msg \n";
			echo "$res \n";
			
			$enc = $res;
			break;
		}
	}
}

// wnneesssnewne

// n,get key drawer,w,n,n,e,e,s,s,s,n,e,w,n,e,look key

// n,get key drawer,w,n,n,e,e,s,s,s,n,e,w,n,n,n,n,look key,get helmet,wear helmet,drop key,say kevin @

// n,get key drawer,w,n,n,e,e,s,s,s,n,e,w,s,n,e,w,n,n,n,look key

function tryDecrypt($k, $e){
	$ret = -1;
	
	$e = customUrlEncode($e);
	$url = "http://127.0.0.1:9999/some/thing.asp?k=".$k;
	//echo $url."\n";
	$url .= "&e=".$e;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$resp = curl_exec($ch);
	if ($resp === false){}
	else if (strpos($resp, "WHALE") !== false){
		// Fail
		$ret = false;
	}
	else $ret = $resp;
	
	curl_close($ch);
	return $ret;
}

function customUrlEncode($str){
	$tmp = str_replace("=", "%3D", $str);
	$tmp = str_replace("+","-", $tmp);
	$tmp = str_replace("/","_", $tmp);
	
	return $tmp;
}
?>