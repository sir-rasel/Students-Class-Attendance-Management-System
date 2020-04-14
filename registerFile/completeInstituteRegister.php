<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        include "../inc/insertIntoLoginDatabase.php";
        include "../inc/insertIntoInfoTable.php";
        
        $instituteName = validateFormData($_POST["instituteName"]);
        $instituteCode = validateFormData($_POST["instituteCode"]);
        $instituteEmail = validateFormData($_POST["instituteEmail"]);
        $instituteMobile = validateFormData($_POST["instituteMobile"]);
        $password = validateFormData($_POST["password"]);
        $confirmPassword = validateFormData($_POST["confirmPassword"]);
        
        if($password==$confirmPassword){
            $database = "db".$instituteCode;
            $col = "institute";
            $flag = true;
            
            $sql = "create database if not exists $database";
            if ($conn->query($sql) !== TRUE) $flag=false;
            $sql = "use $database";
            if ($conn->query($sql) !== TRUE) $flag=false;
            
            $sql = "create table if not exists institute_info(
                        instituteName varchar(100) not null,
                        instituteCode varchar(30) not null primary key,
                        instituteEmail varchar(100),
                        instituteMobile varchar(20)
                    )";
            if ($conn->query($sql) !== TRUE) $flag=false;
        
            $table = "institute_info";
            $flag = insertIntoInfoTable($conn,$flag,$table,$col,$instituteName,$instituteCode,$instituteEmail,$instituteMobile);   
            
            $table = "institute_login";
            $flag = insertIntoInstituteLogin($conn,$flag,$table,$instituteName,$instituteCode,$password);
                
            if($flag==true){
                $conn->close();
                echo "<script>alert('Successfully Register');</script>";
    
                session_start();
                $_SESSION["instituteStatus"]=true;
                $_SESSION["instituteCode"]=$instituteCode;
                $_SESSION["instituteName"]=$instituteName;
                echo "<script>window.location.href='../homeFile/instituteHome.php';</script>";
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