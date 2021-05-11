<?php
$datetime = date("H:i");


// 1 : user/  2:admin / 3: master / 4: black list
if (isset($_SESSION['id'])) {
    if ($_SESSION['status'] == 1) { ?>

        <div class="container">
            <div class="row">
                <div class="row mt-5 mx-auto">
                    <h1>Reservation Table<h1>
                </div>
            </div>
            <form>
                <table class="table table-bordered">
                    <thead class=" thead-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">08.00-09.00</th>
                            <th scope="col">09.00-10.00</th>
                            <th scope="col">10.00-11.00</th>
                            <th scope="col">11.00-12.00</th>
                            <th scope="col">12.00-13.00</th>
                            <th scope="col">13.00-14.00</th>
                            <th scope="col">14.00-15.00</th>
                            <th scope="col">15.00-16.00</th>
                            <th scope="col">16.00-17.00</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <?php
                                    include_once("connect.php");
                                    include_once("allroom.php");
                                    $sql_reserv = "SELECT * FROM reservation";
                                    $result_reserv = $conn->query($sql_reserv);
                                    $num = mysqli_num_rows($result_reserv);
                                    $check_reserv = 0 ;

                                    $sql_allroom = "SELECT * FROM allroom";
                                    $result_allroom = $conn->query($sql_allroom);
                                    while ($row_reserv = mysqli_fetch_assoc($result_reserv)) {
                                        $row_allroom =  mysqli_fetch_assoc($result_allroom);
                                        ?>
                        <tr>
                            <th>
                                <?php echo  $row_allroom['roomname']; ?>
                            </th>
                            <?php
                                        for ($i = 1; $i <= 9; $i++) { ?>
                                <th>
                                    <?php
                                                    if ($row_reserv[$i] == 0) { ?>
                                        <form action="" method="get">
                                            <input class="btn btn-success" type="submit" value="จอง" name="<?php echo $row_reserv['roomid'] . "/" . $i; ?>">
                                        </form>
                                    <?php }
                                                    if ($row_reserv[$i] >= 1) { ?>
                                        <div class="btn btn-danger">เต็ม</div>
                                    <?php }
                                                    ?>
                                </th>
                        <?php
                                        $submit_y = $row_reserv['roomid'] . "/" . $i;
                                        // echo $submit_y;
                                        if ($_SESSION['id'] == $row_reserv[$i]) {
                                            $check_reserv = 1;
                                        }

                                        if ($datetime >= "00:00" && $datetime <= "17.00") {
                                            if (isset($_GET[$submit_y])) {
                                                require('checktime.php');
                                                // เช็คในตาราง resservation ว่ามีการจองแล้ว อนุมัติหรือยัง
                                                if ($check_reserv == 1) {
                                                    echo '<script language="javascript">';
                                                    echo 'alert("คุณได้ทำการจองไปแล้วค่ะ")';
                                                    echo '</script>';
                                                    echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
                                                } else if ($check_reserv == 0 && $row_reserv[$i] == 0) {
                                                    $check_reserv_now = 0;
                                                    $sql_admin_c = "SELECT * FROM `admin_control` WHERE `userid` = '" . $_SESSION['id'] . "' AND `status` = 1 ";
                                                    $result_admin_c = $conn->query($sql_admin_c);
                                                    while ($row_admin_c = mysqli_fetch_assoc($result_admin_c)) {
                                                        if ($_SESSION['id'] == $row_admin_c['userid'] && $row_admin_c['status'] == 1) {
                                                            echo '<script language="javascript">';
                                                            echo 'alert("โปรดรอการอนุมัติ")';
                                                            echo '</script>';
                                                            $check_reserv_now = 1;
                                                        }
                                                    }
                                                    if ($check_reserv_now == 0) {
                                                        $_SESSION['formname'] = $submit_y;
                                                        $_SESSION['rowroomid'] = $row_reserv['roomid'];
                                                        $_SESSION['num'] = $num;
                                                        $_SESSION['roomname'] = $row_allroom['roomname'];
                                                        echo $_SESSION['formname'];
                                                        echo "<meta http-equiv='refresh' content='0;URL=confirm_2.php' >";
                                                    }


                                                    // echo "<meta http-equiv='refresh' content='1;URL=index.php' >";

                                                }
                                            }
                                        } else if (isset($_GET[$submit_y])) { 
                                            echo '<script language="javascript">';
                                            echo 'alert("อยู่นอกเวลาจอง")';
                                            echo '</script>';
                                        }
                                    }
                                }

                                ?>
                        </tr>

                        <?php
                                ?>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

    <?php } else if ($_SESSION['status'] == 2) { ?>
        <div class="container">
            <div class="row">
                <div class="row mt-5 mx-auto">
                    <h1>Reservation Table<h1>
                </div>
            </div>
            <form>
                <table class="table table-bordered">
                    <thead class=" thead-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">08.00-09.00</th>
                            <th scope="col">09.00-10.00</th>
                            <th scope="col">10.00-11.00</th>
                            <th scope="col">11.00-12.00</th>
                            <th scope="col">12.00-13.00</th>
                            <th scope="col">13.00-14.00</th>
                            <th scope="col">14.00-15.00</th>
                            <th scope="col">15.00-16.00</th>
                            <th scope="col">16.00-17.00</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <?php
                                    include_once("connect.php");
                                    include_once("allroom.php");
                                    $sql_reserv = "SELECT * FROM reservation";
                                    $result_reserv = $conn->query($sql_reserv);
                                    $num = mysqli_num_rows($result_reserv);

                                    $sql_allroom = "SELECT * FROM allroom";
                                    $result_allroom = $conn->query($sql_allroom);
                                    while ($row_reserv = mysqli_fetch_assoc($result_reserv)) {
                                        $row_allroom =  mysqli_fetch_assoc($result_allroom);
                                        ?>
                        <tr>
                            <th>
                                <?php echo  $row_allroom['roomname']; ?>
                            </th>
                            <?php
                                        for ($i = 1; $i <= 9; $i++) { ?>
                                <th>
                                    <?php
                                                    if ($row_reserv[$i] == 0) { ?>
                                        <form action="" method="get">
                                            <input class="btn btn-success" type="submit" value="จอง" name="<?php echo $row_reserv['roomid'] . "/" . $i; ?>">
                                        </form>
                                        <?php
                                                        }

                                                        if ($row_reserv[$i] >= 1) {

                                                            $sql_member = "SELECT * FROM member";
                                                            $result_member = $conn->query($sql_member);
                                                            while ($row_member = mysqli_fetch_assoc($result_member)) {
                                                                if ($row_reserv[$i] == $row_member['id']) {
                                                                    $r_name = $row_member['name'];
                                                                    // echo $r_name ; 
                                                                    ?>
                                                <div class="btn btn-danger">เต็ม</div>
                                                <div><?php echo $r_name ?></div>
                                    <?php }
                                                        }
                                                    } ?>
                                </th>
                            <?php
                                            $submit_y = $row_reserv['roomid'] . "/" . $i;
                                            // echo $submit_y;
                                            if (isset($_GET[$submit_y])) {
                                                // echo $submit_y;
                                                // echo $_GET[$submit_y];
                                               
                                                $_SESSION['formname'] = $submit_y;
                                                $_SESSION['rowroomid'] = $row_reserv['roomid'];
                                                $_SESSION['num'] = $num;
                                                $_SESSION['roomname'] = $row_allroom['roomname'];
                                                // echo $_SESSION['formname'];
                                                echo "<meta http-equiv='refresh' content='0;URL=confirm_2.php' >";


                                                // echo "<a href='confirm.php'>..</a>" ;
                                                // header('location:confirm.php');
                                                
                                            }
                                        }
                                        ?>
                        </tr>

                    <?php }
                            ?>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    <?php  } else if ($_SESSION['status'] == 3) { ?>
        <div class="container">
            <div class="row">
                <div class="row mt-5 mx-auto">
                    <h1>Reservation Table<h1>
                </div>
            </div>
            <form>
                <table class="table table-bordered">
                    <thead class=" thead-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">08.00-09.00</th>
                            <th scope="col">09.00-10.00</th>
                            <th scope="col">10.00-11.00</th>
                            <th scope="col">11.00-12.00</th>
                            <th scope="col">12.00-13.00</th>
                            <th scope="col">13.00-14.00</th>
                            <th scope="col">14.00-15.00</th>
                            <th scope="col">15.00-16.00</th>
                            <th scope="col">16.00-17.00</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <?php
                                    include_once("connect.php");
                                    include_once("allroom.php");
                                    $sql_reserv = "SELECT * FROM reservation";
                                    $result_reserv = $conn->query($sql_reserv);
                                    $num = mysqli_num_rows($result_reserv);

                                    $sql_allroom = "SELECT * FROM allroom";
                                    $result_allroom = $conn->query($sql_allroom);
                                    while ($row_reserv = mysqli_fetch_assoc($result_reserv)) {
                                        $row_allroom =  mysqli_fetch_assoc($result_allroom);
                                        ?>
                        <tr>
                            <th>
                                <?php echo  $row_allroom['roomname']; ?>
                            </th>
                            <?php
                                        for ($i = 1; $i <= 9; $i++) { ?>
                                <th>
                                    <?php
                                                    if ($row_reserv[$i] == 0) { ?>
                                        <form action="" method="get">
                                            <input class="btn btn-success" type="submit" value="จอง" name="<?php echo $row_reserv['roomid'] . "/" . $i; ?>">
                                        </form>
                                        <?php
                                                        }

                                                        if ($row_reserv[$i] >= 1) {

                                                            $sql_member = "SELECT * FROM member";
                                                            $result_member = $conn->query($sql_member);
                                                            while ($row_member = mysqli_fetch_assoc($result_member)) {
                                                                if ($row_reserv[$i] == $row_member['id']) {
                                                                    $r_name = $row_member['name'];
                                                                    // echo $r_name ; 
                                                                    ?>
                                                <div class="btn btn-danger">เต็ม</div>
                                                <div><?php echo $r_name ?></div>
                                    <?php }
                                                        }
                                                    } ?>
                                </th>
                            <?php
                                            $submit_y = $row_reserv['roomid'] . "/" . $i;
                                            // echo $submit_y;
                                            if (isset($_GET[$submit_y])) {
                                                // echo $submit_y;
                                                // echo $_GET[$submit_y];
                                               
                                                $_SESSION['formname'] = $submit_y;
                                                $_SESSION['rowroomid'] = $row_reserv['roomid'];
                                                $_SESSION['num'] = $num;
                                                $_SESSION['roomname'] = $row_allroom['roomname'];
                                                // echo $_SESSION['formname'];
                                                echo "<meta http-equiv='refresh' content='0;URL=confirm_2.php' >";


                                                // echo "<a href='confirm.php'>..</a>" ;
                                                // header('location:confirm.php');
                                                
                                            }
                                        }
                                        ?>
                        </tr>

                    <?php }
                            ?>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    <?php  } else if ($_SESSION['status'] == 4) { ?>
        <div class="container">
            <div class="row">
                <div class="row mt-5 mx-auto">
                    <h1>Reservation Table<h1>
                </div>
            </div>
            <form>
                <table class="table table-bordered">
                    <thead class=" thead-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">08.00-09.00</th>
                            <th scope="col">09.00-10.00</th>
                            <th scope="col">10.00-11.00</th>
                            <th scope="col">11.00-12.00</th>
                            <th scope="col">12.00-13.00</th>
                            <th scope="col">13.00-14.00</th>
                            <th scope="col">14.00-15.00</th>
                            <th scope="col">15.00-16.00</th>
                            <th scope="col">16.00-17.00</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <?php
                                    include_once("connect.php");
                                    include_once("allroom.php");
                                    $sql = "SELECT * FROM reservation";
                                    $result = $conn->query($sql);
                                    $num = mysqli_num_rows($result);

                                    $sql2 = "SELECT * FROM allroom";
                                    $result2 = $conn->query($sql2);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $row2 =  mysqli_fetch_assoc($result2);
                                        ?>
                        <tr>
                            <th>
                                <?php echo  $row2['roomname']; ?>
                            </th>
                            <?php
                                        for ($i = 1; $i <= 9; $i++) { ?>
                                <th>
                                    <?php
                                                    if ($row[$i] == 0) { ?>
                                        <form action="" method="get">
                                            <input class="btn btn-success" type="submit" value="จอง" name="<?php echo $row['roomid'] . "/" . $i; ?>">
                                        </form>
                                    <?php }
                                                    if ($row[$i] >= 1) { ?>
                                        <div class="btn btn-danger">เต็ม</div>
                                    <?php }
                                                    ?>
                                </th>
                            <?php

                                        }
                                        ?>
                        </tr>

                    <?php }
                            ?>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    <?php }
    }

    if (empty($_SESSION['id'])) { ?>
    <div class="container">
        <div class="row">
            <div class="row mt-5 mx-auto">
                <h1>Reservation Table<h1>
            </div>
        </div>
        <form>
            <table class="table table-bordered">
                <thead class=" thead-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">08.00-09.00</th>
                        <th scope="col">09.00-10.00</th>
                        <th scope="col">10.00-11.00</th>
                        <th scope="col">11.00-12.00</th>
                        <th scope="col">12.00-13.00</th>
                        <th scope="col">13.00-14.00</th>
                        <th scope="col">14.00-15.00</th>
                        <th scope="col">15.00-16.00</th>
                        <th scope="col">16.00-17.00</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <?php
                            include_once("connect.php");
                            include_once("allroom.php");
                            $sql = "SELECT * FROM reservation";
                            $result = $conn->query($sql);
                            $num = mysqli_num_rows($result);

                            $sql2 = "SELECT * FROM allroom";
                            $result2 = $conn->query($sql2);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $row2 =  mysqli_fetch_assoc($result2);
                                ?>
                    <tr>
                        <th>
                            <?php echo  $row2['roomname']; ?>
                        </th>
                        <?php
                                for ($i = 1; $i <= 9; $i++) { ?>
                            <th>
                                <?php
                                            if ($row[$i] == 0) { ?>
                                    <form action="" method="get">
                                        <input class="btn btn-success" type="submit" value="จอง" name="<?php echo $row['roomid'] . "/" . $i; ?>">
                                    </form>
                                <?php }
                                            if ($row[$i] >= 1) { ?>
                                    <div class="btn btn-danger">เต็ม</div>
                                <?php }
                                            ?>
                            </th>
                        <?php
                                    $a = $row['roomid'] . "/" . $i;
                                    if (isset($_GET[$a])) {
                                        echo '<script language="javascript">';
                                        echo 'alert("กรุณา login ก่อนจองค่ะ")';
                                        echo '</script>';
                                    }
                                }
                                ?>
                    </tr>

                <?php }
                    ?>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
<?php }
?>