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

            <?php $sqlallroom = "SELECT * FROM allroom";
                    $result = $conn->query($sqlallroom);
                    $num_allroom = mysqli_num_rows($result);
                    // echo "asdasdasdasdasd".$num_allroom;
                    ?>

            <div class="container mx-auto mt-5" style="width: 600px;">
                <div class="card text-center">

                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="qradmin.php">สร้าง QRcode</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="qradmin_viewqrcode.php">ดู QRcode</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <table class="table  mx-auto">
                            <thead class="thead-light text-center">
                                <tr>

                                    <th>ชื่อห้อง</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class=" text-center">
                                <tr>
                                    <?php while ($row = $result->fetch_assoc()) { ?>

                                        <td><?php echo $row['roomname'] ?></td>
                                        <?php if ($row['status'] == 2) { ?>
                                            <td>
                                                <p class="text-success">พร้อมใช้งาน</p>
                                            </td>
                                        <?php  } else if ($row['status'] == 0) { ?>
                                            <td>
                                                <p class="text-danger">ไม่พร้อมใช้งาน</p>
                                            </td>
                                        <?php } ?>
                                        <form action="" method="POST">
                                            <td>
                                                <input type="submit" class="btn btn-outline-primary" onclick="return confirm('ต้องการสร้างQR Code ของ <?php echo $row['roomname'] ?>  ? ')" value="QRcode" name="<?php echo $row['roomid'] ?>">
                                            </td>
                                        </form>
                                        <?php
                                                    if (isset($_POST[$row['roomid']])) {
                                                        // echo $row['roomid'];
                                                        $rd = rand(000, 999);
                                                        $qr = "99999" . "/" . $rd . "/" . $row['roomid'] . "/" . "10";
                                                        // echo $qr;

                                                        // update ค่าไปยัง qr10 ใน reservation table
                                                        $update_reserv = "UPDATE `reservation` SET `q10` = '" . $qr . "' WHERE `reservation`.`rid` = " . $row['roomid'];
                                                        if ($conn->query($update_reserv) === TRUE) {
                                                            // echo "SUS";
                                                            echo '<script language="javascript">';
                                                            echo 'alert("สร้างQR Code สำเร็จ !!")';
                                                            echo '</script>';
                                                            echo "<meta http-equiv='refresh' content='0;URL=qradmin_viewqrcode.php' >";
                                                        }
                                                    }
                                                    ?>

                                </tr>
                            <?php  } ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>

        </html>
<?php   }
}
?>