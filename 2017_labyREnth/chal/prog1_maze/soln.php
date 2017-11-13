<?php
include('dijkstra.php');
$url = "54.69.145.229";
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

//echo "Received:\n$data\n";
$marker = "Now go!";
$pos = strpos($data,$marker) + strlen($marker) + 2;
$map = trim(substr($data,$pos));
echo "Solving 1\n";
//echo $map."\n";
$route = startDijkstra($map);
echo "Sending:\n$route\n\n";
fwrite($sock, $route);
fflush($sock);

$data = fread($sock, $readsize);
$marker = "Now solve dis...";
$pos = strpos($data,$marker);
$count = 0;
while ($pos !== false){
	$count++;
	$pos += strlen($marker) + 2;
	$map = trim(substr($data,$pos));
	echo "Solving $count\n";
	//echo $map."\n";
	$route = startDijkstra($map);
	echo "Sending:\n$route\n\n";
	fwrite($sock, $route);
	fflush($sock);

	$data = fread($sock, $readsize);
	$marker = "Now solve dis...";
	$pos = strpos($data,$marker);
}

echo $data."\n";
fclose($sock);
// You're aMAZEing! (See what we did there? hehehe) PAN{my_f1rst_labyM4z3.jpeg}
?>