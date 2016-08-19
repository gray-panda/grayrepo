<?php
//http://10.1.33.7/b64/x58/MDgxOTE2MjMwZTMxMDIzMTNhNjk2YjA3NjgzNjM0MjE2YTJjMzA2ODJiNmIwNzBmMzA2ODA3MTMz\nNjY4MmYwNzJmMzA2YjJhNmI2YTM0Njg2ODMzMjU=/evil.exe
// Clue from url - Base64 and then XOR with 58
$data = "MDgxOTE2MjMwZTMxMDIzMTNhNjk2YjA3NjgzNjM0MjE2YTJjMzA2ODJiNmIwNzBmMzA2ODA3MTMz\nNjY4MmYwNzJmMzA2YjJhNmI2YTM0Njg2ODMzMjU=";
$data2 = base64_decode($data);
$out = "";
for ($i=0; $i<strlen($data2); $i+=2){
	$cur = substr($data2, $i, 2);
	$res = hexdec($cur) ^ 0x58;
	$out .= chr($res);
}
echo $out."\n";

// flag is PAN{ViZib13_0nly2th0s3_Wh0_Kn0w_wh3r32l00k}
?>