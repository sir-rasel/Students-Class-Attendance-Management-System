<?php
    session_start();
    if($_SESSION["studentStatus"]!=true){
        echo "<script>alert('Register or Log in first');";
        echo "window.location.href='../loginFile/studentLogin.php';</script>";
        die();
    }
?>

<!doctype html>
<html>
<head>
    <title>Student Class Attendance Management System</title>
    
    <meta charset="UTF-8">
    <meta name="description" content="Student Class Attendance Management System">
    <meta name="keywords" content="Class, Attendance, Managment">
    <meta name="author" content="Saiful Islam Rasel">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeMenu.css">
</head>
<body>
    
    <div class="mainSection">
        <div class="header">
            <img src="../slideShowImage/login.png" alt="demoImage">
            <h2>STUDENT'S CLASS ATTENDANCE MANAGEMENT SYSTEM</h2>
        </div>
        
        <div class="contentSection">
            
             <div class="menuBar">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="#">Check Attendance</a></li>
                    <li><a href="#">Check semester report</a></li>
                    <li style="float:right;"><a class="active" href="../inc/logout.php" >Logout</a></li>
                </ul>
            </div>
            
            <div class="view">
                <h1>WELCOME,</h1>
                <?php
                    $userId = strtoupper($_SESSION["userId"]);
                    echo "<h2 style = 'color:blue;'>$userId</h2>";
                ?>
            </div>
            
            
        </div>
        
    
        <div class="footer">
            <h4>&copy SIR SOFT</h4>
            <p>Maintainance by: Saiful Islam Rasel</p>
            <p>Server Time : 
                <?php 
                    date_default_timezone_set("Asia/Dhaka");
                    echo date("H:i:sa");
                ?> 
            </p>
        </div>
    </div>
    
</body>

</html>

