<?php
session_start();
require("../../server/comn.php");

if(isset($_POST['username'])) {

    
    $sql = "select id, Ten, MatKhau from tai_khoan where Ten='".$_POST['username']."'";
    $query = mysqli_query($conn, $sql);

    $rowCount = mysqli_num_rows($query);

    if($rowCount == 1) {
        $row = mysqli_fetch_array($query);

        if($row['MatKhau'] == $_POST['password']) {
            
            $_SESSION['id'] = $row['id'];
            echo 'true';
            return;
        }
    }
}
echo 'Tài khoản hoăc mật khẩu sai!';
?>
