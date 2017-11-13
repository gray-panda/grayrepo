<?php
$dirname = "responses/";
$hashes = array();
$dir = new DirectoryIterator($dirname);
foreach ($dir as $fileinfo) {
    if (!$fileinfo->isDot()) {
    	$fname = $fileinfo->getFilename();
        $data = file_get_contents($dirname.$fname);
        $hash = md5($data);
        $hashes[$hash] = $fname;
    }
}

$logdirname = "logs/";
$logdir = new DirectoryIterator($logdirname);
foreach($logdir as $loginfo){
	$logname = $loginfo->getFilename();
	$data = file_get_contents($logdirname.$logname);
	$hash = md5($data);
	if (array_key_exists($hash, $hashes)){
		unlink($logdirname.$logname);
	}
}
?>