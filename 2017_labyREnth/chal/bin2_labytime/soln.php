<?php
$url = "24.56.178.140:13"; // NIST Time server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
curl_close($ch);
$dt = substr($resp,6);
$dt = substr($dt,0,17);
$dt[16] = "0";
echo $dt."\n";

// 17-07-04 12:26:34 50 0 0 659.8 UTC(NIST) *
// !?!?AllYourFlagsAreBelongToUs!?!?!
//$dt = "17-07-04 12:56:40";  
$adder = ord($dt[0]);
$plain = "!?!?AllYourFlagsAreBelongToUs!?!?!";
$enc = "";
for ($i=0; $i<strlen($plain); $i+=2){
	$p1 = ord($plain[$i]);
	$p2 = ord($plain[$i+1]);
	
	$d1 = ord($dt[($i % strlen($dt))]);
	$d2 = ord($dt[(($i+1) % strlen($dt))]);

	$e1 = (($p1 ^ $d1) + $adder) & 0xff;
	$e2 = (($p2 ^ $d2) + $adder) & 0xff;
	$enc .= chr($e1).chr($e2);
}
$thehash =  sha1($enc);
$theflag = "PAN{".$thehash."}";
echo "Submitting $theflag ...\n";

$url = "labytime.com";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$postfields = "flag=".urlencode($theflag);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$postfields);
$resp = curl_exec($ch);
echo $resp."\n";
curl_close($ch);

// <div class="won">You won!<br>The real flag to submit is: PAN{tricky_tricky_better_be_quicky}</div></body>

/*
Given hint on challenge site points to "labytime.com"
The program does the following
	- Grab the Current Date Time from a NIST NTP server
	- Only grab the 17 char DataTime Value "YY-MM-DD HH:ii:ss"
		- Change the 2nd "second" value to "0"
	- Does some encryption using this DateTime String and the String "!?!?AllYourFlagsAreBelongToUs!?!?!"
	- The resulting (0x22 len) string is hashed using sha1 and displayed on the UI

The solution is to re-implement this code and pipe the current hash to labytime.com.
If it is correct, the actual flag will be given.
This script re-implements what the binary does in regards to the flag and submits it to labytime.com

It can be completed easier if you have fast fingers or you manage to copy the flag hash our from the UI and submit it manually to labytime.com
*/
?>