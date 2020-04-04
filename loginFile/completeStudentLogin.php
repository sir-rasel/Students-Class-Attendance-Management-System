<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/checkingLoginStatus.php";
        
        $userId = validateFormData($_POST["userId"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $password = validateFormData($_POST["password"]);
       
        $database = "login_info";
        $table = "student_login";
            
        $flag = checkUserLoginStatus($conn,$database,$table,$userId,$instituteCode,$password);
               
        if($flag == 1){
            $conn->close();
            echo "<script>alert('Successfully Login');</script>";
    
            session_start();
            $_SESSION["studentStatus"]=true;
            echo "<script>window.location.href='../homeFile/studentHome.php';</script>";
            die();
        }
        else if($flag == 2){
            $conn->close();
            echo "<script>alert('Incorrect Password or UserId or Institute Code, try again');";
            echo "window.location.href='studentLogin.php';</script>";
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