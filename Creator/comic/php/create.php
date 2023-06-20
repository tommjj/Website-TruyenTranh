<?php 

session_start();
if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
} else {
    return;
}

require("../../../server/comn.php");


if ($_POST) {
    $imgName;

    if(isset($_FILES["avt"])) {
        $error = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        $file_name = $_FILES["avt"]["name"];
        $file_tmp = $_FILES["avt"]["tmp_name"];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {
            if (!file_exists("../../../res/" . $file_name)) {
                move_uploaded_file($_FILES["avt"]["tmp_name"], "../../../res/". $file_name);
                $imgName = $file_name;
            } else {
                $filename = basename($file_name, $ext);
                $newFileName = $filename . time() . "." . $ext;
                move_uploaded_file($file_tmp = $_FILES["avt"]["tmp_name"], "../../../res/". $newFileName);
                $imgName = $newFileName;
            }
        } else {
            array_push($error, "$file_name, ");
        }
    }

    if(isset($imgName) && isset($_POST["name"]) && isset($_POST["description"])) {
        $sql = "INSERT INTO `truyen`(`TenTruyen`, `AnhBia`, `NoiDung`, `id`) VALUES ('".$_POST["name"]."','".$imgName."','".$_POST["description"]."','".$userID."')";
        
        $query = mysqli_query($conn, $sql);
    
        if($query) {
            $sql = "SELECT MaTruyen FROM truyen WHERE id = 1 ORDER BY MaTruyen DESC LIMIT 1";

            $query = mysqli_query($conn, $sql);

            $newComic = mysqli_fetch_array($query);

            $Ma = $newComic['MaTruyen'];

            if(isset($_POST["tags"])) {
                $temp = $_POST["tags"];
                foreach($temp as $tag) {
                    $sql = "INSERT INTO `tl_truyen`(`MaTL`, `MaTruyen`) VALUES ('".$tag."','".$Ma."')";
                    $query = mysqli_query($conn, $sql);
                }
            }
            echo 'true';
        }
    }

    
}

?>