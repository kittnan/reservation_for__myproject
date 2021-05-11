<?php session_start() ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>RMUTL Reservation</title>
</head>

<body>


    <?php include_once("connect.php"); ?>

    <?php require("navbarall.php"); ?>

    <?php
    $sql_reserv = "SELECT * FROM reservation";
    $result_reserv = $conn->query($sql_reserv);
    while ($row_reserv = mysqli_fetch_assoc($result_reserv)) {
        for ($i = 1; $i <= 9; $i++) {
            if ($row_reserv[$i] == $_SESSION['id']) {

                $qrcheck = "q" . $i;
                if ($row_reserv[$qrcheck] != " " && $row_reserv[$qrcheck] != NULL ) {
                    // echo $qrcheck . "=" .$row_reserv[$qrcheck] . "]" ;

                    $sql_member = "SELECT * FROM `member` WHERE `id` =" . $_SESSION['id'];
                    $result_member = $conn->query($sql_member);
                    $row_member = mysqli_fetch_assoc($result_member);
                    $rid = $row_reserv['rid'];

                    $sql_allroom = "SELECT * FROM `allroom` WHERE `roomid` = " .$row_reserv['roomid'];;
                    $result_allroom = $conn->query($sql_allroom);
                    $row_allroom = mysqli_fetch_assoc($result_allroom);

                    $nameshow = $row_member['name'];
                    // $roomshow = $row_reserv['roomid'];
                    $roomname = $row_allroom['roomname'];
                    $stdidshow = $row_member['stdid'];
                    $tinmeshow = timet($i);
                    $q = "q" . $i;
                    $qrshow = $row_reserv[$q];
                    // echo "name= " . $row_member['name'];
                    // echo "room = " . $row_reserv['roomid'];
                    // echo "stdid= " . $row_member['stdid'];
                    // echo "time= " . $tinmeshow;
                    // echo "q= " . $q;
                    // echo "qrcode= " . $qrshow;
                    ?>

                    <div class="container mt-5">
                        <div class="row">
                            <div class="row mx-auto">
                                <div class="card">
                                    <div class="card-header text-center">
                                        QR Code
                                    </div>
                                    <div class="card-body text-center">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>ชื่อ <?php echo $nameshow ?></td>
                                                    <td>ห้อง <?php echo $roomname ?></td>
                                                </tr>
                                                <tr>
                                                    <td>รหัสนักศึกษา <?php echo $stdidshow ?></td>
                                                    <td>เวลาที่จอง <?php echo $tinmeshow ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer text-muted text-center">
                                        <center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $qrshow ?>&choe=UTF-8" title="Link to my Website" /></center>
                                        <div class="w3-section">
                                            <form action="" method="POST">
                                                <input type="submit" value="ยกเลิกการจอง" name="<?php echo $rid . "/" . $i . "/" . $q ?>" class=" btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <?php
                    // delete------------------------------------------------------------------------
                    $name_submit = $rid . "/" . $i . "/" . $q;
                    if (isset($_POST[$name_submit])) {
                        $sql_reserv_delete = "UPDATE `reservation` SET `" . $i . "` = '0', `" . $q . "` = '' WHERE `reservation`.`rid` =" . $rid;
                        if ($conn->query($sql_reserv_delete) === TRUE) {
                            echo '<script language="javascript">';
                            echo 'alert("ทำการยกเลิกการจองเรียบร้อย")';
                            echo '</script>';
                            echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
                            // echo "DELETeeE";
                        }
                    }
                } // loop row_reserv------------------------------------------------
            } 
            // else {
            //     echo '<script language="javascript">';
            //     echo 'alert("กรุณาจองห้อง")';
            //     echo '</script>';
            //     echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
            // }
        }
    }
    ?>






    <?php function timet($t)
    {
        $word = array("0", "08.00", "09.00", "10.00", "11.00", "12.00", "13.00", "14.00", "15.00", "16.00", "17.00");
        for ($i = 1; $i <= 9; $i++) {
            if ($t == $i) {
                return $t = $word[$i] . "-" . $word[$i + 1] . "น.";
            }
        }
    } ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>