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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/homeMenu.css">
    <link rel="stylesheet" href="../css/multipleForm.css">
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
                    <li><a href="">Assign Course to Teacher</a></li>
                    <li><a href="entryStudent.php">Entry Student</a></li>
                    <li><a href="migrateSemester.php">Migrate Semester</a></li>
                    <li style="width:146px;"><a href="classSchedule.php">Class Schedule</a></li>
                    <li><a href="courseList.php">Course List</a></li>
                    <li><a href="teacherList.php">Teacher List</a></li>
                    <li><a href="#">Semester Overall Report</a></li>
                    <li><a href="studentList.php">Student List</a></li>
                    <li><a href="teacherAttendance.php" style="width:192px;">Check Teacher Attendance</a></li>
                    <li><a class="active" href="../inc/logout.php">Logout</a></li>
                </ul>
            </div>
                
            <div class="registerForm">
                <form action="" method="post">
                    <table align = "center">
                        <tr>
                            <td>Teacher UserID</td>
                            <td colspan="2"><input type="text" name="userId" required></td>
                        </tr>
                        <tr>
                            <td>Number of course be assigned</td>
                            <td colspan="2"><input type="number" name="numberOfCourse" value = 1 required></td>
                        </tr>
                        <tr>
                            <th><input type="submit" name="submit" value="Assign Course"></th>
                            <th><input type="submit" name="submit" value="Update Assignment"></th>
                            <th><input type="submit" name="submit" value="Delete Class"></th>
                        </tr>
                    </table>
                </form>
            </div>
            
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]=="Assign Course"){
                    include "../inc/databaseConnection.php";
                    include "../inc/formValidation.php";
        
                    $userId = validateFormData($_POST["userId"]);
                    $numberOfCourse = validateFormData($_POST["numberOfCourse"]);
                    settype($numberOfCourse,"integer");
                        
                    echo "<div class='registerForm'>";
                        echo "<form action='completeAssignCourse.php' method='post'>";
                            echo "<table align ='center'>";
                                echo "<tr>
                                        <th colspan = '4'>Course Assignment</th>
                                      </tr>";
                    
                                for($i=0;$i<$numberOfCourse;$i++){
                                    $dayVal = "day"."$i"."[]";
                                    $number = $i+1;
                                    echo "<tr          
                                           style='height:10px;'>
                                           <th colspan='4'>Course : $number
                                           </th>
                                          </tr>
                                          <tr>
                                            <th>Class Time</th>
                                            <td><input type='text' name='classTime[]' required></td>
                                            <th>Department</th>
                                            <td><input type='text' name='department[]' required></td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Semester</th>
                                            <td><input type='text' name='semester[]' required></td>
                                            <th>Academic Year</th>
                                            <td><input type='text' name='academicYear[]' required></td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Course Code</th>
                                            <td><input type='text' name='courseCode[]' required></td>
                                            <th>Course Name</th>
                                            <td><input type='text' name='courseName[]' required></td>
                                          </tr>
                                          <tr>
                                            <th>Day</th>
                                            <td colspan='3'>
                                                <input type='checkbox' name='$dayVal' value='Sat'/>Sat
                                                <input type='checkbox' name='$dayVal' value='Sun'/>Sun
                                                <input type='checkbox' name='$dayVal' value='Mon'/>Mon
                                                <input type='checkbox' name='$dayVal' value='Tue'/>Tue
                                                <input type='checkbox' name='$dayVal' value='Wed'/>Wed
                                                <input type='checkbox' name='$dayVal' value='Thu'/>Thu
                                            </td>
                                          </tr>
                                          ";
                                }
                                echo "<tr>
                                          <input type='hidden' name='userId' value = $userId>
                                       </tr>
                                       <tr>
                                        <th colspan = '4'><input type='submit' name='submit' value='Assign'></th>
                                      </tr>";
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                }
                else if($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]=="Update Assignment"){
                    include "../inc/databaseConnection.php";
                    include "../inc/formValidation.php";
        
                    $userId = validateFormData($_POST["userId"]);
                    $numberOfCourse = validateFormData($_POST["numberOfCourse"]);
                    settype($numberOfCourse,"integer");
                        
                    echo "<div class='registerForm'>";
                        echo "<form action='completeUpdateCourseAssign.php' method='post'>";
                            echo "<table align ='center'>";
                                echo "<tr>
                                        <th colspan = '4'>Course Assignment</th>
                                      </tr>";
                    
                                for($i=0;$i<$numberOfCourse;$i++){
                                    $dayVal = "day"."$i"."[]";
                                    $number = $i+1;
                                    echo "<tr          
                                           style='height:10px;'>
                                           <th colspan='4'>Course : $number
                                           </th>
                                          </tr>
                                          <tr>
                                            <th>Class Time</th>
                                            <td><input type='text' name='classTime[]' required></td>
                                            <th>Department</th>
                                            <td><input type='text' name='department[]' required></td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Semester</th>
                                            <td><input type='text' name='semester[]' required></td>
                                            <th>Academic Year</th>
                                            <td><input type='text' name='academicYear[]' required></td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Course Code</th>
                                            <td><input type='text' name='courseCode[]' required></td>
                                            <th>Course Name</th>
                                            <td><input type='text' name='courseName[]' required></td>
                                          </tr>
                                          <tr>
                                            <th>Day</th>
                                            <td colspan='3'>
                                                <input type='checkbox' name='$dayVal' value='Sat'/>Sat
                                                <input type='checkbox' name='$dayVal' value='Sun'/>Sun
                                                <input type='checkbox' name='$dayVal' value='Mon'/>Mon
                                                <input type='checkbox' name='$dayVal' value='Tue'/>Tue
                                                <input type='checkbox' name='$dayVal' value='Wed'/>Wed
                                                <input type='checkbox' name='$dayVal' value='Thu'/>Thu
                                            </td>

                                          </tr>
                                          ";
                                }
                                echo "<tr>
                                          <input type='hidden' name='userId' value = $userId>
                                       </tr>
                                       <tr>
                                        <th colspan = '4'><input type='submit' name='submit' value='Update'></th>
                                      </tr>";
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                }
                else if($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]=="Delete Class"){
                    include "../inc/databaseConnection.php";
                    include "../inc/formValidation.php";
        
                    $userId = validateFormData($_POST["userId"]);
                    $numberOfCourse = validateFormData($_POST["numberOfCourse"]);
                    settype($numberOfCourse,"integer");
                        
                    echo "<div class='registerForm'>";
                        echo "<form action='completeDeleteClassAssign.php' method='post'>";
                            echo "<table align ='center'>";
                                echo "<tr>
                                        <th colspan = '4'>Delete Class</th>
                                      </tr>";
                    
                                for($i=0;$i<$numberOfCourse;$i++){
                                    $dayVal = "day"."$i"."[]";
                                    $number = $i+1;
                                    echo "<tr          
                                           style='height:10px;'>
                                           <th colspan='4'>Course : $number
                                           </th>
                                          </tr>
                                          <tr>
                                            <th>Class Time</th>
                                            <td><input type='text' name='classTime[]' required></td>
                                            <th>Department</th>
                                            <td><input type='text' name='department[]' required></td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Semester</th>
                                            <td><input type='text' name='semester[]' required></td>
                                            <th>Academic Year</th>
                                            <td><input type='text' name='academicYear[]' required></td>
                                          </tr>
                                          <tr>
                                            <th>Day</th>
                                            <td colspan='3'>
                                                <input type='checkbox' name='$dayVal' value='Sat'/>Sat
                                                <input type='checkbox' name='$dayVal' value='Sun'/>Sun
                                                <input type='checkbox' name='$dayVal' value='Mon'/>Mon
                                                <input type='checkbox' name='$dayVal' value='Tue'/>Tue
                                                <input type='checkbox' name='$dayVal' value='Wed'/>Wed
                                                <input type='checkbox' name='$dayVal' value='Thu'/>Thu
                                            </td>
                                          </tr>
                                        ";
                                }
                                echo "<tr>
                                          <input type='hidden' name='userId' value = $userId>
                                       </tr>
                                       <tr>
                                        <th colspan = '4'><input type='submit' name='submit' value='Delete'></th>
                                      </tr>";
                            echo "</table>";
                        echo "</form>";
                    echo "</div>";
                }
            ?>
                
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

