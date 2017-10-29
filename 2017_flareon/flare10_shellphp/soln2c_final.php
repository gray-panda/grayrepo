<?php
$base = "<html>\r\n<titl"; // $base1 = "<html>\r\n<title>Raytraced C";

$enc1 = base64_decode('SDcGHg1feVUIEhsbDxFhIBIYFQY+VwMWTyAcOhEYAw4VLVBaXRsKADMXTWxrSH4ZS1IiAgA3GxYUQVMvBFdVTysRMQAaQUxZYTlsTg0MECZSGgVcNn9AAwobXgcxHQRBAxMcWwodHV5EfxQfAAYrMlsCQlJBAAAAAAAAAAAAAAAAAFZhf3ldEQY6FBIbGw8RYlAxGEE5PkAOGwoWVHgCQ1BGVBdRCAAGQVQ2Fk4RX0gsVxQbHxdKMU8ABBU9MUADABkCGHdQFQ4TXDEfW0VDCkk0XiNcRjJxaDocSFgdck9CTgpPDx9bIjQKUW1NWwhERnVeSxhEDVs0LBlIR0VlBjtbBV4fcBtIEU8dMVoDACc3ORNPI08SGDZXA1pbSlZzGU5XVV1jGxURHQoEK0x+a11bPVsCC1FufmNdGxUMGGE=');
$key1len = 13;
$cipher1 = str_split($enc1, $key1len);
$msg1 = $base;

for ($i=1; $i<count($cipher1); $i++){
	$xored = $cipher1[0] ^ $cipher1[$i];
	$msg1 .= $xored ^ $base;
}
echo $msg1."\n";
$key1 = $cipher1[0] ^ $base;
echo "Key1: $key1 \n\n"; // Key: t_rsaat_4froct_rsaat_4froc (t_rsaat_4froc) keylength is actually 13

$enc2 = base64_decode('VBArMg1HYn1XGAwaAw1GDCsACwkeDgABUkAcESszBEdifVdNSENPJRkrNwgcGldMHFVfSEgwOjETEE9aRlJoZFMKFzsmQRALSilMEQsXHEUrPg9ZDRAoAwkBHVVIfzkNGAgaBAhUU00AAAAAAAAAAAAAAAAASkZSVV0KDAUCHBFQHA0MFjEVHB0BCgBNTAJVX3hkAkQiFh8ESw0AG0M5MBNRGkpdWV4bVEEVdGJGRR9XGBgcAgpVCDAsCA0GGAVWBAwcBxQqKwRCGxgbVkJFR11IdHcbRFxOUkNNV0RAVXIKSgxCWk1aVkdGQVI8dxRTVl5CR0JLVAQdOStbXkRfXlxOFEULUCp2SFJIUlVGQlUtRhExMQQLJyMmIFgDTUQtYmZIRUAECB4MHhtWRHA9Dh0WSWZmWUEHHBUzYQ==');
$key2len = 13;
$cipher2 = str_split($enc2, $key2len);
$msg2 = $base;
for ($i=1; $i<count($cipher2); $i++){
	$xored = $cipher2[0] ^ $cipher2[$i];
	$msg2 .= $xored ^ $base;
}
echo $msg2."\n";
$key2 = $cipher2[0] ^ $base;
echo "Key2: $key2 \n\n";

$enc3 = base64_decode('DycdGg1hYjl8FURaAVZxPhgNOQpdMxVIRwNKc0YDCCsDVn5sJxJMHmJJOgArB1olFA0JHQN+TlcpOgFBKUEAA1M+RVUVDjsWEy8PQUEMV3IsSgJxCFY0IkJAGVY3HV9DbQsRaU1eSxl6IR0SEykOX2gnEAwZGHJHRU0OUn4hFUUADlw8UhRPNwpaJwlZE14Df1IRDi1HS30JFlZAHnRAEQ4tR0p9CRZXQB50LFkHNgNfEgROWkVLZV1bGHVbHyJMSRFZCQtGRU0bQAFpSEtBHxsLVEdaeEEUfCd2akdKYAFaJXBdT3BeHBRFV3IdXCV1PhsUXFUBBR5hXFwwdxsab1kECFoaM0FET2pEd2owBXpAC2ZAS11sMhVmJREWVlFyDV4ldFIdcUMBWlBbcl5CSGFTUCEPW08eEyYNSgJhYjl8Tk9BCUpvDxsAODBeLwUfE08AAAAAAAAAAAAAAAAAEXFkfV1wB0ctDRM=');
$key3len = 13;
$cipher3 = str_split($enc3, $key3len);
$msg3 = $base;
for ($i=1; $i<count($cipher3); $i++){
	$xored = $cipher3[0] ^ $cipher3[$i];
	$msg3 .= $xored ^ $base;
}
echo $msg3."\n";
$key3 = $cipher3[0] ^ $base;
echo "Key3: $key3 \n\n";

$finalkey = "";
for ($i=0; $i<strlen($key1); $i++){
	$finalkey .= $key1[$i].$key2[$i].$key3[$i];
}
echo "Final Key: $finalkey\n\n";
// Final Key: th3_xOr_is_waaaay_too_w34k@flare-on.com
?>