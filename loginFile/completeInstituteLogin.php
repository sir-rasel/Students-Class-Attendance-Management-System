<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/checkingLoginStatus.php";
        
        $instituteName = validateFormData($_POST["instituteName"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $password = validateFormData($_POST["password"]);
       
        $database = "login_info";
        $table = "institute_login";
            
        $flag = checkLoginStatus($conn,$database,$table,$instituteCode,$password);
               
        if($flag == 1){
             $conn->close();
             echo "<script>window.location.href='../index.php';</script>";
        }
        else if($flag == 2){
            $conn->close();
            echo "<script>alert('Incorrect Password, try again');";
            echo "window.location.href='instituteLogin.php';</script>";
            die();
        }
        else{
            echo "Error creating database: " . $conn->error;
            $conn->close();
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>