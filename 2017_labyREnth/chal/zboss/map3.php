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
	passthru("x32dbg \"C:\labyrenth2017\boss3\TOSLoader.exe\""); // Full Path to challenge binary
	
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
        array('id'=>"tos_f482e72b184a421d86f02f742e25af30", 'parentID'=>"tos_3b1d5947b6b743dc8c1b0a9f37d01427", 'lyrics'=>'Yes were lovers, and that is that', 'level'=>5),
Executing TOS...
   *** ** *****   ** *  * ****      **  *  ****      ** * * ***
 * ***** * **  *    ****    * * ***    **    * * **  *   **  * *
*  **  **    ***** ** * * *  **   ****** *  *    *  ****  ******
* *    *  * ** *** ** *** * *  **** ******  * * *      ** ** *
*     ** * * *** *** *    *  ** *  *** ** * **  **     ****** *
** *  ** * *  ****   *     *** * **   ****   * *  ** ***** *  **
http://dl.labyrenth.com/tos.inf/52b820b4471767e1be68c61d5fd0cd67cd380a2ba84280e6901d0166dd522fc8.7z

        array('id'=>"tos_6a5b5fb4ad6646aaa1af9b8ff687fd97", 'parentID'=>"tos_3b1d5947b6b743dc8c1b0a9f37d01427", 'lyrics'=>'And we kissed, as though nothing could fall nothing could fall', 'level'=>5),
*/
?>