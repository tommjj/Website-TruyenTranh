<?php 
if(isset($_GET['MaTruyen'])) {
    $MaTruyen = $_GET['MaTruyen'];
} else {
    return;
}

$limit = '';

if(isset($_GET['at'])) {
    $limit .= ' LIMIT '.$_GET['at'];
    if(isset($_GET['limit'])) {
        $limit .= ' , '.$_GET['limit'];
    }
}

require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

$sql = "SELECT `MaTap`, `TenTap`, `TapSo`, `LuocXem`, DATE(`NgayDang`) as NgayDang, `TenCD` FROM `tap_truyen`, cd_thien_thi WHERE cd_thien_thi.MaCD = tap_truyen.MaCD and MaTruyen = '".$MaTruyen."' ORDER by TapSo DESC ".$limit;

$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) == 0) {
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