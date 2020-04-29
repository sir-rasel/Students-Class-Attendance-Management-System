<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        session_start();
        include "../inc/databaseConnection.php";
        include "../inc/formValidation.php";
        
        $database = "db".$_SESSION["instituteCode"];
        $flag = true;
        
        $sql = "use $database;";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $department = validateFormData($_POST["department"][0]);
        $academicYear = validateFormData($_POST["academicYear"][0]);
        
        $table = $department."_student_info";
        $sql = "create table if not exists $table
                (studentName varchar(100) not null,
                 studentId varchar(30) not null primary key,
                 department varchar(20) not null,
                 academicYear varchar(20) not null,
                 studentEmail varchar(100),
                 studentMobile varchar(20)
                );";
        if($conn->query($sql)!==TRUE) $flag=false;
        
        $len = count($_POST["studentId"]);
        $flag = true;
        
        for($i=0;$i<$len;$i++){
            $studentName = validateFormData($_POST["studentName"][$i]);
            $studentId = validateFormData($_POST["studentId"][$i]);
            $studentEmail = validateFormData($_POST["studentEmail"][$i]);
            $studentMobile = validateFormData($_POST["studentMobile"][$i]);
            
            
            $sql = "insert into $table(studentName,studentId,department,academicYear,studentEmail,studentMobile) values('$studentName','$studentId','$department','$academicYear','$studentEmail','$studentMobile');";
            if($conn->query($sql)!==TRUE) $flag=false;
        }
        
               
        if($flag == true){
            $conn->close();
            echo "<script>alert('Successfully Entry student information');</script>";
            echo "<script>window.location.href='teacherList.php';</script>";
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