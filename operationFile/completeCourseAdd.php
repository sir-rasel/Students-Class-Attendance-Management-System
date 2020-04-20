<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        session_start();
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        
        $database = "db".$_SESSION["instituteCode"];
        $sql = "use $database;";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $len = count($_POST["courseCode"]);
        $flag = true;
        
        for($i=0;$i<$len;$i++){
            $courseCode = validateFormData($_POST["courseCode"][$i]);
            $courseName = validateFormData($_POST["courseName"][$i]);
            
            $sql = "insert into course_info(courseCode,courseName) values('$courseCode','$courseName');";
            if($conn->query($sql)!==TRUE) $flag=false;
        }
        
               
        if($flag == true){
            $conn->close();
            echo "<script>alert('Successfully Added Courses');</script>";
            echo "<script>window.location.href='courseList.php';</script>";
        }
        else{
            echo "Error creating database: " . $conn->error;
            $conn->close();
        }
    }
    else {
        header("Location: ../homeFile/instituteHome.php");
        exit();
    }
?>