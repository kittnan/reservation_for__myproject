<!-- <?php session_start() ?> -->
<?php  
    if(isset($_SESSION['id'])){
        if($_SESSION['status'] == 2 || $_SESSION['status'] == 3){ ?>
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
    require('sidebar.php'); ?>

    <!-- Page Content -->
    <div style="margin-left:15%">

        <?php
        include_once('connect.php');
        if (isset($_POST['submit'])) {
            $roomname = $_POST['roomname'];
            $sql = "SELECT * FROM allroom WHERE roomname = '$roomname' ";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();


            if ($roomname == NULL || $roomname == " ") { ?>
                <div class="text-center mt-5">โปรดระบุชื่อห้องให้ถูกต้อง!!</div>
                <?php } else {
                        if ($row['roomname'] == $roomname) {
                            if ($row['status'] == 0) {
                                $update_allroom = "UPDATE `allroom` SET `status` = '2' WHERE `allroom`.`roomid` =" . $row['roomid'];
                                if ($conn->query($update_allroom) === TRUE) {
                                    $update_reserv = "UPDATE `reservation` SET `1` = '0', `2` = '0', `3` = '0', `4` = '0', `5` = '0', `6` = '0', `7` = '0', `8` = '0', `9` = '0' WHERE `reservation`.`rid` =" . $row['roomid'] ;
                                    if ($conn->query($update_reserv) === TRUE) { 
                                        echo "<meta http-equiv='refresh' content='1;URL=addroom.php' >";
                                        ?>
                                <!-- เปิดใช้งานห้อง ถ้ามีห้องอยู่แล้ว-->
                                <div class="text-center mt-5"> เปิดใช้<?php echo $roomname ?>นี้แล้ว!</div>
                        <?php  }
                                        }
                                    } else { ?>
                        <!-- เตือนว่ามีห้องแล้วถ้า ไม่มี status  -->
                        <div class="text-center mt-5"> มีห้อง<?php echo $roomname ?>แล้ว!</div>
                    <?php   }

                                // ----------เพิ่มห้องเสร็จสมบูรณ์
                            } else {
                                $sql2 = "INSERT INTO `allroom` (`roomid`, `roomname`, `status`) VALUES (NULL, '" . $roomname . "' , '1')";
                                if ($conn->query($sql2) === TRUE) {
                                    include_once('allroom.php');
                                    echo "<meta http-equiv='refresh' content='1;URL=manageroom.php' >";
                                    ?>
                        <div class="w3-panel w3-green">
                            <h3>Success!</h3>
                            <p>เพิ่มห้องเสร็จสมบูรณ์</p>
                        </div>
                    <?php } else { ?>
                        <div class="w3-panel w3-red">
                            <h3>Fail!</h3>
                            <p>มีข้อผิดพลาด ไม่สามารถเพิ่มห้องได้!!</p>
                        </div>
        <?php }
                }
            }
        }

        ?>

        <?php $sqlallroom = "SELECT * FROM allroom";
        $result = $conn->query($sqlallroom);
        ?>

        <div class="container">
            <div class="row">
                <div class=" col-md-8 mx-auto mt-5">
                    <form action="" method="POST">

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">ชื่อห้อง</label>
                            <div class="col-sm-10">
                                <input type="text" class=" form-control" id="roomname" name="roomname" placeholder="ชื่อห้อง">
                            </div>
                        </div>
                        <center> <input type="submit" name="submit" value="AddRoom" class="btn btn-success"></center>

                    </form>
                </div>
            </div>
            <table class="table mt-3 col-8 mx-auto">
                <thead class="thead-light text-center">
                    <tr>

                        <th>ชื่อห้อง</th>
                        <th>สถานะ</th>
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
                    </tr>
                <?php  } ?>

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
<?php   }
    }
?>
