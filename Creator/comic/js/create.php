<<?php 

if ($_POST) {
    // // $deleteList = array();
    // if (isset($_POST["avt"])) {
    //     $deleteList = $_POST["name"];
    //     foreach ($deleteList as $id) {
    //         $sql = "delete from taikhoan where id ='".$id."'";
    //         $query = mysqli_query($conn, $sql);          
               
    //     }
    // };
    // echo 'true'; 
    // //header("Location: index.php");
    if(isset($_FILES["avt"])) {
        sleep(1);
        $error = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        //foreach ($_FILES["avt"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["avt"]["name"];
        $file_tmp = $_FILES["avt"]["tmp_name"];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {
            if (!file_exists("photo/" . $file_name)) {
                move_uploaded_file($_FILES["avt"]["tmp_name"], "photo/". $file_name);
                
            } else {
                $filename = basename($file_name, $ext);
                $newFileName = $filename . time() . "." . $ext;
                move_uploaded_file($file_tmp = $_FILES["avt"]["tmp_name"], "photo/". $newFileName);
                
            }
        } else {
            array_push($error, "$file_name, ");
        }
        //}
    }

    if(isset($_POST["name"])) {
       echo $_POST["name"] ."\n";
    }
    
    if(isset($_POST["tags"])) {
        echo "test";
        $temp = $_POST["tags"];
       foreach($temp as $tag) {
             echo $tag ."\n";
         }
     }
}

?>