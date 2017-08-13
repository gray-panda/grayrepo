<?php
$d1 = file_get_contents("311.jpg");
$d2 = file_get_contents("315.jpg");
file_put_contents("311315.jpg",$d1.$d2);
?>