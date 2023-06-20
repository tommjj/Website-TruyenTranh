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
$sql = "SELECT `Trang` FROM `trang_truyen` WHERE MaTap = 2";

$query = mysqli_query($conn, $sql);

$temp;
while($temp = mysqli_fetch_assoc($query)) {
    unlink('../../../res/'.$temp['Trang']);
}

$sql = "DELETE FROM `trang_truyen` WHERE MaTap = '".$MaTap."'";

$query = mysqli_query($conn, $sql);

$sql = "DELETE FROM `tap_truyen` WHERE MaTap = '".$MaTap."'";

$query = mysqli_query($conn, $sql);
?>