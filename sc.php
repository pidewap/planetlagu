<?php
function bacaHTML($url){
  // inisialisasi CURL
  $data = curl_init();
  // setting CURL
  curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($data, CURLOPT_URL, $url);
  // menjalankan CURL untuk membaca isi file
  $hasil = curl_exec($data);
  curl_close($data);
  return $hasil;
}
function copet($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}return '';}}

$kodeHTML =  bacaHTML('https://userscloud.com/go/n4du2itmzorv');
$pecah = explode('<td class="strong" width="460">', $kodeHTML);
echo '<link href="http://www.autogeneratelink.us/css/bootstrap.min.css" rel="stylesheet">
<form action="http://www.autogeneratelink.us/" method="get" class="form-inline">
<input style="height:28px;font-size:12px" type="text" class="form-control" name="link" placeholder="';
if(!empty($kodeHTML)){
for($i=1; $i<=100; $i++){
  $url = copet($pecah[$i],'href="//userscloud.com/','"');
  echo 'http://userscloud.com/'.$url.'
  ';
}
}
echo '">
<input type="submit" name="do" value="Generate" class="btn btn-primary btn-sm" onclick="document.getElementById('img_load').style.display='inline'"/>
<img src="http://www.autogeneratelink.us/loading.gif" id="img_load" style="display:none;" />
<br/><p style="font-size:12px">Supported by autogeneratelink.us</p>
</form>';
?>

