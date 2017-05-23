<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>infogue.fixi.in Zip Extractor</title>
<meta name="robots" content="noindex,nofollow">
<body>
<div style="text-align:center; font-family:verdana; font-size:12px; margin-top:20px;">
<div style="text-align:center; font-weight:bold; padding:15px; background:#eee; font-size:14px;"><a href="zipextractor.php" style="color:#666;">Portal sahabat Zip Extractor</a></div>
<?php
    if(!class_exists('ZipArchive')) {
        echo 'It seems that Zip extension support is not enabled in your hosting! <br> Zip extension is enabled at <a href="http://www.ppc-sites.com/hostgator.php">Hostgator</a> ;)';
    } else {
        $this_dir = dirname(__FILE__);

        if(!empty($_POST) && $_POST['extract'] == 'true' && !empty($_POST['zipfile']) && !empty($_POST['extractto'])) {

            if(!is_dir($_POST['extractto'])) {
                mkdir_recursive($_POST['extractto']);
            }
            $get_zip_file = $_POST['fullpath'] == 'true' ? $_POST['zipfile'] : $this_dir . '/' . $_POST['zipfile'];
            if(zipExtract ($get_zip_file, $_POST['extractto'])) {
                echo '<br><br><span style="color:green;font-weight:bold;">Zip content extracted successfully!</span><br><br>';
                echo '<span style="font-size:14px;font-weight:bold;"><span style="color:red;">IMPORTANT:</span> Delete <span style="color:blue;">zipextractor.php</span> and <span style="color:blue;">' . $_POST['zipfile'] . '</span>!</span>';
            } else {
                echo "Failed extracting the zip content!<br>";
            }
        } else {
            $autofound = false;
            if($handle = opendir($this_dir) ) {
                echo "<p><b>List of auto detected .zip archives!</b></p>";
                while(false !== ($file = readdir($handle))){
                    if( isZip($file) ) {
                        $autofound = true;
                        echo '<form action="zipextractor.php" method="POST">';
                        echo '<input type="hidden" name="zipfile" value="' . $file . '">';
                        echo '<input type="hidden" name="extract" value="true">';
                        echo '<input type="hidden" name="fullpath" value="false">';
                        echo '<b>' . $file . '</b> &nbsp; <i>Extract to:</i><input type="text" name="extractto" size="50" value="' .$this_dir. '"> <input type="submit" value="Extract">';
                        echo '</form><br>';
                    }
                }
            }

            if(!$autofound) {
                echo '<p><i><span style="color:#666;">Not found and .zip archives in <b>' . $this_dir .'</b>. Please select manually your archives full path!</span></i></p>';
                echo '<form action="zipextractor.php" method="POST">';
                echo '<input type="hidden" name="extract" value="true">';
                echo '<input type="hidden" name="fullpath" value="true">';
                echo 'Zip Filename Full Path: <input type="text" name = "zipfile" size="50" > &nbsp; &nbsp; <i>Extract to:</i><input type="text" name="extractto" size="50" value="' .$this_dir. '"> <input type="submit" value="Extract">';
                echo '</form><br>';
            }
        }
    }





    function zipExtract ($src, $dest)
    {
        $zip = new ZipArchive();
        if ($zip->open($src)===true)
        {
            $zip->extractTo($dest);
            $zip->close();
            return true;
        }
        return false;
    }

    function isZip ($src)
    {
        $get_ext = strrchr(strtolower($src), '.');
        $allowed_ext = array('.zip');
        if(in_array($get_ext, $allowed_ext)) {
            return true;
        } else {
            return false;
        }
    }

    function mkdir_recursive($pathname)
    {
        is_dir(dirname($pathname)) || mkdir_recursive(dirname($pathname));
        return is_dir($pathname) || @mkdir($pathname);
    }
?>
<div style="text-align:center; font-weight:normal; padding:5px; background:#eee; font-size:12px; margin-top:10px">Copyr<a href="http://m.sahabat.info/" style="color:#666;">i</a>ght &copy; <a href="http://m.sahabat.info/" style="color:#666;">PPC Sites</a> | <a href="http://m.sahabat.info" style="color:#666;">sahabat mobile blog</a> | <a href="http://twitter.com/" style="color:#666;">find us 0n Twitter</a> | <a href="http://www.ppc-sites.com/forum/forumdisplay.php?f=2" style="color:#666;">Support Forum</a></div>
</div>
</body>
</html>