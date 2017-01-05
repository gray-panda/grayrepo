<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$url = 'http://dev.northpolewonderland.com/index.php';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$postfields = array();
$postfields['date'] = "20170104160539+0800";
$postfields['udid'] = "f69d6681d7473e64";
$postfields['debug'] = "com.northpolewonderland.santagram.EditProfile, EditProfile";
$postfields['freemem'] = 153922016;
$postfields['verbose'] = true;
$jsondata = json_encode($postfields);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);

$httpheaders = array();
$httpheaders[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheaders);

$resp = curl_exec($ch);
if ($resp == false) echo curl_error($ch);
echo $resp."\n";

curl_close($ch);
?>