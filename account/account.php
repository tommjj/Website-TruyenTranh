 <?php
session_start();
require("../server/comn.php");

if(!isset($_SESSION['id']) && !isset($_GET['id'])) {
    header("Location: ../signin-signup/");
    return;
}

if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
}
?>

<?php
    if(isset($userID)) {
        $sql = "SELECT `id`, `Ten`, `AnhDD`, `about`, COUNT(theo_doi.NguoiTD) AS follow FROM `tai_khoan` INNER JOIN `theo_doi` on tai_khoan.id = theo_doi.NguoiDuocTD WHERE id='".$userID."'";

        $query = mysqli_query($conn, $sql);

        $userData = mysqli_fetch_array($query);
    }

    if(isset($_GET['id'])) {
        $sql = "SELECT `id`, `Ten`, `AnhDD`, `about`, COUNT(theo_doi.NguoiTD) AS follow FROM `tai_khoan` INNER JOIN `theo_doi` on tai_khoan.id = theo_doi.NguoiDuocTD WHERE id=".$_GET['id']."";

        $query = mysqli_query($conn, $sql);

        $data = mysqli_fetch_array($query);

        if($data['id'] == null) {
            header("Location: ../index.php");
        }
        
        $checkFollowed = false;
        if(isset($userID)) {
            $sql = "SELECT `NguoiTD` FROM `theo_doi` WHERE NguoiTD='".$userID."' and NguoiDuocTD='".$data['id']."'";

            $query = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query) == 1) {
                $checkFollowed = true;
            }
        }
    } else {
        $data = $userData;
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../header-nav.css">
    <link rel="stylesheet" href="../item.css">
    <link rel="stylesheet" href="../responsive-index.css">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="account.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>

<body>
    <?php 
        require("../header-nav.php");
    ?>

    <main>
        <div class="container">
            <div class="info-user">

                <div class="main">
                    <div class="info-account">
                        <div class="avt">
                            <?php
                                if($data['AnhDD'] == null) {
                                    echo "<img src=\"../res/unnamed.webp\" alt=\"\">";
                                } else {
                                    echo "<img src=\"../res/".$data['AnhDD']."\" alt=\"\">";
                                }                   
                            ?>
                        </div>
                        <div class="text">
                            <h2 class="name"> <?php echo $data['Ten']?> <button class="customize" <?php if((isset($userID) ? $userID : -1) != $data['id']) echo "style=\"display: none\""?>><i class='bx bx-wrench'></i></button>
                            </h2>
                            <p>follower <span><?php echo $data['follow']?></span></p>

                            <button id="follow-button" class="<?php echo $checkFollowed ? 'followed': 'follow'; ?>" <?php if((isset($userID) ? $userID : -1) == $data['id']) echo "style=\"display: none\""?>>Follow</button>
                        </div>


                    </div>
                </div>
            </div>

            <div class="contaner-page">
                <div class="page-bar">
                    <ul>
                        <li class="active">Home</li>
                        <li>About</li>
                    </ul>
                </div>
                <div class="page active">
                    <div class="items">
                        <h2>Truyện của tôi</h2>
                        
                    </div>

                    
                </div>

                <div class="page">
                    <div class="about">
                        <?php 
                            echo $data['about'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    //js

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        const userID = <?php echo (isset($userID) ? $userID : -1)?>;

        const accID = <?php echo $data['id']?>;
    </script>   
    <script src="../index.js"></script>
    <script src="account.js"></script>
    <script>
        loadComic(<?php echo $data['id']?>);
    </script>
    
</body>

</html>