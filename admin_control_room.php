<?php session_start() ?> 

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

    <?php
    require("navbarall.php");
    require('sidebar.php');
    include_once('connect.php');
    ?>

    <?php $sqlallroom = "SELECT * FROM allroom";
    $result = $conn->query($sqlallroom);
    ?>

    <?php
//สำหรับเจ้าหน้าที่
    if ($_SESSION['status'] == 2) { ?>
        <div class="container">
            <div class="row">
                <div class=" col-md-8 mx-auto mt-5 text-center">
                    <form action="" method="POST">
                        <input type="submit" class="btn btn-success" value="AddRoom" name="addroom">
                        <input type="submit" class="btn btn-warning" value="ManageRoom" name="manageroom">
        
                    </form>
                    <?php
                        if (isset($_POST['addroom'])) {
                            echo "<meta http-equiv='refresh' content='0;URL=addroom.php' >";
                        } else if (isset($_POST['manageroom'])) {
                            echo "<meta http-equiv='refresh' content='0;URL=manageroom.php' >";
                        } 
                        ?>
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
<!-- สำหรับmaster -->
    <?php } else if ($_SESSION['status'] == 3) { ?>
        <div class="container">
            <div class="row">
                <div class=" col-md-8 mx-auto mt-5 text-center">
                    <form action="" method="POST">
                        <input type="submit" class="btn btn-success" value="AddRoom" name="addroom">
                        <input type="submit" class="btn btn-warning" value="ManageRoom" name="manageroom">
                        <input type="submit" class="btn btn-danger" value="DeleteRoom" name="deleteroom">
                    </form>
                    <?php
                        if (isset($_POST['addroom'])) {
                            echo "<meta http-equiv='refresh' content='0;URL=addroom.php' >";
                        } else if (isset($_POST['manageroom'])) {
                            echo "<meta http-equiv='refresh' content='0;URL=manageroom.php' >";
                        } else if (isset($_POST['deleteroom'])) {
                            echo "<meta http-equiv='refresh' content='0;URL=deleteroom.php' >";
                        }
                        ?>
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
    <?php }
    ?>

    <?php
    // ฟังชั่น แปลง เวลาตาราง reserv เป็นเวลาจริง
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php     }
    }
?>
