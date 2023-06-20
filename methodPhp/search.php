<?php
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
}


if ($_GET) {
    $select = "SELECT t.MaTruyen, t.TenTruyen, t.AnhBia, t.NoiDung, t.NgayTao, t.MaCD ";
    $from = " FROM truyen as t";
    $where = " WHERE 1";
    $grBy = " GROUP BY t.MaTruyen";
    $limit = " ";

    $like = false;
    if (isset($_GET['like'])) {
        $like = $_GET['like'];
    }



    if (isset($_GET['search'])) {
        // if($_GET['search'] == "") {
        //     return;
        // } else {
        //     $search = trim($_GET['search']);
        // }


        if(isset($_GET['user']) ? $_GET['user'] : true) {
            $from .= " , tai_khoan as tk";
            $where .= " and t.id = tk.id";

            if ($like == 1) {
                $where .= " and (tk.Ten LIKE '%" . $_GET['search'] . "'";
            } else if ($like == 2) {
                $where .= " and (tk.Ten LIKE '" . $_GET['search'] . "%'";
            } else if ($like == 3) {
                $where .= " and (tk.Ten LIKE '%" . $_GET['search'] . "%'";
            } else {
                $where .= " and (tk.Ten = '" . $_GET['search'] . "'";
            }
        }              
        
        if(isset($_GET['user']) ? $_GET['user'] : true) {
            if(isset($_GET['user']) ? $_GET['user'] : true) {
                if ($like == 1) {
                    $where .= " or t.TenTruyen LIKE '%" . $_GET['search'] . "' )";
                } else if ($like == 2) {
                    $where .= " or t.TenTruyen LIKE '" . $_GET['search'] . "%' )";
                } else if ($like == 3) {
                    $where .= " or t.TenTruyen LIKE '%" . $_GET['search'] . "%' )";
                } else {
                    $where .= " or t.TenTruyen = '" . $_GET['search'] . "' )";
                }
            } else {
                if ($like == 1) {
                    $where .= " and t.TenTruyen LIKE '%" . $_GET['search'] . "'";
                } else if ($like == 2) {
                    $where .= " and t.TenTruyen LIKE '" . $_GET['search'] . "%'";
                } else if ($like == 3) {
                    $where .= " and t.TenTruyen LIKE '%" . $_GET['search'] . "%'";
                } else {
                    $where .= " and t.TenTruyen = '" . $_GET['search'] . "'";
                }
            }
        } 
    } else {
        return;
    }

    if (isset($_GET['tags'])) {
        $from .= " , tl_truyen as tl";
        $where .= " and t.MaTruyen = tl.MaTruyen";

        $arr = $_GET['tags'];

        if (gettype($arr) == "array") {
            $checkF = true;

            foreach ($arr as $item) {
                if ($checkF) {
                    $where .= "  and ( tl.MaTL = '" . $item . "'";
                    $checkF = false;
                } else {
                    $where .= " or tl.MaTL = '" . $item . "'";
                }
            }
            $where .= " ) ";
        } else {
            $where .= " and tl.MaTL = '" . $arr . "'";
        }
    }

    if (isset($_GET['at'])) {
        $limit .= " LIMIT " . $_GET['at'];

        if (isset($_GET['limit'])) {
            $limit .= ", " . $_GET['limit'];
        }
    }

    require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

    $sql = $select . $from . $where . $grBy . $limit;

    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0) {
        $searchArr;
        $temp;

        while ($temp = mysqli_fetch_array($query)) {
            $searchArr[] = $temp;
        }

        if (isset($_GET['json'])) {
            if ($_GET['json'] == true) {
                echo json_encode($searchArr);
            }
        }
    }
} 

if ($_POST) {
    $select = "SELECT t.MaTruyen, t.TenTruyen, t.AnhBia, t.NoiDung, t.NgayTao, t.MaCD ";
    $from = " FROM truyen as t";
    $where = " WHERE 1";
    $grBy = " GROUP BY t.MaTruyen";
    $limit = " ";

    $like = false;
    if (isset($_POST['like'])) {
        $like = $_POST['like'];
    }



    if (isset($_POST['search'])) {
        if($_POST['search'] == "") {
            return;
        } else {
            $search = trim($_POST['search']);
        }


        if(isset($_POST['user']) ? $_POST['user'] : true) {
            $from .= " , tai_khoan as tk";
            $where .= " and t.id = tk.id";

            if ($like == 1) {
                $where .= " and (tk.Ten LIKE '%" . $_POST['search'] . "'";
            } else if ($like == 2) {
                $where .= " and (tk.Ten LIKE '" . $_POST['search'] . "%'";
            } else if ($like == 3) {
                $where .= " and (tk.Ten LIKE '%" . $_POST['search'] . "%'";
            } else {
                $where .= " and (tk.Ten = '" . $_POST['search'] . "'";
            }
        }              
        
        if(isset($_POST['user']) ? $_POST['user'] : true) {
            if(isset($_POST['user']) ? $_POST['user'] : true) {
                if ($like == 1) {
                    $where .= " or t.TenTruyen LIKE '%" . $_POST['search'] . "' )";
                } else if ($like == 2) {
                    $where .= " or t.TenTruyen LIKE '" . $_POST['search'] . "%' )";
                } else if ($like == 3) {
                    $where .= " or t.TenTruyen LIKE '%" . $_POST['search'] . "%' )";
                } else {
                    $where .= " or t.TenTruyen = '" . $_POST['search'] . "' )";
                }
            } else {
                if ($like == 1) {
                    $where .= " and t.TenTruyen LIKE '%" . $_POST['search'] . "'";
                } else if ($like == 2) {
                    $where .= " and t.TenTruyen LIKE '" . $_POST['search'] . "%'";
                } else if ($like == 3) {
                    $where .= " and t.TenTruyen LIKE '%" . $_POST['search'] . "%'";
                } else {
                    $where .= " and t.TenTruyen = '" . $_POST['search'] . "'";
                }
            }
        } 
    } else {
        return;
    }

    if (isset($_POST['tags'])) {
        $from .= " , tl_truyen as tl";
        $where .= " and t.MaTruyen = tl.MaTruyen";

        $arr = $_POST['tags'];

        if (gettype($arr) == "array") {
            $checkF = true;

            foreach ($arr as $item) {
                if ($checkF) {
                    $where .= "  and ( tl.MaTL = '" . $item . "'";
                    $checkF = false;
                } else {
                    $where .= " or tl.MaTL = '" . $item . "'";
                }
            }
            $where .= " ) ";
        } else {
            $where .= " and tl.MaTL = '" . $arr . "'";
        }
    }

    if (isset($_POST['at'])) {
        $limit .= " LIMIT " . $_POST['at'];

        if (isset($_POST['limit'])) {
            $limit .= ", " . $_POST['limit'];
        }
    }

    require("C:/xampp/htdocs/WEBTruynTranh/server/comn.php");

    $sql = $select . $from . $where . $grBy . $limit;

    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0) {
        $searchArr;
        $temp;

        while ($temp = mysqli_fetch_array($query)) {
            $searchArr[] = $temp;
        }

        if (isset($_POST['json'])) {
            if ($_POST['json'] == true) {
                echo json_encode($searchArr);
            }
        }
    }
}
