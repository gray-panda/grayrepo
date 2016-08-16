<?php
$treasures = array();
$treasures[] = strrev(base64_decode("bm9lZ251ZA==")); 	// dungeon
$treasures[] = strrev(base64_decode("aHRuaXJ5YmFs"));	// labyrinth
$treasures[] = strrev(base64_decode("bGl2ZQ=="));		// evil
$treasures[] = strrev(base64_decode("bGF0c3lyYw=="));	// crystal
$treasures[] = strrev(base64_decode("c2VkYWg="));		// hades
$treasures[] = strrev(base64_decode("ZWl3b2I="));		// bowie
$treasures[] = strrev(base64_decode("ZWNhcHM="));		// space
$treasures[] = strrev(base64_decode("ZXJ1c2FlcnQ="));	// treasure
$treasures[] = strrev(base64_decode("dG9vbA=="));		// loot
$treasures[] = strrev(base64_decode("dHNvbA=="));		// lost
$treasures[] = strrev(base64_decode("ZXphbQ=="));		// maze
$treasures[] = strrev(base64_decode("dGVyY2Vz"));		// secret


for ($a=0; $a<count($treasures); $a++){
	for ($b=0; $b<count($treasures); $b++){
		$url = "http://pan";
		$url .= $treasures[$a];
		$url .= $treasures[$b];
		$url .= ".com";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		echo "Trying $url... \n";
		$res = curl_exec($ch);
		if ($res !== false){
			echo $res."\n";
			echo "from $url \n";
		}
		curl_close($ch);
	}
}

// Trying http://panspacedungeon.com... 
// M4z3Cub3
?>