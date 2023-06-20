<?php 
if(!isset($_GET['MaTap'])) {
    return;
}
$MaTap = $_GET['MaTap'];

require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

$sql = "SELECT `MaTrang`, `Trang`, `SoTrang` FROM `trang_truyen` WHERE MaTap = '".$MaTap."' ORDER BY SoTrang ASC";

$query = mysqli_query($conn, $sql);

$arr;
$temp;

if(mysqli_num_rows($query) == 0) {
    echo 'false';
    return;
}

while($temp = mysqli_fetch_assoc($query)) {
    $arr[] = $temp;
}

echo json_encode($arr);
?>