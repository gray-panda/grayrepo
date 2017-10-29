<?php
//baseline cb0920b84a00b930aab336018ac9d90a000cd02010aac091d010aaaa009a0aac

$a = genPossibleKeys("possiblekeys");

for ($i=0; $i<count($a); $i++){
	$pos = "";
	for ($k=0; $k<count($a[$i]); $k++){
		$pos .= $a[$i][$k];
	}
	echo "$i: $pos\n";
}

function genPossibleKeys($fname){
	$keys = array();

	$data = explode("\n",trim(file_get_contents($fname)));
	for ($i=0; $i<count($data); $i++){
		$line = $data[$i];
		$parts = explode(" ",$line);
		
		$charindex = intval($parts[1]);
		$poskey = $parts[2];
		
		if (array_key_exists($charindex, $keys)) $keys[$charindex][] = $poskey;
		else{
			$keys[$charindex] = array();
			$keys[$charindex][] = $poskey;
		}
	}
	
	return $keys;
}
?>