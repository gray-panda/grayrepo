################################################################################
# Welcome to the 2017 FLARE-ON Challenge mega-script. Have fun!
################################################################################
Set-StrictMode -Version 2.0
$logo = @"
--------------------------------------------------------------------
                               _a,                                 
                              _W#m,                                
                             _Wmmmm/                               
BmmBmmBmm[  Bmm             a#mmmmmB/        BmmBmmBm6a   3BmmBmmBm
mmm[        mmm            j##mmmmmmm6       mmm   -4mm[  3mm[        
mBmLaaaa,   Bmm           JW#mmP 4mmmmL      mmBaaaa#mm'  3Bm6aaaa,
mmmP!!"?'   mmm          JWmmmP   4mmmBL     Bmm!4X##"    3mmP????'
Bmm[        Bmmaaaaa    jWmmm?     4mmmBL    mmm  !##L,   3BmLaasaa
mmm[        mmm##Z#Z  _jWmmmmaaaaaa,]mBmm6.  mmB   "#Bm/  3mmm#UZ#Z
                     _WBmmmmm#Z#Z#!  "mmmBm,                          
                     ??!??#mmmm#!     "??!??                          
                        .JmmmP'                                    
                       _jmmP'                                      
                      _JW?'                                        
                      "?                                           
--------------------------------------------------------------------
Welcome to FLARE Single-User Dungeon v2.4 - Escape Room
--------------------------------------------------------------------
"@

################################################################################
# Graeber + Dbo = Graebo? Dber?
################################################################################
SET-Item  vaRIabLE:S52  ([typE]('RuNTime.INTERopseRVICES.CallINGConVENTiOn'));
$qVdjaZ = [TyPE]('rUnTIME.INteROPServices.chArsEt');
$H06bGf  = [type]('runtIME.intEroPserVicEs.dLLiMPORtATTrIbUTE');
function GeT-CuStOmATTr {
	$dlL = $aRgS[0];
	$FUNc =  $aRgs[1];
	$SeTLaSt = $ARgS[2];
	$fIElDaRRAy =  [Reflection.FieldInfo[]] @(
		(ChilDitEM("VARIABLE:h06BGf")).VAlUE.("GetField").Invoke("EntryPoint"),
		$H06bGf.("GetField").Invoke("PreserveSig"),
		(vaRIAbLE H06BGf).VaLUE.("GetField").Invoke("SetLastError"),
		$H06bGf.("GetField).Invoke("CallingConvention"),
		(GET-vArIaBLE H06bGF).VaLuE.("GetField").Invoke("CharSet")
		);
	$FieLDVAlUeS = [Object[]] @(
		$fuNC, $TRUe, $seTlasT,
		(gET-VaRiAblE S52 ).VAlue::"wInaPI",
		(get-vARiaBle ('QvdjAZ' ) -vALueo)::"uNiCOde" );
		$DllimPORTCONsTRuCTor =  (Dir vARiablE:h06BGf).vALUE."gETcoNSTrUctoR"(@([String]));
		$ATTR = .("new-Object") rEfleCTION.emItCuSTomatTRIbuteBUiLDer($DlLIMpORTConSTRuCTOR, @($dLl), $fIeLdARRAy, $fiEldVaLues);
		return $aTTr;   
	}

. SEt-ITEM VariaBLE:q21s ([TyPE]("aPpdoMaIn"));
& set-ITeM  VaRiAble:x1RwF ([TYPe]("rEfLECtiOn.emiT.ASseMBLyBUildErAcCesS"));

function GET-MsvCRT {
 $DYNaSSeMBly = &("New-Object") System.Reflection.AssemblyName("Win32Lib");
 $aSSEMBlYbUiLdeR =  $q21s::CUrREnTdomain.deFiNEdYNamiCAssEMbLy($DynAsSEMBly,  $x1rWF::"RUN");
 $MoDuLEBuILDER = $asseMBlybUiLDEr.DefineeDynamicModule.Invoke("Win32Lib", $FAlSe);
 $typeBUILDER = $mOduLeBuILdeR.DefineType.Invoke("msvcrt", "Public, Class");
 $MeTH_SRaND = $TyPeBuiLder.DefineMethod.Invoke("srand", [Reflection.MethodAttributes] ("Public, Static"), [Void], [Type[]] @([Int32]));
 MetH_rAND = $typeBuIldeR.DefineMethod.Invoke("rand", [Reflection.MethodAttributes] ("Public, Static"), [Int32], [Type[]] @());
 $atTR_sRAnd = &("Get-CustomAttr") ("msvcrt.dll") ("srand") $FAlse;
 $ATTR_RAnd = &("Get-CustomAttr") ("msvcrt.dll") ("rand") $fAlse;
 $mETH_srANd.SetCustomAttribute.Invoke($ATtr_srAND);
 $mETH_RAND.SetCustomAttribute.Invoke($ATTR_RAND);

 return $TypeBUIldEr.CreateType.Invoke(); 
}


################################################################################
# Character class
################################################################################

function New-Char()
{
	return new-object PSObject -Property @{ Name="Our Hero"; Contents=@(); Wearing=@(); }
}

function Get-Inventory($char, $trailing) {
	$inv = ''
	if ($char.Contents.Count -ne 0) {
		foreach ($thing in $char.Contents) {
			$inv += "n  $($thing.Name)"
		}
	}

	if ($inv -eq '') {
		$inv = 'nothing'
	}
	return "You have: $inv"
}

################################################################################
# Map class
################################################################################
function New-Map
{
	return New-Object PSObject -Property @{ StartingRoom=@() }
}

function Get-Map
{
	$map = New-Map

	$outside = New-Room "Outside" "You're locked out. It doesn't look like there's a way back in."
	Add-RoomLink $outside 'n' $outside 
	Add-RoomLink $outside 'e' $outside 

	$vestibule = New-Room "the vestibule" "This is surely the entrance to a great company."
	Add-RoomLink $vestibule 's' $outside -OneWay

	$lobby = New-Room "the lobby" "There is a reception desk with ferns on either side, and a sign that says MANDIANT."
	Add-RoomLink $vestibule 'n' $lobby

	$sehall = New-Room "the southeast hallway" "This is the hallway between the lobby and the restrooms"
	Add-RoomLink $lobby 'e' $sehall

	$mens = New-Room "the men's room" "This is an immaculate men's room."
	Add-RoomLink $sehall 'e' $mens
	$womens = New-Room "the women's room" "This is an immaculate women's room."
	Add-RoomLink $sehall 's' $womens

	$cubicles = New-Room "the Mandiant offices" "This is where the magic happens. To the west, open work areas, cubicles, offices, and adjustable desks stretch out and intersect in a dazzling maze as far as the eye can see."
	Add-RoomLink $sehall 'n' $cubicles

	$confrooms = New-Room "the conference rooms" "A row of impressive conference rooms spans out before you. Behind the frosted glass are clean tables, perfectly aligned chairs, and neatly wired audio/visual equipment. Every conference room is empty. A low hum of server fans can be heard."
	Add-RoomLink $cubicles 'n' $confrooms

	$office = New-Room "Kevin Mandia's Office" "This room smells of rich mahogany and leather."
	Add-RoomLink $confrooms 'n' $office

	$itcloset = New-Room "the IT access junction" "A shelf contains neatly labeled bins of adapters, cables, and other IT equipment. A moderate hum of server and switch fans can be heard."
	Add-RoomLink $confrooms 'w' $itcloset

	$nwhall = New-Room "the northeast hallway" "This hallway links the snack/lunch area with the IT access junction."
	Add-RoomLink $itcloset 'w' $nwhall

	$lunchroom = New-Room "the snack/lunch area" "An impressive array of juices, waters, coffes, teas, cookies, chips, and snacks adorn every corner. There is an LCD TV displaying a FireEye threat map."
	Add-RoomLink $nwhall 's' $lunchroom

	$swhall = New-Room "the southwest hallway" "This hallway links the snack/lunch area with the lobby."
	Add-RoomLink $lunchroom 's' $swhall

	Add-RoomLink $swhall 'e' $lobby

	$maze = New-Room "work area" "This is someone's cubicle. The desk has a laptop docked on it, and is festooned with the personal effects of whoever works here. The whiteboard has a humorous drawing on it."

	Add-RoomLink $maze 'n' $maze
	Add-RoomLink $maze 'e' $maze
	Add-RoomLink $maze 'u' $maze
	Add-RoomLink $cubicles 'e' $maze -OneWay

	$map.StartingRoom = $vestibule

	$sign = New-Thing "a MANDIANT sign" "It is a sign saying MANDIANT in large, red letters." @("sign", "mandiant") -Hidden -Fixed

	$key = New-Thing "a key" "You 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" @("key")

	$drawers = New-Thing "the desk drawers" "The drawers are mostly empty, except the bottom-right drawer which contains some junk." @("drawer", "drawers", "desk drawer", "desk drawers") -Hidden -Fixed -Container -Contents @($key)
	$sheet = New-Thing "a sign-in sheet" "It's blank, and chained to the desk." @("sign-in", "sign-in sheet", "sheet", "signin", "signin sheet") -Hidden -Fixed
	$fern1 = New-Thing "a potted fern" "It is a healthy fern." @("fern", "ferns") -Hidden
	$fern2 = New-Thing "a potted fern" "It is a healthy fern." @("fern", "ferns") -Hidden
	$desk = New-Thing "a desk" "It's a plain desk with a sign-in sheet and laptop on top and a few drawers on the sides." @("desk") -Fixed
	$computer = (New-Thing "a computer" "It's powered off and tethered to the desk with a chain." @("computer", "laptop") -Hidden -Fixed)
	$lobby.Contents += $sign
	$lobby.Contents += $desk
	$lobby.Contents += $fern1
	$lobby.Contents += $fern2
	$lobby.Contents += $drawers
	$lobby.Contents += $sheet
	$lobby.Contents += $computer

	$pewpew = New-Thing "an LCD TV displaying a FireEye threat map" "Pew pew." @("threat map", "threatmap", "map", "tv", "lcd") -Hidden -Fixed
	$lunchroom.Contents += $pewpew

	$kevinmandia = New-Thing "Kevin Mandia" "This guy looks pretty intense." @("kevin", "mandia", "kevinmandia", "theman", "themyth", "thelegend") -Fixed
	$kevinsdesk = New-Thing "Kevin Mandia's Desk" "It is made of rich mahogany." @("desk") -Fixed
	$helmet = New-Thing "A football helmet" "It is a black football helmet with a FireEye logo on the side and numerous cryptic decals. It begs to be worn." @("helmet")
	$office.Contents += $kevinmandia
	$office.Contents += $kevinsdesk
	$office.Contents += $helmet

	return $map
}

################################################################################
# Room class
################################################################################

function New-Exits([PSObject]$n=$null, [PSObject]$s=$null, [PSObject]$e=$null, [PSObject]$w=$null, [PSObject]$u=$null, [PSObject]$d=$null)
{
	return New-Object PSObject -Property @{ N=$n; S=$s; E=$e; W=$W; U=$u; D=$d }
}

function New-Room([String]$name, [String]$desc, [PSObject]$n=$null, [PSObject]$s=$null, [PSObject]$e=$null, [PSObject]$w=$null, [PSObject]$u=$null, [PSObject]$d=$null)
{
	return New-Object PSObject -Property @{ Name=$name; Desc=$desc; Contents=@(); Exits=New-Exits $n $s $e $w $u $d }
}

function Add-RoomLink([PSObject]$room1, $dir_to_2, [PSObject]$room2, [Switch]$OneWay=$false)
{
	switch ($dir_to_2.ToLower()) {
		'n' { $room1.Exits.N = $room2; if ($OneWay -eq $false) { $room2.Exits.S = $room1 } }
		's' { $room1.Exits.S = $room2; if ($OneWay -eq $false) { $room2.Exits.N = $room1 } }
		'e' { $room1.Exits.E = $room2; if ($OneWay -eq $false) { $room2.Exits.W = $room1 } }
		'w' { $room1.Exits.W = $room2; if ($OneWay -eq $false) { $room2.Exits.E = $room1 } }
		'u' { $room1.Exits.U = $room2; if ($OneWay -eq $false) { $room2.Exits.D = $room1 } }
		'd' { $room1.Exits.D = $room2; if ($OneWay -eq $false) { $room2.Exits.U = $room1 } }
	}
}

function Get-RoomAdjoining($room, $direction) {
	$adjoining = $null

	switch ($direction.ToLower()) {
		'n' { $adjoining = $room.Exits.N }
		'north' { $adjoining = $room.Exits.N }
		's' { $adjoining = $room.Exits.S }
		'south' { $adjoining = $room.Exits.S }
		'e' { $adjoining = $room.Exits.E }
		'east' { $adjoining = $room.Exits.E }
		'w' { $adjoining = $room.Exits.W }
		'west' { $adjoining = $room.Exits.W }
		'u' { $adjoining = $room.Exits.U }
		'up' { $adjoining = $room.Exits.U }
		'd' { $adjoining = $room.Exits.D }
		'down' { $adjoining = $room.Exits.D }
	}

	return $adjoining
}

################################################################################
# Item class
################################################################################

function New-Thing($name, $desc, [String[]]$keywords, [Switch]$container=$false, [PSObject[]]$contents=@(), [Switch]$hidden=$false, [Switch]$fixed=$false)
{
	return new-object PSObject -Property @{ Name=$name; Desc=$desc; Keywords=$keywords; Container=$container; Contents=$contents; Hidden=$hidden; Fixed=$fixed }
}

function Get-ThingByKeyword($container, $kw) {
	foreach ($thing in $container.Contents) {
		if ($thing.Keywords -contains $kw.ToLower()) {
			return $thing
		}
	}

	return $null
}

################################################################################
# Commands
################################################################################

function Get-NotImplementedCmd()
{
	return "You don't know how to do that yet."
}

function Get-InvalidCmd()
{
	return "Huh?"
}

################################################################################
# UI/char/game
################################################################################

function Invoke-Move($char, $room, $cmd) {

	$split = $cmd.Split()
	$base = $split[0]
	$trailing = [String]$split[1..$split.Length]


	Add-ConsoleText "n> $cmd"
	$script:lastcmd = $cmd

	$resp = ''

	switch($base.ToLower()) {
		'' { } # Instead of going "Huh?" when the player just presses enter

		'h' { $resp = Get-SudHelp }
		'help' { $resp = Get-SudHelp }
		'q' { $script:window.Close() }
		'quit' { $script:window.Close() }
		'exit' { $script:window.Close() }

		'inv' { $resp = Get-Inventory $char $trailing }
		'inventory' { $resp = Get-Inventory $char $trailing }

		'get' { $resp = Invoke-GetThing $char $room $trailing }
		'wear' { $resp = Invoke-Wear $char $trailing }
		'remove' { $resp = Invoke-Remove $char $trailing }
		'drop' { $resp = Invoke-DropThing $char $room $trailing }

		'l' { $resp = Get-LookText $char $room $trailing }
		'look' { $resp = Get-LookText $char $room $trailing }

		'n' { $resp = Invoke-MoveDirection $char $room 'n' $trailing }
		'north' { $resp = Invoke-MoveDirection $char $room 'n' $trailing }
		's' { $resp = Invoke-MoveDirection $char $room 's' $trailing }
		'south' { $resp = Invoke-MoveDirection $char $room 's' $trailing }
		'e' { $resp = Invoke-MoveDirection $char $room 'e' $trailing }
		'east' { $resp = Invoke-MoveDirection $char $room 'e' $trailing }
		'w' { $resp = Invoke-MoveDirection $char $room 'w' $trailing }
		'west' { $resp = Invoke-MoveDirection $char $room 'w' $trailing }
		'u' { $resp = Invoke-MoveDirection $char $room 'u' $trailing }
		'up' { $resp = Invoke-MoveDirection $char $room 'u' $trailing }
		'd' { $resp = Invoke-MoveDirection $char $room 'd' $trailing }
		'down' { $resp = Invoke-MoveDirection $char $room 'd' $trailing }

		'say' { $resp = Invoke-Say $char $room $trailing }
		default { $resp = Get-InvalidCmd($char) }
	}

	if ($resp -ne '') {
		Add-ConsoleText $resp
	}
}

function Get-SudHelp {
	$resp = ""
	
	$resp += "Game commands:n"
	$resp += "h[elp] - See this helpn"
	$resp += "q[uit] - Exit the gamen"
	$resp += "n"
	$resp += "Area commands:n"
	$resp += "l[ook] [object] - Look at the room [or at an optional object)n"
	$resp += "n[orth] - Move northn"
	$resp += "s[outh] - Move southn"
	$resp += "e[ast] - Move eastn"
	$resp += "w[est] - Move westn"
	$resp += "u[p] - Move upn"
	$resp += "d[own] - Move downn"
	$resp += "n"
	$resp += "Personal commands:n"
	$resp += "say <someone> <words...> - Say <words...> to <someone>n"
	$resp += "wear <inventory-item> - Put <inventory-item> onn"
	$resp += "remove <thing> - Take <thing> offn"
	$resp += "n"
	$resp += "Inventory commands:"
	$resp += "inv[entory] - Check your inventoryn"
	$resp += "get <object> [location] - Get object [from within optional location])n"
	$resp += "drop <object> - Put object downn"

	return $resp
}

function Add-ConsoleText($text) {
	$script:console.AppendText("n$text")
	Invoke-ScrollToEnd
}

function Invoke-ScrollToEnd() {
	$script:console.SelectionStart = $script:console.TextLength
	$script:console.ScrollToCaret()
}

function Invoke-Wear($char, $trailing) {
	$thing = Get-ThingByKeyword $char $trailing
	if ($thing -eq $null) {
		$resp = "You don't have a $trailing to wear."
	} else {
		if ($trailing -ne "helmet") {
			$resp = "You put the $trailing on your head. It looks objectively silly."
		} else {
			$resp = "You put the $trailing on your head. It looks objectively awesome."
		}
		$al = [System.Collections.ArrayList]($char.Contents)
		$al.Remove($thing)
		$char.Contents = $al

		$char.Wearing += $thing
	}

	return $resp
}

function Invoke-Remove($char, $trailing) {
	$resp = "You are not wearing a $trailing."
	$removing = $null
	foreach ($thing in $char.Wearing) {
		if ($thing.Keywords -contains $trailing.ToLower()) {
			$removing = $thing
			break
		}
	}

	if ($removing -ne $null) {
		$resp = "You take off the $trailing."
		$al = [System.Collections.ArrayList]($char.Wearing)
		$al.Remove($thing)
		$char.Wearing = $al

		$char.Contents += $thing
	}

	return $resp
}

function Invoke-DropThing($char, $room, $trailing) {
	$resp = ''

	$thing = Get-ThingByKeyword $char $trailing
	if ($thing -eq $null) {
		$resp = "You don't have a $trailing to drop."
	} else {
		$result = Invoke-TransferThing $char $room $thing
		if ($result -eq $true) {
			$resp = "You drop a $trailing"
		} else {
			$resp = "For whatever reason, you can't drop the $trailing"
		}
	}

	return $resp
}

function Invoke-TransferThing([PSObject][ref]$container_old, [PSObject][ref]$container_new, $thing) {
	$ret = $false

	if ($thing.Fixed -eq $false) {
		$al = [System.Collections.ArrayList]($container_old.Contents)
		$al.Remove($thing)
		$container_old.Contents = @($al)

		$container_new.Contents += $thing
		$ret = $true

		if (($thing.Keywords -Contains "key") -and ($container_new -eq $script:char)){
			${MsvcRT}::("srand").Invoke(42)
		}
	}

	return $ret
}

function Invoke-Say($char, $room, $trailing) {
	$resp = "It doesn't talk back"

	$ar = $trailing.Split()
	if ($ar.Length -lt 2) {
		return "Syntax: say <someone> <words...>"
	}

	$to_whom = $ar[0]
	$words = $ar[1..99999]

	$thing = Get-ThingByKeyword $room $to_whom
	if ($thing.Name -eq "Kevin Mandia") {
		$resp = "Kevin says a friendly 'hello' and then looks back down at his computer. He's busy turbo-hacking."

		$key = Get-ThingByKeyword $room 'key'

		$helmet = $null
		foreach ($thing in $char.Wearing) {
			if ($thing.Keywords -contains "helmet") {
				$helmet = $thing
			}
		}

		if (($key -ne $null) -and ($helmet -ne $null)) {
			$md5 = New-Object System.Security.Cryptography.MD5CryptoServiceProvider
			$utf8 = New-Object System.Text.UTF8Encoding
			$hash = [System.BitConverter]::ToString($md5.ComputeHash($utf8.GetBytes($key.Desc)))


			$Data = [System.Convert]::FromBase64String("EQ/Mv3f/1XzW4FO8N55+DIOkeWuM70Bzln7Knumospan")
			$Key = [System.Text.Encoding]::ASCII.GetBytes($hash)

			# Adapated from the gist by harmj0y et al
			$R={$D,$K=$Args;$H=$I=$J=0;$S=0..255;0..255|%{$J=($J+$S[$_]+$K[$_%$K.Length])%256;$S[$_],$S[$J]=$S[$J],$S[$_]};$D|%{$I=($I+1)%256;$H=($H+$S[$I])%256;$S[$I],$S[$H]=$S[$H],$S[$I];$_-bxor$S[($S[$I]+$S[$H])%256]}}
			$x = (& $r $data $key | ForEach-Object { "{0:X2}" -f $_ }) -join ' '
			$resp = "nKevin says, with a nod and a wink: '$x'."
			$resp += "nnBet you didn't know he could speak hexadecimal! :-)"
		}
	}

	return $resp
}

function Invoke-GetThing($char, $room, $trailing) {
	$resp = ''

	$container = $null

	$ar = $trailing.Split()
	if ($ar.Length -gt 2) {
		return "Syntax: get thing [container]"
	}

	$wanted = $ar[0]
	$containername = ''
	if ($ar.Length -eq 2) {
		$containername = $ar[1]
	}

	if ($containername -ne '') {
		$container = Get-ThingByKeyword $room $containername
		if ($container -eq $null) {
			$container = Get-ThingByKeyword $char $containername
		}

		if ($container -eq $null) {
			return "There is no $containername to get a $wanted out of."
		}

		$thing = Get-ThingByKeyword $container $wanted

		if ($thing -eq $null) {
			return "There is no $wanted in the $containername."
		}

		$ret = Invoke-TransferThing ([ref]$container) ([ref]$char) $thing
		if ($ret -eq $true) {
			$thing.Hidden = $false
			return "You get $($thing.Name)."
		} else {
			return "You can't get $($thing.Name)."
		}
	}

	$thing = Get-ThingByKeyword $room $wanted

	if ($thing -eq $null) {
		$thing = Get-ThingByKeyword $char $wanted
		if ($thing -ne $null) {
			$resp = "You already have that"
		} else {
			$resp = "You don't see that here."
		}
	} else {
		$ret = Invoke-TransferThing $room $char $thing
		if ($ret -eq $true) {
			$thing.Hidden = $false
			$resp = "You get $($thing.Name)."
		} else {
			$resp = "You can't get $($thing.Name)."
		}
	}

	return $resp
}

function Invoke-XformKey([String]$keytext, [String]$desc) {
	$newdesc = $desc 

	Try {
		$split = $desc.Split()
		$text = $split[0..($split.Length-2)]
		$encoded = $split[-1]
		$encoded_urlsafe = $encoded.Replace('+', '-').Replace('/', '_').Replace('=', '%3D')
		$uri = "${script:baseurl}?k=${keytext}&e=${encoded_urlsafe}"
		# baseurl was set to 'http://127.0.0.1:9999/some/thing.asp'

		$r = Invoke-WebRequest -UseBasicParsing "$uri"

		$decoded = $r.Content

		if ($decoded.ToLower() -NotContains "whale") {
			$newdesc = "$text $decoded"
		}
	} Catch {
		Add-ConsoleText "..."
	}

	return $newdesc
}

function Invoke-MoveDirection($char, $room, $direction, $trailing) {
	$nextroom = $null
	$movetext = "You can't go $direction."
	$statechange_tristate = $null

	$nextroom = Get-RoomAdjoining $room $direction
	if ($nextroom -ne $null) {
		$key = Get-ThingByKeyword $char 'key'
		if (($key -ne $null) -and ($script:okaystopnow -eq $false)) {
			$dir_short = ([String]$direction[0]).ToLower()

			$N = sCRiPt:MSVcRt::rand()%6

			if ($directions_enum[$dir_short] -eq ($n)) {
				$script:key_directions += $dir_short
				$newdesc = Invoke-XformKey $script:key_directions $key.Desc
				$key.Desc = $newdesc
				if ($newdesc.Contains("@")) {
					$nextroom = $script:map.StartingRoom
					$script:okaystopnow = $true
				}
				$statechange_tristate = $true
			} else {
				$statechange_tristate = $false
			}
		}

		$script:room = $nextroom
		$movetext = "You go $($directions_short[$direction.ToLower()])"

		if ($statechange_tristate -eq $true) {
			$movetext += "nThe key emanates some warmth..."
		} elseif ($statechange_tristate -eq $false) {
			$movetext += "nHmm..."
		}

		if ($script:autolook -eq $true) {
			$movetext += "n$(Get-LookText $char $script:room $trailing)"
		}
	} else {
		$movetext = "You can't go that way."
	}

	return "$movetext"
}

function Get-ThingsText($room) {
	$thingstext = Get-ContentsText $room.Contents

	if ($thingstext -ne '') {
		$thingstext = "nnYou see: $thingstext"
	}
	return $thingstext
}

function Get-ExitsText($room) {
	$exitstext = ''

	if ($room.Exits.N -ne $null) { $exitstext += "North "}
	if ($room.Exits.S -ne $null) { $exitstext += "South "}
	if ($room.Exits.E -ne $null) { $exitstext += "East "}
	if ($room.Exits.W -ne $null) { $exitstext += "West "}
	if ($room.Exits.U -ne $null) { $exitstext += "Up "}
	if ($room.Exits.D -ne $null) { $exitstext += "Down "}

	if ($exitstext -ne '') {
		$exitstext = "nnExits: $exitstext"
	}

	return $exitstext
}

function Get-ContentsText($container, [Switch]$OneLine=$false) {
	$resp = ''

	$spacer = '  '
	$sep = ''
	$lf = "n"
	if ($OneLine -eq $true) {
		$spacer = ''
		$sep = ', '
		$lf = ''
	}

	foreach ($thing in $container) {
		if ($thing.Hidden -eq $false) {
			if ($resp -eq '') {
				$resp = "$lf$spacer$($thing.Name)"
			} else {
				$resp += "$lf$sep$spacer$($thing.Name)"
			}
		}
	}

	return $resp
}

function Get-ThingDesc($thing, [Switch]$OneLine=$false) {
	$desc = ''

	if ($thing -ne $null) {
		$desc = $thing.Desc

		if ($desc.Length -gt 1024) {
			$desc = $desc.Substring(0, 1023) + "..."
		}

		if ($thing.Container -eq $true) {
			$contents = Get-ContentsText $thing.Contents -OneLine:$OneLine
			if ($contents -ne '') {
				$desc += " It has $contents."
			}
		}
	}

	return $desc
}

function Get-LookText($char, $room, [String]$at) {
	$looktext = ''

	if ($at.Length -gt 0) {
		if ( $script:directions -contains $at.ToLower() ) {
			$dirname = $at.ToLower()

			if ($directions_short.ContainsKey($dirname)) {
				$dirname = $directions_short[$dirname]
			}

			$preposition = $prepositions[$dirname]

			$looktext = "There is nothing $preposition here."

			$adjoining = Get-RoomAdjoining $room $at
			if ($adjoining) {
				$preposition = $preposition.substring(0, 1).ToUpper() + $preposition.substring(1)
				$name = $adjoining.Name.ToLower()
				$looktext = "$preposition here is $name"
			}

		} else {
			$thing = Get-ThingByKeyword $char $at
			if ($thing -ne $null) {
				$looktext = Get-ThingDesc $thing -OneLine
			}

			if ($looktext -eq '') {
				$thing = Get-ThingByKeyword $room $at
				if ($thing -ne $null) {
					$looktext = Get-ThingDesc $thing -OneLine
				}
			}
		}
	} else {
		$exits = $(Get-ExitsText $room)
		$things = $(Get-ThingsText $room)
		return "$($room.Name)n$($room.Desc) $things $exits"
	}

	if ($looktext -eq '') {
		$looktext = "You don't see that here."
	}

	return $looktext
}

function Invoke-HandleMove($sender, $e) {
	if ($e.KeyCode -eq 'Enter')
	{
		$cmd = $sender.Text
		foreach ($mv in $cmd.Split(",")) {
			Invoke-Move $script:char $script:room $mv.Trim()
		}
		$sender.Text = ''
		$e.SuppressKeyPress = $true
	}

	if ($e.KeyCode -eq 'Escape')
	{
		$script:window.Close()
	} elseif ($e.KeyCode -eq 'Up') {
		$script:input.Text = $script:lastcmd
	}
}

################################################################################
# Script
################################################################################

[void]([System.Reflection.Assembly]::LoadWithPartialName('System.Windows.Forms'))
[void]([System.Reflection.Assembly]::LoadWithPartialName('System.Drawing'))
$msgBox = [System.Windows.Forms.MessageBox]


$window = New-Object System.Windows.Forms.Form
$window.Size = New-Object System.Drawing.Point(800, 670)
$window.Text = "FLARE SUD v2.4 - Escape Room"

$bmp = New-Object System.Drawing.Bitmap(64,64)
$g = [System.Drawing.Graphics]::FromImage($bmp)
$mode = [System.Drawing.Drawing2D.FillMode]::Alternate

$p0 = New-Object System.Drawing.PointF(31, 0)
$p1 = New-Object System.Drawing.PointF(10, 44)
$p2 = New-Object System.Drawing.PointF(21, 44)
$p3 = New-Object System.Drawing.PointF(12, 63)
$p4 = New-Object System.Drawing.PointF(38, 36)
$p5 = New-Object System.Drawing.PointF(24, 36)
$p6 = New-Object System.Drawing.PointF(32, 19)
$p7 = New-Object System.Drawing.PointF(44, 44)
$p8 = New-Object System.Drawing.PointF(54, 44)
$p9 = New-Object System.Drawing.PointF(31, 0)

$a_shape = ($p0, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9)
$a_color = [System.Drawing.Brushes]::LightBlue
$g.FillPolygon($a_color, $a_shape, $mode)
$ico = [System.Drawing.Icon]::FromHandle($bmp.GetHicon())

$window.Icon = $ico

$console = New-Object System.Windows.Forms.RichTextBox
$console.Size = New-Object System.Drawing.Point(780, 590)
$console.ReadOnly = $true
$console.Font = "Consolas, 12"
$console.BackColor = 'Black'
$console.ForeColor = 'YellowGreen'

$input = New-Object System.Windows.Forms.TextBox
$input.Size = New-Object System.Drawing.Point(800, 40)
$input.Location = New-Object System.Drawing.Point(1, 595)
$input.ShortcutsEnabled = $true
[System.Windows.Forms.Application]::EnableVisualStyles()
$input.add_KeyDown([System.Windows.Forms.KeyEventHandler]{param($s,$e) Invoke-HandleMove $s $e})

$window.Controls.Add($console)
$window.Controls.Add($input)

$autolook = $true
$char = New-Char
$map = Get-Map
$room = $map.StartingRoom


$baseurl = 'http://127.0.0.1:9999/some/thing.asp'
$directions = @('n', 'north', 's', 'south', 'e', 'east', 'w', 'west', 'u', 'up', 'd', 'down')
$directions_short = @{'n' = 'north'; 's' = 'south'; 'e' = 'east'; 'w' = 'west'; 'u' = 'up'; 'd' = 'down'}
$directions_enum = @{'n' = 0; 's' = 1; 'e' = 2; 'w' = 3; 'u' = 4; 'd' = 5}
$prepositions = @{'north' = 'north of'; 'south' = 'south of'; 'east' = 'east of'; 'west' = 'west of'; 'uu' = 'above'; 'down' = 'below'}
[String]$key_directions = ''
$lastcmd = ''

function Start-Game {
	$script:window.Activate()
	$script:input.Focus()

	# Shout-out to Stonekeep, Tenchi, and the 414
	$dialstring_hayes_compatible = "ATDT 14141111111........."
	$telnet_string = "jgsdos.flare-on.com 5000"

	Add-ConsoleText $dialstring_hayes_compatible
	Add-ConsoleText $telnet_string

	Add-ConsoleText "Connected to ${telnet_string}n"

	Add-ConsoleText "${logo}nnYou are in $($room.Name). Try looking around."
}

$okaystopnow = $false

$window.Add_Shown({Start-Game})
$window.BringToFront()
$MsvCRt = &('Get-msvcrt')
$ret = $window.ShowDialog()
