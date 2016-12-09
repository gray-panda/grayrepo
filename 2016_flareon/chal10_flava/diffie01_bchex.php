<?php
$g = '91a812d65f3fea132099f2825312edbb'; $gdec = bchexdec($g);
$p = '3a3d4c3d7e2a5d4c5c4d5b7e1c5a3c3e'; $pdec = bchexdec($p);
$A = '16f2c65920ebeae43aabb5c9af923953'; $Adec = bchexdec($A);
$B = '3101c01f6b522602ae415d5df764587b'; $Bdec = bchexdec($B);

echo "g : $gdec (0x$g)\n";
echo "p : $pdec (0x$p)\n";
echo "A : $Adec (0x$A)\n";
echo "B : $Bdec (0x$B)\n";

function bchexdec($hex){
    $dec = 0;
    $len = strlen($hex);
    for ($i = 1; $i <= $len; $i++) {
        $dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($len - $i))));
    }
    return $dec;
}
?>