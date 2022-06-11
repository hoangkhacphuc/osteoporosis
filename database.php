<?php

    $username = "root";
    $password = "";
    $hostname = "localhost";
    $dbname = "osteoporosis";
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    if (!$conn) {
        die("Kết nối cơ sở dữ liệu thất bại : " . mysqli_connect_error());
    }
?>