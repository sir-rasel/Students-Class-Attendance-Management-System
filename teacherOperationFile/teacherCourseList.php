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
                    <li><a href="../homeFile/teacherHome.php">Home</a></li>
                    <li><a href="#">Take Student Attendance</a></li>
                    <li><a href="#">Check Student Attendance</a></li>
                    <li><a href="#">Check Teacher Attendance</a></li>
                    <li><a href="#" style="width:120px;">Semester report</a></li>
                    <li><a href="teacherClassSchedule.php">Class schedule</a></li>
                    <li><a href="teacherCourseList.php" style="width:90px">Course list</a></li>
                    <li style="float:right;"><a class="active" href="../inc/logout.php" >Logout</a></li>
                </ul>
            </div>
                       
            <div class="view">
            <?php    
                include_once "../inc/databaseConnection.php";
                include_once "../inc/formValidation.php";
                $database = "db".$_SESSION["instituteCode"];
                
                $sql = "use $database;";
                $conn->query($sql);
                
                $userId = validateFormData($_SESSION["userId"]);    
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
                        
                    $sql = "select distinct course_teacher.courseCode, courseName from course_teacher inner join course_info on course_teacher.courseCode = course_info.courseCode where userId = '$userId' order by courseCode;";
                    $result = $conn->query($sql);

                    if(!$result){
                         $conn->close();
                         echo "<script>alert('Data not found or Error Occured, Try again');";
                         echo "window.location.href='../homeFile/teacherHome.php';</script>";
                         die();
                    }
                    else if($result->num_rows==0){
                        echo "<h3>Empty List. No  course assinged right now. Assigned Course..</h3>";
                        $conn->close();
                    }
                    else{
                        $totalCourse = $result->num_rows;
                        echo "<table align = 'center'>";
                        echo "<tr><th colspan='2'>$teacherName - ($userId)</th></tr>";
                        echo "<tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                              </tr>";

                        while($row = $result->fetch_assoc()){

                            echo "<tr>
                                    <td>".$row["courseCode"]."</td>
                                    <td>".$row["courseName"]."</td>
                                    </tr>";
                            }
                            echo "<tr>
                                    <th colspan='2'>Total number of course: $totalCourse</th>
                                </tr>";

                            echo "</table>";
                            $conn->close();
                        }
                    }
                    else{
                        echo "Invalid userId, not exists";
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
