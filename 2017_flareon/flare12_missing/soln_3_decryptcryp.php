<?php
    $key = base64_decode("tCqlc2+fFiLcuq1ee1eAPOMjxcdijh8z0jrakMA/jxg=");
	$cryp = file_get_contents("lab10.cryp");
	$magic = substr($cryp,0,4);
	$iv = substr($cryp,4,16);
	//$hash = substr($cryp,20,32);
	
	$enc = substr($cryp,52,-0x14);
	//file_put_contents("encdata",$enc);
	$plain = openssl_decrypt($enc, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv);
	if ($plain == false) echo openssl_error_string()."\n";
	else{
		file_put_contents("lab10.zip",$plain);
	}
?>