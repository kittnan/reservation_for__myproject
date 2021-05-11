<!-- <?php session_start() ?> -->
<?php
if (isset($_SESSION['id'])) {

    if ($_SESSION['status'] == 2 || $_SESSION['status'] == 3) { ?>

        <!doctype html>
        <html lang="en">

        <head>
            <title>AdminPage</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        </head>

        <body>

            <?php require("navbarall.php");
                    require('sidebar.php');
                    include_once('connect.php');
                    ?>
            <div class="container">
                <div class="row">
                    <div class=" col-md-8 mx-auto mt-5 text-center">
                        <h3>Manage Room</h3>
                    </div>
                </div>
                <table class="table mt-3 col-8 mx-auto">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>ชื่อห้อง</th>
                            <th>สถานะ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class=" text-center">
                        <?php
                                $sql_allroom = "SELECT * FROM allroom";
                                $result_allroom = $conn->query($sql_allroom);
                                while ($row_allroom = mysqli_fetch_assoc($result_allroom)) { ?>
                            <tr>
                                <th><?php echo $row_allroom['roomname']; ?></th>

                                <th>
                                    <?php
                                                if ($row_allroom['status'] == 2) { ?>
                                        <p class="text-success">พร้อมใช้งาน</p>
                                    <?php } else if ($row_allroom['status'] == 0) { ?>
                                        <p class="text-danger">ไม่พร้อมใช้งาน</p>
                                    <?php }
                                                ?>
                                </th>

                                <th>
                                    <form action="" method="GET">
                                        <?php
                                                    if ($row_allroom['status'] == 2) { 
                                                        $sql_reserv = "SELECT * FROM `reservation` WHERE `roomid` = ".$row_allroom['roomid'];
                                                        $result_reserv = $conn->query($sql_reserv);
                                                        $row_reserv = mysqli_fetch_assoc($result_reserv);
                                                        $busy = 0 ;
                                                        for($i=1; $i<=9; $i++){
                                                            if($row_reserv[$i] != 0 ){ 
                                                                $busy = 1 ;

                                                             }
                                                        } 
                                                        if($busy == 1){ ?>
                                                            
                                                            <input type="submit" class="btn btn-outline-danger" onclick="return confirm('ขณะนี้มีผู้ใช้ห้อง คุณต้องการจะปิดห้องหรือไม่ ?')" value="ปิด" name="<?php echo $row_allroom['roomid'] . "/" . "close"; ?>">
                                                <?php  } else { ?>
                                                                <input type="submit" class="btn btn-outline-danger" value="ปิด" name="<?php echo $row_allroom['roomid'] . "/" . "close"; ?>">
                                                        <?php  }
                                                        ?>
                                                        
                                        <?php } else if ($row_allroom['status'] == 0) { ?>
                                            <input type="submit" class="btn btn-success" value="เปิด" name="<?php echo $row_allroom['roomid'] . "/" . "open"; ?>">
                                        <?php }
                                                    ?>
                                    </form>
                                </th>
                            </tr>
                        <?php
                                    // echo $row_allroom['roomid'] . "/" ."close" ;
                                    $submit_close = $row_allroom['roomid'] . "/" . "close";
                                    $submit_open = $row_allroom['roomid'] . "/" . "open";
// ปุ่มปิดห้อง
                                    if (isset($_GET[$submit_close])) {
                                        $sql_update_allroom = "UPDATE `allroom` SET `status` = '0' WHERE `allroom`.`roomid` =" . $row_allroom['roomid'];
                                        if ($conn->query($sql_update_allroom) === TRUE) {

                                            $sql_update_reserv = "UPDATE `reservation` SET `1` = '" . $_SESSION['id'] . "', `q1` = ' ', `2` = '" . $_SESSION['id'] . "', `q2` = ' ',
                             `3` = '" . $_SESSION['id'] . "', `q3` = ' ', `4` = '" . $_SESSION['id'] . "', `q4` = ' ', `5` = '" . $_SESSION['id'] . "', `q5` = ' ', `6` = '" . $_SESSION['id'] . "', `q6` = ' ',
                              `7` = '" . $_SESSION['id'] . "', `q7` = ' ', `8` = '" . $_SESSION['id'] . "', `q8` = ' ', `9` = '" . $_SESSION['id'] . "', `q9` = ' ' WHERE `reservation`.`rid` =" . $row_allroom['roomid'];
                                            if ($conn->query($sql_update_reserv) === TRUE) {
                                                echo '<script language="javascript">';
                                                echo 'alert("ห้องถูกปิดแล้ว !!")';
                                                echo '</script>';
                                                echo "<meta http-equiv='refresh' content='0;URL=admin_control_room.php' >";
                                            }
                                        }
// ปุ่มเปิดห้อง
                                    } else if (isset($_GET[$submit_open])) {
                                        $sql_update_allroom = "UPDATE `allroom` SET `status` = '2' WHERE `allroom`.`roomid` =" . $row_allroom['roomid'];
                                        if ($conn->query($sql_update_allroom) === TRUE) {

                                            $sql_update_reserv = "UPDATE `reservation` SET `1` = '0', `q1` = ' ', `2` = '0', `q2` = ' ',
                             `3` = '0', `q3` = ' ', `4` = '0', `q4` = ' ', `5` = '0', `q5` = ' ', `6` = '0', `q6` = ' ',
                              `7` = '0', `q7` = ' ', `8` = '0', `q8` = ' ', `9` = '0', `q9` = ' ' WHERE `reservation`.`rid` =" . $row_allroom['roomid'];
                                            if ($conn->query($sql_update_reserv) === TRUE) {
                                                echo '<script language="javascript">';
                                                echo 'alert("ห้องถูกเปิดแล้ว !!")';
                                                echo '</script>';
                                                echo "<meta http-equiv='refresh' content='0;URL=admin_control_room.php' >";
                                            }
                                        }
                                    }
                                }
                                ?>
                    </tbody>
                </table>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

        </html>
<?php } else {
     echo '<script language="javascript">';
     echo 'alert("เฉพาะเจ้าหน้าที่เท่านั้น !!")';
     echo '</script>';
     echo "<meta http-equiv='refresh' content='0;URL=admin_control_room.php' >";
}
} else{
     echo '<script language="javascript">';
     echo 'alert("กรุณา login  !!")';
     echo '</script>';
     echo "<meta http-equiv='refresh' content='0;URL=admin_control_room.php' >";
}
?>