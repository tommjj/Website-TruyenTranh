<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['MaTap'])) {
    $MaTap = $_GET['MaTap'];
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../header-nav.css">
    <link rel="stylesheet" href="../../../responsive-index.css">
    <link rel="stylesheet" href="../css/edit-chapter.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Creator</title>
</head>

<body>
    <?php 
        require("../../header-nav.php");
    ?>

    <main class="main">
        <div class="container">
            <div class="head-bar">
                <div>
                    <button class="back"><i class='bx bx-chevron-left'></i></button>
                    <h3>name</h3>

                    
                </div>
                
                <div class="buttons">
                    <button class="cancel">Huỷ</button>
                    <button class="save">LƯU</button>
                </div>
            </div>
            <div class="page-chapter-container">
                
            </div>
            <div class="add-page">  
                <form action="" class="add-img" enctype="multipart/form-data">
                    <p>Thêm trang.</p>
                    <input type="hidden" name="MaTap" value="<?php echo $MaTap?>">
                    <input type="file" name="img" id="" multiple>
                </form>
            </div>
        </div>
    </main>

    <!-- ====js==== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../../../index.js"></script>
    <script src="../js/edit-chapter.js"></script>

    <script>
        loadPage(<?php echo $MaTap?>);
    </script>
</body>

</html>