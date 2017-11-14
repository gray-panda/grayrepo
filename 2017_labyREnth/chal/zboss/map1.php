<?php
doStep("Start");
echo "Done?"."\n";

function doStep($parent, $level7 = false){
	if ($level7){
		echo "Executing TOS...\n";
		passthru("TOSLoader.exe");
		echo "\n";
		return;
	}
	passthru("x32dbg \"C:\labyrenth2017\boss\TOSLoader.exe\""); // Full Path to challenge binary
	
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
		if ($curlevel < 7) doStep($name);
		else doStep($name, true);
		putenv($name);
	}
}

/*

        array('id'=>"tos_68652ae0be884b4683e4fd8968f24877", 'parentID'=>"tos_1e46cef8455c4c8f81e7366d64f58984", 'lyrics'=>'To get things done', 'level'=>7),
Executing TOS...
 * * *******     * * **  * ****  *  ** * **  *  * * **  ****
* **  ** *  ****    ***     **  ********** ** *       * ** ** **
 *  ** *  *   * * * * * * **   * * * * ** **   ** ***** * *   **
**** **** *******    * ** *  ***   **** *  ** ** * * *    ***
** *   ***   *    *   *******   **   **  *** **  **  *   * *
 * ***     * * ** *** *    *   * *  * *     ** *    ***  *
    **  *** **** * * ** **** **** *  ***    *  ****    ****  **
****    ** * **  * *****  **   * * * *      *     * ***   *  ***
http://dl.labyrenth.com/tos.inf/d2476ee0823448f4e6628676b252d65a6a5d6169d73a31fa5df3e16bee4b95f2.7z

        array('id'=>"tos_1199aafe667c4c5b8627a5504b789ec0", 'parentID'=>"tos_56b4cd654be24143b50bb8dc9cb42581", 'lyrics'=>'Ashes to ashes, fun to funky', 'level'=>6),
*/

/*
 * * *******     * * **  * ****  *  ** * **  *  * * **  ****
* **  ** *  ****    ***     **  ********** ** *       * ** ** **
 *  ** *  *   * * * * * * **   * * * * ** **   ** ***** * *   **
**** **** *******    * ** *  ***   **** *  ** ** * * *    ***
** *   ***   *    *   *******   **   **  *** **  **  *   * *
 * ***     * * ** *** *    *   * *  * *     ** *    ***  *
    **  *** **** * * ** **** **** *  ***    *  ****    ****  **
****    ** * **  * *****  **   * * * *      *     * ***   *  ***
http://dl.labyrenth.com/tos.inf/d2476ee0823448f4e6628676b252d65a6a5d6169d73a31fa5df3e16bee4b95f2.7z
tos_4e801728d1054995bb3d99ddfefa8ab3: Ashes to ashes, fun to funky
tos_68f4f342be354e06bc4cc846b10573e0: Your circuits dead, theres something wrong
tos_e47886d1a9f6422b8b1627da6b060792: Now its time to leave the capsule if you dare
tos_f60ad38f40d442f696c1c4bf4dde4840: And theres nothing I can do
tos_56b4cd654be24143b50bb8dc9cb42581: Im feeling very still
tos_1e46cef8455c4c8f81e7366d64f58984: Do you remember a guy thats been in such an early song
tos_68652ae0be884b4683e4fd8968f24877: To get things done
*/
?>