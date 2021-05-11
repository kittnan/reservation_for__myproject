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
  // echo $_SESSION['id'];
  $sql_reservation = "SELECT * FROM reservation";
  $result = $conn->query($sql_reservation);
  $reserv = 0;
  while ($row_reservation = mysqli_fetch_assoc($result)) {
    // echo "<br> rid = " . $row_reservation['rid'];
    for ($i = 1; $i <= 9; $i++) {
      // echo "<br> time = ". $i ."=" . $row_reservation[$i];
      // echo "<br>" . $_SESSION['id'];
      if ($_SESSION['id'] == $row_reservation[$i]) {
        // echo "<br> YES";
        // echo "<meta http-equiv='refresh' content='1;URL=register.php' >";
        $reserv = 1;
      } else {
        // echo '<script language="javascript">';
        // echo 'alert("กรุณาจองห้องก่อนกดดู QRcode")';
        // echo '</script>';
        // echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
        // echo "NO";
      }
    }
  }
  if ($reserv == 1) {
    // echo "PO = $reserv";
    echo "<meta http-equiv='refresh' content='1;URL=qrshow.php' >";
    $reserv = 0;
  } else {

    echo '<script language="javascript">';
    echo 'alert("กรุณาจองห้องก่อนกดดู QRcode")';
    echo '</script>';
    echo "<meta http-equiv='refresh' content='0;URL=index.php' >";
  }
  ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>