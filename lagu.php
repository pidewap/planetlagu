<html>
  <script type='text/javascript'>
var copyTextareaBtn = document.querySelector('.js-textareacopybtn');
copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea');
  copyTextarea.select();
  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});
</script>
<style>
   .js-copytextarea{
 border:1px solid blue;border-left:5px solid blue;background:#eee;
 display:block;margin:5px 0 10px 0;word-break: break-all;
 text-align:left;width:95%;height:150px;overflow:auto;}
  </style>
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
  $urr='https://k2nblog.com/category/single-album/'.$pages.'';
}


$f=file(''.$urr.'');
$gg=@implode($f);
$bod=maling($gg, '<body', '</body>');
$bod=str_replace('/"', '"', $bod);
$bod=str_replace('https://k2nblog.com/category/single-album/k-pop/page/', '/lagu.php?page=', $bod);
$bod=str_replace('https://k2nblog.com/category/single-album/page/', '/lagu.php?page=', $bod);
$bod=str_replace('https://k2nblog.com/', '/lagu.php?url=https://k2nblog.com/', $bod);
if(!empty($_GET['url'])){
  $linkdownload=maling($bod, 'tracks:<br />', '<footer>');
  $linkdownload=str_replace('iTunes:', '<b>iTunes:</b>', $linkdownload);
  $linkdownload=str_replace('MP3:', '<b>MP3:</b>', $linkdownload);
  $hdesc=maling($bod, '<p>Track List:', '</p>');
  $artist=maling($gg, 'property="og:description" content="', ' - ');
  $imgs=maling($gg, '<p><center><img src="', '"');
  $linkdo=strip_tags($linkdownload, '<b><a><br>');
  $linkdo=str_replace('http://linkshrink.net/zfb5=', '', $linkdownload);
  $linkdo=str_replace('http://q.gs/15745813/', '', $linkdownload);
  $linkdo=str_replace('<a href="', '<p><button class="js-textareacopybtn">Copy All</button><textarea class="js-copytextarea">', $linkdownload);
  $linkdo=str_replace('" ', '</textarea></p>', $linkdownload);
  $linkdo=str_replace('target', '<center>', $linkdownload);
  $linkdo=str_replace('|', '</center>', $linkdownload);
  $linkdoo=strip_tags($linkdo, '<textarea><button><b><br><p>');
echo '
<body>
<center>'.$linkdoo.'</center>
</body>
</html>';
}else{
echo strip_tags($bod, '<a><div><p><br>');
}
?>
