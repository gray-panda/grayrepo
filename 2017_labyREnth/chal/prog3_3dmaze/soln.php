<?php
$valid = getHashes();
$url = "34.211.117.64";
$port = "16000";
$readsize = 8192;

$sock = fsockopen($url, $port);
if ($sock === false){
	echo "socket_connect failed...\n";
	socket_close($sock);
	die();
}

//$data = readAll($sock, $valid);
$data = fread($sock,8192);
if ($data === false){
	echo "socket_read failed...\n";
	socket_close($sock);
	die();
}

$cmdqueue = array(); // Commands at the end of the queue is executed first. More like a stack.
$cmdqueue[] = 'w';
$cmdcount = 0;
while (strpos($data,"PAN{") === false){
	var_dump($cmdqueue);
	if (count($cmdqueue)<1){
		// Determine next command
		$state = getState($data,$valid);
		// Always take left turn
		if (strcmp($state, "corner_left_near") == 0) {
			$cmdqueue[] = 'a';
			$cmdqueue[] = 'w';
		}
		else if (strcmp($state, "corner_right_near") == 0) {
			$cmdqueue[] = 'd';
			$cmdqueue[] = 'w';
		}
		else if (strcmp($state, "junc_t_near") == 0) {
			$cmdqueue[] = 'a';
			$cmdqueue[] = 'w';
		}
		else if (strcmp($state, "junc_forward_left_near") == 0) {
			$cmdqueue[] = 'a';
			$cmdqueue[] = 'w';
		}
		// Turn around when facing a deadend
		else if (strcmp($state, "deadend_far") == 0) {
			$cmdqueue[] = 'd';
			$cmdqueue[] = 'd';
		}
		else if (strcmp($state, "deadend_near") == 0) {
			$cmdqueue[] = 'd';
			$cmdqueue[] = 'd';
		}
		else{
			$cmdqueue[] = 'w';
		}
	}
	echo $data."\n";
	if ($cmdcount % 10 == 9){
		// Get ready for cheating wall insertion
		$state = getState($data,$valid);
		if (strpos($state, "meme") !== false) {
			// if already facing a wall, just move forward
			$cmdqueue[] = 'w';
		}
		else{
			// else turn right to face a wall, then turn left to resume.
			$cmdqueue[] = 'a';
			$cmdqueue[] = 'd';
		}
	}
	$nextcmd = array_pop($cmdqueue);
	if (!empty($nextcmd)){
		$cmdcount++;
		echo "$nextcmd $cmdcount\n";
		fwrite($sock, $nextcmd);
		fflush($sock);
		$data = readAll($sock, $valid);
		sleep(1);
	}
	else{
		fclose($sock);
		die();
	}
}
echo $data."\n";

fclose($sock);

function readAll($sock, $hashes){
	$data = fread($sock,8192);
	$hash = md5($data);
	if (strpos($data,"PAN{") !== false) return $data;
	while (!array_key_exists($hash, $hashes)){
		$data .= fread($sock,8192);
		$hash = md5($data);
	}
	return $data;
}

function getHashes(){
	$dirname = "responses/";
	$hashes = array();
	$dir = new DirectoryIterator($dirname);
	foreach ($dir as $fileinfo) {
	    if (!$fileinfo->isDot()) {
	    	$fname = $fileinfo->getFilename();
	        $data = file_get_contents($dirname.$fname);
	        $hash = md5($data);
	        $hashes[$hash] = $fname;
	    }
	}
	return $hashes;
}

function getState($cur, $hashes){
	$hash = md5($cur);
	return $hashes[$hash];
}

/*
--------------------------------------------------------------------------------
                                                                                
                     ROFL:ROFL:LOL:ROFL:LOL:ROFL:LOL:ROFL:ROFL                  
                                        ||                                      
                         _______________||_______________                         
                        /      ____   ___     _   __ [ 0 \                         
          L            /      / __ \ /   |   / | / / |_|<_\                         
          O           /      / /_/ // /| |  /  |/ /  |_____\                       
        LOLOL========       / ____// ___ | / /|  /          \                
          O          |     /_/    /_/  |_|/_/ |_/            )                 
          L        B | O M B                                /                   
                     |____________,--------------__________/                    
                  F /      ||                       ||                        
                 T /     }-OMGPAN{c0ntact_jugglers_R_Ballerz}ROCKET))         
                W /________||_______________________||__/_/                    
                                                                                
                                                                                
                                                                   

*/
?>