<?php 
session_start();

require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
} else {
    header("location: http://localhost/WEBTruynTranh/");
}
?>

<?php 
if (isset($userID)) {


    $sql = "SELECT `Ten`, `AnhDD`, about FROM `tai_khoan` WHERE id='" . $userID . "'";

    $query = mysqli_query($conn, $sql);

    $userData = mysqli_fetch_array($query);
}

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
    <link rel="stylesheet" href="../../css/page.css">
    <link rel="stylesheet" href="../css/customization.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Creator</title>
</head>

<body>
    <?php 
        require("../header-nav.php");
    ?>


    <main class="main">
        <div class="container">
            <h2>Tùy chỉnh</h2>
            <div class="contaner-page">
                <div class="page-bar p-relative">
                    <ul>
                        <li class="active">Hình ảnh</li>
                        <li>Thông tin</li>
                    </ul>
                    <div class="buttons">
                        <button class="cancel">Huỷ</button>
                        <button class="save">LƯU</button>

                    </div>
                </div>
    
                <div class="page active">
                    <div class="change-avt">
                        <h3>Ảnh đại diện</h3>
                
                        <div class="avt-image">
                            <img src="<?php echo getPath('/WEBTruynTranh/res/'.$userData['AnhDD'])?>" alt="">
                            
                         </div>
                         <form action="" class="change-info-form">
                            <div class="text">
                                Bạn nên dùng ảnh có độ phân giải tối thiểu 98 x 98 pixel và 
                                có kích thước tối đa 4 MB. Hãy dùng tệp PNG hoặc GIF (không dùng ảnh động).
                            </div>
                            <input class="select-img" type="file" name="avt" id="">
                        
                    </div>
                </div>
    
                <div class="page">
                   <div class="change-info">
                            <h3>Tên</h3>
                            <p>Chọn tên cho tài khoảng của bạn.</p>
                            <input type="text" name="name" id="" autocomplete="off" value="<?php echo $userData['Ten']?>">
                            <h3>Thông tin mô tả</h3>
                            <p>Giới thiệu với người trang của bạn.</p>
                            <textarea name="description" id="" cols="30" rows="10" ><?php echo $userData['about']?></textarea>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ====js==== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../../index.js"></script>
    <script src="../../js/page.js"></script>
    <script src="../js/customization.js"></script>
    <script src="customizzation.js"></script>
</body>

</html>