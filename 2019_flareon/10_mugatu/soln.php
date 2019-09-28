<?php
require_once "XTEA.class.php"; // https://github.com/divinity76/php-xtea
$xtea = new XTEA();

// Sanity Checks
$pikachu = file_get_contents("pikachu.gif.Mugatu");
$charmander = file_get_contents("charmander.gif.Mugatu");
$keys = array(ord('a'), ord('b'), ord('c'), ord('d'));
echo $xtea->decrypt($pikachu, $keys)."\n";
echo $xtea->decrypt(substr($charmander,0,8), $keys)."\n";
// Sanity Checks End

/*
// Decrypting the informant gives us the first key byte
$keys = array(0, 0, 0, 0);
$informant = file_get_contents("the_key_to_success_0000.gif.Mugatu");
$res = $xtea->decrypt($informant, $keys);
var_dump($res);
file_put_contents("the_key_to_success.gif", $res);
*/

$best = file_get_contents("best.gif.Mugatu");
$best_8 = substr($best,0,8);

for($k2 = 0; $k2<256; $k2++){
    for($k3 = 0; $k3<256; $k3++){
        for($k4 = 0; $k4<256; $k4++){
            $keys = array(0x31, $k2, $k3, $k4);
            $res = $xtea->decrypt($best_8, $keys);

            $gifheader = substr($res, 0, 3);
            $k_print = $keys[0]."_".$keys[1]."_".$keys[2]."_".$keys[3];
            // echo "$k_print : $gifheader \n";

            if ($gifheader == "GIF"){
                echo "Possible valid key: $k_print \n";

                $gif = $xtea->decrypt($best, $keys);
                $fname = "best_".$k_print.".gif";
                file_put_contents($fname, $gif);
                echo "$fname written\n";

            }
        }
    }
}

// best_49_115_53_177.gif is correct
// flag is FL4rE-oN_5o_Ho7_R1gHt_NoW@flare-on.com

?>
