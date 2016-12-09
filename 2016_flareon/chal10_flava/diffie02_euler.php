<?php
// https://securelist.com/blog/research/72097/attacking-diffie-hellman-protocol-implementation-in-the-angler-exploit-kit/

echo euler(array('2','227','11251','2837111','14709647','363154264459302223'))."\n";

function euler($values){
	$out = '';
	for ($i=0; $i<count($values); $i++){
		if ($i == 0) $out = bcsub($values[$i],'1');
		else{
			$out = bcmul($out,bcsub($values[$i],1));
		}
	}
	return $out;
}

function checkFactorsCorrect($values){
	$out = '';
	for ($i=0; $i<count($values); $i++){
		if ($i == 0) $out = $values[$i];
		else{
			$out = bcmul($out,$values[$i]);
		}
	}
	return $out;
}
?>