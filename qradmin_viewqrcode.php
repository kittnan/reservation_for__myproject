<?php session_start() ?>
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

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        </head>

        <body>

            <?php
                    require("navbarall.php");
                    require('sidebar.php');
                    include_once('connect.php');

                    ?>

            <!-- menu -->


            <div class="container mx-auto mt-5" style="width: 600px;">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="qradmin.php">สร้าง QRcode</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="qradmin_viewqrcode.php">ดู QRcode</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">


                        <?php
                                $sql_reserv_qr = "SELECT * FROM reservation";
                                $result_qr = $conn->query($sql_reserv_qr);
                                while ($row_qr = mysqli_fetch_assoc($result_qr)) {
                                    // echo $row_qr['q10'];

                                    if ($row_qr['q10'] != "") {

                                        $str = explode("/", $row_qr['q10']);
                                        // echo $str[2];

                                        $sql_allroom = "SELECT * FROM `allroom` WHERE `roomid` = " . $str[2];
                                        $result_allroom = $conn->query($sql_allroom);
                                        if ($row_allroom = mysqli_fetch_assoc($result_allroom)) { ?>
                                    <div class="card mt-5">
                                        <div class="card-header">
                                            QR Code
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $row_allroom['roomname'] ?></p>
                                            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $row_qr['q10'] ?>&choe=UTF-8" title="Link to my Website" />

                                            <form action="" method="POST">
                                                <input type="submit" class="btn btn-danger" value="ลบ" name="<?php echo $row_qr['rid'] ?>">
                                            </form>

                                        </div>
                                        <div class="card-footer text-muted text-center">
                                        </div>

                                        <?php
                                                            $name_submit = $row_qr['rid'];
                                                            if (isset($_POST[$name_submit])) {
                                                                // echo $_POST[$name_submit];

                                                                $update_del_qr10 = "UPDATE `reservation` SET `q10` = '' WHERE `reservation`.`rid` = " . $row_qr['rid'];
                                                                if ($conn->query($update_del_qr10) === TRUE) {
                                                                    echo '<script language="javascript">';
                                                                    echo 'alert("ลบQR Code สำเร็จ !!")';
                                                                    echo '</script>';
                                                                    echo "<meta http-equiv='refresh' content='0;URL=qradmin_viewqrcode.php' >";
                                                                }
                                                            }
                                                            ?>

                            <?php }
                                        }
                                    }
                                    ?>


                                    </div>

                    </div>

                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

        </html>
<?php      }
}
?>