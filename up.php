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

$a=getfileinfo(''.str_replace(' ', '%20', $_GET['url']).'');
if(!empty($_GET['infos'])){
echo'<pre>';
print_r($a);
echo'</pre>';
}else{
if(!empty($a[tags][id3v2][title]['0'])){
 echo '<style>.input {width:80%;}</style><center><form method="post" action="/muviza.php" enctype="multipart/form-data">URL:<br>
<input type="text" class="input" name="mp3_filepath" value="http://mp3download.planetlagu.site/save/'.str_replace(' ', '%20', $url).'.mp3" /><br>
<input type="hidden" class="input" name="mp3_filename" value="'.str_replace(' ', '_', $nname).'.mp3" />Judul Lagu:<br>
<input type="text" class="input" name="mp3_songname" value="'.htmlspecialchars($a[tags][id3v2][title]['0']).'" />
<input type="hidden" class="input" name="mp3_comment" value="Download from SatriaMusic.com" /><br>Artist:<br>
<input type="text" class="input" name="mp3_artist" value="'.htmlspecialchars(str_replace('PlanetLagu', 'SatriaMusic', $a[tags][id3v2][artist]['0'])).'" /><br>
<input type="hidden" class="input" name="mp3_album" value="'.htmlspecialchars($a[tags][id3v2][album]['0']).'" />
<input type="hidden" class="input" name="mp3_year" value="'.htmlspecialchars($a[tags][id3v2][year]['0']).'" />
<input type="hidden" class="input" name="mp3_genre" value="'.htmlspecialchars($a[tags][id3v2][genre]['0']).'" /><br>
<input type="submit" name="submit" value=" Download Music "/></form></center>';
}
?>
