<?php
// Empty string could be a key, add empty string key to all SIG
$SIG_DAY_FIRSTCHAR = array('M'=>1,'T'=>1,'W'=>1,'F'=>1,'S'=>1);
$SIG_MONTH_LASTCHAR = array('y'=>1,'h'=>1, 'l'=>1,'e'=>1,'t'=>1,'r'=> 1);
$SIG_DNA = array('A'=>1,'T'=>1,'C'=>1,'G'=>1);
$SIG_BOOLEAN = array('0'=>1,'1'=>1);
$SIG_DIGITS_01789 = array('0'=>1,'1'=>1,'7'=>1,'8'=>1,'9'=>1);
$SIG_HEX = array(0=>1,1=>1,2=>1,3=>1,4=>1,5=>1,6=>1,7=>1,8=>1,9=>1,'A'=>1,'B'=>1,'C'=>1,'D'=>1,'E'=>1,'F'=>1);
$SIG_BOOLEAN_CHAR = array('T'=>1,'F'=>1);
$SIG_PERIODIC = array('N'=>1,'H'=>1,'L'=>1,'B'=>1,'C'=>1,'O'=>1,'F'=>1,'M'=>1,'A'=>1,'S'=>1,'P'=>1,'K'=>1,'T'=>1,'V'=>1,'Z'=>1,'G'=>1);

$FORMAT_DAY_FIRSTCHAR = 1;
$FORMAT_MONTH_LASTCHAR = 2;
$FORMAT_DNA = 4;
$FORMAT_BOOLEAN = 5;
$FORMAT_DIGITS_01789 = 6;
$FORMAT_HEX = 7;
$FORMAT_BOOLEAN_CHAR = 8;
$FORMAT_PERIODIC = 9;
$FORMAT_UNKNOWN = 100;

/*
$data = file_get_contents("qn3_formaterror.txt");
$data = processData($data);
$keys = extractKeys($data);

$format = analyzeFormat($keys, true); // shows debug information
//$format = analyzeFormat($keys);
$DNA = getDNATable($data, $format);
//var_dump($DNA);
printFormat($format);
breakitdown($data,$format);
*/
//echo dgeh($format, 172972929);


function breakitdown($data,$format){
	global $FORMAT_DAY_FIRSTCHAR, $FORMAT_MONTH_LASTCHAR, $FORMAT_DIGITS_012345, $FORMAT_DNA, $FORMAT_BOOLEAN, $FORMAT_DIGITS_01789,
			$FORMAT_PERIODIC, $FORMAT_HEX, $FORMAT_BOOLEAN_CHAR, $FORMAT_UNKNOWN;
	
	$dna = getReverseDNATable($data,$format);
	$periodic = getReversePeriodicTable();
	foreach($data as $key => $val){
		$tmpkey = $key;
		$out = "";
		$show = true;
		$bs = decbin($val['timestamp']);
		while (strlen($bs)<32) $bs = '0'.$bs;
		for ($i=0; $i<count($format); $i++){
			$cur = $format[$i];
			switch($cur){
				case $FORMAT_DAY_FIRSTCHAR: 	
					$out .= $tmpkey[0]."\t";
					$tmpkey = substr($tmpkey,1);
					break;
				case $FORMAT_MONTH_LASTCHAR:
					$out .= $tmpkey[0]."\t";
					$tmpkey = substr($tmpkey,1);
					break;
				case $FORMAT_DNA:
					$curbits = substr($bs,0,2);
					$bs = substr($bs,2);
					$out .= $tmpkey[0]."($curbits)\t";
					$tmpkey = substr($tmpkey,1);					
					break;
				case $FORMAT_BOOLEAN: 			
					$curbits = substr($bs,0,3);
					$bs = substr($bs,3);
					$out .= $tmpkey[0]."($curbits)\t";
					$tmpkey = substr($tmpkey,1);
					break;
				case $FORMAT_BOOLEAN_CHAR:
					$curbits = substr($bs,0,1);
					$bs = substr($bs,1);
					$out .= $tmpkey[0]."($curbits)\t";
					$tmpkey = substr($tmpkey,1);
					break;
				case $FORMAT_DIGITS_01789:
					$out .= $tmpkey[0].$tmpkey[1]."\t";
					$tmpkey = substr($tmpkey,2);
					break;
				case $FORMAT_HEX:
					$curbits = substr($bs,0,4);
					$bs = substr($bs,4);
					//$out .= $tmpkey[0]."\t";
					$testhex = decbin(hexdec($tmpkey[0]));
					while(strlen($testhex) < 4) $testhex = '0'.$testhex;
					$out .= $testhex."($curbits)\t";
					if (strcmp($tmpkey[0], 6) == 0) $show = true;
					$tmpkey = substr($tmpkey,1);
					break;
				case $FORMAT_PERIODIC:
					$curbits = substr($bs,0,5);
					$bs = substr($bs,5);
					$b1 = extractPeriodicName($tmpkey);
					//$out .= $b1."\t";
					$testpe = decbin($periodic[$b1]);
					while(strlen($testpe) < 5) $testpe = '0'.$testpe;
					$out .= $testpe."($curbits)\t";
					$tmpkey = substr($tmpkey,strlen($b1));
					break;
			}
		}
		
		$dt = new DateTime('@'.$val['timestamp']);
		$binstr = decbin($val['timestamp']);
		while (strlen($binstr) < 32) $binstr = '0'.$binstr;
		
		//$out = $key."\t".$out.$binstr."\t".$dt->format('Y-m-d H:i:s U')."\n";
		$out = $key."\t".$out.$binstr."\n";
		if($show) echo $out;
	}
}

function analyzeFormat($keys, $showdebug = false){
	global 	$SIG_DAY_FIRSTCHAR, $SIG_MONTH_LASTCHAR, $SIG_DNA, $SIG_BOOLEAN, $SIG_DIGITS_01789, $SIG_HEX, $SIG_BOOLEAN_CHAR, $SIG_PERIODIC,
			$FORMAT_DAY_FIRSTCHAR, $FORMAT_MONTH_LASTCHAR, $FORMAT_DNA, $FORMAT_BOOLEAN, $FORMAT_DIGITS_01789, $FORMAT_PERIODIC,
			$FORMAT_HEX, $FORMAT_BOOLEAN_CHAR, $FORMAT_UNKNOWN;
			
	$REMOVE_NONE = 0;
	$REMOVE_1CHAR = 1;
	$REMOVE_PERIODIC = 2;
	$REMOVE_2CHAR = 3;
	$periodic = getReversePeriodicTable();
	$checkPeriodicNames = false;
	$keyhistory = array();
	$keyhistory[] = $keys;
	
	$count = 0;
	$format = array();
	$keylen = 1;
	$removeCode = $REMOVE_NONE;
	$testkey = $keys[0];
	while (strlen($testkey)>0){
		$count++;
		$keyhistory[] = $keys;
		$tmp = array();
		
		for ($i=0; $i<count($keys); $i++){
			$key = $keys[$i];
			$tmp[substr($key,0,$keylen)] = 1;
		}
		
		if ($showdebug){
			echo $count."\n";
			var_dump($tmp);
		}
		
		// Checking signature of keyspace
		if (isSubset($tmp, $SIG_BOOLEAN)){
			if ($showdebug) echo "Its BOOLEAN\n";
			$format[] = $FORMAT_BOOLEAN;
			$removeCode = $REMOVE_1CHAR;
		}
		else if (isSubset($tmp, $SIG_BOOLEAN_CHAR)){
			if ($showdebug) echo "Its BOOLEAN_CHAR\n";
			$format[] = $FORMAT_BOOLEAN_CHAR;
			$removeCode = $REMOVE_1CHAR;
		}
		else if (isSubset($tmp, $SIG_DAY_FIRSTCHAR)){
			if ($showdebug) echo "Its DAY_FIRSTCHAR\n";
			$format[] = $FORMAT_DAY_FIRSTCHAR;
			$removeCode = $REMOVE_1CHAR;
		}
		else if (isSubset($tmp, $SIG_MONTH_LASTCHAR)){
			if ($showdebug) echo "Its MONTH_LASTCHAR\n";
			$format[] = $FORMAT_MONTH_LASTCHAR;
			$removeCode = $REMOVE_1CHAR;
		}
		else if (isSubset($tmp, $SIG_DIGITS_01789)){
			if ($showdebug) echo "Its DIGITS_01789\n";
			$format[] = $FORMAT_DIGITS_01789;
			$removeCode = $REMOVE_2CHAR;
		}
		else if (isSubset($tmp, $SIG_DNA)){
			if ($showdebug) echo "Its DNA\n";
			$format[] = $FORMAT_DNA;
			$removeCode = $REMOVE_1CHAR;
		}
		else if (isSubset($tmp, $SIG_HEX)){
			if ($showdebug) echo "Its HEX\n";
			$format[] = $FORMAT_HEX;
			$removeCode = $REMOVE_1CHAR;
		}
		else if (isSubset($tmp, $SIG_PERIODIC)){
			if ($showdebug) echo "Its PERIODIC\n";
			$format[] = $FORMAT_PERIODIC;
			$removeCode = $REMOVE_PERIODIC;
		}
		else{
			// Last case is Unknown - Some error occured
			echo "Format Error!\n";
			$keys = $keyhistory[count($keyhistory)-2]; // restore the previous keys
			array_pop($format);// remove the last format value
			$checkPeriodicNames = true;			
		}
		
		// Consume characters from the key string
		if ($removeCode == $REMOVE_1CHAR){
			for ($k=0; $k<count($keys); $k++){
				$cur = $keys[$k];
				$cur = substr($cur,1);
				$keys[$k] = $cur;
			}
		}
		else if ($removeCode == $REMOVE_2CHAR){
			for ($k=0; $k<count($keys); $k++){
				$cur = $keys[$k];
				$cur = substr($cur,2);
				$keys[$k] = $cur;
			}
		}
		else if ($removeCode == $REMOVE_PERIODIC){
			for ($k=0; $k<count($keys); $k++){
				$cur = $keys[$k];
				$pname = extractPeriodicName($cur, $checkPeriodicNames);
				if ($showdebug) echo $pname,"\n";;
				$keys[$k] = substr($cur,strlen($pname));
			}
			if ($checkPeriodicNames) $checkPeriodicNames = false; // reset the flag
		}
		
		// refresh ending condition
		$testkey = $keys[0];
		$removeCode = $REMOVE_NONE;
		//echo $testkey."\n";
		//if ($count == 10) {var_dump($format); die();}
	}
	
	return $format;
}

function dgeh($format, $ts, $dna){
	global $FORMAT_DAY_FIRSTCHAR, $FORMAT_MONTH_LASTCHAR, $FORMAT_DNA, $FORMAT_BOOLEAN, $FORMAT_DIGITS_01789,
			$FORMAT_PERIODIC, $FORMAT_HEX, $FORMAT_BOOLEAN_CHAR, $FORMAT_UNKNOWN;
	$url = "";
	$periodicCount = 0;
	$hexCount = 0;
	$dt = new DateTime('@'.$ts); // Create DateTime object based on timestamp
	$bs = decbin(intval($ts)); // Get binary string of timestamp
	
	$periodic = getPeriodicTable();
	while (strlen($bs) < 32) $bs = '0'.$bs;
	
	// Start processing format
	for ($i=0; $i<count($format); $i++){
		$cur = $format[$i];
		switch($cur){
			case $FORMAT_DAY_FIRSTCHAR:
				// Append First character of day ('M' for 'Monday', etc..)
				// Does not consume bits;
				$url .= $dt->format('D')[0];
				break;
			case $FORMAT_MONTH_LASTCHAR:
				// Append Last character of Month ('y' for 'January', etc...)
				// Does not consume bits;
				$url .= substr($dt->format('F'), -1);
				break;
			case $FORMAT_DNA:
				// Consumes 2 bits
				// Represents them as DNA Sequence ATCG or ACGT
				$curbits = bindec(substr($bs,0,2));
				$bs = substr($bs,2);
				$url .= $dna[$curbits];
				break;
			case $FORMAT_BOOLEAN: 			
				// Consumes 3 bits
				// Performs a bitwise AND with all 3 bits, append the results
				$b1 = intval(substr($bs,0,1));
				$b2 = intval(substr($bs,1,1));
				$b3 = intval(substr($bs,2,1));
				if ($b1 == 1 && $b2 == 1 & $b3 == 1) $url .= '1';
				else $url .= '0';
				$bs = substr($bs,3);
				break;
			case $FORMAT_BOOLEAN_CHAR:
				// Consumes 1 bit
				// Appends T if 1, F if 0
				$b1 = intval(substr($bs,0,1));
				if ($b1 == 1) $url .= 'T';
				else $url .= 'F';
				$bs = substr($bs,1);
				break;
			case $FORMAT_DIGITS_01789:
				// Append the character in the Ten position of the Year ('8' for '1987', etc...)
				// Does not consume bits'
				$url .= $dt->format('Y')[2].'0';
				break;
			case $FORMAT_HEX:
				// Consumes 4 bits
				// Appends the hex representation of the 4 bits
				$curbits = strtoupper(dechex(bindec(substr($bs,0,4))));
				$url .= $curbits;
				$bs = substr($bs,4);
				break;
			case $FORMAT_PERIODIC:
				// Consumes 5 bits
				// Appends the base32 representation of the bits using Periodic Elements
				$curbits = bindec(substr($bs,0,5));
				$url .= $periodic[$curbits];
				$bs = substr($bs,5);
				break;
		}
	}
	return "http://".$url.".dgeh";
}

function isSameSig($sig1, $sig2){
	$diff1 = count(array_diff_key($sig1,$sig2));
	$diff2 = count(array_diff_key($sig2,$sig1));
	if ($diff1 == 0 && $diff2 == 0) return true;
	else return false;
}

function isSubset($sig1, $sig2){
	$diff = count(array_diff_key($sig1, $sig2));
	if ($diff == 0) return true;
	else return false;
}

function printFormat($format){
	global $FORMAT_DAY_FIRSTCHAR, $FORMAT_MONTH_LASTCHAR, $FORMAT_DNA, $FORMAT_BOOLEAN, $FORMAT_DIGITS_01789, $FORMAT_PERIODIC, $FORMAT_HEX, $FORMAT_BOOLEAN_CHAR;
	$out = "";
	echo "Total Elements in FORMAT: ".count($format)."\n";
	for ($i=0; $i<count($format); $i++){
		$cur = $format[$i];
		switch($cur){
			case $FORMAT_DAY_FIRSTCHAR: 	echo "[$i] Day_FirstChar\n"; break;
			case $FORMAT_MONTH_LASTCHAR: 	echo "[$i] Month_LastChar\n"; break;
			case $FORMAT_DNA: 				echo "[$i] DNA\n"; break;
			case $FORMAT_BOOLEAN: 			echo "[$i] Boolean\n"; break;
			case $FORMAT_BOOLEAN_CHAR: 		echo "[$i] Boolean Char\n"; break;
			case $FORMAT_DIGITS_01789: 		echo "[$i] Tenth Position in Year\n"; break;
			case $FORMAT_HEX:				echo "[$i] HEX\n"; break;
			case $FORMAT_PERIODIC: 			echo "[$i] Periodic\n"; break;
		}
	}
}

function getReversePeriodicTable(){
	$table = getPeriodicTable();
	$out = array();
	foreach($table as $key => $val){
		$out[$val] = $key;
	}
	return $out;
}

function getPeriodicTable(){
	$table = array();
	$table[0] = 'Nu'; // Null ?
	$table[1] = 'H';
	$table[2] = 'He';
	$table[3] = 'Li';
	$table[4] = 'Be';
	$table[5] = 'B';
	$table[6] = 'C';
	$table[7] = 'N';
	$table[8] = 'O';
	$table[9] = 'F';
	$table[10] = 'Ne';
	$table[11] = 'Na';
	$table[12] = 'Mg';
	$table[13] = 'Al';
	$table[14] = 'Si';
	$table[15] = 'P';
	$table[16] = 'S';
	$table[17] = 'Cl';
	$table[18] = 'Ar';
	$table[19] = 'K';
	$table[20] = 'Ca';
	$table[21] = 'Sc';
	$table[22] = 'Ti';
	$table[23] = 'V';
	$table[24] = 'Cr';
	$table[25] = 'Mn';
	$table[26] = 'Fe';
	$table[27] = 'Co';
	$table[28] = 'Ni';
	$table[29] = 'Cu';
	$table[30] = 'Zn';
	$table[31] = 'Ga';
	$table[32] = 'Ge';

	return $table;
}

function extractPeriodicName($str, $checkflag=false){
	$valid1stChar = "NHLBCOFMASPKTVZG";
	$valid2ndChar = "ueiaglrcno";
	$possible2nd = "NHLBMASCTFZG";
	
	$monthlastchar = "yhletr";
	$valid = getReversePeriodicTable();
	$name = "";
	//echo $str."\n";
	if (strpos($valid1stChar, $str[0]) !== false){
		$name .= $str[0];
		if (strpos($possible2nd, $str[0]) !== false){
			// Possible 2nd char
			
			if ($checkflag){
				// More stringent checks (Next signature should be monthlastchar)
				if (strlen($str) > 1 && strpos($monthlastchar, $str[1]) !== false){
					// 2nd char is a valid monthlastchar
					if (strlen($str) > 2 && strpos($monthlastchar, $str[2]) === false){
						// If next char is not a valid monthlastchar, dun take this char
						return $name;
					}
				}				
			}
			
			if (strlen($str) > 1 && strpos($valid2ndChar, $str[1]) !== false){
				// if 2nd char is valid, take it
				if (array_key_exists($name.$str[1], $valid)) $name .= $str[1];
				return $name;
			}
		}
	}
	if (strlen($name) > 0) return $name;
	else return false;
}

function getReverseDNATable($data, $format){
	$table = getDNATable($data, $format);
	$out = array();
	foreach($table as $key => $val){
		$out[$val] = $key;
	}
	return $out;
}

function getDNATable($data, $format){
	// Using the format, checks through all data and generate the correct DNATable
	global $FORMAT_DAY_FIRSTCHAR, $FORMAT_MONTH_LASTCHAR, $FORMAT_DNA, $FORMAT_BOOLEAN, $FORMAT_DIGITS_01789, $FORMAT_PERIODIC, $FORMAT_HEX, $FORMAT_BOOLEAN_CHAR;
	$found0 = false;
	$found1 = false;
	$found2 = false;
	$found3 = false;
	$allFound = false;
	
	foreach($data as $key => $val){
		$bs = decbin($val['timestamp']);
		$curkey = $key;
		while (strlen($bs)<32) $bs = '0'.$bs;
		/*
		var_dump($found0);
		var_dump($found1);
		var_dump($found2);
		var_dump($found3);
		*/
		for ($i=0; $i<count($format); $i++){
			$cur = $format[$i];
			switch($cur){
				case $FORMAT_DAY_FIRSTCHAR: 	
					$curkey = substr($curkey,1); // consumes 1 character
					break; 
				case $FORMAT_MONTH_LASTCHAR:
					$curkey = substr($curkey,1); // consumes 1 character
					break;
				case $FORMAT_DNA: 				
					$dnakey = substr($curkey,0,1);
					$curkey = substr($curkey,1); // consumes 1 character
					$dnabs = substr($bs,0,2);
					$bs = substr($bs,2); // consumes 2 bits
					
					if ($found0 === false){
						if (strcmp($dnabs, '00') == 0) $found0 = $dnakey;
					}
					if ($found1 === false){
						if (strcmp($dnabs, '01') == 0) $found1 = $dnakey;
					}
					if ($found2 === false){
						if (strcmp($dnabs, '10') == 0) $found2 = $dnakey;
					}
					if ($found3 === false){
						if (strcmp($dnabs, '11') == 0) $found3 = $dnakey;
					}
					break;
				case $FORMAT_BOOLEAN:
					$curkey = substr($curkey,1); // consumes 1 character
					$bs = substr($bs,3); // consumes 3 bits
					break; 
				case $FORMAT_BOOLEAN_CHAR:
					$curkey = substr($curkey,1); // consumes 1 character
					$bs = substr($bs,1); // consumes 1 bit
					break; 
				case $FORMAT_DIGITS_01789:
					$curkey = substr($curkey,2); // consumes 2 character
					break;
				case $FORMAT_HEX:
					$curkey = substr($curkey,1); // consumes 1 character
					$bs = substr($bs,4); // consumes 4 bits
					break; 
				case $FORMAT_PERIODIC:
					$pname = extractPeriodicName($curkey);
					$curkey = substr($curkey, strlen($pname)); // consumes 1 or 2 characters
					$bs = substr($bs,5); // consumes 5 bits
					break;
				default:
					echo "SOMETHING WRONG DNATABLE!!\n";
			}
		}
		
		if ($found0 !== false && $found1 !== false && $found2 !== false && $found3 !== false) {
			$allFound = true;
			break;
		}
	}
	
	$dnaTable = array();
	if ($allFound){
		$dnaTable[0] = $found0;
		$dnaTable[1] = $found1;
		$dnaTable[2] = $found2;
		$dnaTable[3] = $found3;
	}
	// For smaller sample size, if there is only 1 missing character, still possible to deduce the order
	else if ($found0 === false && $found1 !== false && $found2 !== false && $found3 !== false){
		$missing = dnaGetRemainingChar($found1.$found2.$found3);
		$dnaTable[0] = $missing;
		$dnaTable[1] = $found1;
		$dnaTable[2] = $found2;
		$dnaTable[3] = $found3;
	}
	else if ($found0 !== false && $found1 === false && $found2 !== false && $found3 !== false){
		$missing = dnaGetRemainingChar($found0.$found2.$found3);
		$dnaTable[0] = $found0;
		$dnaTable[1] = $missing;
		$dnaTable[2] = $found2;
		$dnaTable[3] = $found3;
	}
	else if ($found0 !== false && $found1 !== false && $found2 === false && $found3 !== false){
		$missing = dnaGetRemainingChar($found0.$found1.$found3);
		$dnaTable[0] = $found0;
		$dnaTable[1] = $found1;
		$dnaTable[2] = $missing;
		$dnaTable[3] = $found3;
	}
	else if ($found0 !== false && $found1 !== false && $found2 !== false && $found3 === false){
		$missing = dnaGetRemainingChar($found0.$found1.$found2);
		$dnaTable[0] = $found0;
		$dnaTable[1] = $found1;
		$dnaTable[2] = $found2;
		$dnaTable[3] = $missing;
	}
	else{
		return false;
	}
	return $dnaTable;
}

function dnaGetRemainingChar($chars){
	if (strlen($chars) < 3) return false;
	if (strpos('A',$chars) === false) return 'A';
	if (strpos('C',$chars) === false) return 'A';
	if (strpos('G',$chars) === false) return 'A';
	if (strpos('T',$chars) === false) return 'A';
}

function extractKeys($data){
	$keys = array();
	foreach($data as $key=>$val){
		$keys[] = $key;
	}
	return $keys;
}

function processData($input){
	$tmppos = strpos($input, '(');
	$input = substr($input,$tmppos);
	$tmppos = strrpos($input, ')', -10);
	$input = substr($input, 0, $tmppos);
	$input = trim($input);
	//echo $input."\n";
	$data = explode("\n", $input);
	$out = array();
	foreach($data as $str){
		$str = substr(trim($str),1);
		$str = substr($str,0,-1);
		$parts = explode(', ',$str);
		
		$key = stripDgehURL($parts[2]);
		$out[$key] = array();
		$out[$key]['timestamp'] = $parts[0];
		$dt = substr($parts[1],1);
		$dt = substr($dt,0,-1);
		$out[$key]['datetime'] = $dt;
	}

	return $out;
}
function stripDgehURL($str){
	$tmppos = strpos($str, 'http://') + 7;
	$out = substr($str,$tmppos);
	$tmppos = strpos($out, '.dgeh');
	$out = substr($out,0,$tmppos);
	return $out;
}
?>