<?php
$flag = array();
$flag[] = ord('P');
$flag[] = ord('A');
$flag[] = ord('N');
$flag[] = ord('{');

$flag[] = 0xcf ^ 0xab;
$flag[] = 0x1e ^ 0x2d;
$flag[] = 0x52 ^ 0x3e;
$flag[] = 0x22 ^ 0x52;
$flag[] = 0x08 ^ 0x60;
$flag[] = 0x68 + 1;
$flag[] = 0xe5 ^ 0xba;
$flag[] = 0xd7 ^ 0xbe;
$flag[] = 0xe6 / 2;
$flag[] = (0x2f << 1) + 1; 				// possibly 0x5e or 0x5f (choosing 0x5f thus the +1) '_'
$flag[] = 0x194 >> 2;
$flag[] = ((0x19 << 1) + 2); 			// possibly 0x34 or 0x35 (choosing 0x34) '4'
$flag[] = (0x1c0 ^ 0x0c) >> 2;
$flag[] = ((0x38 ^ 0x04) << 1) + 1; 	// possibly 0x78 or 0x79 (choosing 0x79 thus the +1) 'y'
$flag[] = ((0x28 + 7) << 1) + 1; 		// possibly 0x5e or 0x5f (choosing 0x5f thus the +1) '_'
$flag[] = ((0x8c / 0x0a) << 3) + 4;		// possibly from 0x70 to 0x78 (choosing 0x74 thus the +4) 't'
$flag[] = 0x60 / 2;
$flag[] = 0x17c >> 2;
$flag[] = ((0x59 ^ 0x60) << 1);			// possibly 0x72 or 0x73 (choosing 0x72) 'r'
$flag[] = (0x42 ^ 0x88) / 2;
$flag[] = (0xc0 ^ 0x2c) / 2;
$flag[] = ((0x16 << 1) + 7);			// possibly 0x33 or 0x34 (choosing 0x33) '3'
$flag[] = (0x36 ^ 0x29a) / 6;
$flag[] = ((0x130f0 >> 3) ^ 0x2486) >> 3;
$flag[] = ((0x2950 ^ 0x25a0) >> 4) / 3;
$flag[] = 0x7d;

$out = "";
for ($i=0; $i<count($flag); $i++){
	$out .= chr($flag[$i]);
}
echo $out."\n";

// flag is PAN{d3lphi_is_e4sy_t0_rev3rSE}
?>