<?php
doStep("Start");
echo "Done?"."\n";

function doStep($parent, $level5 = false){
	if ($level5){
		echo "Executing TOS...\n";
		passthru("TOSLoader.exe");
		echo "\n";
		return;
	}
	passthru("x32dbg \"C:\labyrenth2017\boss4\TOSLoader.exe\""); // Full Path to challenge binary
	
	// Rename the log file
	$logdir = 'C:\x64dbg\release\x32'; // Path to x64dbg directory
	unlink("$logdir\\log.txt");
	$files = scandir($logdir);
	for ($i=0; $i<count($files); $i++){
		$curfile = $files[$i];
		if (strpos($curfile, "log-") === 0){
			rename($logdir."\\".$curfile, $logdir."\\"."log.txt");
		}
	}

	$data = file_get_contents("$logdir\\log.txt");
	$lines = explode("\n",trim($data));

	$lastline = $lines[count($lines)-1];
	if (strcmp($lastline, "MissionComplete") == 0){
		echo "Returning from $parent"."\n";
		passthru("TOSLoader.exe");
		return;
	}
	
	$level = explode(" ", $lastline)[1];

	$keys = array();
	for ($i=0; $i<count($lines); $i++){
		if (strpos($lines[$i], "Level $level") === 0){
			// Starts with "Level x"
			$keys[] = $lines[$i];
		}
	}

	//for ($i=0; $i<count($keys); $i++){
	for ($i=count($keys)-1; $i>=0; $i--){
		$cur = $keys[$i];
		//echo $cur."\n";
		$curlevel = intval(explode(" ", $cur)[1]);
		$parts = explode('" = "', $cur);
		$name = substr($parts[0], strpos($parts[0], '"')+1);
		$val = substr($parts[1], 0, strpos($parts[1], '"'));
		
		
		$mapping = "\tarray('id'=>\"$name\", 'parentID'=>\"$parent\", 'lyrics'=>'$val', 'level'=>$curlevel),\n";
		echo "\n".$mapping;
		file_put_contents("mapping.txt",$mapping, FILE_APPEND);
		
		putenv($name.'='.$val);
		if ($curlevel < 5) doStep($name);
		else doStep($name, true);
		putenv($name);
	}
}

/*
    array('id'=>"tos_1044c6fa7bf84c2bbd3a408fe7b12aeb", 'parentID'=>"tos_b82921bc59f5465d8e9a676d569c0baf", 'lyrics'=>'Heaven knows, shed have taken anything, but', 'level'=>5),
Executing TOS...
  ** **   ***** *** *    * *    ***  * * *  * * ***** *  * ** *
 *       *  **   * ** ***   * ** *****    * **  ****  ***   * *
*** *    **** ** * ** * *   * * * ** ***** **  *   *   ***  * **
 *   ****  *** **   ** * ** *  ** * *  *  ** ***  **** **** * *
    ** * * *    * *** ** ***   ** *  *  **  ***  ** ** * *******
 *  *    ** *** **   *** *** **  *****  * **   *  * *  *  **  **
PAN{dd864aebeeba3e125dce2e111e6ea04fb759333409a87da8e7bd413b3e36105b}

        array('id'=>"tos_a9b1b4e1817f48239650bf789c945f98", 'parentID'=>"tos_9558027f72f24a3a82dc3754069d073a", 'lyrics'=>'Aint there one damn song that can make me', 'level'=>3),
*/
?>