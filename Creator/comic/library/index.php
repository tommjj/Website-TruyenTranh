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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../header-nav.css">
    <link rel="stylesheet" href="../../../responsive-index.css">
    <link rel="stylesheet" href="../css/library.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Creator</title>
</head>

<body>
    <?php 
        require("../header-nav.php");
    ?>

    <main class="main">
        <div class="container">
            <div class="head-bar">
                <h2>Danh sách tập truyện</h2>
                <div class="show-create">
                    + Tạo Tập Mới
                </div>
            </div>
            
            <table class="chapters">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Tập</td>
                        <td>Chế độ hiển thị</td>
                        <td>Ngày tạo</td>
                        <td>Lược xem</td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6"> 
                            <div class="buttons">
                                <a href=""><i class='bx bx-chevrons-left' ></i></a>
                                <a class="pre"><i class='bx bx-chevron-left'></i></a>
                                <a class="next"><i class='bx bx-chevron-left bx-flip-horizontal' ></i></a>
                                <a href=""><i class='bx bx-chevrons-left bx-flip-horizontal' ></i></a>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="createEP hidden">
            <div class="head"><h3>Tạo Tập Mới</h3> <div class="close bx bx-x"></div></div>
                <form action="">
                    
                    <input type="hidden" name="MaTruyen" value="<?php echo $MaTruyen?>">
                    tập số.
                    <input type="number" name="TapSo" id="">
                    Tên Tập.
                    <input type="text" name="TenTap" id="" autocomplete="off">
                    <div class="create-bt">Tạo</div>
                </form>

            </div>
        </div>
    </main>

    <!-- ====js==== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../../index.js"></script>
    <script src="library.js"></script>

    <script>
        setMaTruyen(<?php echo $MaTruyen?>);
        loadRow();
    </script>
</body>

</html>