<?php
// Run this outside the folder with all the "doc" files
$expected = "powershell -win normal -ep bypass -enc JABvAHUAdAB0AHkAPQBAACIACgA8ACAATgBvAHQAaABpAG4AZwAgAEgAZQByAGUAIABGAHIAaQBlAG4AZAAgAD4ACgAgACAAIAAgACAAIAAgACAAXAAgACAAIABeAF8AXwBeAAoAIAAgACAAIAAgACAAIAAgACAAXAAgACAAKABvAG8AKQBcAF8AXwBfAF8AXwBfAF8ACgAgACAAIAAgACAAIAAgACAAIAAgACAAIAAoAF8AXwApAFwAIAAgACAAIAAgACAAIAApAFwALwBcAAoAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAB8AHwALQAtAC0ALQB3ACAAfAAKACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAfAB8ACAAIAAgACAAIAB8AHwACgBnAHMAcgB0AAoAIgBAAAoAJABvAHUAdAB0AHkAIAA9ACAAJABvAHUAdAB0AHkAIAAqADEAMAAwADAAMAAKAFcAcgBpAHQAZQAtAEgAbwBzAHQAIAAkAG8AdQB0AHQAeQA=POSITIONWScript.Shell";

$flag = array();

//$dir = "test\\";
$dir = "pkg".DIRECTORY_SEPARATOR;
$files = scandir($dir);
$count = 1;
foreach ($files as $file){
	$parts = explode('.',$file);
	if (strcmp($parts[count($parts)-1], 'doc') !== 0) continue;
	
	$fn = $dir.$file;
	$macroDir = $dir.strtoupper($file)."-Macros".DIRECTORY_SEPARATOR;
	
	// Extract the Arrays from the macro codes
	$macroFiles = scandir($macroDir);
	foreach ($macroFiles as $mfile){
		if (strcmp($mfile, "ThisDocument") === 0) continue;
		else if (strcmp($mfile, ".") === 0) continue;
		else if (strcmp($mfile, "..") === 0) continue;
		else{
			$mfn = $macroDir.$mfile;
			$code = file_get_contents($mfn);
			$res = grabDecryptCode($code);
			
			$tmp = file_get_contents($fn.".dict");
			$dicts = explode("\r\n",$tmp);
			$dict = $dicts[3];
			
			$out = "";
			for ($j=0; $j<count($res); $j++){
				$curres = $res[$j];
				$out .= decrypt($curres[0], $curres[1], $dict);
			}
			/* // Lists out all that did not give expected failed answer. Spotted the position string
			if (strcmp($out,$expected) !== 0){
				echo "---------------------------\n$count\n";
				echo $out."\n";
			}
			*/
			
			// Assign to flag array based on presence of the "POSITION" string
			if (strpos($out, "SEVENTEEN") !== false) $flag[16] = $out;
			else if (strpos($out, "SIXTEEN") !== false) $flag[15] = $out;
			else if (strpos($out, "FIFTEEN") !== false) $flag[14] = $out;
			else if (strpos($out, "FOURTEEN") !== false) $flag[13] = $out;
			else if (strpos($out, "THIRTEEN") !== false) $flag[12] = $out;
			else if (strpos($out, "TWELVE") !== false) $flag[11] = $out;
			else if (strpos($out, "ELEVEN") !== false) $flag[10] = $out;
			else if (strpos($out, "TEN") !== false) $flag[9] = $out;
			else if (strpos($out, "NINE") !== false) $flag[8] = $out;
			else if (strpos($out, "EIGHT") !== false) $flag[7] = $out;
			else if (strpos($out, "SEVEN") !== false) $flag[6] = $out;
			else if (strpos($out, "SIX") !== false) $flag[5] = $out;
			else if (strpos($out, "FIVE") !== false) $flag[4] = $out;
			else if (strpos($out, "FOUR") !== false) $flag[3] = $out;
			else if (strpos($out, "THREE") !== false) $flag[2] = $out;
			else if (strpos($out, "TWO") !== false) $flag[1] = $out;
			else if (strpos($out, "ONE") !== false) $flag[0] = $out;
		}
	}
	$count++;
}

// Extract the b64-encoded code and print out the flag
for ($f=0; $f<count($flag); $f++){
	$cur = $flag[$f];
	$parts = explode(" ",$cur);
	$enc = $parts[count($parts)-1];
	$marker = "";
	switch ($f){
		case 0: $marker = "ONE"; break;
		case 1: $marker = "TWO"; break;
		case 2: $marker = "THREE"; break;
		case 3: $marker = "FOUR"; break;
		case 4: $marker = "FIVE"; break;
		case 5: $marker = "SIX"; break;
		case 6: $marker = "SEVEN"; break;
		case 7: $marker = "EIGHT"; break;
		case 8: $marker = "NINE"; break;
		case 9: $marker = "TEN"; break;
		case 10: $marker = "ELEVEN"; break;
		case 11: $marker = "TWELVE"; break;
		case 12: $marker = "THIRTEEN"; break;
		case 13: $marker = "FOURTEEN"; break;
		case 14: $marker = "FIFTEEN"; break;
		case 15: $marker = "SIXTEEN"; break;
		case 16: $marker = "SEVENTEEN"; break;
		default: $marker = "WTF"; break;
	}
	$pos = strpos($enc,$marker);
	$enc = substr($enc,0,$pos);
	echo base64_decode($enc)."\n";
}

// PAN{6398db85783f}

// Another way is to sort the files by Time Modified and inspect those that does not follow the pattern

function grabDecryptCode($code){
	$result = array();
	$marker = "(Array(";
	$parts = explode($marker, $code);
	for ($i=1; $i<count($parts); $i++){
		$cur = $parts[$i];
		$tmp = explode(")",$cur);
		
		// Get Numbers
		$curarray = array();
		$numstr = $tmp[0];
		$numstr = str_replace("_\r\n","",$numstr);
		$nums = explode(", ",$numstr);
		for ($j=0; $j<count($nums); $j++){
			$curarray[] = (int) $nums[$j];
		}
		
		// Get Offset
		$offset = (int) trim(substr($tmp[1],1));
		$result[] = array($curarray, $offset);
	}
	return $result;
}

function decrypt($crypted, $offset, $dict){
	$msg = "";
	for ($i=0; $i<count($crypted); $i++){
		$tmp = $crypted[$i] ^ ord($dict[$i+$offset]);
		$msg .= chr($tmp);
	}
	return $msg;
}

?>