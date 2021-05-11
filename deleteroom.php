<!-- <?php session_start() ?> -->
<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['status'] == 3) { ?>

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
                        <h3>Delete Room</h3>
                        <p class=" text-danger">* หากทำการลบห้องแล้ว ฐานข้อมูลของห้องจะถูกลบด้วย *</p>
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
                                        <input type="submit" class="btn btn-outline-danger" value="ลบ" name="<?php echo $row_allroom['roomid'] . "/" . "delete"; ?>">
                                    </form>
                                </th>
                            </tr>
                        <?php
                                    // echo $row_allroom['roomid'] . "/" ."close" ;
                                    $submit_delete = $row_allroom['roomid'] . "/" . "delete";
                                    if (isset($_GET[$submit_delete])) {
                                        $sql_delete_allroom = "DELETE FROM `allroom` WHERE `allroom`.`roomid` =" . $row_allroom['roomid'];
                                        if ($conn->query($sql_delete_allroom) === TRUE) {

                                            $sql_delete_reserv = "DELETE FROM `reservation` WHERE `reservation`.`rid` =" . $row_allroom['roomid'];
                                            if ($conn->query($sql_delete_reserv) === TRUE) {
                                                echo '<script language="javascript">';
                                                echo 'alert("ห้องถูกลบแล้ว !!")';
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
<?php    }
}
?>