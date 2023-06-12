<?php

if(isset($_FILES["img"])) {
    $error = array();
    $extension = array("jpeg", "jpg", "png", "gif");
    $file_name = $_FILES["img"]["name"];
    $file_tmp = $_FILES["img"]["tmp_name"];

    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if (in_array($ext, $extension)) {
        if (!file_exists("photo/" . $file_name)) {
            move_uploaded_file($_FILES["img"]["tmp_name"], "photo/". $file_name);
            echo basename($file_name, $ext);
        } else {
            $filename = basename($file_name, $ext);
            $newFileName = $filename . time() . "." . $ext;
            move_uploaded_file($file_tmp = $_FILES["img"]["tmp_name"], "photo/". $newFileName);
            echo basename($file_name, $ext);
        }
    } else {
        array_push($error, "$file_name, ");
    }
}
   
?>