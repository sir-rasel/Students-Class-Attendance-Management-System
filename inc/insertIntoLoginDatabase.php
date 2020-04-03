<?php
    function insertIntoInstituteLogin($conn,$flag,$table,$name,$code,$password){
        $sql = "use login_info";
        if ($conn->query($sql) !== TRUE) $flag=false;

        $sql = "insert into $table(instituteName,instituteCode,password) values ('$name','$code','$password')";
        if ($conn->query($sql) !== TRUE) $flag=false;
        return $flag;
    }

    function insertIntoUserLogin($conn,$flag,$table,$userId,$code,$password){
        $sql = "use login_info";
        if ($conn->query($sql) !== TRUE) $flag=false;

        $sql = "insert into $table(UserID,instituteCode,password) values ('$userId','$code','$password')";
        if ($conn->query($sql) !== TRUE) $flag=false;
        return $flag;
    }
?>