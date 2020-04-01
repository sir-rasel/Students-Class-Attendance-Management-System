<?php
    function insertIntoLoginDatabase($conn,$flag,$table,$col,$name,$code,$password){
        $colName = $col.'Name';
        $colCode = $col.'Code';
        
        $sql = "use login_info";
        if ($conn->query($sql) !== TRUE) $flag=false;

        $sql = "insert into $table($colName,$colCode,password) values ('$name','$code','$password')";
        if ($conn->query($sql) !== TRUE) $flag=false;
        return $flag;
    }
?>