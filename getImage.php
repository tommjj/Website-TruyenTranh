<?php 
if(isset($_GET['name'])) {
    $newfile = $_GET['name'];

    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($newfile));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');   
    header('Pragma: public');
    header('Content-Length: ' . filesize('res/'.$newfile));
    header("Content-Type: " . 'image/'.pathinfo($newfile, PATHINFO_EXTENSION));
    readfile('res/'.$newfile);
}
