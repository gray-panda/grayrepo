<?php
/*
$flag = "PAN{A00aAa!}";
//$flag = "PAN{L00tEr!}";
$enc = AddAndXor($flag);
echo bin2hex($enc)."\n";
echo hash("sha256",$enc)."\n";

$encrev = "";
for ($i=0; $i<3; $i++){
	$cur = substr($enc,$i,4);
	$tmp = strrev($cur);
	$encrev .= $tmp;
}
echo hash("sha256",$encrev)."\n";
//6dd3f1a7c9244d549620d9c53efd56ffdfaee41afb92c91420e6974c0e7d188a
*/

$target = "801a522a9448362e8d1b410255772793b55a50cdb750df569eabbdaf2cb10986";
$found = false;
$count = 0;
for ($c1=ord('A'); $c1<=ord('Z'); $c1++){
	for ($c2=ord('0'); $c2<=ord('9'); $c2++){
		for ($c3=ord('0'); $c3<=ord('9'); $c3++){
			for ($c4=ord('a'); $c4<=ord('z'); $c4++){
				for ($c5=ord('A'); $c5<=ord('Z'); $c5++){
					for ($c6=ord('a'); $c6<=ord('z'); $c6++){
						for ($c7=ord('!'); $c7<ord('0'); $c7++){
							$count++;
							if ($count % 100000 == 0){
								echo "Testing $flag ($hash) ...\n";
								$count = 0;
							}
							$flag = "PAN{".chr($c1).chr($c2).chr($c3).chr($c4).chr($c5).chr($c6).chr($c7)."}";
							$enc = AddAndXor($flag);
							$hash = hash('sha256',$enc);
							//echo "Testing $flag ($hash) \n";
							if (strcmp($hash,$target) == 0){
								$found = true;
								echo "Flag Found!! $flag ($hash)\n";
								die();
							}
						}
					}
				}
			}
		}
	}
}
// Flag Found!! PAN{M03iLe&} (801a522a9448362e8d1b410255772793b55a50cdb750df569eabbdaf2cb10986)

function AddAndXor($input){
	$out = "";
	for ($i=0; $i<strlen($input); $i++){
		$cur = ord($input[$i]);
		$tmp = ($cur - 4) & 0xff;
		$tmp = $tmp ^ 0x17;	
		$out .= chr($tmp);
	}
	return $out;
}
?>