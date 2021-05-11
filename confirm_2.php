<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include_once('connect.php') ?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-8 mx-auto">
                <div class="card mx-auto">
                    <div class="card-header text-center text-primary">
                        ยืนยันการจอง
                    </div>
                    <div class="card-body text-center">
                        <span class="col-sm-6">ชื่อ <?php echo $_SESSION['name'] ?> </span>
                        <span class="col-sm-6">รหัสนักศึกษา <?php echo $_SESSION['stdid'] ?> </span>
                        <br>

                        <span class="col-sm-6">ห้อง <?php echo  $_SESSION['roomname']; ?> </span>
                        <span class="col-sm-6">เวลา <?php echo timet($_SESSION['formname']); ?> </span>
                        <div class="col-sm-6  mx-auto"><?php echo ThDate() ?></div>


                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="POST">

                            <input type="submit" class="btn btn-success mr-3" value="ยืนยัน" name="yes">
                            <input type="submit" class="btn btn-danger ml-3" value="ยกเลิก" name="no">

                        </form>
                    </div>
                </div>
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

<?php
if (isset($_POST['yes'])) {
    // echo "yes";
    date_default_timezone_set("Asia/Bangkok");
    $timenow = date("H.i น.");
    $datetime = date("d/m/y-H:i");

    $str = explode("/", $_SESSION['formname']);
    $room = $str[0];
    $time = $str[1];
    // echo "<br>" . $timenow ."<br>" . $_SESSION['name'] ."<br>" . $_SESSION['stdid'];
    $sql_auto = "SELECT * FROM auto";
    $result_sql_auto = $conn->query($sql_auto);

    while ($row_auto = mysqli_fetch_assoc($result_sql_auto)) {

        if ($row_auto['status'] == 1) {
            // echo "111";
            $sql_indata_ac = "INSERT INTO `admin_control` (`admincontrol_id`, `userid` , `name`, `stdid`, `roomid`, `time`, `reserv_time`, `status`, `approve_status`)
                                     VALUES (NULL, '" . $_SESSION['id'] . "' , '" . $_SESSION['name'] . "', '" . $_SESSION['stdid'] . "', '" . $room . "', '" . $datetime . "', '" . $time . "', '2', '" . $row_auto['status'] . "')";
            if ($conn->query($sql_indata_ac) === TRUE) {
                $rd = rand(000, 999);
                $qr = $_SESSION['stdid'] . "/" . $rd . "/" . $room . "/" . $time;
                $q = "q" . $time;
                // echo $q;
                // echo $time;
                // echo $room;
                $sql_inreserv = "UPDATE `reservation` SET `" . $time . "` = '" . $_SESSION['id'] . "', `" . $q . "` = '" . $qr . "' WHERE `reservation`.`rid` = " . $room;
                if ($conn->query($sql_inreserv) === TRUE) {
                    // echo "<br> qr = " . $qr . " q=" . $q;
                    // echo "Suscess!!";
                    echo '<script language="javascript">';
                    echo 'alert("จองสำเร็จ !!")';
                    echo '</script>';
                    echo "<meta http-equiv='refresh' content='1;URL=qr.php' >";
                } else echo $conn->error;
            }
        } else if ($row_auto['status'] == 0) {

            $sql = "INSERT INTO `admin_control` (`admincontrol_id`, `userid`, `name`, `stdid`, `roomid`, `time`, `reserv_time`, `status`, `approve_status`)
                                         VALUES (NULL, '" . $_SESSION['id'] . "', '" . $_SESSION['name'] . "' , '" . $_SESSION['stdid'] . "' 
                                         , '" . $room . "', '" . $datetime . "', '" . $time . "', '1', '" . $row_auto['status'] . "')";
            if ($conn->query($sql) === TRUE) {
                echo '<script language="javascript">';
                echo 'alert("โปรดรอการอนุมัติ")';
                echo '</script>';
                echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
            }
        }
    }
}

if (isset($_POST['no'])) {

    echo '<script language="javascript">';
    echo 'alert("ยกเลิกการจองสำเร็จ")';
    echo '</script>';
    echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
    
}

?>

<?php
function timet($t)
{
    $str = explode("/", $t);
    $word = array("0", "08.00", "09.00", "10.00", "11.00", "12.00", "13.00", "14.00", "15.00", "16.00", "17.00");
    for ($i = 1; $i <= 9; $i++) {
        if ($str[1] == $i) {
            return $t = $word[$i] . "-" . $word[$i + 1] . "น.";
        }
    }
}

function ThDate()
{
    //วันภาษาไทย
    $ThDay = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์");
    //เดือนภาษาไทย
    $ThMonth = array("มกรามก", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    //กำหนดคุณสมบัติ
    $week = date("w"); // ค่าวันในสัปดาห์ (0-6)
    $months = date("m") - 1; // ค่าเดือน (1-12)
    $day = date("d"); // ค่าวันที่(1-31)
    $years = date("Y") + 543; // ค่า ค.ศ.บวก 543 ทำให้เป็น ค.ศ.

    return "วัน$ThDay[$week] ที่ $day เดือน $ThMonth[$months] พ.ศ. $years";
}
?>