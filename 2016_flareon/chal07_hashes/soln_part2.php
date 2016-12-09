<?php
$correct = "3cab2465e955b78e1dc84ab2aad1773641ef6c294a1bf8bd1e91f3593a6ccc9cc9b2d5682e62244f9e6061a36250e1c47e69f0312db4e561528a1fb506046b721e18e20b841f497e257753b2314b866ccc720842d0884da08e26d9fccb24bc9c27bd254e";

$charset = 'abcdefghijklmnopqrstuvwxyz@-._1234';
$hashes = str_split($correct,40);
$plain = array("","","","flare-","on.com");
$count = 0;

$found0 = false;
$found1 = false;
$found2 = false;

// Brute force the shit
$timestart = time();
brute($hashes, 6, 0, "")."\n";
$timeend = time();

$timetaken = $timeend - $timestart;

echo "Flag is : ";
for ($i=0; $i<count($plain); $i++){
	echo $plain[$i];
}
echo " ($timetaken s) \n";

function brute($target, $targetlen, $curlen, $curstr){
	global $charset;
	
	if ($curlen >= $targetlen){ // termination condition
		checkHash($curstr);
		return checkAllFound();
	}
	
	for ($i=0; $i<strlen($charset); $i++){
		$newstr = $curstr.$charset[$i];
		$res = brute($target, $targetlen, strlen($newstr), $newstr);
		if ($res == false) {continue;}
		else return $res;
	}
}

function checkAllFound(){
	global $found0, $found1, $found2;
	return $found0 && $found1 && $found2;
}

function checkHash($input){
	global $count, $hashes, $plain, $found0, $found1, $found2;
	
	// status update
	$count++;
	if ($count >= 100000) {
		echo "Checking $input \n";
		$count = 0;
	}
	
	$hash = tripleSha1($input);
	$hash = bin2hex($hash);
	if (!$found0 && strcmp($hashes[0], $hash) === 0){
		$plain[0] = $input;
		$found0 = true;
		$tmpres = "Found 0 : $input \n";
		echo $tmpres;
		file_put_contents("cracked.wtf",$tmpres,FILE_APPEND);
	}
	else if (!$found1 && strcmp($hashes[1], $hash) === 0){
		$plain[1] = $input;
		$found1 = true;
		$tmpres = "Found 1 : $input \n";
		echo $tmpres;
		file_put_contents("cracked.wtf",$tmpres,FILE_APPEND);
	}
	else if (!$found2 && strcmp($hashes[2], $hash) === 0){
		$plain[2] = $input;
		$found2 = true;
		$tmpres =  "Found 2 : $input \n";
		echo $tmpres;
		file_put_contents("cracked.wtf",$tmpres,FILE_APPEND);
	}
	
	return false;
}

function tripleSha1($input){
	$tmp = sha1($input, true);
	$tmp = sha1($tmp, true);
	$tmp = sha1($tmp, true);
	return $tmp;
}

// Flag is : h4sh3d_th3_h4sh3s@flare-on.com (75692 s)

// apt-get install mingw-w64 (to compile hashcat for windows)

// https://hashcat.net/forum/thread-2933.html
// hashcat should modify method 300 - Just make it run 1 more time (method 300 is sha1(sha1(pass,true)))
/*
Hello,

I have a question about 2 hash type distinguishing
It is hard to identify MySQL4.1/MySQL5(htype=300) and sha1(sha1($pass)) (htype=4500)

as reference;
http://www.palominodb.com/blog/2011/12/0...l-password

I doubt that just two hashtype is the same(exact) hash except between Uppercased hash(300) and Lowercased hash(4500), as memtioned Example hashes pages


pls , explain me about difference of two hashtype.. 

---

That's simple, the -m 300 uses the binary digest from the first sha1() as input for the 2nd sha1() while -m 4500 uses the ascii hex representation of the first sha1(). 



*/
?>