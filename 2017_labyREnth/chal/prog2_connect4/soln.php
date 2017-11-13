<?php
/*
Conenct 4 Solver downloaded from https://github.com/kevinAlbs/Connect4
Original code was for a 7x7 board.
Had to edit it to support a 6x7 board in C4AI_6x7.php

Expected input is a string representing spaces from top to bottom, left to right
0 = Empty
1 = Player
2 = Opponent

You've done a thing!
You did it again! Congratz! PAN{0ld_g4mz_4r3_b3st_g4mz}
*/
//include('C4AI.php');
include('C4AI_6x7.php');
$url = "52.40.187.77";
$port = "16000";
$readsize = 8192;

$sock = fsockopen($url, $port);
if ($sock === false){
	echo "socket_connect failed...\n";
	socket_close($sock);
	die();
}

$data = fread($sock, $readsize);
if ($data === false){
	echo "socket_read failed...\n";
	socket_close($sock);
	die();
}

while (strpos($data, "Skeelz") !== false){
	echo $data."\n";
	$board = parseBoard($data);
	//echo $board."\n";
	$mymove = getBestMove($board);
	echo $mymove."\n";
	fwrite($sock, $mymove);
	fflush($sock);
	$data = fread($sock, $readsize);
}

echo $data."\n";

fclose($sock);

function parseBoard($data){
	$tmp = substr($data,strpos($data, "Skeelz"));
	$tmp = explode("\n",$tmp);
	$rows = array();
	for ($i=0; $i<6; $i++){
		$rows[] = $tmp[(4+($i*2))];
	}
	//$board = "0000000"; // 0 empty, 1 player, 2 opponent
	$board = ""; // 0 empty, 1 player, 2 opponent
	for ($i=0; $i<count($rows); $i++){
		$currow = $rows[$i];
		$parts = explode('|', $currow);
		for ($j=1; $j<count($parts)-1; $j++){
			$part = $parts[$j];
			//var_dump($part);
			if (strpos($part, "x") !== false){
				$board .= "1";
			}
			else if (strpos($part, "o") !== false){
				$board .= "2";
			}
			else {
				$board .= "0";
			}
		}
	}
	return $board;
}

function getMoves($rawboard){
	$board = array_chunk(str_split($rawboard), 7);
	$ai = C4AI::getInstance();
	$ai->printBoard($board);
	$moves = $ai->findAllMoves($board, "1");
	return $moves;
}

function getBestMove($rawboard){
	$board = array_chunk(str_split($rawboard), 7);
	$ai = C4AI::getInstance();
	$ai->printBoard($board);
	$moves = $ai->findBestMove($board, "1");
	return $moves;
}

function evaluateMoves($moves){
	$validMoves = array();
	$max = -9999;
	for ($i=0; $i<count($moves); $i++){
		$cur = $moves[$i];
		if ($cur > $max){
			$max = $cur;
			$validMoves = array();
			$validMoves[] = $i;
		}
		if ($cur == $max){
			$validMoves[] = $i;
		}
	}

	if (count($validMoves) < 1) return false;
	if (count($validMoves) == 1) return $validMoves[0];
	else return max($validMoves);
}
?>