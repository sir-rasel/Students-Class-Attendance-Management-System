<?php
    function insertIntoInfoTable ($conn,$flag,$table,$col,$name,$code,$email,$mobile){
        $colName = $col.'Name';
        $colCode = "instituteCode";
        $colEmail = $col.'Email';
        $colMobile = $col.'Mobile';
        
        $sql = "insert into $table($colName,$colCode,$colEmail,$colMobile) values ('$name','$code','$email','$mobile')";
        if ($conn->query($sql) !== TRUE) $flag=false;
        return $flag;
    }

    function insertUserInfo ($conn,$flag,$table,$col,$id,$name,$code,$dept,$email,$mobile){
        $colName = $col.'Name';
        $colDept = $col.'Department';
        $colCode = "instituteCode";
        $userId = "userID";
        $colEmail = $col.'Email';
        $colMobile = $col.'Mobile';
        
        $sql = "insert into $table($userId,$colName,$colCode,$colDept,$colEmail,$colMobile) values ('$id', '$name','$code','$dept','$email','$mobile')";
        if ($conn->query($sql) !== TRUE) $flag=false;
        return $flag;
    }
?>