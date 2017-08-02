<?php
echo "Current Device Name: ".singleByteXor(base64_decode("eENJQVl6QkVETw=="), 0x2a)."\n";
echo "Some GPS Location Coordinate: ".singleByteXor(base64_decode("IiY/IyIlIiIj"), 0x11)."\n";
echo "Current Device Model: ".singleByteXor(base64_decode("QHlITQ=="), 0x29)."\n";
echo "Battery Level: ".singleByteXor(base64_decode("GQcY"), 0x29)."\n";
echo "Error Msg?: ".singleByteXor(base64_decode("Y05OAAFvTlUBYk5OTQA="), 0x21)."\n";
echo singleByteXor(base64_decode("OiYmIjkvJyEhISQ="), 0x17)."\n";
echo "\n\n";
echo singleByteXor(base64_decode("IiY/IyIlIiIj"), 0x11)."\n";
echo singleByteXor(base64_decode("OiYmIjkvJyEhISQ="), 0x17)."\n";
echo "\n\n";
echo singleByteXor(base64_decode("QHlITQ=="), 0x29)."\n";
echo singleByteXor(base64_decode("UjtXUlBeO0xTWk87QlROO1xUTzU7XFRUXztRVFk1"), 0x1b)."\n";

function singleByteXor($msg, $key){
	$out = "";
	for ($i=0; $i<strlen($msg); $i++){
		$out .= chr(ord($msg[$i]) ^ $key);
	}
	return $out;
}
?>