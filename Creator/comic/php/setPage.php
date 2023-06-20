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
if(isset($_POST["pages"])) {
    $map;
    $count = 1;
    $temp = $_POST["pages"];
    
    foreach($temp as $trang) {
        echo $trang;
        $map[$trang] = $count++;
    }

    $sql = "SELECT `MaTrang`, `Trang` FROM `trang_truyen` WHERE MaTap ='".$_POST["MaTap"]."'";

    $query = mysqli_query($conn, $sql);

    $page;
    

    while($page = mysqli_fetch_assoc($query)) {
        if(isset($map[$page['MaTrang']])) {
            $sql = "UPDATE `trang_truyen` SET `SoTrang`='".$map[$page['MaTrang']]."' WHERE MaTrang = '".$page['MaTrang']."'";
        
            mysqli_query($conn, $sql); 
        } else {
            $st = unlink("../../../res/".$page['Trang']);

            $sql = "DELETE FROM `trang_truyen` WHERE MaTrang ='".$page['MaTrang']."'";
        
            mysqli_query($conn, $sql);
        }
    }

    
}

?>