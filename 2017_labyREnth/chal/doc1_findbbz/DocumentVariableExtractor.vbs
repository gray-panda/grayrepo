Option Explicit

if WScript.Arguments.Count < 2 then
	WScript.Echo "Not enough arguments" & vbCRLF
    WScript.Echo "cscript <thisfile> targetfile variablename" & vbCRLF
end if

Dim objWord
Dim wordPath
Dim currentDocument
Dim dict

wordPath = WScript.Arguments(0)

Set objWord = CreateObject("Word.Application")
objWord.WordBasic.DisableAutoMacros 1

objWord.Documents.Open wordPath, false, true
Set currentDocument = objWord.Documents(1)

dict = currentDocument.Variables(WScript.Arguments(1)).Value
WScript.Echo dict & vbCRLF

currentDocument.Close
Set currentDocument = Nothing
objWord.Quit
Set objWord = Nothing