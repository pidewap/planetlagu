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


if(!empty($_GET['page'])){
$pages='page/'.$_GET['page'].'/';
}else{
  $pages='';
}

if(!empty($_GET['url'])){
  $urr=$_GET['url'];
}else{
  $urr='https://k2nblog.com/category/single-album/'.$pages.'';
}


$f=file(''.$urr.'');
$gg=@implode($f);
$bod=maling($gg, '<body data', '</html>');
$bod=str_replace('/"', '"', $bod);
$bod=str_replace('https://k2nblog.com/category/single-album/k-pop/page/', '/ppo.php?page=', $bod);
$bod=str_replace('https://k2nblog.com/category/single-album/page/', '/ppo.php?page=', $bod);
$bod=str_replace('https://k2nblog.com/', '/ppo.php?url=https://k2nblog.com/', $bod);
   $artist=maling($bod, 'description" content="',' - ');
if(!empty($_GET['url'])){
  $tite=maling($bod, '<h1 class="entry-title">', '</h1>');
  $artist=maling($gg, 'property="og:description" content="', ' - ');
  $imgs=maling($gg, '<p><center><img src="', '"');
  $content=maling($bod, '<div class="td-post-content">', '<p>Track');
  $rd=maling($content, 'Date: ', '<');
  $genre=maling($content, 'Genre: ', '<');
  $lang=maling($content, 'Language: ', '<');
  $br=maling($content, 'Bit Rate: ', '<');
  echo '<textarea id="code" data-cm-size="2" name="data" style="width: 100%; min-height: 50px" rows="5">{"title":"'.$tite.'","image":"'.str_replace('https', 'http', $imgs).'","date":"'.$rd.'","genre":"'.$genre.'","lang":"'.$lang.'","bitrate":"'.$br.'","content":"';
   $hasil=explode('<p>Track List:',$bod);
$hasil=explode('</p>',$hasil[1]);
$hasil=explode('<br />',$hasil[0]);
  $hasil = str_replace('&#038;', '&', $hasil);
  $hasil = preg_replace("/\d+/u","<new>",$hasil);
   for($i=1;$i<count($hasil);$i++){
      $link=explode('<new>. ',$hasil[$i]);
$link=explode('<br',$link[1]);
$link=$link[0];
     echo ''.$i.'. <strong>'.$artist.' - '.$link.'<\/strong> [<a href=\"\/search\/'.strtolower(urlencode($artist)).'+-+'.strtolower(urlencode($link)).'\" target=\"_blank\">Download<\/a>]<br>';
      }
  echo '"}</textarea>';
}else{
echo strip_tags($bod, '<a><div><p><br>');
}
?>
