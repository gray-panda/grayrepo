<?php
// Run this in the same directory with all the ".doc" files
$dir = ".\\";
$files = scandir($dir);
foreach ($files as $file){
	$parts = explode('.',$file);
	if (strcmp($parts[count($parts)-1], 'doc') !== 0) continue;
	
	// Extract the Macros from the doc files
	$fn = $dir.$file;
	$cmd = "OfficeMalScanner $fn info";
	passthru($cmd);
	
	// Extract the ActiveDocument Variable name from the "ThisDocument" macro file
	$VARNAME = "";
	$macroDir = strtoupper($file)."-MACROS\\";
	$data = file_get_contents($macroDir."ThisDocument");
	$marker = "Variables(\"";
	$start = strpos($data, $marker) + strlen($marker);
	$VARNAME = substr($data,$start,6);
	
	// Run DocumentVariableExtractor.vbs to extract the ActiveDocument variable
	$outfile = "$fn".".dict";
	$cmd = "cscript ../DocumentVariableExtractor.vbs ".realpath($fn)." $VARNAME > $outfile";
	passthru($cmd);
}
?>
