Attribute VB_Name = "ThisDocument"
Attribute VB_Base = "1Normal.ThisDocument"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = True
Attribute VB_TemplateDerived = True
Attribute VB_Customizable = True
#If VBA7 And Win64 Then
Private Declare PtrSafe Function jFlnz8 Lib "winmm.dll" Alias "sndPlaySoundA" _
       (ByVal lpszSoundName As String, ByVal uFlags As Long) As Long
#Else
Private Declare Function jFlnz8 Lib "winmm.dll" Alias "sndPlaySoundA" _
       (ByVal lpszSoundName As String, ByVal uFlags As Long) As Long
#End If

Public cMSuxt As Variant
Public gkKg As Object
Public cN3r As String
Public kZ4gU8sc As String
Public qa317 As Integer

Sub playsSoundFile() // znOIKcDsLlMKQVsnFfWaE2bHu18RdOmKFoVb
    Selection.WholeStory
    Selection.Font.ColorIndex = (Selection.Font.ColorIndex + 1) Mod 15
    If Selection.Font.ColorIndex Mod 2 = 0 Then
        Set gkKg = CreateObject("Excel.Application")
        gkKg.Speech.speak NpuXrzgq.Label1, True
        gkKg.Quit
    ElseIf Selection.Font.ColorIndex Mod 2 = 1 Then
        adk49an = Environ("tmp") & "\" & "asdf"
        jFlnz8 adk49an, 1
    End If
    Application.OnTime Now + TimeValue("00:00:01"), "znOIKcDsLlMKQVsnFfWaE2bHu18RdOmKFoVb"
End Sub

Private Sub callsCallsXorAndCompare(m4dYL, fviLw9) // UxKo3LivfGHxI2OtWa3KtqOgY6cRb5yrbR00
    On Error GoTo NavnYIF0:
    Dim fjGeMmP8Z() As Byte
    fjGeMmP8Z = Z1yiWeP.base64_encode(m4dYL)
    Z1yiWeP.callsXorAndCompare fjGeMmP8Z, fviLw9
NavnYIF0:
    GoTo VadXU4
VadXU4:

End Sub

Private Function lookForSomething(dd) As Boolean // BqNFmKCS7cTPv9XNFOd2mCLrdqCfmdNm6HBz
    lookForSomething = False
    On Error GoTo B3A:
    Dim A4xcPiKtrr() As Byte
    A4xcPiKtrr = Z1yiWeP.base64_encode(dd)
    lookForSomething = Z1yiWeP.checkFlag1(A4xcPiKtrr)
B3A:
End Function

Private Function findSpecificProcedure() // zoycqKJvqznJMeMpHe7Z61xYJfLLmbObxBVy
    findSpecificProcedure = None
    For Each vbComponents In ActiveDocument.VBProject.VBComponents
        l = 1
        Set cm = vbComponents.CodeModule
        Do While l < cm.CountOfLines
            procedureName = cm.ProcOfLine(l, 0)
            If procedureName <> "" Then
                If lookForSomething(procedureName) Then
                    findSpecificProcedure = procedureName
                    GoTo CfHFE
                End If
                l = l + cm.ProcCountLines(procedureName, 0)
            Else
                l = l + 1
            End If
        Loop
    Next vbComponents
CfHFE:
End Function

Private Sub checkStuffs() // XiqyXdC809pP5esSrC633ag92w0x6otQylY0
    sN2l0P = findSpecificProcedure
    If Not IsNull(sN2l0P) Then
        For Each vbComponents In ActiveDocument.VBProject.VBComponents
            If vbComponents.Type = 1 Then
                i = 1
                Set cm = vbComponents.CodeModule
                Do While i < cm.CountOfLines
                    pn = cm.ProcOfLine(i, 0)
                    If pn <> "" Then
                        callsCallsXorAndCompare pn, sN2l0P
                        i = i + cm.ProcCountLines(pn, 0)
                    Else
                        i = i + 1
                    End If
                Loop
            End If
        Next vbComponents
    End If
    writeAndPlayAudioFile
End Sub

Private Function writeFile(filename, rawdata) // OcbCTRJiqmq8ZHdtwfA1hsuje7UPUwkL1TcL
    df = Environ("tmp") & "\" & filename
    Dim data() As Byte
    data = Z1yiWeP.base64_encode(rawdata)
    Open df For Binary Access Write As #1
    Put #1, , data
    Close #1
    writeFile = df
End Function

Private Sub writeAndPlayAudioFile() // zkceuV405Q5LjUp587OYxTI7OR9zTyPdvz8k
    callsWriteFile
    Selection.WholeStory
    Selection.Delete
    Selection.TypeText NpuXrzgq.Label1
    Selection.WholeStory
    Selection.Font.Size = 72
    playsSoundFile
End Sub

Private Sub callsWriteFile() // yRQaQqmn4iZIgFxTHSbChaoJt9SxKmV7T1L5
    cMSuxt = Array(writeFile("asdf", NpuXrzgq.assda))
    kZ4gU8sc = NpuXrzgq.Label1
End Sub

Public Sub Document_Open()
    On Error GoTo sjjQMD:
    If ActiveDocument.VBProject.VBComponents.Count > 4 Then
        checkStuffs
    Else
        writeAndPlayAudioFile
    End If
sjjQMD:
    If err.Number = 6068 Or err.Number = 50289 Then
        writeAndPlayAudioFile
    Else
        Resume Next
    End If
End Sub


