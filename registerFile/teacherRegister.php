<?php
    session_start();
    if($_SESSION["instituteStatus"]!=true){
        echo "<script>alert('Register or Log in first');";
        echo "window.location.href='../loginFile/instituteLogin.php';</script>";
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
    <link rel="stylesheet" href="../css/registration.css">
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
                    <li><a href="#">Register Teacher</a></li>
                    <li><a href="#">Assign Course to Teacher</a></li>
                    <li><a href="#">Entry Student</a></li>
                    <li><a href="#">Migrate Semester</a></li>
                    <li><a href="#">Teacher List</a></li>
                    <li><a href="#">Course List</a></li>
                    <li><a href="#">Semester Overall Report</a></li>
                    <li><a class="active" href="../inc/logout.php">Logout</a></li>
                </ul>
            </div>
            
            <div class="view">
                <div class="registerForm">
                    <form action="completeTeacherRegister.php" method="post">
                        <table align = "center">
                            <tr>
                                <th colspan = "2">Teacher Registration Form</th>
                            </tr>
                            <tr>
                                <td>Teacher Name </td>
                                <td><input type="text" name="teacherName" required></td>
                            </tr>
                            <tr>
                                <td>Teacher Department </td>
                                <td><input type="text" name="teacherDepartment" required></td>
                            </tr>
                            <tr>
                                <td>Institute code/id </td>
                                <td><input type="text" name="instituteCode" required></td>
                            </tr>
                            <tr>
                                <td>Teacher e-mail </td>
                                <td><input type="email" name="teacherEmail"></td>
                            </tr>
                            <tr>
                                <td>Teacher mobile </td>
                                <td><input type="text" name="teacherMobile"></td>
                            </tr>
                            <tr>
                                <td>UserID </td>
                                <td><input type="text" name="userId" required></td>
                            </tr>
                            <tr>
                                <td>Password </td>
                                <td><input type="text" name="password" required></td>
                            </tr>
                            <tr>
                                <td>Confirm Password </td>
                                <td><input type="text" name="confirmPassword" required></td>
                            </tr>
                            <tr>
                                <th colspan = "2"><input type="submit" name="submit" value="REGISTER"></th>
                            </tr>
                        </table>
                    </form>
                </div>
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

