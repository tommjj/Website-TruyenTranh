<div class="filters">
                <div class="bar">
                    <div class="button">
                        <i class='bx bx-slider'></i> Bộ lọc
                    </div>
                </div>
                <div class="tags">
                    <?php echo "<h4>Theo loại</h4>"; ?>
                    <ul>
                        <?php

                        $sql = "SELECT * FROM `the_loai`";

                        $query = mysqli_query($conn, $sql);

                        $temp;

                        

                        while ($temp = mysqli_fetch_array($query)) {
                            
                            if (isset($_GET['tags'])) {
                                $tempArr = $_GET['tags'];
    
                                if (gettype($tempArr) == "array") {
                                    
                                    $checkSelect = true;

                                    foreach ($tempArr as $item) {
                                        if($item == $temp['MaTL']) {
                                            echo "<li class='active' ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                            $checkSelect = false;
                                            break;
                                        } 
                                    }

                                    if($checkSelect) {
                                        echo "<li ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                    }
                                } else {

                                    if($tempArr == $temp['MaTL']) {
                                        echo "<li class='active' ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                    } else {
                                        echo "<li ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                                    }
                                }
                            } else {
                                echo "<li ma='" . $temp['MaTL'] . "'>" . $temp['TenTL'] . "</li>";
                            }                  
                        }
                        ?>
                    </ul>
                </div>
            </div>