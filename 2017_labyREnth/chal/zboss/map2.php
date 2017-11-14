<?php
doStep("Start");
echo "Done?"."\n";

function doStep($parent, $level8 = false){
	if ($level8){
		echo "Executing TOS...\n";
		passthru("TOSLoader.exe");
		echo "\n";
		return;
	}
	passthru("x32dbg \"C:\labyrenth2017\boss2\TOSLoader.exe\""); // Full Path to challenge binary
	
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

	for ($i=0; $i<count($keys); $i++){
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
		if ($curlevel < 8) doStep($name);
		else doStep($name, true);
		putenv($name);
	}
}

/*
        array('id'=>"tos_723ad3b7e2d344ae82d2222fe67ba0ff", 'parentID'=>"tos_66d40d4cb17e4b28b4079eaf653f7730", 'lyrics'=>'Chchchchchanges', 'level'=>8),
Executing TOS...
** * ** ***    *  **       ***   *  ** ** * ** * *  ***  *  *
*   *** **** *  **    **   **  *  ***  ****** *   *** * * * * **
  *****  ****      * ******** *    *  **  *   *****  ****    * *
*   *    ****  ***    * **       * *     * *  ******** * * * **
 ** * *  * *** *  ****  * * * *     *  ** *  ** *     ** * ** **
****   ***  *****  * **  ** *  *         ** * *** *** **** *  *
    **** * ****  * ***    * ***  *** * * ** *** *  **   ***  *
* ** *** *  *  *     *    **  **    ** **  **  ***  * *** ***
 ****** ***  * ***** ***** ***  * *  ** * **** ***   *** **  *
http://dl.labyrenth.com/tos.inf/aabde9674c602172beccbdc0616292ec533474d30807c7b099febdb45d5aa405.7z

        array('id'=>"tos_2ea8cf05e91f4ba4bcbf5ce3b8ccd585", 'parentID'=>"tos_66d40d4cb17e4b28b4079eaf653f7730", 'lyrics'=>'Im so high, it makes my brain whirl', 'level'=>8),
		*/
?>