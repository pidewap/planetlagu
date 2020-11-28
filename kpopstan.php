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
  $urr='https://kpopstan.com/category/single-album/'.$pages.'';
}


$f=file(''.$urr.'');
$gg=@implode($f);
$bod=maling($gg, '</head>', '</html>');
$bod=str_replace('/"', '"', $bod);
$bod=str_replace('https://kpopstan.com/category/single-album/k-pop/page/', '/kpopstan.php?page=', $bod);
$bod=str_replace('https://kpopstan.com/category/single-album/page/', '/kpopstan.php?page=', $bod);
$bod=str_replace('https://kpopstan.com/', '/kpopstan.php?url=https://kpopstan.com/', $bod);
   $artist=maling($bod, 'description" content="',' - ');
if(!empty($_GET['url'])){
  $sc=maling($gg, 'hostimg/mirror.png"/>', '<!--endhidelink-->');
   $sc=str_replace('http://j.gs/21989111/https://kpopstan.com/gotothedl.html?url=', '', $sc);
   $sc=strip_tags($sc, '<a>');
  $scx=maling($sc, 'href="', '"');
  $scx=base64_decode($scx);
  $hdesc=maling($bod, '<p>Track List:', '</p>');
  $artist=maling($gg, 'property="og:description" content="', ' - ');
  $imgs=maling($gg, '<p><center><img src="', '"');
echo '<center><textarea>'.str_replace('https', 'http', $imgs).'</textarea><br/>
<a href="'.$scx.'">Mirror</a><p></p>'.$artist.'<p></p>'.$hdesc.'
</center>';
}else{
echo strip_tags($bod, '<a><div><p><br>');
}
?>
