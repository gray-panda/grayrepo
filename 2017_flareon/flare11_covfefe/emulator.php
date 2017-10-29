<?php
// Runs only on 64bit php

$buffer = file_get_contents("covfefe_00403000.mem");

$printtrace = true; // change to false to just see inputs/outputs
$count = 0;
$pc = 0x463;
//$input = "subleq_and_reductio_ad_absurdum\n";
$input = "ABC\n";
$inputcount = 0;

while ($pc <= 0x1100){
	$doPrint = deref(0x4);
	if ($doPrint > 0){
		$printchar = chr(deref(0x2));
		if (!$printtrace) echo $printchar;
		else echo "Printing '$printchar'\n";
		writeback(0x2,0);
		writeback(0x4,0);
	}
	
	$doInput = deref(0x3);
	if ($doInput > 0){
		$inputchar = $input[$inputcount++];
		if (!$printtrace) echo $inputchar;
		else echo "Input '$inputchar'\n";
		writeback(0x1, ord($inputchar));
		writeback(0x3,0);
	}
	
	$pc = dostuffs($pc, $printtrace);
	$count++;
	//if ($count == 5) die();
}

function doStuffs($pc, $printtrace=true){
	global $buffer;
	
	if ($pc == 0xf22) file_put_contents("buffer.tmp",$buffer);
	
	$outmsg = "";
	$p1 = deref($pc);
	$p2 = deref($pc+1);
	$p3 = deref($pc+2);
	
	$pchex = "0x".dechex($pc);
	$p1hex = "0x".dechex($p1);
	$p2hex = "0x".dechex($p2);
	$p3hex = "0x".dechex($p3);
	
	$num = deref($p2);
	//echo $num."\n";
	//$num -= deref($p1);
	$num = ($num - deref($p1)) & 0xffffffff;
	writeback($p2, $num);
	$numhex = "0x".dechex($num);
	if (isNegative($num)) $num |= 0xffffffff00000000; // For beautifying output on 64bit php
	
	$instruction = "[$p2hex] = $num ($numhex)";
	//$instruction = "[$p2hex] = $num";
	$outmsg = beautify("$pchex:");
	$outmsg .= beautify("$p1hex");
	$outmsg .= beautify("$p2hex");
	$outmsg .= beautify("$p3hex");
	$outmsg .= $instruction;
	//$outmsg = "$pchex:\t\t$p1hex\t\t$p2hex\t\t$p3hex\t\t".$instruction;
	
	// p3 is a branch jump location
	// jumps if deref(p2) <= 0
	$ret = $pc+3;
	if ($p3 !== 0){
		$jmpcond = deref($p2);
		//var_dump($jmpcond);
		if ($jmpcond == 0 || isNegative($jmpcond)){ 
			// Take the jump only when p3 is not zero and deref(p2) is < zero (terminating null character)
			// To handle printing
			$ret = $p3;
			$outmsg .= ", jmp $p3hex";
		}
	}
	
	$outmsg .= "\n";
	if ($printtrace) echo $outmsg;
	return $ret;
}

function writeback($addr, $num){
	global $buffer;
	
	$msg = pack("V", $num);
	$buffer[offset($addr)] = $msg[0];
	$buffer[offset($addr)+1] = $msg[1];
	$buffer[offset($addr)+2] = $msg[2];
	$buffer[offset($addr)+3] = $msg[3];
}

function deref($addr){
	global $buffer;
	
	return unpack("V", substr($buffer,offset($addr),4))[1];
}

function offset($index){
	return ($index*4)+8;
}

function tohex($bin){
	$tmp = dechex(ord($bin));
	while (strlen($tmp) < 2) $tmp = '0'.$tmp;
	return $tmp;
}

function beautify($msg){
	while (strlen($msg) < 8) $msg .= " ";
	return $msg;
}

function isNegative($num){
	// Helper function to determine a negative number in a 32bit int on 64bit php
	$test = $num & 0x80000000;
	if ($test != 0) return true;
	return false;
}
?>