<?php

function friendly_size($size,$round=2){
$sizes=array(' Byts',' Kb',' Mb',' Gb',' Tb');
$total=count($sizes)-1;
for($i=0;$size>1024 && $i<$total;$i++){
$size/=1024;
}
return round($size,$round).$sizes[$i];
}

$default_mp3_directory =  "./download/";
$quot_arr = array(
'satriamusic1.png','satriamusic2.png','satriamusic3.png','satriamusic4.png','satriamusic5.png','satriamusic6.png','satriamusic7.png','satriamusic8.png');

$quot_rand = array_rand($quot_arr);
if(isset($_POST['submit'])){
$mp3_filepath = $_POST['mp3_filepath'];
$mp3_filename = $_POST['mp3_filename'];
$mp3_songname = $_POST['mp3_songname'];
$mp3_comment = $_POST['mp3_comment'];
$mp3_artist = $_POST['mp3_artist'];
$mp3_album = $_POST['mp3_album'];
$mp3_year = $_POST['mp3_year'];
$mp3_genre = $_POST['mp3_genre'];
if(filter_var($mp3_filepath,FILTER_VALIDATE_URL)){
if($mp3_filename!=""){
$mp3_filename = str_replace(DIRECTORY_SEPARATOR,"-X-",$mp3_filename);


$sname = $default_mp3_directory.$mp3_filename;
if(copy($mp3_filepath,$sname)){
$size = friendly_size(filesize($sname));
echo"<center><b>".basename($sname)."</b>
<br/>Ukuran : </b>$size</b></br><a href='$sname'>Download ".basename($sname)."</a></center>";

$mp3_tagformat = 'UTF-8';

require_once('getid3/getid3.php');
$mp3_handler = new getID3;
$mp3_handler->setOption(array('encoding'=>$mp3_tagformat));
require_once('getid3/write.php');
$mp3_writter = new getid3_writetags;
$mp3_writter->filename       = $sname;
$mp3_writter->tagformats     = array('id3v1', 'id3v2.3');
$mp3_writter->overwrite_tags = true;
$mp3_writter->tag_encoding   = $mp3_tagformat;
$mp3_writter->remove_other_tags = true;


$mp3_data['title'][]   = $mp3_songname;
$mp3_data['artist'][]  = $mp3_artist;
$mp3_data['album'][]   = $mp3_album;
$mp3_data['year'][]    = $mp3_year;
$mp3_data['genre'][]   = $mp3_genre;
$mp3_data['comment'][] = $mp3_comment;
  
        if (empty($picture)) {
          $picture = ''.$quot_arr[$quot_rand].'';
          $picturecaption = 'No picture available';
        }
       

        $albumcover = $picture;
       

        if ($fd = @fopen($albumcover, 'rb')) {
          $APICdata = fread($fd, filesize($albumcover));
          fclose ($fd);
          list($APIC_width, $APIC_height, $APIC_imageTypeID) = GetImageSize($albumcover);
          $mp3_data['attached_picture'][0]['data']            = $APICdata;
          $mp3_data['attached_picture'][0]['picturetypeid']   = 0x03;                    
          $mp3_data['attached_picture'][0]['description']     = $picturecaption;
          $mp3_data['attached_picture'][0]['mime']            = 'image/jpeg';
        }
        else {
          echo "Cannot open $albumcover <br />";
        }
               





$mp3_writter->tag_data = $mp3_data;

if($mp3_writter->WriteTags()) {
echo"<br />";
}
else{
echo"<br />Failed to write tags!<br>".implode("<br /><br />",$mp3_writter->errors);
}
}
else{echo"<br />Unable to copy file.";}
}
else{echo"<br />Empty filename.";}
}
else{echo"<br />Invalid FilePath.";}
}
else{
?>
<?php
}
?>
