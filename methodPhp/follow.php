<?php
session_start();

if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    
    if (isset($_POST['id'])) {
        if ($userid != $_POST['id']) {

            require("../server/comn.php");

            $sql = "SELECT `NguoiTD`, `NguoiDuocTD` FROM `theo_doi` WHERE NguoiTD = '" . $userid . "' and NguoiDuocTD = '" . $_POST['id'] . "'";

            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query) == 1) {
                $sql = "DELETE FROM `theo_doi` WHERE NguoiTD = '" . $userid . "' and NguoiDuocTD = '" . $_POST['id'] . "'";

                require("../server/comn.php");

                $query = mysqli_query($conn, $sql);

                if ($query) {
                    echo 'unfollow';
                    return;
                }
            } else {
                $sql = "INSERT INTO `theo_doi`(`NguoiTD`, `NguoiDuocTD`) VALUES ('" . $userid . "','" . $_POST['id'] . "')";

                require("../server/comn.php");

                $query = mysqli_query($conn, $sql);

                if ($query) {
                    echo 'followed';
                    return;
                }
            }
        }
    }
}
echo 'false';
