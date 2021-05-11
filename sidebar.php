<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['status'] == 2) { ?>
        <!DOCTYPE html>
        <html>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <body>
            <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
                <h5 class="w3-bar-item w3-pink">Menu</h5>
                <a href="adminpage.php" class="w3-bar-item w3-button">AdminControl</a>
                <a href="admin_control_room.php" class="w3-bar-item w3-button">Room</a>
                <a href="blacklist.php" class="w3-bar-item w3-button">BlackList</a>
                <a href="qradmin.php" class="w3-bar-item w3-button">QRcodeAdmin</a>
            </div>
        </body>

        </html>
    <?php } else if ($_SESSION['status'] == 3) { ?>
        <!DOCTYPE html>
        <html>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <body>
            <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
                <h5 class="w3-bar-item w3-pink">Menu</h5>
                <a href="adminpage.php" class="w3-bar-item w3-button">AdminControl</a>
                <a href="admin_control_room.php" class="w3-bar-item w3-button">Room</a>
                <a href="blacklist.php" class="w3-bar-item w3-button">BlackList</a>
                <a href="addadmin.php" class="w3-bar-item w3-button">AddAdmin</a>
                <a href="qradmin.php" class="w3-bar-item w3-button">QRcodeAdmin</a>
            </div>
        </body>

        </html>
<?php }
}
?>