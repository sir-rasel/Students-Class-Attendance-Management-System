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
                department varchar(30) not null,
                semester varchar(30) not null,
                academicYear varchar(30) not null,
                courseCode varchar(30) not null,
                userId varchar(30) not null,
                foreign key(courseCode) references course_info(courseCode) on update cascade on delete cascade,
                foreign key(userId) references teacher_info(userId) on update cascade on delete cascade
               )";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $len = count($_POST["classTime"]);
        $flag = true;
        
        $userId = validateFormData($_POST["userId"]);
        for($i=0;$i<$len;$i++){
            $classTime = validateFormData($_POST["classTime"][$i]);
            settype($classTime,"integer");
            $department = validateFormData($_POST["department"][$i]);
            $semester = validateFormData($_POST["semester"][$i]);
            $academicYear = validateFormData($_POST["academicYear"][$i]);
            
            $sql = "select * from course_teacher where classTime = $classTime and userId = '$userId';";
            $result = $conn->query($sql);
            
            if(!$result) $flag=false;
            else if($result->num_rows!=0){
                $sql = "delete from course_teacher where userId = '$userId' and classTime = $classTime and department = '$department' and semester = '$semester' and academicYear = '$academicYear';";
                if($conn->query($sql)!==TRUE) $flag=false;
            }
        }
               
        if($flag == true){
            echo $conn->error;
            $conn->close();
            echo "<script>alert('Successfully Deleted Courses');</script>";
            echo "<script>window.location.href='classSchedule.php';</script>";
        }
        else{
            $conn->close();
            echo "<script>alert('Error occured');</script>";
            echo "<script>window.location.href='classSchedule.php';</script>";
        }
    }
    else {
        header("Location: ../homeFile/instituteHome.php");
        exit();
    }
?>