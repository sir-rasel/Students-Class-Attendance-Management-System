<?php
    session_start();
    session_unset();
    session_destroy();

    echo "<script>alert('Succesfully Logout');";
    echo "window.location.href='../index.php';</script>";
    die();
?>