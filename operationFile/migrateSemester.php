<?php
    session_start();
    if($_SESSION["instituteStatus"]!=true){
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
    <meta http-equiv="refresh" content="300">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeMenu.css">
    <link rel="stylesheet" href="../css/multipleForm.css">
    <link rel="stylesheet" href="../css/view.css">
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
                    <li><a href="../homeFile/instituteHome.php">Home</a></li>
                    <li><a href="../registerFile/teacherRegister.php">Register Teacher</a></li>
                    <li><a href="assignCourse.php">Assign Course to Teacher</a></li>
                    <li><a href="entryStudent.php">Entry Student</a></li>
                    <li><a href="">Migrate Semester</a></li>
                    <li><a href="classSchedule.php" style="width:114px;">Class Schedule</a></li>
                    <li><a href="courseList.php">Course List</a></li>
                    <li><a href="teacherList.php">Teacher List</a></li>
                    <li><a href="semesterReport.php">Semester Overall Report</a></li>
                    <li><a href="studentList.php">Student List</a></li>
                    <li><a href="teacherAttendance.php" style="width:192px;">Check Teacher Attendance</a></li>
                    <li><a class="active" href="../inc/logout.php">Logout</a></li>
                </ul>
            </div>
            
            <div class="registerForm">
                <form action="" method="post">
                    <table align = "center">
                        <tr>
                            <td>Students Department</td>
                            <td><input type="text" name="department" required> Example : CSE</td>
                        </tr>
                        <tr>
                            <td>Academic Year</td>
                            <td><input type="text" name="academicYear" required> Use full form like: 2016-2017</td>
                        </tr>
                        <tr>
                            <td>Present semester</td>
                            <td><input type="text" name="semester" required> Example: 6th</td>
                        </tr>
                        <tr>
                            <td>Migrate to semester</td>
                            <td><input type="text" name="newSemester" required> Example: 7th, 5th</td>
                        </tr>
                        <tr>
                            <th colspan = "2"><input type="submit" name="submit" value="Migrate"></th>
                        </tr>
                    </table>
                </form>
            </div>
            
            <div class="view">
            <?php    
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    include_once "../inc/databaseConnection.php";
                    include_once "../inc/formValidation.php";
                    $database = "db".$_SESSION["instituteCode"];
                
                    $sql = "use $database;";
                    $conn->query($sql);
        
                    $department = validateFormData($_POST["department"]);
                    $academicYear = validateFormData($_POST["academicYear"]);
                    $semester = validateFormData($_POST["semester"]);
                    $newSemester = validateFormData($_POST["newSemester"]);
                    
                    $table = $department."_student_info";
                    
                    $sql = "update $table set semester='$newSemester' where semester='$semester' and academicYear='$academicYear';";
                    $result = $conn->query($sql);
                    
                    if(!$result){
                        $conn->close();
                        echo "<script>alert('Data not found or Error Occured, Try again');";
                        echo "window.location.href='';</script>";
                        die();
                    }
                    else{
                        echo "<table align = 'center'>";
                        echo "<tr>
                                <th>Succefully migrate $department - $semester ($academicYear) TO $department - $newSemester ($academicYear)</th>
                            </tr>";
                        
                        echo "</table>";
                        $conn->close();
                    }
                }
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
