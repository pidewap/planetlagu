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
$kodeHTML =  bacaHTML('https://userscloud.com/go/n4du2itmzorv');
$pecah = explode('<td class="strong" width="460">', $kodeHTML);
$pecahLagi = explode('</td>', $pecah[1]);
echo "<ul>".$pecahLagi[0]."</ul>";
?>
