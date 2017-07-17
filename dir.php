<?php
if(empty($_GET['id'])){
$url='http://admin.wapka.com/wap/en/1898520/cm/manager/view/content_type/2/id/'.$_GET['id'].'/tw_pr/xhtml';
header("location: '.$url.'");
}
echo '<form action="/dir.php" method="get">
<input type="text" value="" name="id"/>
<input type="submit" value="Search"/>
</form>';
?>
