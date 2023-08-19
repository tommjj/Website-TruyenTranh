<?php
if($_GET) {
    $sql = "SELECT * FROM `truyen` WHERE 1 ";

    if(isset($_GET['id'])) {
        $sql .= " and id = '".$_GET['id']."'"; 
    }

    if(isset($_GET['name'])) {   
        $sql .= " and TenTruyen = '".$_GET['name']."'"; 
    }
    if(isset($_GET['tags'])) {
        $arr = $_GET['tags'];

        if(gettype($arr) == "array") {
            foreach($arr as $item) {               
                $sql .= " and Loi = '" .$item."'"; 
            }
        } else {
            $sql .= " and Loi = '" .$arr."'"; 
        }
    }
    
    if(isset($_GET['at'])) {
        $sql .= " LIMIT ". $_GET['at'];

        if(isset($_GET['limit'])) {
            $sql .= ", ". $_GET['limit'];
        }
    }  

    require("../server/comn.php");

    $query = mysqli_query($conn, $sql);
 
    $temp;
    $data;
    while($temp =  mysqli_fetch_assoc($query)) {
        $data[] = $temp;
    }

    echo json_encode($data);
} else {
    require("../server/comn.php");

    $sql = "SELECT * FROM `truyen` WHERE 1 ";

    $query = mysqli_query($conn, $sql);
 
    $temp;
    $data;
    while($temp =  mysqli_fetch_assoc($query)) {
        $data[] = $temp;
    }
    echo json_encode($data);
}
?>