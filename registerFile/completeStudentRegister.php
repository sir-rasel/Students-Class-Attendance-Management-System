<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/insertIntoLoginDatabase.php";
        include "../inc/insertIntoInfoTable.php";
        
        $studentName = validateFormData($_POST["studentName"]);
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
            $flag = insertUserInfo($conn,$flag,$table,$col,$userId,$studentName,$instituteCode,$studentEmail,$studentMobile);   
            
            if($flag==true){
                $conn->close();
                echo "<script>alert('Successfully Register');";
                echo "window.location.href='../index.php';</script>";
                die();
            }
            else {
                echo "Error creating database: " . $conn->error;
                $conn->close();
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