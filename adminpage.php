<!-- <?php session_start() ?> -->

<?php 
    if(isset($_SESSION['id'])){
        if($_SESSION['status']==2 || $_SESSION['status']==3){ ?>

<!doctype html>
<html lang="en">

<head>
    <title>AdminPage</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php require("navbarall.php");
    require('sidebar.php') ?>
    <?php
    include_once('connect.php');

    ?>
    <div class="container">
        <div class="row">
            <div class=" col-md-9 mx-auto mt-5">
                <form action="" class="text-center" method="POST">
                    <span>ตอบรับการจองอัตโนมัติ</span>
                    <?php
                    $sql_admin_control = "SELECT * FROM admin_control";
                    $result_admin_control = $conn->query($sql_admin_control);

                    $sql_auto = "SELECT * FROM auto";
                    $result_sql_auto = $conn->query($sql_auto);
                    $row_sql_auto = mysqli_fetch_assoc($result_sql_auto);
                    if ($row_sql_auto['status'] == 1) { ?>
                        <input type="submit" value="ON" name="on" class="btn btn-success">
                        <input type="submit" value="OFF" name="off" class="btn btn-outline-danger">
                    <?php
                    } else { ?>
                        <input type="submit" value="ON" name="on" class="btn btn-outline-success">
                        <input type="submit" value="OFF" name="off" class="btn btn-danger">
                    <?php
                    }
// mode auto / on off
                    if (isset($_POST['on'])) {
                        $sql_auto = "UPDATE auto SET status = 1 ";
                        if ($conn->query($sql_auto) === TRUE) {
                            echo '<script language="javascript">';
                            echo 'alert("เปิดตอบรับอนุมัติ")';
                            echo '</script>';
                            echo "<meta http-equiv='refresh' content='0;URL=adminpage.php' >";
                            // echo "ON";
                        }
                    }
                    if (isset($_POST['off'])) {
                        $sql_auto = "UPDATE auto SET status = 0 ";
                        if ($conn->query($sql_auto) === TRUE) {
                            echo '<script language="javascript">';
                            echo 'alert("ปิดตอบรับอนุมัติ")';
                            echo '</script>';
                            echo "<meta http-equiv='refresh' content='0;URL=adminpage.php' >";
                            // echo "OFF";
                        }
                    }
//
                    ?>
                    <h4 class="text-center mt-5">รายชื่อรออนุมัติ</h4>
                </form>
                <table class="table mt-3">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Std-id</th>
                            <th scope="col">Room</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="POST" class=" mt-3">
                            <?php while ($row_admin_control = mysqli_fetch_assoc($result_admin_control)) {

                            $sql_allroom = "SELECT * FROM `allroom` WHERE `roomid` = " .$row_admin_control['roomid'] ;
                            $result_allroom = $conn->query($sql_allroom);
                            $row_allroom = mysqli_fetch_assoc($result_allroom);
                            
// show list reserv and auto confirm
                                if ($row_sql_auto['status'] == 1 && $row_admin_control['status'] == 1) { ?>
                                    <tr>
                                        <th scope="col"><?php echo $row_admin_control['time'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['name'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['stdid'] ?></th>
                                        <th scope="col"><?php echo $row_allroom['roomname'] ?></th>
                                        <th scope="col"><?php echo timet($row_admin_control['reserv_time']);  ?></th>
                                        <th scope="col">รอการอนุมัติ</th>
                                        <th scope="col">
                                            <input type="submit" name="<?php echo $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/y"; ?>" value="YES" class="btn btn-success">
                                            <input type="submit" name="<?php echo $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/n"; ?>" value="NO" class="btn btn-danger">
                                            <!-- <input type="submit" name="submit" value="ตกลง" class="btn btn-success"> -->
                                        </th>
                                    </tr>
                                    <?php
                                            $y = $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/y";
                                            $n = $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/n";

                                            // echo $y;
                                            $formname = $y;
                                            // $sql2 = "UPDATE admin_control SET status = 2 WHERE id =" . $row_admin_control['id'];
                                            $sql2 = "UPDATE `admin_control` SET `status` = '2', `approve_status` = '1' WHERE `admin_control`.`admincontrol_id` = ". $row_admin_control['admincontrol_id'];
                                            if ($conn->query($sql2) === TRUE) {
                                                $str = explode("/", $formname);
                                                // echo $str[0] . "-" . $str[1];
                                                $rd = rand(000, 999);
                                                $qr = $row_admin_control['stdid'] . "/" . $rd . "/" . $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'];

                                                for ($i = 1; $i <= 9; $i++) {
                                                    if ($row_admin_control['reserv_time'] == $i) {
                                                        $q = "q" . $i;
                                                    }
                                                }

                                                $sql3 = "UPDATE `reservation` SET `" . $str[1] . "` = '" . $row_admin_control['userid'] . "', `" . $q . "` = '" . $qr . "' WHERE `reservation`.`rid` = " . $str[0] . "";
                                                if ($conn->query($sql3) === TRUE) {
                                                    // echo "<br> qr = " . $qr . " q=" . $q;
                                                    // echo "Suscess!!";
                                                    echo "<meta http-equiv='refresh' content='1;URL=adminpage.php' >";
                                                }
                                            }
// show list reserv and manual confirm
                                        } else if ($row_sql_auto['status'] == 0 && $row_admin_control['status'] == 1) { ?>

                                    <tr>
                                        <th scope="col"><?php echo $row_admin_control['time'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['name'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['stdid'] ?></th>
                                        <th scope="col"><?php echo $row_allroom['roomname'] ?></th>
                                        <th scope="col"><?php echo timet($row_admin_control['reserv_time']);  ?></th>
                                        <th scope="col" class=" text-warning">รอการอนุมัติ</th>
                                        <th scope="col">
                                            <input type="submit" name="<?php echo $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/y"; ?>" value="YES" class="btn btn-success">
                                            <input type="submit" name="<?php echo $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/n"; ?>" value="NO" class="btn btn-danger">
                                            <!-- <input type="submit" name="submit" value="ตกลง" class="btn btn-success"> -->
                                        </th>
                                    </tr>
                            <?php
                                    $y = $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/y";
                                    $n = $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'] . "/n";
// manual yes
                                    if (isset($_POST[$y])) {
                                        // echo $y;
                                        $formname = $y;
                                        $sql2 = "UPDATE admin_control SET status = 2 WHERE admincontrol_id =" . $row_admin_control['admincontrol_id'];
                                        if ($conn->query($sql2) === TRUE) {
                                            $str = explode("/", $formname);
                                            // echo $str[0] . "-" . $str[1];
                                            $rd = rand(000, 999);
                                            $qr = $row_admin_control['stdid'] . "/" . $rd . "/" . $row_admin_control['roomid'] . "/" . $row_admin_control['reserv_time'];

                                            for ($i = 1; $i <= 9; $i++) {
                                                if ($row_admin_control['reserv_time'] == $i) {
                                                    $q = "q" . $i;
                                                }
                                            }

                                            $sql3 = "UPDATE `reservation` SET `" . $str[1] . "` = '" . $row_admin_control['userid'] . "', `" . $q . "` = '" . $qr . "' WHERE `reservation`.`rid` = " . $str[0] . "";
                                            if ($conn->query($sql3) === TRUE) {
                                                // echo "<br> qr = " . $qr . " q=" . $q;
                                                // echo "Suscess!!";

                                                // echo "<br> qr = " . $qr . " q=" . $q;
                                                // echo "Suscess!!";
                                                // $userid_ans_1 = $row_admin_control['userid'];

                                                // $sql_ans_1 = "SELECT * FROM admin_control";
                                                // $result_ans_1 = $conn->query($sql_ans_1);
                                                // while ($row_admin_control_ans_1 = mysqli_fetch_assoc($result_ans_1)) {
                                                //     if ($row_admin_control['userid'] == $userid_ans_1 && $row_admin_control['status'] == 1) {
                                                //         $sql_send_ac = "UPDATE admin_control SET status = 0 WHERE id =" . $row_admin_control['id'];
                                                //         if ($conn->query($sql_send_ac) === TRUE) {
                                                //             echo "5454545454545" ;
                                                //             // echo "<meta http-equiv='refresh' content='1;URL=adminpage.php' >";
                                                //         }
                                                //     }

                                                echo "<meta http-equiv='refresh' content='0;URL=adminpage.php' >";
                                                // }
                                            }
                                        }
// manual no
                                    } else if (isset($_POST[$n])) {
                                        $sql_no = "UPDATE `admin_control` SET `status` = '0' WHERE `admin_control`.`admincontrol_id` =" . $row_admin_control['admincontrol_id'];
                                        if ($conn->query($sql_no) === TRUE) {
                                            // echo "delete";
                                            echo "<meta http-equiv='refresh' content='0;URL=adminpage.php' >";
                                        }
                                    }
                                }
                            }
                            ?>
                        </form>
                    </tbody>
                </table>




                <h4 class="text-center mt-5">ประวัติการจองห้องของวันนี้</h4>

                <table class="table mt-1">
                    <thead class="thead-dark">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Std-id</th>
                        <th scope="col">Room</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $sql_admin_control = "SELECT * FROM admin_control";
                        $result_admin_control = $conn->query($sql_admin_control); ?>
                        <form action="" method="POST">
                            <?php while ($row_admin_control = mysqli_fetch_assoc($result_admin_control)) { 

                                $sql_allroom = "SELECT * FROM `allroom` WHERE `roomid` = " .$row_admin_control['roomid'] ;
                                $result_allroom = $conn->query($sql_allroom);
                                $row_allroom = mysqli_fetch_assoc($result_allroom);
                                // echo $row_allroom['roomname'];
                                
                                

// show list history
                                     if ($row_admin_control['status'] == 2) { ?>
                                    <tr>
                                        <th scope="col"><?php echo $row_admin_control['time'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['name'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['stdid'] ?></th>
                                        <th scope="col"><?php echo $row_allroom['roomname']; ?></th>
                                        <th scope="col"><?php echo timet ($row_admin_control['reserv_time']) ;  ?></th>
                                        <th scope="col" class=" text-success">อนุมัติแล้ว</th>
                                        <th scope="col">
                                            <input type="submit" onclick="return confirm('ต้องการเพิ่ม <?php echo $row_admin_control['name'] ?> ใน blacklist ? ')" name="<?php echo $row_admin_control['userid']; ?>" value="BlackList" class="btn-danger">
                                        </th>
                                    </tr>

                                <?php  } else if ($row_admin_control['status'] == 0) { ?>




                                    <tr>
                                        <th scope="col"><?php echo $row_admin_control['time'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['name'] ?></th>
                                        <th scope="col"><?php echo $row_admin_control['stdid'] ?></th>
                                        <th scope="col"><?php echo $row_allroom['roomname']; ?></th>
                                        <th scope="col"><?php echo timet($row_admin_control['reserv_time']);  ?></th>
                                        <th scope="col" class=" text-danger">ปฎิเสธการอนุมัติแล้ว</th>
                                        <th scope="col">
                                            <input type="submit" name="<?php echo $row_admin_control['userid']; ?>" value="BlackList" class="btn-danger">
                                        </th>
                                    </tr>
                            <?php }
                                $blacklist_userid = $row_admin_control['userid'];
                                if (isset($_POST[$blacklist_userid])) {
                                    // echo $blacklist_userid . "88888888888888888888888888888888888888888";
                                    // echo $row_admin_control['stdid'];
                                    $_SESSION['blacklist_stdid'] = $row_admin_control['stdid'];
                                    // echo '<script language="javascript">';
                                    // echo 'alert("เพิ่ม Black List !!")';
                                    // echo '</script>';
                                    echo "<meta http-equiv='refresh' content='0;URL=blacklist.php' >";

                                }
                            }
                            ?>
                        </form>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>

        <?php }
    }
?>

<?php
    function timet($t)
    {
        $word = array("0", "08.00", "09.00", "10.00", "11.00", "12.00", "13.00", "14.00", "15.00", "16.00", "17.00");
        for ($i = 1; $i <= 9; $i++) {
            if ($t == $i) {
                return $t = $word[$i] . "-" . $word[$i + 1];
            }
        }
    }
    ?>


