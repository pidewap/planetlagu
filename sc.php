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

$kodeHTML =  bacaHTML('https://userscloud.com/go/'.$_GET['id'].'');
$pecah = explode('<td class="strong" width="460">', $kodeHTML);
$ii=count($pecah);
$iii=  $ii - 1;
echo '<textarea>';

if(!empty($kodeHTML)){
for($i=1; $i<=$iii; $i++){
  $url = copet($pecah[$i],'href="//userscloud.com/','"');
  echo 'http://userscloud.com/'.$url.'
';
}
}
echo '</textarea>';
?>
