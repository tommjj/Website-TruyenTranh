<?php 
    session_start();
    if(isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
    } else {
        return;
    }

    $limit = '';

    if(isset($_GET['at'])) {
        $limit .= ' LIMIT '.$_GET['at'];
        if(isset($_GET['limit'])) {
            $limit .= ' , '.$_GET['limit'];
        }
    }

    require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

    $sql = "SELECT COUNT(thich.id) as slt FROM `truyen` LEFT JOIN thich on truyen.MaTruyen = thich.MaTruyen WHERE truyen.id = '".$userID."' GROUP BY truyen.MaTruyen" . $limit;
    
    $query = mysqli_query($conn, $sql);

    $arr1;
    $temp;
    while($temp =  mysqli_fetch_assoc($query)) {
        $arr1[] = $temp;
    }

    $sql = "SELECT truyen.MaTruyen, truyen.TenTruyen, truyen.AnhBia, truyen.NoiDung, truyen.id, DATE(NgayTao) as NgayTao, cd_thien_thi.TenCD FROM truyen, cd_thien_thi WHERE  truyen.MaCD = cd_thien_thi.MaCD AND  id = '".$userID."'" . $limit;

    $query = mysqli_query($conn, $sql);

    $arr2;
    $temp;
    while($temp =  mysqli_fetch_array($query)) {
        $arr2[] = $temp;
    }

    $sql = "SELECT COUNT(binh_luan.MaBL) as sbl FROM `truyen` LEFT JOIN binh_luan ON binh_luan.MaTruyen = truyen.MaTruyen WHERE truyen.id= '".$userID."' GROUP BY truyen.MaTruyen" . $limit;

    $query = mysqli_query($conn, $sql);

    $arr3;
    $temp;
    while($temp =  mysqli_fetch_assoc($query)) {
        $arr3[] = $temp;
    }

    $sql = "SELECT SUM(tap_truyen.LuocXem) as ls FROM truyen LEFT JOIN `tap_truyen` on truyen.MaTruyen = tap_truyen.MaTruyen WHERE truyen.id = '".$userID."' GROUP BY truyen.MaTruyen" . $limit;

    $query = mysqli_query($conn, $sql);

    $arr4;
    $temp;
    while($temp =  mysqli_fetch_assoc($query)) {
        $arr4[] = $temp;
    }

    if($arr2 != null) {
        for($i = 0; $i < count($arr2); $i += 1) {
            $arr2[$i]['slt'] = $arr1[$i]['slt'];
            $arr2[$i]['sbl'] = $arr3[$i]['sbl'];
            $arr2[$i]['ls'] = $arr4[$i]['ls'];
        }
    }
    echo json_encode($arr2);
?>