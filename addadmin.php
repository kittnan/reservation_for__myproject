<?php session_start(); ?>
<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['status'] == 3) { ?>
        <!doctype html>
        <html lang="en">

        <head>
            <title>Register</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        </head>

        <body>

            <!-- navbar -->
            <?php require("navbarall.php");
                    require('sidebar.php');
                    ?>

            <?php require_once("connect.php");
                    if (isset($_POST['submit'])) {
                        if ($_POST['nameregis'] == "" || $_POST['adminidregis'] == "" || $_POST['usernameregis'] == "" || $_POST['passwordregis'] == "") { ?>
                    <div class="text-center text-danger">โปรดกรอกข้อมูลให้ครบถ้วน!!</div>
                    <?php  } else {
                                    $name = $_POST['nameregis'];
                                    $adminid = $_POST['adminidregis'];
                                    $username = $_POST['usernameregis'];
                                    $password = $_POST['passwordregis'];
                                    // echo $name . $stdid . $username . $password ;

                                    $sql = "INSERT INTO member (id, name, username, password, status, stdid) 
        VALUES (NULL, '" . $name . "', '" . $username . "', '" . $password . "', '2', '" . $adminid . "')";

                                    if ($conn->query($sql) === TRUE) { ?>
                        <div class="text-center">สมัครสมาชิกสำเร็จ!!</div>
                    <?php } else { ?>
                        <div class="text-center" color="red">สมัครสมาชิกไม่สำเร็จ!!</div>
            <?php }
                        }
                    }
                    ?>

            <div class="container">
                <div class="row">
                    <div class=" col-md-8 mx-auto mt-5">
                        <form action="" method="POST">
                            <div class="card-header text-center">
                                Register!!
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class=" form-control" id="nameregis" name="nameregis" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">AdminID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class=" form-control" id="stdidregis" name="adminidregis" placeholder="AdminID">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class=" form-control" id="usernameregis" name="usernameregis" placeholder="Username">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class=" form-control" id="passwordregis" name="passwordregis" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <input type="submit" name="submit" value="Submit" class="btn btn-success">
                            </div>
                        </form>
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
<?php   }
}
?>