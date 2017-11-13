<?php
include('dgeh.php');
$url = "35.165.59.122";
$port = "9001";
$readsize = 8192;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
    die();
}
$result = socket_connect($socket, $url, $port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
    die();
}

$qnCount = 0;
$data = readAll($socket);
while (strpos($data, "PAN{") === false){
	$qnCount++;
	echo $data."\n";
	if ($qnCount<6) file_put_contents("qn$qnCount.txt",$data);
	//if ($qnCount == 3) break;
	
	$start = strrpos($data, '(')+1;
	$end = strrpos($data, ')',$start);
	$qnts = substr($data,$start,$end-$start);
	$qnts = intval($qnts);
	
	$data = processData($data);
	$keys = extractKeys($data);
	//$format = analyzeFormat($keys, true); // shows debug information
	$format = analyzeFormat($keys);
	$DNATable = getDNATable($data,$format);
	
	$answer = dgeh($format, $qnts, $DNATable);
	echo "$qnCount: Answering $answer \n";
	socket_write($socket, $answer, strlen($answer));
	
	/*
	// For checking analyzeFormat function is working correctly
	foreach($data as $key => $val){		
		$keycheck = "http://".$key.".dgeh";
		$myres = dgeh($format, $val['timestamp'], $DNATable);
		$chksame = strcmp($keycheck, $myres);
		$result = "WRONG!!!";
		if ($chksame == 0) $result = "Yup";
		else{
			//echo bin2hex($keycheck)."\n";
			//echo bin2hex($myres)."\n";
		}
		echo "$key\t$myres\t$result\n";
	}
	die();
	*/
	
	$data = readAll($socket);
}
echo $data."\n";

socket_close($socket);

function readAll($sock){
	$r = array();
	$r[] = $sock;
	$w = array();
	$e = array();
	$res = socket_select($r, $w, $e, 2);

	$data = "";
	$try = 0;
	while ($res != false){
		$try++;
		if ($try >= 5) break;
		//echo "looping\n";
		$tmp = "";
		socket_recv($sock, $tmp, 8192, 0);
		$data .= $tmp;
		$res = socket_select($r, $w, $e, 2);
	}

	return $data;
}
?>