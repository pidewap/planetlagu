<?php
error_reporting(0);
include 'getid3/getid3.php';

function getfileinfo($remoteFile)

{

$url=$remoteFile;
$uuid=uniqid("designaeon_", true);
 $file="temp/".$uuid.".mp3";
 $size=0;
 $ch = curl_init($remoteFile);
 
$contentLength = 'unknown';
 $ch1 = curl_init($remoteFile);
 curl_setopt($ch1, CURLOPT_NOBODY, true);
 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch1, CURLOPT_HEADER, true);
 curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true); 
 $data = curl_exec($ch1);
 curl_close($ch1);
 if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
 $contentLength = (int)$matches[1];
 $size=$contentLength;
 }
 
 if (!$fp = fopen($file, "wb")) {
 echo 'Error opening temp file for binary writing';
 return false;
 } else if (!$urlp = fopen($url, "r")) {
 echo 'Error opening URL for reading';
 return false;
 }
 try {
 $to_get = 65536;
 $chunk_size = 4096;
 $got = 0; $data = null;

 while(!feof($urlp) && $got < $to_get) {  $data = $data . fgets($urlp, $chunk_size);  $got += $chunk_size;  }  fwrite($fp, $data);
if ($size > 0) {
 curl_setopt($ch, CURLOPT_FILE, $fp);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RESUME_FROM, $size - $to_get);
 curl_exec($ch);
 }

 
@fclose($fp);
 @fclose($urlp);
 } catch (Exception $e) {
 @fclose($fp);
 @fclose($urlp);
 echo 'Error transfering file using fopen and cURL !!';
 return false;
 }
 $getID3 = new getID3;
 $filename=$file;
 $ThisFileInfo = $getID3->analyze($filename);
 getid3_lib::CopyTagsToComments($ThisFileInfo);
 unlink($file);
 return $ThisFileInfo;
}

function maling($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}
return '';
}
}

$uar=array('Nokia2610/2.0 (07.04a) Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/6.3.1.20.0','Nokia5300/2.0 (05.51) Profile/MIDP-2.0 Configuration/CLDC-1.1','Nokia6030/2.0 (y3.44) Profile/MIDP-2.0 Configuration/CLDC-1.1','NokiaN70-1/5.0616.2.0.3 Series60/2.8 Profile/MIDP-2.0 Configuration/CLDC-1.1');
$uarr=array_rand($uar);
$uarand=$uar[$uarr];

ini_set('default_charset',"UTF-8");
ini_set('user_agent',$uarand."\r\naccept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1\r\naccept_charset: $_SERVER[HTTP_ACCEPT_CHARSET]\r\naccept_language: bahasa");


$f=file('http://www.planetlagu.site/'.$_GET['id'].'/');
$gg=@implode($f);
$pagelink=maling($gg, '<ol class="uldownload">', '</ol>');
$linkdir=maling($gg, 'http://planetlagu.download/links?sub=mp3download&id=', '.mp3');
$lname=maling($gg, 'Download lagu <strong>', '</strong>');
$ggg=explode('<li>', $pagelink);

if(!empty($_GET['url'])){
$url=$_GET['url'];
}else{
$url=''.$linkdir.'';
}

if(!empty($_GET['name'])){
$nname=$_GET['name'];
}else{
$nname=''.$lname.'';
}


if(empty($pagelink)){

$a=getfileinfo(''.str_replace(' ', '%20', $url).'');
if(!empty($_GET['infos'])){
echo'<pre>';
print_r($a);
echo'</pre>';
}else{
 echo '<style>.input {width:80%;}</style><center><form method="post" action="/muviza.php" enctype="multipart/form-data">URL:<br>
<input type="text" class="input" name="mp3_filepath" value="'.urlencode(str_replace(' ', '%20', $url)).'" /><br>
<input type="hidden" class="input" name="mp3_filename" value="'.urlencode(str_replace(' ', '_', $a[tags][id3v2][artist]['0'])).'_-_'.urlencode(str_replace(' ', '_', $a[tags][id3v2][title]['0'])).'.mp3" />Judul Lagu:<br>
<input type="text" class="input" name="mp3_songname" value="'.htmlspecialchars($a[tags][id3v2][title]['0']).'" />
<input type="hidden" class="input" name="mp3_comment" value="Download from SatriaMusic.com" /><br>Artist:<br>
<input type="text" class="input" name="mp3_artist" value="'.htmlspecialchars(str_replace('PlanetLagu', 'SatriaMusic', $a[tags][id3v2][artist]['0'])).' - SatriaMusic.com" /><br>
<input type="hidden" class="input" name="mp3_album" value="'.htmlspecialchars($a[tags][id3v2][album]['0']).'" />
<input type="hidden" class="input" name="mp3_year" value="'.htmlspecialchars($a[tags][id3v2][year]['0']).'" />
<input type="hidden" class="input" name="mp3_genre" value="'.htmlspecialchars($a[tags][id3v2][genre]['0']).'" /><br>
<input type="submit" name="submit" value=" Download Music "/></form></center>';
}} else {
for($i=1;$i<=500;$i++){
$eurl=maling($ggg[$i], 'http://planetlagu.download/links?sub=mp3download&id=', '.mp3');
$ename=maling($ggg[$i], '<strong>', ' MP3</strong>');
if(!empty($eurl)){
echo ''.$i.' <a href="?url='.$eurl.'&name='.$ename.'">'.$eurl.'</a><br/>';
}
}
}
?>
