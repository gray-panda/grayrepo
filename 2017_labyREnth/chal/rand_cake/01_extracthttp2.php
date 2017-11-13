<?php
include('http2.php');
$data = file_get_contents('http2.stream');
$frames = array();
$streams = array();

$i = 0;
while (strlen($data) > 0){
	$i++;
	if (checkHTTP2Magic($data)) $data = substr($data,getHTTP2MagicSize());
	$size = getHTTP2FrameSize($data);
	$frame = substr($data,0,$size+9);
	$frame = new HTTP2_FRAME($frame);
	$frame->printme();
	$frames[] = $frame;
	$data = substr($data, $size+9);
	echo "Remaining ".strlen($data)."\n";
}

//echo "Total HTTP2 Frames: ".count($frames)."\n";

for ($i=0; $i<count($frames); $i++){
	$cur = $frames[$i];
	$type = $cur->type;
	if ($type === 0){
		$sid = $cur->streamid;
		if (!array_key_exists($sid, $streams)) $streams[$sid] = "";
		$streams[$sid] .= $cur->data;
	}
}

foreach($streams as $id => $value){
	file_put_contents("streams_$id", $value);
}

function testData($data){
	$tmp = substr($data,0,16);
	echo "Test: ".bin2hex($tmp)."\n";
}

// use pyi-archive-viewer to view streams_13
// x <name> to extract specific object
?>