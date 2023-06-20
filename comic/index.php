<?php
if(isset($_GET['MaTruyen'])) {
    require("../server/comn.php");

    //get comic data
    $sql = "SELECT `MaTruyen`, `TenTruyen`, `AnhBia`, `NoiDung`, tai_khoan.id, `MaTT`, `MaCD`, `NgayTao`, tai_khoan.Ten, tai_khoan.AnhDD FROM `truyen`, tai_khoan WHERE tai_khoan.id = truyen.id and truyen.MaTruyen = '".$_GET['MaTruyen']."'";

    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) != 1) {
        header("location: http://localhost/WEBTruynTranh");
    }

    $ComicData = mysqli_fetch_array($query);

    //get ep

    $sql = "SELECT `MaTap`, `TenTap`, `TapSo`, `LuocXem`, `NgayDang`, `MaCD`, `MaTruyen` FROM `tap_truyen` WHERE MaTruyen = '".$_GET['MaTruyen']."' ORDER BY TapSo ASC";

    $query = mysqli_query($conn, $sql);

    $Ep;
    $temp;
    while($temp =  mysqli_fetch_array($query)) {
        $Ep[] = $temp;
    }

    //get tags
    $sql = "SELECT the_loai.MaTL, the_loai.TenTL FROM the_loai, tl_truyen WHERE the_loai.MaTL = tl_truyen.MaTL and tl_truyen.MaTruyen = '".$_GET['MaTruyen']."'";

    $query = mysqli_query($conn, $sql);

    $tags;
    $temp;
    while($temp =  mysqli_fetch_array($query)) {
        $tags[] = $temp;
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../header-nav.css">
    <link rel="stylesheet" href="../item.css">
    <link rel="stylesheet" href="../responsive-index.css">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="view.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Truyện</title>
</head>

<body>
    <?php
        require("../header-nav.php");
    ?>

    </nav>
    <main>
        <div class="container">
            <div class="back" onclick="history.back()"><i class='bx bx-left-arrow-alt'></i></div>
            <div class="info">

                <div class="img">
                    <img src="<?php echo  getPathImg($ComicData['AnhBia'])?>" alt="">
                </div>
                <div class="text">
                    <div class="name">
                        <?php echo $ComicData['TenTruyen'];?>
                    </div>

                    <a class="author" href="../account/?id= <?php echo  $ComicData['id']?>">
                        <img src="<?php echo  getPathImg($ComicData['AnhDD'])?>" alt="" class="avt">
                        <p class="author-name"><?php echo $ComicData['Ten'];?></p>
                    </a>

                    <div class="content">
                    
                        <?php echo $ComicData['NoiDung'];?>
                    </div>

                    <div class="tags">
                        <ul>
                            <?php 
                            if(!empty($tags)) {
                                foreach($tags as $item) {
                                    echo "<li><a href=".">".$item['TenTL']."</a> </li>";
                                }
                            }
                            
                            ?>                                                
                        </ul>
                    </div>
                    <div class="buttons">
                        <button>Eposide 1</button>
                        <button>Tiếp tục</button>
                    </div>

                </div>
                <div class="contaner-page">
                    <div class="page-bar">
                        <ul>
                            <li class="active">Chapters</li>
                            <li>Comments</li>
                        </ul>
                    </div>

                    <div class="page active">
                        <div class="eposide">
                            
                            <ul>
                                <?php 
                                if(!empty($Ep)) {
                                    foreach($Ep as $item) {
                                        echo "<li><a href='read?MaTap=".$item['MaTap']."'>
                                        <h3 class='stt'>#".$item['TapSo']."</h3> ".$item['TenTap']."
                                        </a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="page">
                        <div class="container-commants">
                            <div class="rep">
                                <h4>Phản hồi</h4>
                                <form action="">
                                    <textarea id="" name="commant" rows="2" cols="50"></textarea>
                                    <div class="rep-button">Gửi</div>
                                </form>
                            </div>
                            
                            <ul>
                                <li>
                                    <div class="commant">
                                        <div class="cm-avt">
                                            <img src="res/Andreana.jfif" alt="">
                                        </div>
                                        <div class="cm-text">
                                            <div class="name"><a href="">Andreana</a> - 12 giờ trước</div>
                                            <div class="cm-texxt">
                                                can you feel my heart?
                                            </div>
                                            <div class="bar">
                                                <div class="reply">PHẢN HỒI</div>
                                                <div class="show-reply">2 phản hồi <i class=' bx bx-chevron-down'></i></div>
                                                <div class="like"><i class='bx bx-like'></i></div>
                                            </div>
                                        </div>
                                        <div class="rep">
                                            <h4>Phản hồi</h4>
                                            <form action="">
                                                <textarea id="" name="commant" rows="2" cols="50"></textarea>
                                                <div class="rep-button">Gửi</div>
                                            </form>
                                        </div>
                                        <div class="rep-commant">
                                            <ul>
                                                <li>
                                                    <div class="commant">
                                                        <div class="cm-avt">
                                                            <img src="res/Andreana.jfif" alt="">
                                                        </div>
                                                        <div class="cm-text">
                                                            <div class="name"><a href="">Andreana</a> - 12 giờ trước</div>
                                                            <div class="cm-texxt">
                                                                your heart in my fridge
                                                            </div>
                                                            <div class="bar">
                                                                <div class="reply">PHẢN HỒI</div>
                                                                <div class="like"><i class='bx bx-like'></i></div>
                                                            </div>
                                                        </div>

                                                        <div class="rep">
                                                            <h4>Phản hồi</h4>
                                                            <form action="">
                                                                <textarea id="" name="commant" rows="2"
                                                                    cols="50"></textarea>
                                                                <div class="rep-button">Gửi</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="items">
                <h2>Đề Xuất</h2>

                <div class="item">
                    <a href="" class="">
                        <img src="./res/KAF.png" alt="">
                        <div class="text">
                            <div class="name">
                                KAF- svgcgvgc adadad dad jfjf hhdhdhđh
                            </div>

                            <div class="content">
                                con chim do biet noi.
                            </div>
                        </div>

                        <div class="icon">
                            <i class='bx bx-right-arrow-alt'></i>
                        </div>
                    </a>

                    <div class="show-overlay">

                    </div>
                </div>

                <div class="item">
                    <a href="" class="">
                        <img src="./res/aiai.jpg" alt="">
                        <div class="text">
                            <div class="name">
                                KAF
                            </div>

                            <div class="content">
                                con chim do biet noi.
                            </div>
                        </div>

                        <div class="icon">
                            <i class='bx bx-right-arrow-alt'></i>
                        </div>
                    </a>

                    <div class="show-overlay">

                    </div>
                </div>

                <div class="item">
                    <a href="" class="">
                        <img src="res/Andreana.jfif" alt="">
                        <div class="text">
                            <div class="name">
                                KAF
                            </div>

                            <div class="content">
                                con chim do biet noi.
                            </div>
                        </div>

                        <div class="icon">
                            <i class='bx bx-right-arrow-alt'></i>
                        </div>
                    </a>

                    <div class="show-overlay">

                    </div>
                </div>

                <div class="item">
                    <a href="" class="">
                        <img src="./res/Fiammetta.jfif" alt="">
                        <div class="text">
                            <div class="name">
                                KAF
                            </div>

                            <div class="content">
                                con chim do biet noi.
                            </div>
                        </div>

                        <div class="icon">
                            <i class='bx bx-right-arrow-alt'></i>
                        </div>
                    </a>

                    <div class="show-overlay">

                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script src="../js/view.js"></script>
</body>

</html>