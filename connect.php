<?php
    $conn = new mysqli('localhost', 'root', '1234', 'pro_x1');
    mysqli_set_charset($conn, "utf8");
    if( $conn->connect_errno){
        die("Connection failed" . $conn->connect_error);
    }

    // $objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
    // $objDB = mysql_select_db("pro_x1");
    // mysql_query("SET NAMES UTF8");
