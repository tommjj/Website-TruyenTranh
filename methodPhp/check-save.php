<?php
session_start();

if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    
    if (isset($_POST['MaTruyen'])) {
        require("../server/comn.php");

        $sql = "SELECT `MaTruyen`, `id` FROM `luu` WHERE  id = '" . $userid . "' and  MaTruyen = '".$_POST['MaTruyen']."'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) == 1) { 
            echo 'true';
            return;
        }
        
    }
}
echo 'false';
