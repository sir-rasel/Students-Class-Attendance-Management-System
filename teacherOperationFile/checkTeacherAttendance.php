<?php
    session_start();
    if($_SESSION["teacherStatus"]!=true){
        echo "<script>alert('Register or Log in first');";
        echo "window.location.href='../index.php';</script>";
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
            <img src="../slideShowImage/register.jpg" alt="demoImage">
            <h2>STUDENT'S CLASS ATTENDANCE MANAGEMENT SYSTEM</h2>
        </div>
        
        <div class="contentSection">
            
             <div class="menuBar">
                <ul>
                    <li><a href="../homeFile/teacherHome.php">Home</a></li>
                    <li><a href="../teacherOperationFile/takeStudentAttendance.php">Take Student Attendance</a></li>
                    <li><a href="../teacherOperationFile/checkStudentAttendance.php">Check Student Attendance</a></li>
                    <li><a href="../teacherOperationFile/checkTeacherAttendance.php">Check Teacher Attendance</a></li>
                    <li><a href="../teacherOperationFile/semesterReport.php" style="width:120px;">Semester report</a></li>
                    <li><a href="../teacherOperationFile/teacherClassSchedule.php">Class schedule</a></li>
                    <li><a href="../teacherOperationFile/teacherCourseList.php" style="width:90px">Course list</a></li>
                    <li style="float:right;"><a class="active" href="../inc/logout.php" >Logout</a></li>
                </ul>
            </div>
            
            <div class="view">
                <h1>WELCOME,</h1>
                <p>This is teacher attendance page</p>
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

