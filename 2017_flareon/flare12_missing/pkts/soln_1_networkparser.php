<?php
require_once('blowfish.php');
require_once('rc4.php');
require_once('xtea.php');

//$data = file_get_contents("forwardedpkts_cnc_to_larry"); // forwarded packets (cnc to larry direction only)
//$data = file_get_contents("forwardedpkts_all"); // forwarded packets (both direction)
$data = file_get_contents("pkts_all_cnc_t1"); // wireshark raw byte dump
$files = array();
$pkts = array();
$screenshot = array();
$screenshot['count'] = 1;
$screenshot['width'] = 0;
$screenshot['height'] = 0;
$screenshot['bitsperpixel'] = 0;
$screenshot['data'] = "";

// Make sure all these directories are created
$dir_decrypted = "out_decrypted/";
$dir_forward = "out_forward/";
$dir_module = "out_module/";
$dir_ftransfer = "out_filetransfer/";

while(strlen($data) > 0){
	$magic = substr($data,0,4);
	if (strcmp($magic,"2017") !== 0){
		echo "ERROR: Magic $magic \n";
		echo count($pkts)."\n";
		die();
	}
	$headerlen = unpack('V',substr($data,8,4))[1];
	$framelen = unpack('V',substr($data,12,4))[1];
	$totallen = $headerlen + $framelen;
	
	$pkts[] = substr($data,0,$totallen);
	$data = substr($data,$totallen);
}
$totalcount = count($pkts);
echo "Total Packets: $totalcount\n";

$loopstart = 0;
$loopend = count($pkts);
//$pauseat = false;
$pauseat = 0;
// $pauseat = 0x1a;
$dowritefiles = false;

for ($i=$loopstart; $i<$loopend; $i++){
	$cur = $pkts[$i];
	
	printMsg("Packet: 0x".dechex($i)." / 0x".dechex($totalcount)." ($i)", "");
	$fullpkt = "";
	$curFrame = processCRPT($cur,$i,"");
	$fullpkt .= $curFrame[0]; // append the CRPT Header
	$curFrame = processCOMP($curFrame[1],$i,"\t"); // Process COMP using CRPT Body
	$fullpkt .= $curFrame[0]; // append COMP Header
	$fullpkt .= $curFrame[1]; // append COMP Body
	$everythingok = $curFrame[2];
	
	// Write the decrypted packet to disk
	if ($dowritefiles) file_put_contents($dir_decrypted."pkts_".$i.".bin", $fullpkt);
	
	if ($everythingok){
		$res = processCMD($curFrame[1], $i, "\t\t");
		if ($res === false) {
			$hexed = bin2hex($progFrame);
			echo substr($hexed,0,100)."\n";
			die();
		}
	}	
	echo "-------------------------------------\n";
	
	if ($pauseat !== false && $i > $pauseat) {
		$handle = fopen("php://stdin", "r");
		fgets($handle); // pause till user hit enter
		fclose($handle);
	}
}

function processCRPT($crpt,$i,$msgprefix){
	$encMagic = substr($crpt,0,4);
	$encChecksum = substr($crpt,4,4);
	$encHeaderLen = unpack('V',substr($crpt,8,4))[1];
	$encBodylen = unpack('V',substr($crpt,12,4))[1];
	
	$encHeader = substr($crpt,0,$encHeaderLen);
	$nextframe = substr($crpt,$encHeaderLen,$encBodylen);
	
	$encHash = substr($encHeader,20,16);
	$encHeaderData = substr($encHeader,36,$encHeaderLen-36);
	
	printMsg("encMagic: ".$encMagic, $msgprefix);
	printMsg("encChecksum: 0x".bin2hex($encChecksum), $msgprefix);
	printMsg("encHeaderLen: 0x".dechex($encHeaderLen), $msgprefix);
	printMsg("encBodyLen: 0x".dechex($encBodylen), $msgprefix);
	printMsg("encHash: ".bin2hex($encHash), $msgprefix);
	if (!empty($encHeaderData)) printMsg("encHeaderData: ".bin2hex($encHeaderData), $msgprefix);
	
	if (strcmp(bin2hex($encHash), "51298f741667d7ed2941950106f50545") === 0){
		// Unencrypted, Do Nothing
		printMsg("No Encryption...", $msgprefix);
	}
	else if (strcmp(bin2hex($encHash), "c30b1a2dcb489ca8a724376469cf6782") === 0){
		// RC4
		printMsg("Decrypting Frame using RC4...", $msgprefix);
		$nextframe = rc4($encHeaderData, $nextframe);
	}
	else if (strcmp(bin2hex($encHash), "38be0f624ce274fc61f75c90cb3f5915") === 0){
		// Static Substitution
		printMsg("Decrypting Frame using Static Substitution...", $msgprefix);
		$out = "";
		$dict = array(199, 25, 48, 12, 168, 16, 173, 213, 212, 22, 82, 252, 27, 130, 125, 50, 52, 1, 230, 76, 18, 8, 43, 247, 172, 139, 63, 103, 72, 114, 33, 220, 237, 246, 133, 184, 79, 95, 83, 10, 4, 40, 223, 216, 126, 6, 61, 3, 64, 54, 104, 115, 37, 183, 93, 30, 210, 13, 198, 195, 34, 242, 32, 14, 23, 204, 96, 92, 81, 194, 29, 74, 203, 51, 28, 248, 102, 131, 107, 62, 39, 227, 159, 245, 58, 170, 138, 38, 127, 90, 66, 207, 124, 7, 88, 113, 235, 5, 186, 41, 75, 122, 224, 236, 154, 123, 46, 55, 254, 164, 190, 73, 222, 0, 197, 187, 150, 233, 196, 121, 153, 135, 244, 19, 26, 21, 99, 249, 160, 209, 2, 214, 9, 31, 229, 146, 106, 231, 24, 67, 145, 110, 65, 200, 163, 178, 44, 238, 141, 166, 91, 239, 36, 185, 117, 87, 15, 111, 17, 71, 155, 59, 118, 225, 157, 100, 84, 167, 193, 85, 179, 137, 49, 253, 171, 177, 148, 182, 20, 47, 243, 188, 105, 191, 161, 128, 89, 11, 189, 201, 42, 215, 129, 60, 35, 211, 241, 250, 234, 57, 56, 158, 94, 181, 69, 97, 255, 78, 119, 77, 101, 156, 232, 217, 147, 175, 80, 162, 132, 136, 120, 152, 226, 134, 206, 221, 140, 142, 169, 149, 112, 174, 228, 202, 98, 205, 144, 192, 251, 176, 219, 180, 208, 151, 240, 45, 70, 218, 108, 109, 68, 116, 165, 143, 86, 53);
		for ($a=0; $a<strlen($nextframe); $a++){
			$tmp = $dict[ord($nextframe[$a])];
			if ($tmp === -1){
				echo "REDO DICT FOR 38be0f624ce274fc61f75c90cb3f5915: Encrypted Byte ".ord($nextframe[$a])." ($a) \n";
				die();
			}
			$out .= chr($tmp);
		}
		$nextframe = $out;
	}
	else if (strcmp(bin2hex($encHash), "ba0504fcc08f9121d16fd3fed1710e60") === 0){
		// Custom Base64
		printMsg("Decrypting Frame using Custom Base64...", $msgprefix);
		$b64 = hex2bin("7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F7F0B7F7F7F0F1D2E0D330E2A360126327F7F7F407F7F7F0300240A29162113223C1A08232D04393A170C1B3119340714387F7F7F7F7F7F3B0611182B25123D1E053E20353F2C1C153709102F28021F30277F7F7F7F7F");
		$out = "";
		$byte4cnt = 0;
		$word = 0;
		for ($a=0; $a<strlen($nextframe); $a++){
			$tmp = ord($b64[ord($nextframe[$a])]);
			$tmp = $tmp & 0x3f;
			$word = $word | $tmp;
			$byte4cnt++;
			if ($byte4cnt == 4){
				$bhexed = dechex($word);
				while (strlen($bhexed) < 6) $bhexed = "0".$bhexed;
				$out .= chr(hexdec(substr($bhexed,0,2)));
				$out .= chr(hexdec(substr($bhexed,2,2)));
				$out .= chr(hexdec(substr($bhexed,4,2)));
				$byte4cnt = 0;
				$word = 0;
			}
			else $word = $word << 6;
		}
		$nextframe = $out;
	}
	else if (strcmp(bin2hex($encHash), "b2e5490d2654059bbbab7f2a67fe5ff4") === 0){
		// XTEA + XOR Decryption		
		printMsg("Decrypting Frame using XTEA and XOR...", $msgprefix);
		
		// Additional Header Data = 16 byte XTEA key, 8 byte XOR key
		$k1 = unpack('N',substr($encHeaderData,0,4))[1];
		$k2 = unpack('N',substr($encHeaderData,4,4))[1];
		$k3 = unpack('N',substr($encHeaderData,8,4))[1];
		$k4 = unpack('N',substr($encHeaderData,12,4))[1];
		$key = array($k1,$k2,$k3,$k4);
		$xorkey = substr($encHeaderData,16,8);
		
		$out = "";
		for ($a=0; $a<strlen($nextframe); $a+=8){
			$block = substr($nextframe,$a,8);
			$x = unpack('N',substr($block,0,4))[1];
			$y = unpack('N',substr($block,4,4))[1];
			
			$res = xteaDecrypt(array($x,$y), $key);
			$tmpx = dechex($res[0]);
			while(strlen($tmpx) < 8) $tmpx = '0'.$tmpx;
			$tmpy = dechex($res[1]);
			while(strlen($tmpy) < 8) $tmpy = '0'.$tmpy;
			$enc = hex2bin($tmpx.$tmpy);
			
			$out .= $enc ^ $xorkey;
			$xorkey = $block;
		}
		$nextframe = $out;
	}
	else if (strcmp(bin2hex($encHash), "2965e4a19b6e9d9473f5f54dfef93533") === 0 ){
		// Blowfish + XOR Decryption
		printMsg("Decrypting Larry Frame using Blowfish and XOR...", $msgprefix);

		// Additional Header Data = 16 byte Blowfish key, 8 byte XOR key
		$key = substr($encHeaderData,0,16);
		$xorkey = substr($encHeaderData,16,8);
		$bf = new BlowFish($key, BlowFish::BLOWFISH_MODE_EBC, BlowFish::BLOWFISH_PADDING_NONE);
		
		$out = "";
		for ($a=0; $a<strlen($nextframe); $a+=8){
			$block = substr($nextframe,$a,8);
			
			$enc = $bf->decrypt($block, $key, BlowFish::BLOWFISH_MODE_EBC, BlowFish::BLOWFISH_PADDING_NONE);
			
			$out .= $enc ^ $xorkey;
			$xorkey = $block;
		}
		$nextframe = $out;
	}
	else if (strcmp(bin2hex($encHash), "8746e7b7b0c1b9cf3f11ecae78a3a4bc") === 0 ){
		// 4 byte Xor
		printMsg("Decrypting Larry Frame using 4-btye XOR...", $msgprefix);
		$key = substr($encHeaderData,0,4);
		$out = "";
		for ($a=0; $a<strlen($nextframe); $a+=1){
			$tmp = ord($nextframe[$a]) ^ ord($key[($a % strlen($key))]);
			$out .= chr($tmp);
		}
		$nextframe = $out;
	}
	else if (strcmp(bin2hex($encHash), "46c5525904f473ace7bb8cb58b29968a") === 0 ){
		// 3DES + Xor
		printMsg("Decrypting Larry Frame using 3DES and XOR...", $msgprefix);

		$key = substr($encHeaderData,0,24);
		$xorkey = substr($encHeaderData,24,8);
		$out = "";
		for ($a=0; $a<strlen($nextframe); $a+=8){
			$block = substr($nextframe,$a,8);
			$enc = openssl_decrypt($block, "DES-EDE3", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING);
			$out .= $enc ^ $xorkey;
			$xorkey = $block;
		}
		$nextframe = $out;
	}
	else if (strcmp(bin2hex($encHash), "9b1f6ec7d9b42bf7758a094a2186986b") === 0 ){
		// Camelia Cipher
		printMsg("Decrypting Larry Frame using Camelia...", $msgprefix);
		$key = substr($encHeaderData,0,16);
		$out = "";
		for ($a=0; $a<strlen($nextframe); $a+=16){
			$block = substr($nextframe,$a,16);
			$enc = openssl_decrypt($block, "camellia-128-ecb", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING);
			$out .= $enc;
		}
		$nextframe = $out;
	}
	else{
		printMsg("Unknown Encryption...", $msgprefix);
	}
	
	return array($encHeader, $nextframe);
}

function processCOMP($comp,$i,$msgprefix){
	$compHeaderLen = unpack('V',substr($comp,0,4))[1];
	$compBodyLen = unpack('V',substr($comp,4,4))[1];
	$compHash = substr($comp, 12, 16);
	
	printMsg("CompHeaderLen: 0x".dechex($compHeaderLen), $msgprefix);
	printMsg("CompBodyLen: 0x".dechex($compBodyLen), $msgprefix);
	printMsg("CompHash: ".bin2hex($compHash), $msgprefix);
	
	$compHeader = substr($comp,0,$compHeaderLen);
	$nextframe = substr($comp,$compHeaderLen);
	
	// Determine which program to run based on compHash
	$decompok = false;
	if (strcmp(bin2hex($compHash), "f37126ad88a5617eaf06000d424c5a21") === 0){
		printMsg("No Compression...", $msgprefix);
		$decompok = true;
	}
	else if (strcmp(bin2hex($compHash), "5fd8ea0e9d0a92cbe425109690ce7da2") === 0){
		printMsg("Decompressing using zlib...", $msgprefix);
		$nextframe = zlib_decode($nextframe);
		$decompok = true;
	}
	else if (strcmp(bin2hex($compHash), "503b6412c75a7c7558d1c92683225449") === 0){
		printMsg("Deompressing using aplib...", $msgprefix);
		file_put_contents("tmp.aplib",$nextframe);
		passthru("appack.exe d tmp.aplib out.aplib");
		$nextframe = file_get_contents("out.aplib");
		$decompok = true;
	}
	else if (strcmp(bin2hex($compHash), "0a7874d2478a7713705e13dd9b31a6b1") === 0){
		printMsg("Decompressing uzing LZO1X...", $msgprefix);
		file_put_contents("test", $comp);
		passthru("LZOP.exe");
		$retdata = file_get_contents("myfile.bin");
		if (strlen($retdata) != 0) $nextframe = $retdata;
		$decompok = true;
	}
	else{
		printMsg("Running Unknown Program ".bin2hex($compHash), $msgprefix);
		printMsg("PayloadLen: 0x".dechex(strlen($nextframe)), $msgprefix);
		printMsg("Payload: 0x".bin2hex(substr($nextframe,0,0x100)), $msgprefix);
	}
	
	return array($compHeader, $nextframe, $decompok);
}

function processCMD($cmd, $i, $msgprefix){
	global $files, $screenshot, $dir_module, $dir_forward, $dir_ftransfer;
	
	$magic = bin2hex(substr($cmd,0,4));
	if (strcmp($magic,"17041720") !== 0){
		echo "ERROR CMD MAGIC: $magic \n";
		return false;
	}
	
	$cmdID = unpack('V',substr($cmd,4,4))[1];
	$cmdCounter = unpack('V',substr($cmd,8,4))[1];
	$cmdP1 = unpack('V',substr($cmd,12,4))[1];
	$cmdP2 = unpack('V',substr($cmd,16,4))[1];
	$cmdHash = substr($cmd,20,16);
	$cmdData = substr($cmd,36);
	
	$cmdStr = "";
	$cmdDetails = "";
	
	if (strcmp(bin2hex($cmdHash), "f47c51070fa8698064b65b3b6e7d30c6") === 0){
		// Unicode Shell
		switch($cmdID){
			case 0x1:
				$cmdStr = "Start Unicode Shell CMD";
				if (!empty($cmdData)) $cmdDetails .= "ShellCMD: ".$cmdData."\n";
				break;
			case 0x2:
				$cmdStr = "Issue Unicode Shell CMD";
				if (!empty($cmdData)) $cmdDetails .= "ShellCMD: ".$cmdData."\n";
				break;
			case 0x3:
				$cmdStr = "Start Download File to CNC";
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				$filepos = unpack('P',substr($cmdData,16,8))[1];
				$filesize = unpack('P',substr($cmdData,24,8))[1];
				$writeloc = substr($cmdData,52);
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "WriteTo: ".$writeloc."\n";
				if (!empty(trim($filehash))) $files[bin2hex($filehash)] = "";
				break;
			case 0x4:
				$cmdStr = "Downloading File to CNC";
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				$filepos = unpack('P',substr($cmdData,16,8))[1];
				$filesize = unpack('P',substr($cmdData,24,8))[1];
				$chunksize = unpack('P',substr($cmdData,32,8))[1];
				$filedata = substr($cmdData, 40, $chunksize);
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "ChunkSize: 0x".dechex($chunksize)."\n";
				if ($filesize == $filepos) file_put_contents($dir_ftransfer.bin2hex($filehash), $files[bin2hex($filehash)]);
				if (!empty(trim($filehash))) $files[bin2hex($filehash)] .= $filedata;
				break;
			case 0x5:
				$cmdStr = "File download to CNC complete";
				$filehash = substr($cmdData,0,16);
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				if (!empty(trim($filehash))) file_put_contents($dir_ftransfer.bin2hex($filehash), $files[bin2hex($filehash)]); // Write out the downloaded file
				break;
			case 0x6:
				$cmdStr = "Start Upload File";
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				$filepos = unpack('P',substr($cmdData,16,8))[1];
				$filesize = unpack('P',substr($cmdData,24,8))[1];
				$writeloc = substr($cmdData,52);
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "WriteTo: ".$writeloc."\n";
				if (!empty(trim($filehash))) $files[bin2hex($filehash)] = "";
				break;
			case 0x7:
				$cmdStr = "Uploading File";
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				//$filetype = substr($cmdData,16,4);
				$filepos = unpack('P',substr($cmdData,16,8))[1];
				$filesize = unpack('P',substr($cmdData,24,8))[1];
				$chunksize = unpack('P',substr($cmdData,32,8))[1];
				$filedata = substr($cmdData, 40, $chunksize);
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "ChunkSize: 0x".dechex($chunksize)."\n";
				if ($filesize == $filepos) file_put_contents($dir_ftransfer.bin2hex($filehash), $files[bin2hex($filehash)]); // Write out the uploaded file
				if (!empty(trim($filehash))) $files[bin2hex($filehash)] .= $filedata;
				break;
			default: 
				$cmdDetails .= "Unknown Command $cmdID ...\n";
				break;
		}
	}
	else if (strcmp(bin2hex($cmdHash), "f46d09704b40275fb33790a362762e56") === 0){
		// ANSI Shell
		switch($cmdID){
			case 0x1:
				$cmdStr = "Start ANSI Shell CMD";
				if (!empty($cmdData)) $cmdDetails .= "ShellCMD: ".$cmdData."\n";
				break;
			case 0x3:
				$cmdStr = "Issue ANSI Shell CMD";
				if (!empty($cmdData)) $cmdDetails .= "ShellCMD: ".$cmdData."\n";
				break;
			case 0x4:
				$cmdStr = "ANSi Shell CMD Reply";
				$cmdDetails .= "ShellReply: ".$cmdData."\n";
				break;
			default: 
				$cmdDetails .= "Unknown Command $cmdID ...\n";
				break;
		}
	}
	else if (strcmp(bin2hex($cmdHash), "a3aecca1cb4faa7a9a594d138a1bfbd5") === 0){
		// Screenshotter
		switch ($cmdID){
			case 0x01:
				$cmdStr = "Take Screenshot";
				if (!empty($cmdData)) $cmdDetails .= "ShellCMD: ".$cmdData."\n";
				break;
			case 0x02:
				$cmdStr = "Start Receiving Screenshot";
				$p1 = unpack('V',substr($cmdData,0,4))[1];
				$p2 = unpack('V',substr($cmdData,4,4))[1];
				$width = unpack('V',substr($cmdData,8,4))[1];
				$height = unpack('V',substr($cmdData,12,4))[1];
				$p5 = unpack('v',substr($cmdData,16,2))[1];
				$bitsperpixel = unpack('v',substr($cmdData,18,2))[1];
				$picsize = unpack('V',substr($cmdData,24,4))[1];
				//$picdata = substr($cmdData,28+(16*4));
				$picdata = substr($cmdData,28);
				
				$cmdDetails .= "PictureSize: 0x".dechex($picsize)."\n";
				$cmdDetails .= "Width: 0x".dechex($width)."\n";
				$cmdDetails .= "Height: 0x".dechex($height)."\n";
				$cmdDetails .= "P1: 0x".dechex($p1)."\n";
				$cmdDetails .= "P2: 0x".dechex($p2)."\n";
				$cmdDetails .= "P5: 0x".dechex($p5)."\n";
				
				$screenshot['width'] = $width;
				$screenshot['height'] = $height;
				$screenshot['data'] = $picdata;
				//$screenshot['data'] = '';
				$screenshot['bitsperpixel'] = $bitsperpixel;
				break;
			case 0x03:
				$cmdStr = "Receiving Screenshot";
				$picpos = unpack('V',substr($cmdData,0,4))[1];
				$picsize = unpack('V',substr($cmdData,4,4))[1];
				$chunksize = unpack('V',substr($cmdData,8,4))[1];
				$picdata = substr($cmdData,12);
				
				$cmdDetails .= "PicPos: 0x".dechex($picpos)."\n";
				$cmdDetails .= "PicSize: 0x".dechex($picsize)."\n";
				$cmdDetails .= "ChunkSize: 0x".dechex($chunksize)."\n";
				
				$screenshot['data'] .= $picdata;
				if ($picpos+$chunksize == $picsize) {
					// Tansfer complete, Write out the image
					$pi = 0;
					$width = $screenshot['width'];
					$height = $screenshot['height'];
					$pixels = $screenshot['data'];
					$bitsperpixel = $screenshot['bitsperpixel'];
					$img = imagecreatetruecolor($width,$height);
					
					$bmheader = "BM";
					$bmheader .= pack('V',$picsize);
					$bmheader .= pack('V',0);
					$bmheader .= pack('V',0x36);
					$bmheader .= pack('V',0x28);
					$bmheader .= pack('V',$width);
					$bmheader .= pack('V',$height);
					$bmheader .= pack('v',0x01);
					$bmheader .= pack('v',$bitsperpixel);
					$bmheader .= pack('V',0);
					$bmheader .= pack('V',$picsize-0x36);
					
					$img = $bmheader.$screenshot['data'];
					$scount = $screenshot['count'];
					file_put_contents("screenshot_raw",$screenshot['data']);
					file_put_contents("screenshot_".$scount.".bmp",$img);
					$screenshot['count']++;
				}
				break;
			default: 
				$cmdDetails .= "Unknown Command $cmdID ...\n";
				break;
		}
	}
	else  if (strcmp(bin2hex($cmdHash), "155bbf4a1efe1517734604b9d42b80e8") === 0){
		// Default Command Switcher
		switch($cmdID){
			case 0x1:
				$cmdStr = "Start CMD Shell"; 
				if (!empty($cmdData)) $cmdDetails .= "CmdData: ".bin2hex($cmdData)."\n";
				break;
			case 0x2:
				$cmdStr = "WTF CMD 2";
				if (!empty($cmdData)) $cmdDetails .= "CmdData: ".bin2hex($cmdData)."\n";
				break;
			case 0x3:	
				$cmdStr = "Get Computer and User Info"; 
				if (!empty($cmdData)) $cmdDetails .= "CmdData: ".bin2hex($cmdData)."\n";
				break;
			case 0x4:	
				$cmdStr = "Get Version Nums"; 
				if (!empty($cmdData)) $cmdDetails .= "CmdData: ".bin2hex($cmdData)."\n";
				break;
			case 0x5:	
				$cmdStr = "Alloc File"; 
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				$filetype = substr($cmdData,16,4);
				$filepos = unpack('V',substr($cmdData,20,4))[1];
				$filesize = unpack('V',substr($cmdData,24,4))[1];
				$chunksize = unpack('V',substr($cmdData,28,4))[1];
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FileType: ".$filetype."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "ChunkSize: 0x".dechex($chunksize)."\n";
				if (!empty(trim($filehash))) $files[bin2hex($filehash)] = "";
				break;
			case 0x6:	
				$cmdStr = "Append To File"; 
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				$filetype = substr($cmdData,16,4);
				$filepos = unpack('V',substr($cmdData,20,4))[1];
				$filesize = unpack('V',substr($cmdData,24,4))[1];
				$chunksize = unpack('V',substr($cmdData,28,4))[1];
				$filedata = substr($cmdData,32);
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FileType: ".$filetype."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "ChunkSize: 0x".dechex($chunksize)."\n";
				if (!empty(trim($filehash))) {
					if (empty($files[bin2hex($filehash)])) $files[bin2hex($filehash)] = "";
					$files[bin2hex($filehash)] .= $filedata;
				}
				break;
			case 0x7:	
				$cmdStr = "File Downloaded, Load it"; 
				if (empty($cmdData)) break;
				$filehash = substr($cmdData,0,16);
				$filetype = substr($cmdData,16,4);
				$filepos = unpack('V',substr($cmdData,20,4))[1];
				$filesize = unpack('V',substr($cmdData,24,4))[1];
				$chunksize = unpack('V',substr($cmdData,28,4))[1];
				
				$cmdDetails .= "FileHash: ".bin2hex($filehash)."\n";
				$cmdDetails .= "FileType: ".$filetype."\n";
				$cmdDetails .= "FilePos: 0x".dechex($filepos)."\n";
				$cmdDetails .= "FileSize: 0x".dechex($filesize)."\n";
				$cmdDetails .= "ChunkSize: 0x".dechex($chunksize)."\n";
				if (!empty(trim($filehash))) file_put_contents($dir_module.bin2hex($filehash), $files[bin2hex($filehash)]); // Write the module to disk
				break;
			case 0xe:	
				$cmdStr = "CheckPassword"; 
				$cmdDetails .= "CmdData: ".bin2hex($cmdData)."\n";
				break;
			default: 
				$cmdDetails .= "Unknown Command $cmdID ...\n";
				break;
		}
	}
	else  if (strcmp(bin2hex($cmdHash), "77d6ce92347337aeb14510807ee9d7be") === 0){
		// Packet Forwarder
		switch ($cmdID){
			case 0x1:
				$cmdStr = "Connect"; 
				$port = unpack('V',substr($cmdData,0,4))[1];
				$ip = trim(substr($cmdData,4));
				$cmdDetails .= "Conenct to: ".$ip.":".$port."\n";
				break;
			case 0x3:
				$cmdStr = "Forward Packet";
				$forward = $cmdData;
				file_put_contents($dir_forward."fwd_".$i.".pkt", $forward); // Write forwarded packet to disk
				break;
			case 0x4:
				$cmdStr = "Act As Middle Man"; 
				if (!empty($cmdData)) $cmdDetails .= "CmdData: ".bin2hex($cmdData)."\n";
				break;
			default: 
				$cmdDetails .= "Unknown Command $cmdID ...\n";
				break;
		}
	}
	else{
		echo "Unknown CMD Hash...\n";
	}
	
	printMsg("CmdHash: ".bin2hex($cmdHash), $msgprefix);
	printMsg("CmdMagic: 0x".$magic, $msgprefix);
	printMsg("CmdID: 0x".dechex($cmdID)." ($cmdStr) ", $msgprefix);
	printMsg("CmdCounter: 0x".dechex($cmdCounter), $msgprefix);
	printMsg("CmdP1: 0x".bin2hex($cmdP1), $msgprefix);
	printMsg("CmdP2: 0x".bin2hex($cmdP2), $msgprefix);
	$details = explode("\n",$cmdDetails);
	foreach ($details as $detail){
		printMsg($detail,$msgprefix."\t");
	}
	//echo $cmdDetails;
}

function printMsg($msg, $prefix){
	echo $prefix.$msg."\n";
}
?>