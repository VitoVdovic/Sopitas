<?php
    header('Content-type: text/html; charset=utf-8');

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $basename = "Sopitas";

    $dbc = mysqli_connect($servername, $username, $password, $basename) or die('Error connecting to MySQL server.'.mysqli_connect_error());
    mysqli_set_charset($dbc, "utf8");
?>