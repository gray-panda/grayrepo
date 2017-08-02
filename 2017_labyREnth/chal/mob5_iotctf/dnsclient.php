<?php
$url = "http://127.0.0.1:3721/login?";

$params = "username=backdoor&password=}w|~eswb";
$full = $url.$params;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $full);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);
echo $resp."\n";

curl_close($ch);

// token is 
// b3dxYnF9dmcwa0tHTjNKVw= --> owqbq}vg0kKGN3JW
// b3dxYnF9dmdmSGdhZzNMZg= --> owqbq}vgfHgag3Lf
?>