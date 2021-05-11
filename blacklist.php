<?php session_start(); ?>

<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['status'] == 2 || $_SESSION['status'] == 3) { ?>

        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta http-equiv=Content-Type content="text/html; charset=utf-8">


            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

            <title>AdminPage</title>
        </head>

        <body>
            <!-- NavBar -->
            <?php require("navbarall.php");
                    require('sidebar.php');
                    include_once('connect.php');
                    ?>
            <div class="container">
                <div class="row">
                    <div class="card mx-auto mt-5" style="width: 800px;">
                        <form action="" method="post">
                            <div class="card-header text-center">
                                <div class="mb-3">Blacklist Add</div>
                                <span>กรอกรหัสนักศึกษา</span>
                                <?php 
                                    if(isset($_SESSION['blacklist_stdid'])){ ?>
                                      <input type="text" name="bl_add" id="" value="<?php echo $_SESSION['blacklist_stdid']; ?>">

                                    <?php } else { ?>

                                        <input type="text" name="bl_add" id="">
                                <?php  }
                                ?>
                                <span>หมายเหตุ</span>
                                <input type="text" name="note" id="">
                                <br>
                                <input type="submit" value="ยืนยัน" class="btn btn-success mt-3" name="bl_add_b">
                            </div>
                        </form>
                    </div>

                    <div class="card-body col-sm-12 text-center">

                        <?php
                                if (isset($_POST['bl_add_b'])) {
                                    $sql_member = "SELECT * FROM member";
                                    $result_member = $conn->query($sql_member);
                                    while ($row_member = mysqli_fetch_assoc($result_member)) {
                                        if ($_POST['bl_add'] == $row_member['stdid']) {
                                            $sql_member_up = "UPDATE `member` SET `status` = '4' WHERE `member`.`id` =" . $row_member['id'];
                                            if ($conn->query($sql_member_up) === TRUE) {

                                                $sql_insert_blacklist = "INSERT INTO `blacklist` (`blacklist_id`, `blacklist_userid`, `blacklist_name`, `blacklist_stdid`, `blacklist_date`, `blacklist_note`, `blacklist_status`)
                                                 VALUES (NULL, '" . $row_member['id'] . "', '" . $row_member['name'] . "', '" . $row_member['stdid'] . "', CURRENT_TIMESTAMP, '" . $_POST['note'] . "', '1')";
                                                if ($conn->query($sql_insert_blacklist) === TRUE) {
                                                    echo '<script language="javascript">';
                                                    echo 'alert("เพิ่มblacklistแล้ว !!")';
                                                    echo '</script>';
                                                    echo "<meta http-equiv='refresh' content='0;URL=blacklist.php' >";
                                                }
                                                // echo $_POST['bl_add'] . "/" . $row_member['id'] . "/" . $row_member['stdid'];
                                            }
                                        }
                                    }
                                }
                                ?>
                    </div>
                    <table class="table table-light mx-auto" style="width: 800px;">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>ชื่อ</th>
                                <th>รหัสนักศึกษา</th>
                                <th>วันที่</th>
                                <th>ครั้งที่</th>
                                <th>หมายเหตุ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                                        $sql_blacklist = "SELECT * FROM `blacklist` WHERE `blacklist_status` = 1";
                                        $result_blacklist = $conn->query($sql_blacklist); ?>
                                        <tr>



                                     <?php   while ($row_blacklist = mysqli_fetch_assoc($result_blacklist)) {

                                            $sql_blacklist_num = "SELECT * FROM `blacklist` WHERE `blacklist_name` LIKE '" . $row_blacklist['blacklist_name'] . "' AND `blacklist_status` = 0";
                                            $result_blacklist_num = $conn->query($sql_blacklist_num);
                                            $rowcount_blacklist = mysqli_num_rows($result_blacklist_num);
                                            // echo $rowcount_blacklist;
                                            ?>
                                    <th><?php echo $row_blacklist['blacklist_name']; ?></th>
                                    <th><?php echo $row_blacklist['blacklist_stdid']; ?></th>
                                    <th><?php echo $row_blacklist['blacklist_date']; ?></th>
                                    <th><?php echo $rowcount_blacklist + 1; ?></th>
                                    <th><?php echo $row_blacklist['blacklist_note']; ?></th>
                                    <th>
                                        <form action="" method="POST">
                                            <input type="submit" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $row_blacklist['blacklist_userid'] ?> ออกจาก blacklist ? ')" value="ลบ<?php echo $row_blacklist['blacklist_userid'] ?>" name="<?php echo $row_blacklist['blacklist_userid']; ?>">
                                        </form>
                                    </th>
                                <?php
                                            $name = $row_blacklist['blacklist_userid'];
                                            if (isset($_POST[$name])) {
                                                echo $_POST[$name];
                                                $update_status_blacklist = "UPDATE `blacklist` SET `blacklist_status` = '0' WHERE `blacklist`.`blacklist_id` =" . $row_blacklist['blacklist_id'];
                                                if ($conn->query($update_status_blacklist) === TRUE) {
                                                    echo "999999999999999999999999999999999999";
                                                    $update_member = "UPDATE `member` SET `status` = '1' WHERE `member`.`id` =" . $row_blacklist['blacklist_userid'];
                                                    if ($conn->query($update_member) === TRUE) {

                                                        echo '<script language="javascript">';
                                                        echo 'alert("ปลดblacklistแล้ว !!")';
                                                        echo '</script>';
                                                        echo "<meta http-equiv='refresh' content='0;URL=blacklist.php' >";
                                                    }
                                                }
                                            } ?>
                                            </tr>
                                    <?php    }
                                        ?>
                        </tbody>

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
<?php  }
}
?>