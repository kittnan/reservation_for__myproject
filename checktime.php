<?php
include_once('connect.php');
date_default_timezone_set("Asia/Bangkok");
$time = date("H.i");
// $time ="12.00";
// echo $time;

// เช็คเวลาปัจจุบันกับเวลาจอง
    $timearray = array("09.00", "10.00", "11.00", "12.00", "13.00", "14.00", "15.00", "16.00", "17.00");
    for ($i = 0; $i <= 8; ++$i) {
        // echo "<br>" . $timearray[$i];
        if ($time >= $timearray[$i]) {
            $col = $i + 1;
            // echo "i = " . $col  . "/" . $timearray[$i];

            // qr
            $qr = "q" . $col;
            // echo " q = " . $qr;

            //นำข้อมูลใส่ตาราง reservation ตามช่องที่เวลาเกินทีละห้อง
            $sql_reserv = "SELECT * FROM reservation";
            $result_reserv = $conn->query($sql_reserv);
            while ($row_reserv = mysqli_fetch_assoc($result_reserv)) {

                $sql_update_reserv = "UPDATE `reservation` SET `" . $col . "` = '3', `" . $qr . "` = ' ' WHERE `reservation`.`rid` = " . $row_reserv['rid'];
                // $sql_update_reserv2 = "UPDATE `reservation` SET `1` = '999999', `q1` = ' ', `2` = '999999', `q2` = ' ', `3` = '999999', `q3` = ' ', `4` = '999999', `q4` = ' ', `5` = '999999', `q5` = ' ', `6` = '999999', `q6` = ' ', `7` = '999999', `q7` = ' ', `8` = '999999', `q8` = ' ', `9` = '999999', `q9` = ' ' WHERE `reservation`.`rid` = 1";

                // $sql_2 = "UPDATE `reservation` SET `1` = '999999999', `q1` = ' ' WHERE `reservation`.`rid` = 2";
                if ($conn->query($sql_update_reserv) === TRUE) {
                    // echo "OKKKK";
                    // echo "col =" . $col . $qr . "ROOM = " . $row_reserv['roomid'].  "<br>" ;
                }
            }
        }
    }





// reset reserv table and empty admin control and insert history
    $datetime = date("d/m/y-H:i");
    $date = date("d/m/y");

    $sql_admin_control = "SELECT * FROM admin_control";
    $result_admin_control = $conn->query($sql_admin_control);
    while ($row_admin_control = mysqli_fetch_assoc($result_admin_control)) {
        // echo "<br>". $row_admin_control['time'];
        $str = explode('-', $row_admin_control['time']);
        // echo "77777777777777777777777";

        // echo $str[0] . $str[1] . "<br>";
        // echo "<br>datetime =" . $date ;
        // echo "<br>a =" . $str[0] ;
        if( $date > $str[0]){
            // echo "moreeee" ;
        }

        // echo $date;

        if ($date > $str[0]) {
            // echo $row_admin_control['userid'] . $row_admin_control['name'] . $row_admin_control['stdid'] . "<br>";

            $sql_insert_history = "INSERT INTO `history_reservation` (`h_id`, `h_name`, `h_stdid`, `h_roomid`, `h_time`, `h_reserv_time`, `h_status`) VALUES (NULL, '" . $row_admin_control['name'] . "', '" . $row_admin_control['stdid'] . "', '" . $row_admin_control['roomid'] . "', '" . $row_admin_control['time'] . "', '" . $row_admin_control['reserv_time'] . "', '" . $row_admin_control['status'] . "')";
            if ($conn->query($sql_insert_history) === TRUE) {
                // echo "trueeeee";

                $sql_empty_admin_control = "TRUNCATE TABLE `admin_control`";
                if ($conn->query($sql_empty_admin_control) === TRUE) {
                    // echo "clean ";

                    $sql_reserv = "SELECT * FROM reservation";
                    $result_reserv = $conn->query($sql_reserv);
                    while ($row_reserv = mysqli_fetch_assoc($result_reserv)) {

                        $q = "q" ;
                        for($i=1; $i<=9; $i++){
                            $qr = $q. $i;

                            if($row_reserv[$i] != 0){
                                // echo $row_reserv[$i];
                                $update_reserv = "UPDATE `reservation` SET `".$i."` = '0' WHERE `reservation`.`rid` =" . $row_reserv['rid'];
                                if ($conn->query($update_reserv) === TRUE) {
                                    // echo "A";
                                }
                            }
                        }
                    }
                }
            }
        } else {
            // echo "นอกเวลา";
        }
    }

