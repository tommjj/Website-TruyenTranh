<?php
session_start();
require("server/comn.php");

if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
}
?>

<?php
if (isset($_GET['search'])) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head id="head">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header-nav.css ">
    <link rel="stylesheet" href="item.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="responsive-index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>HOME</title>
</head>

<body id="body">
    <?php
    require("header-nav.php");
    ?>

    <!-- ========MAIN======== -->
    <main>
        <div class="container" id="container">
            <?php
            if (!isset($_GET['search'])) {
                require("home.php");
            } else {
                require("methodPhp/search.php");
            }
            ?>

            <div class="filters">
                <div class="bar">
                    <div class="button">
                        <i class='bx bx-slider'></i> Bộ lọc
                    </div>
                </div>
                <div class="tags">
                    <?php echo "<h4>Theo loại</h4>"; ?>
                    <ul>
                        <?php

                        $sql = "SELECT * FROM `the_loai`";

                        $query = mysqli_query($conn, $sql);

                        $temp;

                        

                        while ($temp = mysqli_fetch_array($query)) {
                            
                            if (isset($_GET['tags'])) {
                                $tempArr = $_GET['tags'];
    
                                if (gettype($tempArr) == "array") {
                                    
                                    $checkSelect = true;

                                    foreach ($tempArr as $item) {
                                        if($item == $temp['MaTL']) {
                                            echo "<li class='active' ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                            $checkSelect = false;
                                            break;
                                        } 
                                    }

                                    if($checkSelect) {
                                        echo "<li ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                    }
                                } else {

                                    if($tempArr == $temp['MaTL']) {
                                        echo "<li class='active' ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                    } else {
                                        echo "<li ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                    }
                                }
                            } else {
                                echo "<li ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                            }                  
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </main>

    //js
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./index.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/items.js"></script>
    <script src="js/filters.js"></script>

    <script>
        showItems(document.querySelector('#container'), <?php if(isset($searchArr)) echo "'" . json_encode($searchArr) . "'"; else echo 'null'?>);
    </script>
</body>

</html>