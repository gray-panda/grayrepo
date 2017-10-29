<?php
if (count($argv) < 2){
	echo "Usage: php $argv[0] intel_hex_file\n";
	die();
}

$data = explode("\n", file_get_contents($argv[1]));
$out = "";

for ($i=0; $i<count($data); $i++){
	$line = trim($data[$i]);
	$line = substr($line,1);
	$bytecount = hexdec(substr($line,0,2));
	$address = hexdec(substr($line,2,4));
	$type = hexdec(substr($line,6,2));
	$checksum = hexdec(substr($line,-2));
	$record = substr($line,8,$bytecount*2);
	
	/*
	echo $line."\n";
	var_dump($bytecount);
	var_dump($address);
	var_dump($type);
	var_dump($checksum);
	var_dump($record);
	*/
	
	switch ($type){
		case 0:
			// Data
			$tmpdata = hex2bin($record);
			for ($k=0; $k<strlen($tmpdata); $k++){
				$out[$address+$k] = $tmpdata[$k];
			}
		break;
		case 1:
			// End of file, Done
			// Write the file out
			$tmpout = "";
			for ($k=0; $k<count($out); $k++){
				$tmpout .= $out[$k];
			}
			file_put_contents("hexout", $tmpout);
			echo "Finish";
			die();
		break;
		default:
			echo "Unknown Type: $type \n";
			echo "Line $i : $line \n";
		break;
	}
}
?>