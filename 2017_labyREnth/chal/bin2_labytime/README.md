## LabyREnth CTF 2017
# Binary 2 : LabyTime

I reversed the binary and this is what it does

- Grab the Current Date Time from a NIST NTP server
- Only grab the 17 char DataTime Value "YY-MM-DD HH:ii:ss"
  - Change the last "second" value to "0"
- Does some encryption using this DateTime String and the String "!?!?AllYourFlagsAreBelongToUs!?!?!"
- The resulting (0x22 len) string is hashed using sha1 and displayed on the UI

In summary, it justs grabs the current time, zeroes out the last second value and produces a hash.

I then noticed that the challenge description had a reference to **labytime.com** 
  - As of this writing, this url is already down, thus I can't grab any screenshots

**labytime.com** accepts a hash as an input.

I then realized that the challenge is to somehow pass the generated hash from the binary to the website within the time limit (1 to 10 seconds)

As the binary's logic isn't too complicated, I re-implemented it into a [php script](soln.php)

```php
$url = "24.56.178.140:13"; // NIST Time server
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
curl_close($ch);
$dt = substr($resp,6);
$dt = substr($dt,0,17);
$dt[16] = "0";
echo $dt."\n";

// 17-07-04 12:26:34 50 0 0 659.8 UTC(NIST) *
// !?!?AllYourFlagsAreBelongToUs!?!?!
//$dt = "17-07-04 12:56:40";  
$adder = ord($dt[0]);
$plain = "!?!?AllYourFlagsAreBelongToUs!?!?!";
$enc = "";
for ($i=0; $i<strlen($plain); $i+=2){
	$p1 = ord($plain[$i]);
	$p2 = ord($plain[$i+1]);
	
	$d1 = ord($dt[($i % strlen($dt))]);
	$d2 = ord($dt[(($i+1) % strlen($dt))]);

	$e1 = (($p1 ^ $d1) + $adder) & 0xff;
	$e2 = (($p2 ^ $d2) + $adder) & 0xff;
	$enc .= chr($e1).chr($e2);
}
$thehash =  sha1($enc);
$theflag = "PAN{".$thehash."}";
echo "Submitting $theflag ...\n";

$url = "labytime.com";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$postfields = "flag=".urlencode($theflag);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,$postfields);
$resp = curl_exec($ch);
echo $resp."\n";
curl_close($ch);
```

Running the script will produce the flag

```
<div class="won">You won!<br>The real flag to submit is: PAN{tricky_tricky_better_be_quicky}</div></body>
```

The flag is **PAN{tricky_tricky_better_be_quicky}**