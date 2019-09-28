<?php

// start
echo deobfus("8a8902fe", "043579a27c36")."\n"; // ws2_#2
echo deobfus("54d372cf", "d532461732ac0bd13f1c7c9a4821eb6a")."\n"; // k e r n e l 3 2
echo deobfus("0753d351", "647297f8f5c369ffb098")."\n";
echo deobfus("30ec436e", "eeceb3e116b5")."\n";
echo deobfus("9767d5d1", "43693b3cafc03f834f")."\n";
echo deobfus("75813581", "4a654efbfe")."\n";
echo deobfus("dd7c6fbe", "c245299f")."\n";
echo deobfus("bb0a4741", "ef3077af2fc8e31ed256d49d")."\n"; // LoadLibraryA
echo deobfus("33284124", "0b9f9540432713")."\n";
echo deobfus("07c808ad", "55983158bd19da347327cd49")."\n";
echo deobfus("3dccd6c3", "5ac4dac38fbd")."\n";
echo deobfus("737cdc6a", "b4fda71d")."\n";
echo deobfus("c0050fa1", "0c3411276f6a47a604b78c")."\n"; // closesocket
echo deobfus("cc6d3861", "6b0dee5388ece953e468")."\n";
echo deobfus("3bb7c6e2", "450165cf2f00")."\n";
echo deobfus("fd391ab4", "e9512426b744")."\n";
echo deobfus("24949586", "763a3a3f")."\n"; // recv
echo deobfus("dc5332ea", "2d23458979861f266c5674f6")."\n"; // VirtualAlloc
echo deobfus("77895bfb", "051b5a53d1100592194c91")."\n"; // VirtualFree
echo deobfus("77468f07", "b54ac8b22ccbbe0bdbbd6c")."\n"; // Close Handle
echo deobfus("91e8a57d", "bd642046adade87a397c26")."\n"; // CreateFileA
echo deobfus("8625e471", "87084923bf21")."\n"; // msvcrt
echo deobfus("52c00442", "1925decf843121")."\n"; // sprintf
echo deobfus("fbe54ecb", "7e2f1a6770639022a161a9aff20290")."\n";

echo deobfus("75e19ac4", "6eebe2288886f99dbc1339ec06f76c01646cc0f7c082bc38")."\n"; // ZwQuerySystemInformation
echo deobfus("09413d5b", "c9b6bc769f7b1e59b6cee74f5f9f126ef4586f")."\n"; // MmSectionObjectType
echo deobfus("63fd50fb", "c88875116280085d3e877205a8d8a978a7cc")."\n"; // IoDriverObjectType
echo deobfus("a9d1b9d2", "440b606d54f1803f6f7c03db18f8")."\n"; // ObCreateObject
echo deobfus("82dc377b", "8392fe6587d74c0cd087526d00")."\n"; // D r i v e r w
echo deobfus("bbfd6ac2", "840a84982049d16aa2051f822108d0022e7930133d304bbe00")."\n"; // F L A R E L o a d e d
echo deobfus("39dbba7a", "23c9ea248973b05ca526616400")."\n"; // F L S T R M
echo deobfus("ddfb7b49", "3920308798487380a08bbd2fc287a90b1cb8be2c725732")."\n"; // ZwAllocateVirtualMemory
echo deobfus("d91d1b94", "8cb39ae5e13ee79eed540f8fbd9ea2f04b108b")."\n"; // RtlCreateUserThread
echo deobfus("48db7c49", "587730c512c1e2d5b6e078e6c00325c525f7bd")."\n"; // ZwFreeVirtualMemory

// from s.dll (screenshot)
echo deobfus("7067b6c0", "8b21db399c8c0ffaabdf2057d9dc7d7900")."\n"; // K E R N E L 3 2
echo deobfus("64db9832", "d89d7faeb8bd05163547403e")."\n"; // VirtualAlloc
echo deobfus("56b3ead9", "0734db1e8386d9f69d1d27")."\n"; // VirtualFree
echo deobfus("6ea85ab7", "2c5eb7647456d92d01094a66")."\n"; // LoadLibraryA
echo deobfus("92af65f2", "3f2c163ed958")."\n"; // user32
echo deobfus("ad454c2f", "d75b85a1be")."\n"; // gdi32
echo deobfus("ae070dcd", "01e27a69cc36391b8282f898a9463d4c")."\n"; // GetDesktopWindow
echo deobfus("3355ad0f", "96dccfd87edcb562b93fa2779f44b8baba2d")."\n"; // SetProcessDPIAware
echo deobfus("0885ed9f", "027c79affcd5caa546ea7c2db2")."\n"; // GetClientRect
echo deobfus("88d6cf18", "8e37cf48ce")."\n"; // GetDC
echo deobfus("7529ec35", "14d399b72ec032d9d0a1907a74bfc6ceddd8")."\n"; // CreateCompatitbleDC
echo deobfus("e35831ce", "b87541ca7c3826f33d4b1671d6685624e37cc24e4a7f")."\n"; // CreateCompatitbleBitmap
echo deobfus("2b474a37", "b8c24fe98c33709ee8aa7742")."\n"; // SelectObject
echo deobfus("33737d56", "87447b7dac7d")."\n"; // BitBlt
echo deobfus("d20f395c", "152f543739f234f50168")."\n"; // GetObjectA
echo deobfus("6ab999d6", "e6ca25088a1931fb6d")."\n"; // GetDIBits
echo deobfus("ab5d0688", "239fe95106898630c23563f0")."\n"; // GetLastError
echo deobfus("71e3a510", "e8b09b1bcc8cd04887327621")."\n"; // DeleteObject
echo deobfus("69e628bb", "71f5a5abb85eb501da")."\n"; // ReleaseDC

// from n.dll (network)
echo deobfus("ff8b3f01", "c0f4264af55e")."\n"; // ws2_32
echo deobfus("20dbf93f", "d7dcc00a4695bd10d22bd0fed9ca1d7300")."\n"; // k e r n e l 3 2
echo deobfus("afab6008", "cb44b287280985d78115")."\n"; // WSAStartup
echo deobfus("e0a8fa1e", "73200edf3563")."\n"; // socket
echo deobfus("f84fbbda", "b14c23058cad177ff5")."\n"; // inet_addr 
echo deobfus("d0182e82", "0537d387ff")."\n"; // htons
echo deobfus("103db284", "856db4ff")."\n"; // send
echo deobfus("9cdbf142", "e50529773a5c8fe9f0b665b3")."\n"; // LoadLibraryA
echo deobfus("9a124a69", "86df1018c12b91")."\n"; // connect
echo deobfus("bfec0f13", "99e2363ac4db")."\n"; // msvcrt
echo deobfus("7283163c", "8b3d8a5e34eb")."\n"; // malloc
echo deobfus("0bc57b04", "78fa83d1")."\n"; // free
echo deobfus("b675d2d5", "d9d8e02097cfae97759373")."\n"; // closesocket

// from c.dll (crypto)
echo deobfus("a89dcfd6", "95a8a2bf04cf6a96")."\n"; // advapi32
echo deobfus("578df4b6", "c2220aac0396203d6e60dadc")."\n"; // GetUserNameA
echo deobfus("3d6f988b", "e97ca1623c5940fe0ce5acc82f6f75d4c2")."\n"; // RtlCompressBuffer
echo deobfus("1069ec97", "3e092414cedd46e66654374d")."\n"; // LoadLibraryA
echo deobfus("5c53fda6", "de5427ecb348fe4edb8b315822fadb67a015f96d01596eb11bd61ed7af5a")."\n"; // RtlGetCompressionWorkSpaceSize
echo deobfus("a90d32ad", "996e0c5bdc")."\n"; // ntdll
echo deobfus("bb677f63", "38ee68cfa56ee4f960977f05")."\n"; // VirtualAlloc
echo deobfus("2da1597f", "051efe2522466b3fb61a35dccf6f8cf3")."\n"; // k e r n e l 3 2
echo deobfus("061d5d1c", "3ad5a3a0a5efac668e2e806dce7a")."\n"; // GetProcAddress
echo deobfus("d0d6c630", "42ed33db5dc0fd7c24ee37")."\n"; // VirtualFree

// from k.dll (keylogger)
echo deobfus("71ca3331", "fc00c1493459a8def1268d5182df049b")."\n"; // k e r n e l 3 2
echo deobfus("cfdba913", "8769ee0311f5d932f5183ff3a77330a4928dc9e723eb23a4d489aaeff3d31595544bf6535e")."\n"; // InitializeCriticalSectionAndSpinCount
echo deobfus("387ddaba", "122285adde7b04d08c2955c8")."\n"; // LoadLibraryA
echo deobfus("4bbc2fe7", "7ef1a4adc7a59a9fb4dfa169")."\n"; // CreateThread
echo deobfus("58d2650b", "a6794a0597c32235f9f83bca3386e8292c96c2")."\n"; // WaitForSingleObject
echo deobfus("cf94d406", "b509e7ea6146aa526bd8fd")."\n"; // GetThreadId
echo deobfus("ec1b9642", "902a891618d15981759347")."\n"; // CloseHandle
echo deobfus("73680139", "531f389291aac208b6746f45")."\n"; //VirtualAlloc
echo deobfus("ef26bb65", "518b4de9e2bb6c5901dd8feb77721700c3dc")."\n"; // PostThreadMessageA
echo deobfus("4a017920", "b26dcbb13854")."\n"; // user32
echo deobfus("7d29c272", "da4bc7e8")."\n"; // free
echo deobfus("38f261c8", "63a04f3942b5")."\n"; // msvcrt
echo deobfus("4a017920", "b26dcbb13854")."\n"; // user32
echo deobfus("d03ab919", "6f06b01f0f22490b9a2fde51c1c6")."\n"; // CallNextHookEx
echo deobfus("9a0ac1a0", "19d0dbde87e50c29e559c424547e16de10")."\n"; // SetWindowsHookExA
echo deobfus("6010ce34", "00f834ffaf055f3b4e2b9b5faceec5")."\n"; // SetWinEventHook
echo deobfus("ea62cf26", "abbf64f125fd129cd820914e3463e06cf8371e")."\n"; // UnhookWindowsHookEx
echo deobfus("f4eeceb9", "684ba345518931244f23e65fd58d")."\n"; // UnhookWinEvent
echo deobfus("c79967c1", "385fc5b3cdab4f1e919786")."\n"; // GetMessageA
echo deobfus("1d0fb0d4", "472bfb1e7bf41dfdb06025025bc30c77")."\n"; // DispatchMessageA
echo deobfus("d03ab919", "6f06b01f0f22490b9a2fde51c1c6")."\n"; // CallNextHookEx
echo deobfus("1c75fa0f", "b38fb82c43446030306d5203ef282c1528be2b387a28b6")."\n"; // RtlEnterCriticalSection
echo deobfus("95fdf627", "1daf7def14305ac3111cdf6efbc910edb2e7838042cf89")."\n"; // RtlLeaveCriticalSection
echo deobfus("5cac52a3", "8da2217de60e6d16674e64")."\n"; // GetKeyState
echo deobfus("f864a4d5", "d641971f006991")."\n"; // realloc
echo deobfus("5f480e48", "331f7001c7")."\n"; // ntdll
echo deobfus("73680139", "531f389291aac208b6746f45")."\n"; // VirtualAlloc
echo deobfus("12b18fcc", "56ddef03a2f5094d1198cae8d24974d508ef2b")."\n"; // GetForegroundWindow
echo deobfus("e6ad96e9", "9dd80b21aa969226bcb957d3073f")."\n"; // GetWindowTextA
echo deobfus("916de7f6", "17e5aeb14b2f")."\n"; // malloc
die();

// from f.dll (file)
echo deobfus("c8300441", "24ee5876e81e12a3b42dcd7184a51a94")."\n"; // k e r n e l 3 2
echo deobfus("bce6ac41", "65e3aa4f93d892bfaf2e9c5e")."\n"; // VirtualAlloc
echo deobfus("9732b74e", "a9e0a47c1b9c0953a46320b79a77")."\n"; // GetProcessHeap
echo deobfus("59bf7073", "7e5b4bb06ab53794")."\n"; // HeapFree
echo deobfus("4bbe0f4f", "6a125c5ea0c5b4045f6f92")."\n"; // DeleteFileA
echo deobfus("2ac67d3d", "2816551197189bab3cafa9")."\n"; // CreateFileA
echo deobfus("24c4da96", "763f96fb1dcf5afffb9316")."\n"; // GetFileSize
echo deobfus("73ca06de", "312cd52c55669d3073d94c")."\n"; // CloseHandle
echo deobfus("f1176d6e", "016497c8f6d0fbf4")."\n"; // ReadFile
echo deobfus("a020a023", "ce342b412bf2f4a230237b")."\n"; // VirtualFree
echo deobfus("9edc725c", "37340e1b91b9e5ac14")."\n"; // WriteFile
echo deobfus("074d2582", "836cda9a6b90")."\n"; // msvcrt
echo deobfus("6986c627", "21dad384")."\n"; // free
echo deobfus("4a3d32e6", "28db0a950e3f005a23410667")."\n"; // LoadLibraryA
echo deobfus("3019395b", "fa382803d4127999507e86d56c84")."\n"; // GetProcAddress
echo deobfus("82339123", "8291ec743347bc83e55106331a95")."\n"; // FindFirstFileA
echo deobfus("c9b83c16", "3b9b099fa1c0ea6d3b225ffe5e")."\n"; // FindNextFileA
echo deobfus("dc97bbec", "b35d223dc4f50f4f29")."\n"; // FindClose
echo deobfus("454a541d", "29f45cb93c3f")."\n"; // malloc
echo deobfus("0f473f1d", "6a97bc097b35")."\n"; // strstr

// echo deobfus("", "")."\n";
function deobfus($key, $msg){
    return rc4(hex2bin($key), hex2bin($msg));
}

function rc4($key, $str) {
	$s = array();
	for ($i = 0; $i < 256; $i++) {
		$s[$i] = $i;
	}
	$j = 0;
	for ($i = 0; $i < 256; $i++) {
		$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
	}
	$i = 0;
	$j = 0;
	$res = '';
	for ($y = 0; $y < strlen($str); $y++) {
		$i = ($i + 1) % 256;
		$j = ($j + $s[$i]) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
		$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
	}
	return $res;
}
?>