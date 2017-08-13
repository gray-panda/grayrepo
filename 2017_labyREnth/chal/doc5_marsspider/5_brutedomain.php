<?php
for ($a=ord('A'); $a<=ord('Z'); $a++){
	for ($b=ord('A'); $b<=ord('Z'); $b++){
		for ($c=ord('A'); $c<=ord('Z'); $c++){
			$domain = 'x'.chr($a).'x'.chr($b).'x'.chr($c);
			passthru("powershell -ep bypass -file darkcrystal_patched.ps1 $domain");
			
			$res = file_get_contents('pscmd.txt');
			$res = trim(substr($res,2));
			$res = str_replace("\x00","",$res);
			if (strcmp($res, "iex") === 0){
				echo "FOUND!! Domain is $domain\n";
				die();
			}
		}
	}
}

// Domain Found "xJxAxU"
?>