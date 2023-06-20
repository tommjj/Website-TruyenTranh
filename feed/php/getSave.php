<?php 
session_start();
if(!isset($_SESSION['id'])) {
    return;
}
$userID = $_SESSION['id'];

require("../../server/comn.php");

$limit = ' ';
if(isset($_GET['at']) && isset($_GET['limit'])) {
    $limit .= ' LIMIT '.$_GET['at'] .', '. $_GET['limit'];

}

$sql = "SELECT truyen.MaTruyen, `TenTruyen`, `AnhBia`, `NoiDung` FROM `truyen`, luu WHERE truyen.MaTruyen = luu.MaTruyen and luu.id = '".$userID."' ORDER BY luu.NgayGio DESC ".$limit;

$query = mysqli_query($conn, $sql);

if((mysqli_num_rows($query) == 0)) {
    echo 'null';
    return;
}

$arr;
$temp;
while($temp = mysqli_fetch_assoc($query)) {
    $arr[] = $temp;
}
echo json_encode($arr);
?>