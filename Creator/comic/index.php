<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['MaTruyen'])) {
    $MaTruyen = $_GET['MaTruyen'];
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
$sql = "SELECT COUNT(MaTap) as st, SUM(LuocXem) as tls, MAX(LuocXem)as lsnn FROM `tap_truyen` WHERE MaTruyen = '".$MaTruyen."'";

$q = mysqli_query($conn, $sql);

$solieu = mysqli_fetch_assoc($q);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../header-nav.css">
    <link rel="stylesheet" href="../../responsive-index.css">
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Creator</title>
</head>

<body>
    <?php 
        require("header-nav.php");
    ?>

    <main class="main">
        <div class="container">
            <div class="side-bar">
                <h2>Trang tổng quan</h2>
                <div class="buttons"></div>
            </div>

            <div class="card">
                <div class="data">
                    <h2>Số liệu phân tích</h2>
                    <p>Số lược xem</p>
                    <p class="flower"><?php echo $solieu['tls']?></p>
                    <hr>
                    <h2>Tóm tắt</h2>
                    <div class="view">Số tập: <span class="number"><?php echo $solieu['st']?></span></div>
                    <hr>
                    <h2>Tập hàng đầu</h2>
                    <div class="view">Số lượt xem: <span class="number"><?php echo $solieu['lsnn']?></span></div>
                    <a href="">CHUYỂN ĐẾN SỐ LIỆU PHÂN TÍCH</a>
                </div>
                <div class="back-ground">
                    <i class='bx bxs-bar-chart-alt-2' ></i>
                </div>

            </div>


            <div class="info"></div>
        </div>
    </main>

    <!-- ====js==== -->
    <script src="../../index.js"></script>
</body>

</html>