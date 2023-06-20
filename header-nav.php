<?php
if (!isset($_SESSION)) {
    session_start();
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

    $userData = mysqli_fetch_array($query);


    $sql = "SELECT  tai_khoan.id, tai_khoan.Ten, tai_khoan.AnhDD FROM `theo_doi`, tai_khoan WHERE theo_doi.NguoiDuocTD = tai_khoan.id and theo_doi.NguoiTD = '" . $userID . "'";

    $query = mysqli_query($conn, $sql);

    $numFollowed = mysqli_num_rows($query);

    $followedArr;
    if ($numFollowed > 0) {
        $temp;
        while ($temp = mysqli_fetch_array($query)) {
            $followedArr[] = $temp;
        }
    }

    mysqli_fetch_array($query);
} else {
    $unknown = true;
}
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
        <form  class="search-form" action="<?php echo getServertPageURL() . "/WEBTruynTranh/"; ?>" method="GET" enctype="multipart/form-data">
            <div class="search-icon"><i class='bx bx-search'></i></div>

            <input type="text" name="search" id="" autocomplete="off" value="<?php if (isset($_GET['search'])) {echo $_GET['search'];}?>">
            <input type="hidden" name="like" id="" value=3>
            <input type="submit" onclick="return checkSreachBar()" value="search">

            <?php 
                if(isset($_GET['tags'])) {
                    $tempArr = $_GET['tags'];

                    if (gettype($tempArr) == "array") {
            
                        foreach ($tempArr as $item) {
                            echo "<input type=\"hidden\" name='tags[]' value='".$item."'>";
                        }
                        
                    } else {
                        echo "<input type=\"hidden\" name='tags[]' value='".$tempArr."'>";
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
            if ($userData['AnhDD'] == null) {
                echo "<img src=\"" . getServertPageURL() . "/WEBTruynTranh/res/unnamed.webp\" alt=\"\">";
            } else {
                echo "<img src=\"" . getServertPageURL() . "/WEBTruynTranh/res/" . $userData['AnhDD'] . "\" alt=\"\">";
            }
            ?>
        </div>



        <div class="name">
            <?php echo $userData['Ten'] ?>
        </div>

        <div class="account-op">
            <ul>
                <li><a href="<?php echo getServertPageURL() . "/WEBTruynTranh/account/" ?>"><i class='bx bx-user'></i></i>Trang của bạn</a></li>
                <li><a href="<?php echo getPath('/WEBTruynTranh/Creator/')?>"><i class='bx bxs-grid'></i>Quản lý</a></li>
                <li id="log-out"><i class='bx bx-log-out'></i>Đăng xuất</li>
            </ul>
        </div>
    </div>

    <a href="<?php echo getServertPageURL() . "/WEBTruynTranh/signin-signup" ?>" class="signin-button" <?php if (!isset($unknown)) echo "style=\"display: none;\"" ?>>
        SIGN IN
    </a>
</header>

<nav class="nav active hidden" id="nav">
    <div>
        <ul>
            <li><a href="<?php echo getServertPageURL() . "/WEBTruynTranh/" ?>"><i class='bx bx-home-alt'></i>Trang chủ </a></li>
            <li><a href="<?php echo getServertPageURL() . "/WEBTruynTranh/feed/save" ?>"><i class='bx bx-book-content'></i>Truyện đã lưu</a></li>
            <li><a href=""><i class='bx bx-book-reader' ></i></i>Đã theo dõi</a></li>
            <li><a href=""><i class='bx bx-bookmark-alt'></i></i>Lịch sử</a></li>
            <li><a href=""><i class='bx bx-like'></i>Đã thích</a></li>
        </ul>

        <?php
        if (!isset($unknown)) {
            echo '<h4>Đang Theo dỏi</h4>';

            if (!empty($followedArr)) {

                echo "<ul class=\"show-followed\">";

                foreach ($followedArr as $item) {
                    echo "<li><a href=\"" . getServertPageURL() . "/WEBTruynTranh/account/?id=" . $item['id'] . "\"><img src=\"" . getPathImg($item['AnhDD']) . "\" alt=\"\">" . $item['Ten'] . "</a></li>";
                }

                if (count($followedArr) > 4) {
                    echo "<li class=\"show-more-followed\"><a><i class='bx bx-chevron-down' ></i></a></li>";
                }
                echo "</ul>";
            }
        }

        ?>

        <div class="contact">
            <a href=""><i class='bx bx-envelope'></i>Liên hệ với chúng tôi</a>
        </div>
    </div>
</nav>