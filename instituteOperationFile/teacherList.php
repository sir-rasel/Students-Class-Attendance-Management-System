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
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeMenu.css">
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
                    <li><a href="classSchedule.php" style="width:114px;">Class Schedule</a></li>
                    <li><a href="courseList.php">Course List</a></li>
                    <li><a href="">Teacher List</a></li>
                    <li><a href="semesterReport.php">Semester Overall Report</a></li>
                    <li><a href="studentList.php">Student List</a></li>
                    <li><a href="teacherAttendance.php" style="width:192px;">Check Teacher Attendance</a></li>
                    <li><a class="active" href="../inc/logout.php">Logout</a></li>
                </ul>
            </div>
            
            <div class="view">
                <?php
                    include_once "../inc/databaseConnection.php";
                    $database = "db".$_SESSION["instituteCode"];
                
                    $sql = "use $database;";
                    $conn->query($sql);
                
                    $sql = "create table if not exists teacher_info(
                        teacherName varchar(100) not null,
                        instituteCode varchar(30) not null,
                        userId varchar(30) not null primary key,
                        teacherDepartment varchar(100) not null,
                        teacherEmail varchar(100),
                        teacherMobile varchar(20)
                    )";
                    if ($conn->query($sql) !== TRUE) $flag=false;

                    $sql = "select userId, teacherName,teacherDepartment,teacherEmail,teacherMobile from teacher_info order by teacherDepartment;";
                    $result = $conn->query($sql);
                
                    if(!$result){
                        $conn->close();
                        echo "<script>alert('Error Occured, Try again');";
                        echo "window.location.href='../homeFile/instituteHome.php';</script>";
                        die();
                    }
                    else if($result->num_rows==0){
                        echo "<h3>Empty List. No teacher available right now. Register teacher..</h3>";
                        $conn->close();
                    }
                    else{
                        echo "<table align = 'center'>";
                        echo "<tr>
                                <th>SI. NO:</th>
                                <th>UserId</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Mobile</th>
                            </tr>";
                        
                        $idx = 1;
                        while($row = $result->fetch_assoc()){
                            echo "<tr>
                                    <td>".$idx."</td>
                                    <td>".$row["userId"]."</td>
                                    <td>".$row["teacherName"]."</td>
                                    <td>".$row["teacherDepartment"]."</td>
                                    <td>".$row["teacherEmail"]."</td>
                                    <td>".$row["teacherMobile"]."</td>
                                </tr>";
                            $idx++;
                        }
                        --$idx;
                        echo "<tr><th colspan='6'>Total number of teacher: $idx</th></tr>";
                        
                        echo "</table>";
                        $conn->close();
                    }
                ?>
                
                <table align = 'center' style="border:none">
                    <tr>
                        <th colspan="2" style="padding:0px"><a href="../registerFile/teacherRegister.php">ADD TEACHER</a></th>
                    </tr>
                </table>
                
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

