<?php
    session_start();
    session_unset();
    session_destroy();

    session_start();
    $_SESSION["instituteStatus"]=false;
    $_SESSION["studentStatus"]=false;
    $_SESSION["teacherStatus"]=false;

    echo "<script>alert('Succesfully Logout');";
    echo "window.location.href='../index.php';</script>";
    die();
?>