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
                    <li><a href="migrateSemester.php">Migrate Semester</a></li>
                    <li><a href="" style="width:114px;">Class Schedule</a></li>
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
                            <td>Teacher userId </td>
                            <td><input type="text" name="userId" required> Example : lutifi-habiba</td>
                        </tr>
                        <tr>
                            <th colspan="2"><input type="submit" name="submit" value="Show Result"></th>
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
        
                    $userId = validateFormData($_POST["userId"]);
                    
                    $sql = "select teacherName from teacher_info where userId = '$userId';";
                    $result = $conn->query($sql);
                    $teacherName;
                    
                    if(!$result) $flag = false; 
                    else if($result->num_rows!=0){
                        $row = $result->fetch_assoc();
                        $teacherName = $row["teacherName"];
                        
                        $sql = "create table if not exists
                        course_teacher(
                        classTime int not null,
                        day varchar(10) not null,
                        department varchar(30) not null,
                        semester varchar(30) not null,
                        academicYear varchar(30) not null,
                        courseCode varchar(30) not null,
                        userId varchar(30) not null,
                        foreign key(courseCode) references course_info(courseCode) on update cascade on delete cascade,
                        foreign key(userId) references teacher_info(userId) on update cascade on delete cascade)";
                        if($conn->query($sql)!==TRUE) $flag=false;
                        
                        $sql = "select classTime,day, department,semester,academicYear,course_teacher.courseCode, courseName from course_teacher inner join course_info on course_teacher.courseCode = course_info.courseCode where userId = '$userId' order by classTime;";
                        $result = $conn->query($sql);

                        if(!$result){
                            $conn->close();
                            echo "<script>alert('Data not found or Error Occured, Try again');";
                            echo "window.location.href='';</script>";
                            die();
                        }
                        else if($result->num_rows==0){
                            echo "<h3>Empty List. No  course assinged right now. Assigned Course..</h3>";
                            $conn->close();
                        }
                        else{
                            $totalCourse = $result->num_rows;
                            echo "<table align = 'center'>";
                            echo "<tr><th colspan='7'>$teacherName - ($userId)</th></tr>";
                            echo "<tr>
                                    <th>Class Time</th>
                                    <th>Day</th>
                                    <th>Department</th>
                                    <th>Semester</th>
                                    <th>Academic Year</th>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                </tr>";

                            while($row = $result->fetch_assoc()){

                                echo "<tr>
                                        <td>".$row["classTime"]."</td>
                                        <td>".$row["day"]."</td>
                                        <td>".$row["department"]."</td>
                                        <td>".$row["semester"]."</td>
                                        <td>".$row["academicYear"]."</td>
                                        <td>".$row["courseCode"]."</td>
                                        <td>".$row["courseName"]."</td>
                                    </tr>";
                            }
                            echo "<tr>
                                    <th colspan='7'>Total number of class: $totalCourse</th>
                                </tr>";

                            echo "</table>";
                            $conn->close();
                        }
                    }
                    else{
                        echo "Invalid userId, not exists";
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
