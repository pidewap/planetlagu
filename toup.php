<?php
define('BUFSIZ', 4095);
$url = 'http://wordpress.org/themes/download/wrock-metro.1.8.zip';
$rfile = fopen($url, 'r');
$lfile = fopen(basename($url), 'w');
while(!feof($rfile))
fwrite($lfile, fread($rfile, BUFSIZ), BUFSIZ);
fclose($rfile);
fclose($lfile);
?>
