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
    if($_POST) {
        $sqlchange = "UPDATE `tai_khoan` SET ";
        $checkf = false;

        if(isset($_FILES["avt"])) {
            $error = array();
            $extension = array("jpeg", "jpg", "png", "gif");
            $file_name = $_FILES["avt"]["name"];
            $file_tmp = $_FILES["avt"]["tmp_name"];
    
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $imgName;
            if (in_array($ext, $extension)) {
                if (!file_exists("../../res/" . $file_name)) {
                    move_uploaded_file($_FILES["avt"]["tmp_name"], "../../res/". $file_name);
                    $imgName = $file_name;
                } else {
                    $filename = basename($file_name, $ext);
                    $newFileName = $filename . time() . "." . $ext;
                    move_uploaded_file($file_tmp = $_FILES["avt"]["tmp_name"], "../../res/". $newFileName);
                    $imgName = $newFileName;
                }

                $sql = "SELECT `AnhDD` FROM `tai_khoan` WHERE id= '".$userID."'";
                $query = mysqli_query($conn, $sql);

                $imgr = mysqli_fetch_array($query);
                if($imgr['AnhDD'] != null) {
                    $st = unlink("../../res/".$imgr['AnhDD']);
                }

                $sqlchange .= " AnhDD = '".$imgName."'";
                $checkf = true;
            } else {
                array_push($error, "$file_name, ");
            }
        }
    
        if(isset($_POST["name"])) {
            if($checkf) {
                $sqlchange .= ", Ten = '".$_POST["name"]."' ";
            } else {
                $sqlchange .= " Ten = '".$_POST["name"]."' ";
                $checkf = true;
            }
           
        }
        
        if(isset($_POST["description"])) {
            if($checkf) {
                $sqlchange .= ", about = '".$_POST["description"]."' ";
            } else {
                $sqlchange .= " about = '".$_POST["description"]."' ";
                $checkf = true;
            }
        }

        $sqlchange .= " WHERE id= '".$userID."'";

        $query = mysqli_query($conn, $sqlchange);

        if($query) {
            echo 'true';
            return;
        } else {
            echo $sqlchange;
        }
    }
    echo 'false';
?>