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
  $urr='https://k2nblog.com/category/single-album/k-pop/'.$_GET['page'].'';
}
if(!empty($_GET['url'])){
  $urr=$_GET['url'];
}
if(empty($_GET['url']) && empty($_GET['page'])) {
$urr='https://k2nblog.com/category/single-album/k-pop/';
}

$f=file(''.$urr.'');
$gg=@implode($f);
$bod=maling($gg, '<div class="td-category-description">', '<div class="td-pb-span4 td-main-sidebar">
');

$bod=str_replace('https://k2nblog.com/category/single-album/k-pop/page/', '/lagu.php?page=', $bod);
$bod=str_replace('https://k2nblog.com/', '/lagu.php?url=https://k2nblog.com/', $bod);

if(!empty($_GET['url'])){
  $linkmega=maling($gg, 'mega/logo.png', '<!--endhidelink-->');
}
if(!empty($_GET['url'])){
echo strip_tags($linkmega, '<a><br>');
}else{
echo strip_tags($bod, '<a><br>');
}
?>
