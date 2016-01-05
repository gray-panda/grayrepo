<?php
function xorimg($imagick1, $imagick2){
	// Use the iterator functions for iter1, iterate iter2 manually	
	$iter1 = new ImagickPixelIterator($imagick1);
	$iter2 = new ImagickPixelIterator($imagick2);
	$count = 0;

	foreach ($iter1 as $pixelRow1){
		if (!$iter2->valid()){
			break; // make sure iter2 is still valid
		}
		$pixelRow2 = $iter2->current();

		foreach($pixelRow1 as $column=>$pixel1){
			$pixel2 = $pixelRow2[$column];

			$color1 = $pixel1->getColor();
			$color2 = $pixel2->getColor();

			$newcolor = array();
			$newR = $color1['r'] ^ $color2['r'];
			$newG = $color1['g'] ^ $color2['g'];
			$newB = $color1['b'] ^ $color2['b'];
			$pixel1->setColor("rgb($newR, $newG, $newB)");
			$count++;
		}
		$iter2->next();
		$iter1->syncIterator();
	}

	return $imagick1;
}

$corrupt = new Imagick('camera_feed_overlap_error.png');
$cam1 = new Imagick('factory_cam_1.png');
$cam2 = new Imagick('factory_cam_2.png');
$cam3 = new Imagick('factory_cam_3.png');
$cam4 = new Imagick('factory_cam_4.png');
$cam5 = new Imagick('factory_cam_5.png');

echo "Xoring with cam1...\n";
$tmp = xorimg($corrupt, $cam1);
echo "Xoring with cam2...\n";
$tmp = xorimg($tmp, $cam2);
echo "Xoring with cam3...\n";
$tmp = xorimg($tmp, $cam3);
echo "Xoring with cam4...\n";
$tmp = xorimg($tmp, $cam4);
echo "Xoring with cam5...\n";
$tmp = xorimg($tmp, $cam5);
echo "Done :) \n";
$tmp->writeImage('restored.png');
?>