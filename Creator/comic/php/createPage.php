<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['MaTap'])) {
    $MaTap = $_POST['MaTap'];
} else {
    return;
}

require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
}

$sql = "SELECT id FROM tap_truyen ,truyen WHERE truyen.MaTruyen = tap_truyen.MaTruyen  and MaTap = '".$MaTap."'";

$q = mysqli_query($conn, $sql);

$temp = mysqli_fetch_assoc($q);

if($temp['id'] != $userID) {
    return;
}
?>
<?php

if(isset($_FILES["img"])) {
    $imgName;
    $error = array();
    $extension = array("jpeg", "jpg", "png", "gif");
    $file_name = $_FILES["img"]["name"];
    $file_tmp = $_FILES["img"]["tmp_name"];

    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if (in_array($ext, $extension)) {
        if (!file_exists("photo/" . $file_name)) {
            move_uploaded_file($_FILES["img"]["tmp_name"], "../../../res/". $file_name);
            $imgName = $file_name;
        } else {
            $filename = basename($file_name, $ext);
            $newFileName = $filename . time() . "." . $ext;
            move_uploaded_file($file_tmp = $_FILES["img"]["tmp_name"], "../../../res/". $newFileName);
            $imgName = $newFileName;
        }
    } else {
        array_push($error, "$file_name, ");
    }
}

if(isset($_POST['SoTrang']) && isset($imgName)) {
    $sql = "INSERT INTO `trang_truyen`(`Trang`, `SoTrang`, `MaTap`) VALUES ('".$imgName."','".$_POST['SoTrang']."','".$MaTap."')";

    $q = mysqli_query($conn, $sql);

    if($q) {
        $sql = "SELECT `MaTrang`, `Trang`, `SoTrang`, `MaTap` FROM `trang_truyen` WHERE trang_truyen.MaTap = '".$MaTap."' GROUP BY MaTrang DESC LIMIT 1";

        $q = mysqli_query($conn, $sql);

        $data = mysqli_fetch_assoc($q);

        echo json_encode($data);
        return;
    }
}
echo 'false';
   
?>