<?php
$distanceInit = 99999; // Initial value to set to distance of all nodes

function startDijkstra($map){
	$maze = parseMaze($map);
	echo "Calculating shortest path for: \n";
	echo printMaze($maze)."\n";
	$distance = initializeMaze($maze);

	$reached = false;
	$visited = 0;
	while (!$reached){
		$res = dijkstraStep($maze, $distance, $visited);
		$distance = $res[0];
		$visited = $res[1];
		$reached = $res[2];
	}

	//echo "*****Distance Map*****\n";
	//echo printDistance($distance)."\n";
	//echo "**********************\n";

	$end = findEnd($distance);
	$done = false;
	$route = "";
	while (!$done){
		$res = buildRoute($distance, $end[0], $end[1], count($maze)-1, count($maze[0])-1);
		$end = $res[0];
		$route = $res[1].$route;
		$done = $res[2];
	}

	//echo "Route Calculated!!\n";
	//echo printMaze($maze)."\n";
	//echo "Shortest Route:\n";
	//echo $route."\n";
	return $route;
}

function dijkstraStep($maze, $distance, $visited = 0){
	$reachedEnd = false;
	if ($visited === 0){
		// first run
		$visited = array();
	}
	
	$min = mazeFindMin($distance, $visited);
	$curNodeVal = $min[0];
	$curNode = array($min[1][0], $min[1][1]);
	//echo "$curNodeVal [$curNode[0],$curNode[1]]\n";
	
	$neighbours = mazeGetNeighbours($curNode[0], $curNode[1], count($maze)-1, count($maze[0])-1);
	for ($i=0; $i<count($neighbours); $i++){
		$curNeighbour = $neighbours[$i];
		$symbol = $maze[$curNeighbour[0]][$curNeighbour[1]];
		$num = parseMazeSymbol($symbol);
		if ($num === false){
			echo "Error parsing maze symbol!! Killing... ($symbol)\n";
			die();
		}
		if ($num === -999){
			// End Node
			$distance[$curNeighbour[0]][$curNeighbour[1]] = 'X';
			//echo "End Node Reached!!\n";
			return array($distance, $visited, true);;
		}
		// Calculate distance going through this node, saved if is lesser than current distance
		$newval = $curNodeVal + $num;
		if ($newval < $distance[$curNeighbour[0]][$curNeighbour[1]]){
			$distance[$curNeighbour[0]][$curNeighbour[1]] = $newval;
		}
	}
	//echo printDistance($distance, $curNode);
	//echo "-------------------------------------------------\n";
	$nodeid = $curNode[0].'_'.$curNode[1];
	$visited[$nodeid] = 1;
	return array($distance, $visited, false);
}

function mazeFindMin($distance, $visited){
	//var_dump($visited);
	$min = 999;
	$minpos = array();
	for ($i=0; $i<count($distance); $i++){
		$curline = $distance[$i];
		for ($j=0; $j<count($curline); $j++){
			if (checkVisited($visited, $i, $j)) continue;
			$cur = $curline[$j];
			if ($cur < $min){
				$min = $cur;
				$minpos[0] = $i;
				$minpos[1] = $j;
			}
		}
	}
	return array($min, $minpos);
}

function mazeGetNeighbours($i, $j, $maxi, $maxj){
	//echo "Finding neighbours for [$i,$j] ($maxi,$maxj)\n";
	$neighbours = array();
	// North neighbour
	if ($i > 0) $neighbours[] = array($i-1, $j);
	// South neighbour
	if ($i < $maxi) $neighbours[] = array($i+1,$j);
	// West neighbour
	if ($j > 0) $neighbours[] = array($i, $j-1);
	// East neighbour
	if ($j < $maxj) $neighbours[] = array($i, $j+1);
	return $neighbours;
}

function checkVisited($visited,$i,$j){
	$nodeid = $i.'_'.$j;
	return array_key_exists($nodeid, $visited);
}

function parseMaze($in){
	// Parses the input data and return a 2D-array of maze symbols
	$maze = array();
	$lines = explode("\n",$in);
	$start = array();
	$end = array();
	for ($i=0; $i<count($lines); $i++){
		$maze[$i] = array();
		$curline = trim($lines[$i]);
		for ($j=0; $j<strlen($curline); $j++){
			$cur = $curline[$j];
			$maze[$i][$j] = $cur;
		}
	}
	return $maze;
}

function initializeMaze($maze){
	global $distanceInit;
	$distance = array();
	for ($i=0; $i<count($maze); $i++){
		$curline = $maze[$i];
		$distance[$i] = array();
		for ($j=0; $j<count($curline); $j++){
			$cur = $curline[$j];
			if (strcmp($cur, '>') == 0) $distance[$i][$j] = 0;
			else $distance[$i][$j] = $distanceInit;
		}
	}
	return $distance;
}

function printMaze($maze){
	$out = '';
	for ($i=0; $i<count($maze); $i++){
		$curline = $maze[$i];
		for ($j=0; $j<count($curline); $j++){
			$cur = $curline[$j];
			$out .= $cur;
			//$sym = getMazeSymbol($cur);
			//$out .= $sym;
		}
		$out .= "\n";
	}
	return $out;
}

function printDistance($distance, $curNode = false){
	$out = "";
	for ($i=0; $i<count($distance); $i++){
		$curline = $distance[$i];
		for ($j=0; $j<count($curline); $j++){
			$cur = $curline[$j];
			if ($curNode !== false && $i == $curNode[0] && $j == $curNode[1]){
				$out .= "[".$cur."]\t";
			}
			else{
				if ($cur === 99999) $out .= "?\t";
				else $out .= $cur."\t";
			}
		}
		$out .= "\n";
	}
	return $out;
}

function parseMazeSymbol($sym){
	if (strcmp($sym, '#') == 0) return 999;			// Wall
	else if (strcmp($sym, ' ') == 0) return 1;		// Space
	else if (strcmp($sym, '>') == 0) return 0;		// Start Position
	else if (strcmp($sym, 'X') == 0) return -999;	// End Position
	else return false;	// unknown
}

function getMazeSymbol($num){
	switch($num){
		case 0:
			return '>';
			break;
		case -999:
			return 'X';
			break;
		case 1:
			return ' ';
			break;
		case 999:
			return '#';
			break;
		default:
			return '?';
	}
}

// Final route calculation functions

function findEnd($distance){
	for ($i=0; $i<count($distance); $i++){
		$curline = $distance[$i];
		for ($j=0; $j<count($curline); $j++){
			$cur = $curline[$j];
			if (strcmp($cur, 'X') == 0) return array($i,$j);
		}
	}
}

function buildRoute($distance, $i, $j, $maxi, $maxj){
	//echo "Building Node $i,$j\n";
	$direction = "";
	$minNode = 0;
	$min = 999;
	// Check north
	if ($i > 0){
		$tmp = $distance[$i-1][$j];
		if (strcmp($tmp,'X') != 0){
			if ($tmp < $min){
				$min = $tmp;
				$direction = "V";
				$minNode = array($i-1, $j);
			}
		}		
	}
	// Check south
	if ($i < $maxi){
		$tmp = $distance[$i+1][$j];
		if (strcmp($tmp,'X') != 0){
			if ($tmp < $min){
				$min = $tmp;
				$direction = "^";
				$minNode = array($i+1, $j);
			}
		}
	}
	// Check west
	if ($j > 0){
		$tmp = $distance[$i][$j-1];
		if (strcmp($tmp,'X') != 0){
			if ($tmp < $min){
				$min = $tmp;
				$direction = ">";
				$minNode = array($i, $j-1);
			}
		}
	}
	// Check east
	if ($j < $maxj){
		$tmp = $distance[$i][$j+1];
		if (strcmp($tmp,'X') != 0){
			if ($tmp < $min){
				$min = $tmp;
				$direction = "<";
				$minNode = array($i, $j+1);
			}
		}		
	}
	
	//var_dump($minNode);
	//var_dump($direction);
	//echo "__________________\n";
	
	if ($min == 0) return array($minNode, $direction, true);
	else return array($minNode, $direction, false);
}

/*
Basic maze loop
	for ($i=0; $i<count($maze); $i++){
		$curline = $maze[$i];
		for ($j=0; $j<count($curline); $j++){
			$cur = $curline[$j];
			
		}
	}
*/

/*
Find the path to your goal...
For example, given this maze:
###########
#>  #     #
# # # #####
#   #     #
# ##### # #
#     # # #
##### #X# #
# #   # # #
# # ##### #
#         #
###########

The solution would be: VVVV>>>>VV<<VV>>>>>>^^^^^^<<VVV
*/
/*
$data = "
###########
#>  #     #
# # # #####
#   #     #
# ##### # #
#     # # #
##### #X# #
# #   # # #
# # ##### #
#         #
###########";

$data = "
#############################
#>  #     #               # #
# ##### # ####### ####### # #
#       # #     # #     #   #
######### # ### # ### ##### #
#   #     #   # #   # #     #
# # # ####### # ### # # #####
# # #         # #   # #     #
# # ########### # ### # #####
# #       #   # #   #   #   #
# ### ### # # # # # ##### # #
# # # # # # # # # #       # #
# # # # # # # # ### ####### #
#   # #     # #   #   #     #
##### ####### ### # ### ### #
#   #   #   #   # # #   # # #
# # ### # ### ### # # ### # #
# #     #     #   # # #     #
# ####### ##### ##### #######
# #         #   #     #     #
# ########### ### # # # ### #
# #   #       #   # # #   # #
# # # # ########### ### ### #
# # #   #     #   #     #   #
# # ##### ### # # ####### ###
# #   #   # # # #       #   #
# ### # ### # # ####### ### #
#       #       #     X     #
#############################";
*/
?>