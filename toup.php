<?php
define('BUFSIZ', 4095);
$url = 'http://srv-7.directserver.us/?file=mega_4181575602';
$rfile = fopen($url, 'r');
$lfile = fopen(basename($url), 'w');
while(!feof($rfile))
fwrite($lfile, fread($rfile, BUFSIZ), BUFSIZ);
fclose($rfile);
fclose($lfile);
?>
