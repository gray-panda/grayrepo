<?php
$HTTP2_MAGIC = "PRI * HTTP/2.0\r\n\r\nSM\r\n\r\n";

$FRAMETYPES = array();
$FRAMETYPES[0] = "DATA";
$FRAMETYPES[1] = "HEADERS";
$FRAMETYPES[2] = "PRIORITY";
$FRAMETYPES[4] = "SETTINGS";
$FRAMETYPES[5] = "PUSH_PROMISE";
$FRAMETYPES[7] = "GOAWAY";
$FRAMETYPES[8] = "WINDOW_UPDATE";

function checkHTTP2Magic($input){
	global $HTTP2_MAGIC;
	return strpos($input, $HTTP2_MAGIC) === 0;
}

function getHTTP2MagicSize(){
	global $HTTP2_MAGIC;
	return strlen($HTTP2_MAGIC);
}

function getHTTP2FrameSize($input){
	return unpack('N', "\x00".substr($input,0,3))[1];
}

class HTTP2_FRAME{
	public $len = -1;
	public $type = -1;
	public $flag = -1;
	public $streamid = -1;
	public $data = "";

	function __construct($input){
		$this->len = unpack('N', "\x00".substr($input,0,3))[1];
		$this->type = ord(substr($input,3,1));
		$this->flag = ord(substr($input,4,1));
		$this->streamid = unpack('N',substr($input,5,4))[1];
		$this->data = substr($input,9);
	}

	function printme(){
		global $FRAMETYPES;
		echo "----------\n";
		echo "Frame Length:\t".$this->len."\n";
		echo "Frame Type:\t".$FRAMETYPES[$this->type]." (".$this->type.")\n";
		echo "Frame Flag:\t".$this->flag."\n";
		echo "Stream ID:\t".$this->streamid."\n";
		echo "Data:\n";
		$datalen = strlen($this->data);
		if (strlen($this->data)>100){
			echo "<<< $datalen bytes >>> redacted \n";
		}
		//else echo bin2hex($this->data)."\n";
		else echo $this->data."\n";
		echo "----------\n";
	}
}
?>