<?php
$data = file_get_contents("15_SwfLoader.Run_challenge1.bin");

echo proudBelly($data, "HEAPISMYHOME");

function proudBelly($param1, $param2){
	// param1 is byte array
	// param2 is a string
	
	$loc3 = substr($param1, 16);
	// should make param2 to utf8 first
	$loc4 = $param2 . substr($param1,0,16);
	$loc5 = md5($loc4);
	$loc6 = 0;
	$loc7 = 0;
	$loc8 = 0;
	$loc9 = array();
	$loc10 = 0;
	$loc11 = "";
	
	while ($loc7 < 256){
		$loc9[] = $loc7;
		$loc7++;
	}
	
	$loc7 = 0;
	while ($loc7 < 256){
		$loc10 = $loc10 + $loc9[$loc7] + ord($loc5[$loc7 % strlen($loc5)]) & 0xff;
		$loc6 = $loc9[$loc7];
		$loc9[$loc7] = $loc9[$loc10];
		$loc9[$loc10] = $loc6;
		$loc7++;
	}
	
	$loc7 = 0;
	$loc10 = 0;
	$loc8 = 0;
	while ($loc8 < strlen($loc3)){
		//if ($loc8 % 0x5000 == 0) echo "At ".dechex($loc8)." ...\n";
		$loc7 = ($loc7 + 1) & 0xff;
		$loc10 = ($loc10 + $loc9[$loc7]) & 0xff;
		$loc6 = $loc9[$loc7];
		$loc9[$loc7] = $loc9[$loc10];
		$loc9[$loc10] = $loc6;
		
		$loc11 .= chr($loc3[$loc8] ^ $loc9[($loc9[$loc7] + $loc9[$loc10]) & 0xff]);
		$loc8++;
	}
	
	return $loc11;
}

?>