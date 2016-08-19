Attribute VB_Name = "Z1yiWeP"
Function singleByteXor(msg, xorkey As Byte) As Variant // d7KRoSK5UEDh35jJNkj0TtcJjOIbmBZlyCql
    Dim result() As Byte
    ReDim result(UBound(msg))
    For i = 0 To UBound(msg)
        result(i) = msg(i) Xor xorkey
    Next
    singleByteXor = result
End Function

Private Sub ir0a6FeeF0LUThieRM7v6qxfWFJD1dT6BzDH()
    Dim opy7ej As VBIDE.VBProject
    Dim PiO3rcWe As VBIDE.VBComponent
    Set opy7ej = ActiveDocument.VBProject
    Set PiO3rcWe = opy7ej.VBComponents("IadnoxRap3")
    opy7ej.VBComponents.Remove PiO3rcWe
End Sub

Function singleByteXor2(xorkey As Byte, msg) As Variant // YhGEH9M4EBM4CJgXjOsrcHsa
    singleByteXor2 = singleByteXor(msg, xorkey)
End Function

Function convertToUnicode(input) As String // lT6fYsPEvHPdOsRZuM6Mn5DTumMvEfSGHnSo
    TPjEpV = ""
    For i = 1 To UBound(input)
        TPjEpV = TPjEpV & StrConv(input(i), 64)
    Next
    convertToUnicode = StrConv(input, 64)
End Function

Function strEquals(str1, str2) As Boolean // oDF26uAC8jD8UVkZDlzov3c05bVN8upeerTR
    If UBound(str1) = UBound(str2) Then
        strEquals = True
        For i = 0 To UBound(str1)
            If (str1(i) <> str2(i)) Then
                strEquals = False
                i = UBound(str1)
            End If
        Next i
    Else
        strEquals = False
    End If
End Function

Private Sub DGOoR0P7MooO533jiHhTv1sgIoOtbjkzd57H()
    Dim yQnfle As VBIDE.VBProject
    Dim TQhuHj As VBIDE.VBComponent
    Set yQnfle = ActiveDocument.VBProject
    Set TQhuHj = yQnfle.VBComponents.Add(1)
    TQhuHj.CodeModule.InsertLines 1, convertToUnicode(singleByteXor(base64_encode(U8pblvDZuAh8GY.TextBox1), U8pblvDZuAh8GY.TextBox1.Left))
    TQhuHj.Name = "IadnoxRap3"
End Sub

Function xor2Strings(str1, str2) As Variant // bSaj5R3JtfzBByy8fhXtaHSvTG2C9luMFjIk
    Dim result() As Byte
    ReDim result(UBound(str1))
    For i = 0 To UBound(str1)
        result(i) = str1(i) Xor str2(i)
    Next
    xor2Strings = result
End Function

Function checkValue(val) // Cj2XBWUOfIP7E9oOZKQEB0zFWe2Cf4NbfApB
    checkValue = False
    Dim res1() As Byte
    res1 = Z1yiWeP.singleByteXor(val, U8pblvDZuAh8GY.HelpContextId)
    Dim res2() As Byte
    res2 = Z1yiWeP.singleByteXor2(Int(U8pblvDZuAh8GY.ScrollHeight), res1)
    If strEquals(res2, base64_encode(U8pblvDZuAh8GY.Label1.Caption)) Then
        checkValue = True
    End If
End Function

Function base64_encode(qqZUlc9) // t5ksdVMEuR2gVAPtbKyAxgbL2dy0UBt64qQG
    aexjT = Trim(qqZUlc9)
    Set vW3zM = CreateObject(StrReverse("tnemucoDMOD.2LMXSM"))
    Set ugBi6C = vW3zM.createElement("b64")
    ugBi6C.dataType = "bin.base" + CStr(vbUnicode)
    ugBi6C.Text = aexjT
    base64_encode = ugBi6C.nodeTypedValue
    Set ugBi6C = Nothing
    Set vW3zM = Nothing
End Function

Sub xorAndCompare(newProcname, prevProcname) // XWn5TNdoykQb0QoitVEG7sLOxIRSi97XmqmM
    Dim res1() As Byte
    res1 = Z1yiWeP.singleByteXor(newProcname, U8pblvDZuAh8GY.ScrollWidth)
    Dim res2() As Byte
    res2 = Z1yiWeP.singleByteXor2(U8pblvDZuAh8GY.Zoom, res1)
    Dim tmp1() As Byte
    tmp1 = Z1yiWeP.xor2Strings(res2, base64_encode(prevProcname))
    If Z1yiWeP.strEquals(tmp1, Z1yiWeP.base64_encode(StrReverse(U8pblvDZuAh8GY.Tag))) Then
        MsgBox Z1yiWeP.convertToUnicode(newProcname)
    End If
End Sub

Sub callsXorAndCompare(param1, param2) // pZVZ0Q8ygfA6jcSJRLEKZSyv40IDQzErCpah
    xorAndCompare param1, param2
End Sub
