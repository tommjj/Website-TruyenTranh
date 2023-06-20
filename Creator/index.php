<?php 
session_start();

if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
} else {
    header("location: http://localhost/WEBTruynTranh/");
}
?>

<?php 

// get number of follower
    require("../server/comn.php");

    $sql = "SELECT `id`, `Ten`, `AnhDD`, `about`, COUNT(theo_doi.NguoiTD) AS follow FROM `tai_khoan` INNER JOIN `theo_doi` on tai_khoan.id = theo_doi.NguoiDuocTD WHERE id='".$userID."'";

    $query = mysqli_query($conn, $sql);

    $userData = mysqli_fetch_array($query);

// get tls

$sql = "SELECT SUM(`LuocXem`) as sls FROM `tap_truyen`, truyen WHERE tap_truyen.MaTruyen = truyen.MaTruyen and truyen.id = '".$userID."' GROUP BY truyen.MaTruyen";

$query = mysqli_query($conn, $sql);




$sumView = 0;
$maxView = 0;
$temp;
while($temp = mysqli_fetch_array($query)) {
    $sumView += $temp['sls'];
    if($temp['sls'] > $maxView) {
        $maxView = $temp['sls'];
    }
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
    <link rel="stylesheet" href="../responsive-index.css">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="comic/css/customization.css">
    <link rel="stylesheet" href="comic/css/create-chaper.css">
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
            <div class="up-load card">
                <i class='bx bx-library'></i>
                <p >tạo truyện của bạn để bắt đầu.</p>
                <button>Tạo truyện</button>
                <a href="">Thư viện</a>
            </div>

            <div class="card">
                <div class="data">
                    <h2>Số liệu phân tích</h2>
                    <p>Số người theo dỏi hiện tại</p>
                    <p class="flower"><?php echo $userData['follow'];?></p>
                    <hr>
                    <h2>Tóm tắt</h2>
                    <div class="view">Số lượt xem: <span class="number"><?php echo $sumView?></span></div>
                    <hr>
                    <h2>Truyện hàng đầu</h2>
                    <div class="view">Số lượt xem: <span class="number"><?php echo $maxView?></span></div>
                    <a href="">CHUYỂN ĐẾN SỐ LIỆU PHÂN TÍCH</a>
                </div>
                <div class="back-ground">
                    <i class='bx bxs-bar-chart-alt-2' ></i>
                </div>

            </div>

            <div class="create-comic hidden">
                <div class="contaner-page">
                    <div class="page-bar p-relative">
                        <ul>
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                        </ul>
                        <div class="buttons">
                            <button class="cancel"><i class='bx bx-x'></i></button>
                        </div>
                    </div>

                    <form action="" class="form-create" enctype="multipart/form-data">

                        <div class="page active">
                            <div class="change-avt">
                                <h3>Ảnh đại diện</h3>

                                <div class="avt-image">
                                    <img src="../res/KAF.png" alt="">

                                </div>
                                <div class="text">
                                    Bạn nên dùng ảnh có độ phân giải tối thiểu 200 x 300 pixel và
                                    có kích thước tối đa 6 MB. Hãy dùng tệp PNG hoặc GIF (không dùng ảnh động).
                                    <input class="select-img" type="file" name="avt" id="">
                                </div>   
                            </div>
                        </div>

                        <div class="page">
                            <div class="change-info">
                                    <h3>Tên</h3>
                                    <p>Chọn tên cho truyện của bạn.</p>
                                    <input type="text" name="name" id="">
                                    <h3>Thông tin mô tả</h3>
                                    <p>Giới thiệu truyện của bạn.</p>
                                    <textarea name="description" id="" cols="30" rows="10"></textarea>               
                           </div>
                        </div>

                        <div class="page">
                            <div class="change-info">
                                <h3>Thể loại</h3>
                                <p>Chọn thể loại cho truyện của bạn, bạn có thể chọn nhiều thẻ khác nhau.</p>
                                
                                <ul class="tags">
                                    <li>comic</li>
                                    <li>manga</li>
                                    <li>gia đình</li>
                                    <li>đời thường</li>
                                    <li>lãng mạng</li>
                                </ul>
                       </div>
                        </div>

                        <div class="buttons-ctrl">
                            <div class="button-pre">
                                QUAY LẠI
                             </div>
                            <div class="button-next">
                               TIẾP
                            </div>
                            <div class="button-submit">
                                TẠO
                            </div>
                        </div>
                    </form>
                </div>
            <div class="info"></div>
        </div>
    </main>

    <!-- ====js==== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="comic/js/create-comic.js"></script>
    <script src="comic/js/customization.js"></script>
    <script src="../index.js"></script>
    <script src="index.js"></script>
</body>

</html>