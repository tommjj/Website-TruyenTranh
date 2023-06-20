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
?>

<?php
function getServertPageURL()
{
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == 'on') {
            $pageURL .= "s";
        }
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }
    return $pageURL;
}

function getPath($path)
{
    return getServertPageURL() . $path;
}

function getPathImg($name)
{
    if ($name == null) {
        return getServertPageURL() . "/WEBTruynTranh/res/web-logo.png";
    } else {
        return getServertPageURL() . "/WEBTruynTranh/res/" . $name;
    }
}
?>

<?php
if (isset($userID)) {
    $sql = "SELECT `Ten`, `AnhDD` FROM `tai_khoan` WHERE id='" . $userID . "'";

    $query = mysqli_query($conn, $sql);

    $userInfo = mysqli_fetch_array($query);
}

//
$sql = "SELECT `TenTruyen`, `AnhBia` FROM `truyen` WHERE MaTruyen = '" . $MaTruyen . "'";

$query = mysqli_query($conn, $sql);

$ComicData = mysqli_fetch_array($query);
?>

<header id="header">

    <div class="logo">
        <div class="nav-button" id="nav-button">
            <i class='bx bx-menu'></i>
        </div>

        <a href="<?php echo getPath('/WEBTruynTranh') ?>" class="logo">
            <div class="logo-img">
                <img src=<?php echo getServertPageURL() . "/WEBTruynTranh/res/web-logo.png" ?> alt="">
            </div>
            <div class="logo-text">
                LOGO
            </div>
        </a>
    </div>

    <div class="search">


        <div class="search-overlay" id="search-overlay">
            <i class='bx bx-left-arrow-alt'></i>
        </div>
        <form class="search-form" action="<?php echo getServertPageURL() . "/WEBTruynTranh/"; ?>" method="GET" enctype="multipart/form-data">
            <div class="search-icon"><i class='bx bx-search'></i></div>

            <input type="text" name="search" id="" autocomplete="off" value="<?php if (isset($_GET['search'])) {
                                                                                    echo $_GET['search'];
                                                                                } ?>">
            <input type="hidden" name="like" id="" value=3>
            <input type="submit" onclick="return checkSreachBar()" value="search">

            <?php
            if (isset($_GET['tags'])) {
                $tempArr = $_GET['tags'];

                if (gettype($tempArr) == "array") {

                    foreach ($tempArr as $item) {
                        echo "<input type=\"hidden\" name='tags[]' value='" . $item . "'>";
                    }
                } else {
                    echo "<input type=\"hidden\" name='tags[]' value='" . $tempArr . "'>";
                }
            }

            ?>
        </form>
        <div class="search-suggestions">
            <ul>

            </ul>
        </div>

    </div>

    <div class="account" <?php if (isset($unknown)) echo "style=\"display: none;\"" ?>>
        <div class="avt">
            <?php

            if ($userInfo['AnhDD'] == null) {
                echo "<img src=\"" . getServertPageURL() . "/WEBTruynTranh/res/unnamed.webp\" alt=\"\">";
            } else {
                echo "<img src=\"" . getServertPageURL() . "/WEBTruynTranh/res/" . $userInfo['AnhDD'] . "\" alt=\"\">";
            }
            ?>
        </div>



        <div class="name">
            <?php echo $userInfo['Ten'] ?>
        </div>

        <div class="account-op">
            <ul>
                <li><a href="<?php echo getServertPageURL() . "/WEBTruynTranh/account/" ?>"><i class='bx bx-user'></i></i>Trang của bạn</a></li>
                <li><a href=""><i class='bx bxs-grid'></i>Quản lý</a></li>
                <li id="log-out"><i class='bx bx-log-out'></i>Đăng xuất</li>
            </ul>
        </div>
    </div>

    <a href="<?php echo getServertPageURL() . "/WEBTruynTranh/signin-signup" ?>" class="signin-button" <?php if (!isset($unknown)) echo "style=\"display: none;\"" ?>>
        SIGN IN
    </a>
</header>


<nav class="nav active" id="nav">
    <div>
        <div class="comic">
            <a href="" class="avt"><img src="<?php echo getPathImg($ComicData['AnhBia']) ?>" alt=""></a>
            <div class="name"><?php echo $ComicData['TenTruyen'] ?></div>
        </div>

        <ul>
            <li><a href="<?php echo getPath('/WEBTruynTranh/Creator/comic?MaTruyen=' . $MaTruyen) ?>"><i class='bx bx-category'></i>Tổng quan</a></li>
            <li><a href="<?php echo getPath('/WEBTruynTranh/Creator/comic/library?MaTruyen=' . $MaTruyen) ?>"><i class='bx bx-book-content'></i>Tập Truyện</a></li>
            <li><a href=""><i class='bx bx-bar-chart-alt-2'></i></i>Số liệu</a></li>
            <li><a href=""><i class='bx bx-comment'></i></i>Bình luận</a></li>
            <li><a href="<?php echo getPath('/WEBTruynTranh/Creator/comic/library?MaTruyen=' . $MaTruyen) ?>"><i class='bx bx-customize'></i></i></i>Tuỳ chỉnh</a></li>
        </ul>

        <div class="contact">
            <a href=""><i class='bx bx-envelope'></i>Liên hệ với chúng tôi</a>
        </div>
    </div>
</nav>