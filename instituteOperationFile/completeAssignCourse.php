<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        session_start();
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        
        $database = "db".$_SESSION["instituteCode"];
        $flag = true;
        
        $sql = "use $database;";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $sql = "create table if not exists course_teacher(
                classTime int not null,
                day varchar(10) not null,
                department varchar(30) not null,
                semester varchar(30) not null,
                academicYear varchar(30) not null,
                courseCode varchar(30) not null,
                userId varchar(30) not null,
                foreign key(courseCode) references course_info(courseCode) on update cascade on delete cascade,
                foreign key(userId) references teacher_info(userId) on update cascade on delete cascade
               )";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $sql = "create table if not exists course_info(
                courseName varchar(100) not null,
                courseCode varchar(30) not null primary key
                );";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $len = count($_POST["courseCode"]);
        $flag = true;
        
        $userId = validateFormData($_POST["userId"]);
        for($i=0;$i<$len;$i++){
            $classTime = validateFormData($_POST["classTime"][$i]);
            settype($classTime,"integer");
            $courseCode = validateFormData($_POST["courseCode"][$i]);
            $courseName = validateFormData($_POST["courseName"][$i]);
            $department = validateFormData($_POST["department"][$i]);
            $semester = validateFormData($_POST["semester"][$i]);
            $academicYear = validateFormData($_POST["academicYear"][$i]);
            
            $days = $_POST["day$i"];

            $sql = "insert into course_info(courseCode,courseName) select '$courseCode','$courseName' where not exists (select * from course_info where courseCode = '$courseCode' or courseName = '$courseName');";
            if($conn->query($sql)!==TRUE) $flag=false;

            foreach($days as $key=> $value ){
                $sql = "select * from course_teacher where classTime = $classTime and day = '$value' and userId = '$userId';";
                $result = $conn->query($sql);

                if(!$result) $flag=false;
                else if($result->num_rows==0){
                    $sql = "insert into course_teacher (classTime,day,department,semester,academicYear,courseCode,userId) values ($classTime,'$value','$department','$semester','$academicYear','$courseCode','$userId')";
                    if($conn->query($sql)!==TRUE) $flag=false;
                }
                else $flag = false;
            }
        }
               
        if($flag == true){
            $conn->close();
            echo "<script>alert('Successfully Assigned Courses');</script>";
            echo "<script>window.location.href='classSchedule.php';</script>";
        }
        else{
            $conn->close();
            echo "<script>alert('Class time already assigned or error occured');</script>";
            echo "<script>window.location.href='classSchedule.php';</script>";
        }
    }
    else {
        header("Location: ../homeFile/instituteHome.php");
        exit();
    }
?>