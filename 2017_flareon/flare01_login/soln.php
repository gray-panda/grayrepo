<?php
$enc = "PyvragFvqrYbtvafNerRnfl@syner-ba.pbz";

//rot-13

$out = "";
for ($i=0; $i<strlen($enc); $i++){
	$cur = ord($enc[$i]);
	if ($cur == ord('@') || $cur == ord('-') || $cur == ord('.')){
		$out .= chr($cur);
		continue;
	}
	
	if ($cur <= ord('Z')){
		// Upper Case
		$new = $cur - 13;
		if ($new < ord('A')) $new += 26;
		$out .= chr($new);
	}
	else{
		// Lower Case
		$new = $cur - 13;
		if ($new < ord('a')) $new += 26;
		$out .= chr($new);
	}
}

echo $out."\n";
?>