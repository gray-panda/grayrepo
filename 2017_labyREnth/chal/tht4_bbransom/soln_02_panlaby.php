<?php
$enc = base64_decode("DwImSAI1CgMYSQQ+GhoO");
$key = "For great justice";
$msg = "";
for ($i=0; $i<strlen($enc); $i++){
	$msg .= chr(ord($enc[$i]) ^ ord($key[$i]));
}
echo $msg."\n"; // ImTheGoblinKing

echo base64_decode("PGgxPkkgYW0gdGhlIGdvYmxpbiBraW5nITwvaDE+PGJyPkFsbCB1ciBiYnogIGFyZSBiZWxvbmcgdG8gdXMuIFlvdSBoYXZlIG5vIGNoYW5jZSB0byBzdXJ2aXZlIG1ha2UgeW91ciB0aW1lLg==")."\n";
echo base64_decode("PGgyPkNhbXBhaWduIElEOiBGaTQ4VzFVVEF3TVNRVmtRUmsxYVZBQi9EVVFSVnhRQkJ4ZEdDQmNTRUZ0VUIzUlhFRUpYRkZ4UlRFUmJRaGRIV2dWY2RncEtRMThUQVZSREV3dE5Ga1JmVndNNyA8YnI+PC9oMj4=")."\n";
echo base64_decode("PGgzPlZlcnNpb24gS2V5OiBGb3IgZ3JlYXQganVzdGljZSA8YnI+PC9oMz4=")."\n";
//echo base64_decode("Fi48W1UTAwMSQVkQRk1aVAB/DUQRVxQBBxdGCBcSEFtUB3RXEEJXFFxRTERbQhdHWgVcdgpKQ18TAVRDEwtNFkRfVwM7")."\n";

echo xorString(base64_decode("Fi48W1UTAwMSQVkQRk1aVAB/DUQRVxQBBxdGCBcSEFtUB3RXEEJXFFxRTERbQhdHWgVcdgpKQ18TAVRDEwtNFkRfVwM7"), $msg)."\n";
echo xorString(base64_decode("Fi48W1UTAwMSQVkQRk1aVAB/DUQRVxQBBxdGCBcSEFtUB3RXEEJXFFxRTERbQhdHWgVcdgpKQ18TAVRDEwtNFkRfVwM7"), "For great justice")."\n";

function xorString($msg, $key){
	$out = "";
	for ($i=0; $i<strlen($msg); $i++){
		$out .= chr(ord($msg[$i]) ^ ord($key[$i % strlen($key)]));
	}
	return $out;
}

// PAN{2afbfa3e5937e9b610fdfcfbbad27b28bb0f908d17d33f90e8c8ad573a8e064f}
?>