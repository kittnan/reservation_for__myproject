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
    <?php require("navbarall.php"); ?>

    <?php require_once("connect.php");
    if (isset($_POST['submit'])) {

        if ($_POST['nameregis'] == "" || $_POST['stdidregis'] == "" || $_POST['usernameregis'] == "" || $_POST['passwordregis'] == "") { ?>
            <div class="text-center text-danger">โปรดกรอกข้อมูลให้ครบถ้วน!!</div>
            <?php  } else {
                    $sql_member = "SELECT * FROM member";
                    $result_member = $conn->query($sql_member);
                    while ($row_member = mysqli_fetch_assoc($result_member)) {
                        if ($row_member['username'] == $_POST['usernameregis']) {
                            echo '<script language="javascript">';
                            echo 'alert("มีผู้ใช้แล้ว !!")';
                            echo '</script>';
                            echo "<meta http-equiv='refresh' content='0;URL=register.php' >";
                        } else {
                            $name = $_POST['nameregis'];
                            $stdid = $_POST['stdidregis'];
                            $username = $_POST['usernameregis'];
                            $password = $_POST['passwordregis'];
                            // echo $name . $stdid . $username . $password ;

                            $sql = "INSERT INTO member (id, name, username, password, status, stdid) 
                VALUES (NULL, '" . $name . "', '" . $username . "', '" . $password . "', '1', '" . $stdid . "')";
                        }
                    }
                    if ($conn->query($sql) === TRUE) { ?>
                <div class="text-center">สมัครสมาชิกสำเร็จ!!</div>
            <?php } else { ?>
                <div class="text-center text-danger">สมัครสมาชิกไม่สำเร็จ!!</div>
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
                                <input type="text" class=" form-control" id="nameregis" name="nameregis" placeholder="ชื่อ-สกุล" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">StudentID</label>
                            <div class="col-sm-10">
                                <input type="text" class=" form-control" id="stdidregis" name="stdidregis" placeholder="xxxxxxxxxxx-x" maxlength="13" onblur="checknum(value)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class=" form-control" id="usernameregis" name="usernameregis" placeholder="Username" maxlength="20" onblur="checkeng(value)">
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
    <script>
        function checkeng(value) {
            var n = value.length;
            // value_aci = value.charCodeAt(0)
            noteng = 0;
            for (i = 0; i < n; i++) {
                value_aci = value.charCodeAt(i)
                if (value_aci >= 48 && value_aci <= 57 || value_aci >= 65 && value_aci <= 90 || value_aci >= 97 && value_aci <= 122) {} else {
                    noteng = 1;

                }
            }
            if (noteng == 1) {
                alert("usernameควรเป็นตัวอักษรภาษาอังกฤษหรือตัวเลข");
                return document.getElementById('usernameregis').value = "";
            }


        }

        function checknum(value) {
            var n = value.length;
            notnum = 0;

            if (n == 13) {
                for (i = 0; i <= 12; i++) {
                    value_aci = value.charCodeAt(i);
                    if (i == 11) {
                        if (value_aci != 45) {
                            alert("กรุณากรอกให้ถูกต้อง");
                            return document.getElementById('stdidregis').value = "";
                        }
                        i++;
                    }
                    value_aci = value.charCodeAt(i);
                    if (value_aci >= 48 && value_aci <= 57) {

                    } else {
                        alert("กรุณากรอกให้ถูกต้อง");
                        return document.getElementById('stdidregis').value = "";
                    }
                }
            } else {
                alert("กรุณากรอกให้ถูกต้อง");
                return document.getElementById('stdidregis').value = "";
            }




        }
    </script>

</body>

</html>