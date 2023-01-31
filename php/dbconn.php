<?php
    $server ="localhost";
    $un = "root";
    $pw = "";
    $dbName = "developerTest";

    $conn = mysqli_connect($server,$un,$pw,$dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>