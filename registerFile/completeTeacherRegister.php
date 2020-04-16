<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/insertIntoLoginDatabase.php";
        include "../inc/insertIntoInfoTable.php";
        
        $teacherName = validateFormData($_POST["teacherName"]);
        $teacherDepartment = validateFormData($_POST["teacherDepartment"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $teacherEmail = validateFormData($_POST["teacherEmail"]);
        $teacherMobile = validateFormData($_POST["teacherMobile"]);
        $userId = validateFormData($_POST["userId"]);
        $password = validateFormData($_POST["password"]);
        $confirmPassword = validateFormData($_POST["confirmPassword"]);
        
        if($password==$confirmPassword){
            $database = "db".$instituteCode;
            $col = "teacher";
            $flag = true;
            
            $sql = "use $database";
            if ($conn->query($sql) !== TRUE) $flag=false;
            
            $sql = "create table if not exists teacher_info(
                        teacherName varchar(100) not null,
                        instituteCode varchar(30) not null,
                        userId varchar(30) not null primary key,
                        teacherDepartment varchar(100) not null,
                        teacherEmail varchar(100),
                        teacherMobile varchar(20)
                    )";
            if ($conn->query($sql) !== TRUE) $flag=false;
        
            $table = "teacher_info";
            $flag = insertUserInfo($conn,$flag,$table,$col,$userId,$teacherName,$instituteCode,$teacherDepartment,$teacherEmail,$teacherMobile);   
            
            $table = "teacher_login";
            $flag = insertIntoUserLogin($conn,$flag,$table,$userId,$instituteCode,$password);
                
            if($flag==true){
                $conn->close();
                echo "<script>alert('Successfully Register');</script>";
                echo "<script>window.location.href='../homeFile/instituteHome.php';</script>";
                die();
            }
            else {
                $conn->close();
                echo "<script>alert('Username already exist or error occured');</script>";
                echo "<script>window.location.href='teacherRegister.php';</script>";
                die();
            }
        }
        else{
            echo "<script>alert('Password mis-match, try again');";
            echo "window.location.href='teacherRegister.php';</script>";
            die();
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>