<?php
// Run this outside the folder with all the "doc" files
$expected = "powershell -win normal -ep bypass -enc JABvAHUAdAB0AHkAPQBAACIACgA8ACAATgBvAHQAaABpAG4AZwAgAEgAZQByAGUAIABGAHIAaQBlAG4AZAAgAD4ACgAgACAAIAAgACAAIAAgACAAXAAgACAAIABeAF8AXwBeAAoAIAAgACAAIAAgACAAIAAgACAAXAAgACAAKABvAG8AKQBcAF8AXwBfAF8AXwBfAF8ACgAgACAAIAAgACAAIAAgACAAIAAgACAAIAAoAF8AXwApAFwAIAAgACAAIAAgACAAIAApAFwALwBcAAoAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAB8AHwALQAtAC0ALQB3ACAAfAAKACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAfAB8ACAAIAAgACAAIAB8AHwACgBnAHMAcgB0AAoAIgBAAAoAJABvAHUAdAB0AHkAIAA9ACAAJABvAHUAdAB0AHkAIAAqADEAMAAwADAAMAAKAFcAcgBpAHQAZQAtAEgAbwBzAHQAIAAkAG8AdQB0AHQAeQA=POSITIONWScript.Shell";

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
			echo $out."\n\n";
			/*
			if (strcmp($out,$expected) !== 0){
				echo "---------------------------\n$count\n";
				echo $out."\n";
			}
			*/
		}
	}
	$count++;
}

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