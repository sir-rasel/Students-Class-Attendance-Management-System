<?php
    function insertIntoInfoTable ($conn,$flag,$table,$col,$name,$code,$email,$mobile){
        $colName = $col.'Name';
        $colCode = $col.'Code';
        $colEmail = $col.'Email';
        $colMobile = $col.'Mobile';
        
        $sql = "insert into $table($colName,$colCode,$colEmail,$colMobile) values ('$name','$code','$email','$mobile')";
        if ($conn->query($sql) !== TRUE) $flag=false;
        return $flag;
    }
?>