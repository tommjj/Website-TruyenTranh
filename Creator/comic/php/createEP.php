<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['MaTruyen'])) {
    $MaTruyen = $_POST['MaTruyen'];
} else {
    return;
}

require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
}

$sql = "SELECT id FROM truyen WHERE MaTruyen = '".$MaTruyen."'";

$q = mysqli_query($conn, $sql);

$temp = mysqli_fetch_assoc($q);

if($temp['id'] != $userID) {
    return;
}
?>
<?php 

if(isset($_POST['TenTap']) && isset($_POST['TapSo'])) {
    $sql = "INSERT INTO `tap_truyen`(`TenTap`, `TapSo`, `MaTruyen`) VALUES ('".$_POST['TenTap']."','".$_POST['TapSo']."','".$MaTruyen."')";
    
    $query = mysqli_query($conn, $sql);

    if($query) {
        echo 'true';
        return;
    }
}

?>