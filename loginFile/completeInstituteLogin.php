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
            
        $flag = checkInstituteLoginStatus($conn,$database,$table,$instituteCode,$password);
               
        if($flag == 1){
             $conn->close();
             echo "<script>alert('Successfully Login');</script>";
    
            session_start();
            $_SESSION["instituteStatus"]=true;
            $_SESSION["instituteCode"]=$instituteCode;
            $_SESSION["instituteName"]=$instituteName;
            echo "<script>window.location.href='../homeFile/instituteHome.php';</script>";
        }
        else if($flag == 2){
            $conn->close();
            echo "<script>alert('Incorrect Password or Institute Code, try again');";
            echo "window.location.href='instituteLogin.php';</script>";
            die();
        }
        else{
            $conn->close();
            echo "<script>alert('Error Occured');";
            echo "window.location.href='instituteLogin.php';</script>";
            die();
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>