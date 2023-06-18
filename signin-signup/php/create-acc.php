<?php
session_start();
require("../../server/comn.php");

if(isset($_POST['username'])) {
    
    //check
    $sql = "select Ten from tai_khoan where Ten='".$_POST['username']."'";
    
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);
    if($rowCount >= 1) {
        echo 'Tên đăng nhập đã tồn tại!';
        return;
    }

    $sql = "select Ten from tai_khoan where Email='".$_POST['email']."'";
    
    $query = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($query);

    if($rowCount >= 1) {
        echo 'Email đã được sử dung!';
        return;
    }

    //create acc
    $sql = "INSERT INTO `tai_khoan`(`id`, `Ten`, `Email`, `MatKhau`, `AnhDD`, `MaNhomQuyen`) VALUES (null,'".$_POST['username']."','".$_POST['email']."','".$_POST['password']."', null,'us01')";
    
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo 'true';
        return;
    } else {
        echo "INSERT INTO `tai_khoan`(`id`, `Ten`, `Email`, `MatKhau`, `AnhDD`, `MaNhomQuyen`) VALUES (null,".$_POST['username'].",".$_POST['email'].",".$_POST['password'].", null,'us01')";
        return;
    }


}
echo 'lõi!';
?>
