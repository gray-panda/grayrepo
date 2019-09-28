<?php
/*
//$key = "RoT???eRinG";
$enc = hex2bin("1C5C2200001702620700060D08754517173C3D1C3132022F1272390D231E282969310039");

$key_prefix = "RoT";
$key_suffix = "eRinG";
for ($c3 = 0x20; $c3 < 0x7f; $c3++){
    $c4 = $c3 ^ 0x41;
    for ($c5=0x20; $c5 < 0x7f; $c5 += 2){
        // c5 must be even
        $key = $key_prefix . chr($c3) . chr($c4) . chr($c5) . $key_suffix;
        $res = xorstring($enc, $key);
        echo "$res ($key) \n";
    }
}
*/
// N3v3r_g0nnA_g!ve_You_uP@FAKEFLAG.com (RoT3rHeRinG) 
// Trolled... now where is the real flag

/*
001EFDE0  7A 17 08 34 17 31 3B 25 5B 18 2E 3A 15 56 0E 11  z..4.1;%[..:.V..  
001EFDF0  3E 0D 11 3B 24 21 31 06 3C 26 7C 3C 0D 24 16 3A  >..;$!1.<&|<.$.:  
001EFE00  14 79 01 3A 18 5A 58 73 2E 09 00 16 00 49 22 01  .y.:.ZXs.....I".  
001EFE10  40 08 0A 14 00 00 01 00 04 00 00 00 E0 35 63 00  @...........à5c.  
*/

$enc2 = hex2bin("7A17083417313B255B182E3A15560E113E0D113B242131063C267C3C0D24163A1479013A185A58732E0900160049220140080A14");
$key2 = xorstring(substr($enc2, -13), "@flare-on.com");
// Key is 3HeadedMonkey
echo "Key is $key2 \n";
echo xorstring($enc2, $key2)."\n";

// I_mUsT_h4vE_leFt_it_iN_mY_OthEr_p4nTs?!@flare-on.com

function xorstring($msg, $key){
    $out = "";
    $keylen = strlen($key);
    for ($i=0; $i<strlen($msg); $i++){
        $tmp = ord($msg[$i]) ^ ord($key[$i % $keylen]);
        $out .= chr($tmp);
    }
    return $out;
}

// 0x112d0
?>