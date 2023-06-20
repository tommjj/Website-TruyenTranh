<?php
if (isset($_GET['MaTap'])) {
    require("../../server/comn.php");

    //get tap truyen

    $sql = "SELECT `MaTap`, `TenTap`, `TapSo`, `LuocXem`, `NgayDang`, `MaCD`, `MaTruyen` FROM `tap_truyen` WHERE tap_truyen.MaTap = '" . $_GET['MaTap'] . "'";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) != 1) {
        header("location: http://localhost/WEBTruynTranh");
    }

    $epData = mysqli_fetch_array($query);

    //get ep page

    $sql = "SELECT `MaTrang`, `Trang`, `SoTrang` FROM `trang_truyen` WHERE MaTap = '" . $_GET['MaTap'] . "' ORDER BY SoTrang ASC";

    $query = mysqli_query($conn, $sql);

    $EpPage;
    $temp;
    while ($temp =  mysqli_fetch_array($query)) {
        $EpPage[] = $temp;
    }

    //get ep

    $sql = "SELECT `MaTap`, `TenTap`, `TapSo`, `LuocXem`, `NgayDang`, `MaCD`, `MaTruyen` FROM `tap_truyen` WHERE MaTruyen = '" . $epData['MaTruyen'] . "' ORDER BY TapSo ASC";

    $query = mysqli_query($conn, $sql);

    $Ep;
    $temp;
    while ($temp =  mysqli_fetch_array($query)) {
        $Ep[] = $temp;
    }

    // get current ep
    $current;
    $count = 0;
    if (!empty($Ep)) {
        foreach ($Ep as $item) {
            if($item['MaTap'] == $epData['MaTap']) {
                $current = $count;
            }    
            $count++;
        }
    }

} else {
    header("location: http://localhost/WEBTruynTranh");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ========css======= -->
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../header-nav.css">
    <link rel="stylesheet" href="../../responsive-index.css">
    <link rel="stylesheet" href="read.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Đọc</title>
</head>

<body>
    <!-- =========header======== -->
    <?php
    require("../../header-nav.php");
    ?>
    <!-- ==========main======= -->
    <main>
        <div class="reading-bar reading-bar-top">
            <div onclick="history.back()" class="back-button">
                <i class='bx bx-left-arrow-alt'></i>
            </div>

            <h1 class="cur-ep">
                <?php 
                    echo $epData['TenTap'];
                ?>
            </h1>
            <div class="ep-buttons">
                <button class="pre-button bx bx-chevron-left <?php echo $current > 0 ? : 'active' ?>"<?php echo $current > 0 ? 'MaTap='.$Ep[$current-1]['MaTap'] : 'MaTap="-1"' ?>></button>

                <select name="ep" id="">

                <?php
                if (!empty($Ep)) {
                    foreach ($Ep as $item) {
                        if($item['MaTap'] == $epData['MaTap']) {
                            echo "<option selected='selected' value='".$item['MaTap']."'>".$item['TapSo']." ".$item['TenTap']."</option>";
                        } else {
                            echo "<option value='".$item['MaTap']."'>".$item['TapSo']." ".$item['TenTap']."</option>";
                        }
                        
                    }
                }

                ?>
                </select>

                <button class="next-button bx bx-chevron-right <?php echo $current < count($Ep)-1 ? : 'active'?>" <?php echo $current < count($Ep)-1 ? 'MaTap='.$Ep[$current+1]['MaTap']: 'MaTap="-1"'?>></button>
            </div>

            <div class="page-ctrl">
                <input type="range" id="page-ctrl" value="50" min="25" max="150">
            </div>
        </div>

        <div class="container">
            <?php
            if (!empty($EpPage)) {
                foreach ($EpPage as $item) {
                    echo "<img src='".getPathImg($item['Trang'])."' alt='' class='comic-page'>";
                }
            }

            ?>
        </div>

        <div class="reading-bar ">
            <div class="ep-buttons">
            <button class="pre-button bx bx-chevron-left <?php echo $current > 0 ? : 'active' ?>"<?php echo $current > 0 ? 'MaTap='.$Ep[$current-1]['MaTap'] : 'MaTap="-1"' ?>></button>

                <select name="ep" id="">
                <?php
                if (!empty($Ep)) {
                    foreach ($Ep as $item) {
                        if($item['MaTap'] == $epData['MaTap']) {
                            echo "<option selected='selected' value='".$item['MaTap']."'>".$item['TapSo']." ".$item['TenTap']."</option>";
                        } else {
                            echo "<option value='".$item['MaTap']."'>".$item['TapSo']." ".$item['TenTap']."</option>";
                        }
                        
                    }
                }

                ?>
                </select>

                <button class="next-button bx bx-chevron-right <?php echo $current < count($Ep)-1 ? : 'active'?>" <?php echo $current < count($Ep)-1 ? 'MaTap='.$Ep[$current+1]['MaTap']: 'MaTap="-1"'?>></button>
            </div>
        </div>
    </main>
    <!-- =========js========= -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>        
    <script src="../../index.js"></script>
    <script src="read.js"></script>
</body>

</html>