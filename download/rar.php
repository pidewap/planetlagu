<?php 
    $rarfile = rar_open('demo.rar') or die("Can't open Rar archive");
    $entries = rar_list($rarfile); 
    foreach ($entries as $entry) { 
        echo 'Filename: ' . $entry->getName() . "n"; 
        $entry->extract('/dir/extract/to/'); 
    } 
    rar_close($rarfile); 
?>
