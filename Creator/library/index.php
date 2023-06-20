<?php 
session_start();

if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
} else {
    header("location: http://localhost/WEBTruynTranh/");
}
?>

<?php 


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
            <h2>Truyện của bạn</h2>
            <table class="comics">
                <thead>
                    <tr>
                        <td>Truyện</td>
                        <td>Chế độ hiển thị</td>
                        <td>Ngày tạo</td>
                        <td>Lược xem</td>
                        <td>Binh luận</td>
                        <td>Lược thích</td>
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
        </div>
    </main>

    <!-- ====js==== --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="../../index.js"></script>
    <script src="library.js"></script>
</body>

</html>