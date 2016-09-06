<?php
/*
Flag is
Month 12 Day 13 Hour 10 MajorV 5 MinorV 1 DbgBit 1 Lang 8 
 PAN{th0se_puPP3ts_creeped_m3_out_and_I_h4d_NIGHTMARES} 
*/

/*
00030000  BA AF 4D 55 3C E3 03 22 B0 DF F3 D3 57 D0 E1 40  КЏMU<у."АпѓгWас@  
00030010  F9 13 1F BA 8D 12 F1 FF 48 C2 8E 00 FD 54 97 9D  љ..К..ёџHТ..§T..  
00030020  75 71 30 8F 43 28 FE 69 36 47 8F A2 EF 49 74 7C  uq0.C(ўi6G.ЂяIt|  
00030030  E1 4C 6F 4F D4 82 00 00 00 00 00 00 00 00 00 00  сLoOд...........  

00020000  62 30 30 21 34 76 53 42 41 6A 66 00 00 00 00 00  b00!4vSBAjf.....  

*/

$encflag = array(
	0xBA, 0xAF, 0x4D, 0x55, 0x3C, 0xE3, 0x03, 0x22, 0xB0, 0xDF, 0xF3, 0xD3, 0x57, 0xD0, 0xE1, 0x40,
	0xF9, 0x13, 0x1F, 0xBA, 0x8D, 0x12, 0xF1, 0xFF, 0x48, 0xC2, 0x8E, 0x00, 0xFD, 0x54, 0x97, 0x9D,
	0x75, 0x71, 0x30, 0x8F, 0x43, 0x28, 0xFE, 0x69, 0x36, 0x47, 0x8F, 0xA2, 0xEF, 0x49, 0x74, 0x7C,
	0xE1, 0x4C, 0x6F, 0x4F, 0xD4, 0x82);


/*
Key format
0-3 : 62 30 30 21 (b00!)
4: Month - 12 values (1-12) +2d (2E - 39)
5: Day - 31 values (1-31) +5e (5F - 7D)
6: Hour - 24 values (0-23)  +42 (42 - 59)
7: Major Version  +3C
8: Minor Version +3f
9: Debugger Bit 2 values (0 or 1) (69 or 6A)
A: Language Locale 6 values (0x0c, 0x14, 0x00, 0x08, 0x10, 0x04) +5e
*/
$validLang = array(0x0c, 0x14, 0x00, 0x08, 0x10, 0x04);
for ($month = 1; $month <= 12; $month++){
	//$month = 7;
	for ($day=1; $day<=31; $day++){
		echo "Month $month Day $day\n";
		//$day = 24;
		for ($hour=0; $hour<=23; $hour++){
			//$hour = 17;
			for ($majorV=0; $majorV<=10; $majorV++){
				//$majorV = 6;
				for ($minorV=0; $minorV<=10; $minorV++){
					//$minorV = 2;
					for ($debugbit=0; $debugbit<=1; $debugbit++){
						//$debugbit = 1;
						for ($lang=0; $lang<=5; $lang++){
							//$lang = 0x08;
							
							$key = array(0x62, 0x30, 0x30, 0x21);
							$key[] = $month + 0x2D;
							$key[] = $day + 0x5E;
							$key[] = $hour + 0x42;
							$key[] = $majorV + 0x3C;
							$key[] = $minorV + 0x3F;
							$key[] = $debugbit + 0x69;
							$key[] = ($validLang[$lang]+0x5E) & 0xff;
							//var_dump($key);
							
							$sbox = initSBox($key);
							$result = decrypt($encflag, $sbox);
							if (strpos($result, "PAN") !== false){
								echo $result."\n";
								$log = "Month $month Day $day Hour $hour MajorV $majorV MinorV $minorV DbgBit $debugbit Lang $validLang[$lang] \n $result \n";
								file_put_contents("yay.txt",$log, FILE_APPEND);
							}
						}
					}
				}
			}
		}
	}
}
echo "Done";


//$key = "b00!4vSBAjf";
/*
Resulting Decryption
00030000  DF EF 15 2C 33 FB 21 CF 3E 76 D1 D5 27 3C A6 31  пя.,3ћ!Я>vбе'<І1  
00030010  82 88 21 10 2A 03 67 EB 60 35 DE E8 52 CA E6 A0  ..!.*.gы`5ошRЪц   
00030020  56 5F 4B 5C D6 20 39 69 DD E0 E1 30 CB DA 70 86  V_K\ж 9iнрс0Ыкp.  
00030030  71 26 A0 5C C4 15 00 00 00 00 00 00 00 00 00 00  q& \Ф...........  
*/
/*
$key = array(0x62, 0x30, 0x30, 0x21, 0x34, 0x76, 0x53, 0x42, 0x41, 0x6a, 0x66);
$sbox = initSBox($key);
printSBox($sbox);
echo decrypt($encflag, $sbox, true);
*/


function initSBox($key){
	$sbox = array();
	for ($i=0; $i<0x100; $i++){
		$sbox[] = $i;
	}
	
	$bl = 0;
	for ($i=0; $i<count($sbox); $i++){
		$keychar = $key[$i % count($key)];
		$al = $sbox[$i];
		$bl += $keychar;
		$bl += $al;
		$bl &= 0xff;
		$ah = $sbox[$bl];
		$sbox[$i] = $ah;
		$sbox[$bl] = $al;
	}
	
	return $sbox;
}

function decrypt($enc, $sbox, $outhex=false){
	$out = array();
	$al = 0;
	for ($i=1; $i<=count($enc); $i++){
		$dl = $sbox[$i];
		$al += $dl;
		$al &= 0xff;
		$cl = $sbox[$al];
		$sbox[$i] = $cl;
		$sbox[$al] = $dl;
		
		$cl += $dl;
		$cl &= 0xff;
		$cl = $sbox[$cl];
		$out[] = $enc[$i-1] ^ $cl;
	}
	
	$ret = "";
	for ($i=0; $i<count($out); $i++){
		if ($outhex)$ret .= dechex($out[$i]);
		else $ret .= chr($out[$i]);
	}
	return $ret;
}

function printSBox($box){
	for ($i=0; $i<16; $i++){
		for ($k=0; $k< 16; $k++){
			echo dechex($box[($i*16) + $k])." ";
		}
		echo "\n";
	}
}
?>