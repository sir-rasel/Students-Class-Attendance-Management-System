<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";

    $conn = new mysqli($serverName,$userName,$password);
    if($conn->connect_error){
        die("Connection Failed: ".$conn->connect_error);
    }
?>