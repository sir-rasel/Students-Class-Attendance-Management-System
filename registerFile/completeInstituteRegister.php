<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        
        
        $instituteName = validateFormData($_POST["instituteName"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $instituteEmail = validateFormData($_POST["instituteEmail"]);
        $instituteMobile = validateFormData($_POST["instituteMobile"]);
        $password = validateFormData($_POST["password"]);
        $confirmPassword = validateFormData($_POST["confirmPassword"]);
        
        if($password==$confirmPassword){
            $database = "db".$instituteCode;
            $sql = "create database if not exists $database";
    
            if ($conn->query($sql) === TRUE) {
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
            echo "window.location.href='instituteRegister.php';</script>";
            die();
        }
    }
    else {
        header("Location: ../index.php");
        exit();
    }
?>