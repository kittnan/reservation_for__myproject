<?php session_start() ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login Page</title>
</head>

<body>
    <?php require("navbarall.php"); ?>

    <?php
    include_once('connect.php');
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $conn->real_escape_string($_POST['password']);

        $sql = "SELECT * FROM `member` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            // $_SESSION['ssid'] = $row['ssid'];
            $_SESSION['stdid'] = $row['stdid'];
            $_SESSION['status'] = $row['status'];

            if ($_SESSION['status'] == 4) {
                session_destroy(); ?>
                <div class="text-center" style=" color:red;">คุณอยู่ใน BlackList โปรดติดต่อเจ้าหน้าที่</div>
            <?php 
                        // header('location:login.php');
                    } else if ($_SESSION['status'] == 3) {
                        // header('location:adminpage.php');
                        echo "<meta http-equiv='refresh' content='0;URL=adminpage.php' >";
                    } else if ($_SESSION['status'] == 2) {
                        // header('location:index.php');
                        echo "<meta http-equiv='refresh' content='0;URL=adminpage.php' >";                        
                    } else if($_SESSION['status']==1){
                        echo "<meta http-equiv='refresh' content='0;URL=index.php' >";                        
                    }
                } else { ?>
            <div class=" text-center mt-5">Login Failed!!</div>
    <?php }
    }

    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <form action="" method="POST">
                        <div class="card-header text-center">
                            Log in Your Account!!
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class=" form-control" id="username" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class=" form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" value="Login" class="btn btn-success">
                            <a name="btregis" id="" class="btn btn-primary ml-3" href="register.php" role="button">Register</a>
                        </div>
                    </form>
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