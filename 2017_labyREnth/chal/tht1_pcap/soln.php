<?php
$data = array();
$data[] = "google.;UEsDBBQAAAAIAOCIr0qMVwGeKQAAACoA.com";
$data[] = "youtube.<AAAIABwAZmlsZS5kYXRVVAkAA3QYGlmB.com";
$data[] = "facebook.=GBpZdXgLAAEE6AMAAAToAwAAC3D0q3bM.com";
$data[] = "baidu.:yQnIz8wrSS0q9sxz8QsOzsgvzUkBCzkl.com";
$data[] = "wikipedia.>JmeXJxalFNdyAQBQSwECHgMUAAAACADg.org";
$data[] = "yahoo.:iK9KjFcBnikAAAAqAAAACAAYAAAAAAAB.com";
$data[] = "qq.7AAAAtIEAAAAAZmlsZS5kYXRVVAUAA3QY.com";
$data[] = "reddit.;Gll1eAsAAQToAwAABOgDAABQSwUGAAAA.com";
$data[] = "google./AAEAAQBOAAAAawAAAAAA.co.in";

$d = getstuff($data);
echo base64_decode($d)."\n";

function getstuff($data){
	$out = "";
	for ($i=0; $i<count($data); $i++){
		$cur = $data[$i];
		$start = strpos($cur, '.') + 2;
		$end = strrpos($cur, '.');
		$len = $end-$start;
		$tmp = substr($cur,$start,$len);
		
		$out .= $tmp;
	}
	return $out;
}
?>
