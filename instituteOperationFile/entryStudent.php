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
            <img src="../slideShowImage/register.jpg" alt="demoImage">
            <h2>STUDENT'S CLASS ATTENDANCE MANAGEMENT SYSTEM</h2>
        </div>
        
        <div class="contentSection">
            
             <div class="menuBar">
                <ul>
                    <li><a href="../homeFile/instituteHome.php">Home</a></li>
                    <li><a href="../registerFile/teacherRegister.php">Register Teacher</a></li>
                    <li><a href="assignCourse.php">Assign Course to Teacher</a></li>
                    <li><a href="">Entry Student</a></li>
                    <li><a href="migrateSemester.php">Migrate Semester</a></li>
                    <li style="width:146px;"><a href="classSchedule.php">Class Schedule</a></li>
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
                            <td>Number Of student be added</td>
                            <td><input type="number" name="numberOfStudent" value = 1 required> Example : 10</td>
                        </tr>
                        <tr>
                            <td>Students Department</td>
                            <td><input type="text" name="department" required> Example : CSE</td>
                        </tr>
                        <tr>
                            <td>Academic Year</td>
                            <td><input type="text" name="academicYear" required> Use full form like: 2016-2017</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td><input type="text" name="semester" required> Example: 6th</td>
                        </tr>
                        <tr>
                            <th colspan = "2"><input type="submit" name="submit" value="Show Form"></th>
                        </tr>
                    </table>
                </form>
            </div>
                
                
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    include "../inc/databaseConnection.php";
                    include "../inc/formValidation.php";
        
                    $numberOfStudent = validateFormData($_POST["numberOfStudent"]);
                    settype($numberOfCourse,"integer");
                    $department = validateFormData($_POST["department"]);
                    $academicYear = validateFormData($_POST["academicYear"]);
                    $semester = validateFormData($_POST["semester"]);
                    
                    echo $department," - ".$academicYear;
                        
                    echo "<div class='registerForm'>";
                        echo "<form action='completeStudentEntry.php' method='post'>";
                            echo "<table align ='center'>";
                                echo "<tr>
                                        <th colspan = '4'>Student Information</th>
                                      </tr>";
                    
                                for($i=1;$i<=$numberOfStudent;$i++){
                                    echo "<tr          
                                           style='height:10px;'>
                                           <th colspan='4'>Student : $i
                                           </th>
                                          </tr>
                                          <tr>
                                            <th>Student Name</th>
                                            <td><input type='text' name='studentName[]' required></td>
                                            <th>Student Id</th>
                                            <td><input type='text' name='studentId[]' required></td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Student Email</th>
                                            <td><input type='text' name='studentEmail[]'></td>
                                            <th>Student Mobile</th>
                                            <td><input type='text' name='studentMobile[]'></td>
                                          </tr>
                                          
                                          <tr>
                                          <input type='hidden' name='department[]' value = $department>
                                          <input type='hidden' name='academicYear[]' value = $academicYear>
                                          <input type='hidden' name='semester[]' value = $semester></tr>";
                                }
                                echo "<tr>
                                        <th colspan = '4'><input type='submit' name='submit' value='Entry'></th>
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

