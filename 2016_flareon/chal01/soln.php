<?php
$default = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
$custom  = "ZYXABCDEFGHIJKLMNOPQRSTUVWzyxabcdefghijklmnopqrstuvw0123456789+/";

$enc = "x2dtJEOmyjacxDemx2eczT5cVS9fVUGvWTuZWjuexjRqy24rV29q";
$defenc = strtr($enc, $custom, $default); // "translate" each char from custom to default
echo base64_decode($defenc)."\n"; // use the default base64 decode

// flag is sh00ting_phish_in_a_barrel@flare-on.com
?>