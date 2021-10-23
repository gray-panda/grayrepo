## Flare-On CTF 2021
# Challenge 01 : credchecker

```
Welcome to Flare-On 8!  

This challenge surves as your tutorial mission for the epic quest you are about to emark upon.  
Reverse engineer the Javascript code to determine the correct username and password the web page is looking for and it will show you the flag. 
Enter that flag here to advance to the next stage. 
All flags will be in the format of valid email addresses and all end with "@flare-on.com".

7-zip password: flare
```

We are provided a 7zip file with a simple HTML page with some authentication Javascript

The **checkcreds** function is the one

```js
function checkCreds() {
	if (username.value == "Admin" && atob(password.value) == "goldenticket") 
	{
		... display flag ...
	}
	else
	{
		.. display error ...
	}
}
```

Username is "Admin" and passsword is base64 encoded of "goldenticket"


```sh
> echo -n "goldenticket" | base64
Z29sZGVudGlja2V0
```

The flag will be shown once the credentials are entered

![flag](img/flag.png)

The flag is **enter_the_funhouse@flare-on.com**
