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
$nub='/page/'.$_GET['page'].'';
}

$f=file('http://www.planetlagu.site/tag/2017/'.$nub.'/');
$gg=@implode($f);
$bod=maling($gg, '<div class="ktz-inner-content">', '<h4 class="widget-title">');

$bod=str_replace('<h2 class="entry-title ktz-titlemini"><a href="http://www.planetlagu.site/', '<h2 class="entry-title ktz-titlemini"><a href="/tag.php?id=', $bod);
$bod=str_replace('href="http://www.planetlagu.site/tag/2017/page/', 'href="?page=', $bod);
$bod=str_replace('/" title="', '" title="', $bod);

echo $bod;
?>
