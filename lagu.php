<?php
error_reporting(0);
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

if(!empty($_GET['page'])){
$pages='page/'.$_GET['page'].'/';
}else{
  $pages='';
}

if(!empty($_GET['url'])){
  $urr=$_GET['url'];
}else{
  $urr='https://k2nblog.com/category/single-album/k-pop/'.$pages.'';
}


$f=file(''.$urr.'');
$gg=@implode($f);
$bod=maling($gg, '<body', '</body>');

$bod=str_replace('https://k2nblog.com/category/single-album/k-pop/page/', '/lagu.php?page=', $bod);
$bod=str_replace('<!--hidelink-->iTunes:', 'itunes:', $bod);
$bod=str_replace('MP3:', '<!--hidelink-->MP3:', $bod);
$bod=str_replace('https://k2nblog.com/', '/lagu.php?url=https://k2nblog.com/', $bod);

if(!empty($_GET['url'])){
  $linkxmega=maling($gg, 'mega/logo.png', '4shared.gif');
  $linkmega=maling($linkxmega, '<!--hidelink-->', '<!--endhidelink-->');
  $linkshared=maling($gg, '4shared.gif', '</p>');
  $hdesc=maling($gg, '<p>Track List:', '</p>');
}
if(!empty($_GET['url'])){
  $linkmegax=maling($linkmega, '?u=', '"');
  $linksharedx=maling($linkshared, '?u=', '"');
  $artist=maling($gg, '<meta itemprop="description" content="', ' - ');
  $imgs=maling($gg, '<p><center><img src="', '"');
echo '<textarea>'.base64_decode($linkmegax).'</textarea><p></p>
<textarea>'.base64_decode($linksharedx).'</textarea><p></p><textarea>'.$imgs.'</textarea><p></p><p>'.$artist.'</p><br/><p>'.$hdesc.'';
}else{
echo strip_tags($bod, '<a><div><p><br>');
  echo '<center><a href="?page='.($_GET['page']-1).'">BACK</a> | <a href="?page='.($_GET['page']+1).'">NEXT</a><b>'.$urr.'</center>';
}
?>
