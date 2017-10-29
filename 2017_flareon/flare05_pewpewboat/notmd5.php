<?php
$in = $argv[1];
$notmd5 = ~md5($in, true);
$out = strtoupper(bin2hex($notmd5));
echo "NotMD5($in): $out\n";
?>