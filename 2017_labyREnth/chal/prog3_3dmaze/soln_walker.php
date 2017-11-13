<?php

$url = "34.211.117.64";
$port = "16000";
$readsize = 8192;

$sock = fsockopen($url, $port);
if ($sock === false){
	echo "socket_connect failed...\n";
	socket_close($sock);
	die();
}

$data = readAll($sock);
if ($data === false){
	echo "socket_read failed...\n";
	socket_close($sock);
	die();
}

$count = 2;
while (strpos($data, "PAN{") === false){
	file_put_contents("logs/$count", $data);
	$count++;
	echo $data."\n";
	echo strlen($data)."\n";
	$input = readline();
	fwrite($sock, $input);
	fflush($sock);
	$data = readAll($sock);
}

/*
$cmdqueue = array();
$cmdcount = 0;
while (strpos($data,"PAN{") === false){
	if (count($cmdqueue)<1){
		$tmppos = strpos($data, "Ahead");
		if ($tmppos !== false){
			$endpos = strpos($data,"\n",$tmppos);
			$description = trim(substr($data,$tmppos, $endpos));
			// End of array is executed first
			if (strpos($description, "left") !== false){
				// Got the word Left
				$cmdqueue[] = 'a';
				$cmdqueue[] = 'w';
			}
			else if (strpos($description, "right") !== false){
				// Got the word right
				$cmdqueue[] = 'd';
				$cmdqueue[] = 'w';
				var_dump($cmdqueue);
			}
			else if (strpos($description, "dead") !== false){
				$cmdqueue[] = 'd';
				$cmdqueue[] = 'd';
			}
			else{
				$cmdqueue[] = 'w';
			}
		}
	}
	echo $data."\n";
	if ($cmdcount % 10 == 9){
		$cmdqueue[] = 'a';
		$cmdqueue[] = 'd';
	}
	$nextcmd = array_pop($cmdqueue);
	var_dump($nextcmd);
	if (!empty($nextcmd)){
		$cmdcount++;
		echo "$nextcmd $cmdcount\n";
		fwrite($sock, $nextcmd);
		fflush($sock);
		$data = fread($sock, $readsize);
		sleep(1);
	}
	else{
		fclose($sock);
		die();
	}
}
echo $data."\n";
*/
fclose($sock);

function readAll($sock){
	return fread($sock,8192);
	/*
	$r = array($sock);
	$w = array();
	$e = array();
	$data = "";
	$res = socket_select($r, $w, $e, 0);
	while ($res !== false){
		$data .= fread($sock,8192);
		$res = socket_select($r, $w, $e, 0);
	}
	return $data;
	*/
}
?>