<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/insertIntoLoginDatabase.php";
        include "../inc/insertIntoInfoTable.php";
        
        $studentName = validateFormData($_POST["studentName"]);
        $studentDepartment = validateFormData($_POST["studentDepartment"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $studentEmail = validateFormData($_POST["studentEmail"]);
        $studentMobile = validateFormData($_POST["studentMobile"]);
        $userId = validateFormData($_POST["userId"]);
        $password = validateFormData($_POST["password"]);
        $confirmPassword = validateFormData($_POST["confirmPassword"]);
        
        if($password==$confirmPassword){
            $col = "student";
            $flag = true;
            
            $table = "student_login";
            $flag = insertIntoUserLogin($conn,$flag,$table,$userId,$instituteCode,$password);
        
            $table = "register_student_info";
            $flag = insertUserInfo($conn,$flag,$table,$col,$userId,$studentName,$instituteCode,$studentDepartment,$studentEmail,$studentMobile);  
            
            if($flag==true){
                $conn->close();
                echo "<script>alert('Successfully Register');</script>";
                
                session_start();
                $_SESSION["studentStatus"]=true;
                $_SESSION["userId"]=$userId;
                $_SESSION["instituteCode"]=$institueCode;
                echo "<script>window.location.href='../homeFile/studentHome.php';</script>";
                die();
            }
            else {
                $conn->close();
                echo "<script>alert('Username already exist or error occured');</script>";
                echo "<script>window.location.href='studentRegister.php';</script>";
                die();
            }
            
        }
        else{
            echo "<script>alert('Password mis-match, try again');";
            echo "window.location.href='studentRegister.php';</script>";
            die();
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>