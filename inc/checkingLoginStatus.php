<?php
    function checkInstituteLoginStatus($conn,$database,$table,$instituteCode,$password){
        $sql = "use $database";
        if ($conn->query($sql) !== TRUE) return -1;
        
        $sql = "select password from $table where InstituteCode=$instituteCode";
        
        $flag=false;
        $result=$conn->query($sql);
        if(!$result) return -1;
        
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if($row["password"]==$password){
                    $flag = true;
                    break;
                }
            }   
        }
        
        if($flag==true) return 1;
        else return 2;
    }

    function checkUserLoginStatus($conn,$database,$table,$userId,$instituteCode,$password){
        $sql = "use $database";
        if ($conn->query($sql) !== TRUE) return -1;
        
        $sql = "select password from $table where InstituteCode='$instituteCode' and userId='$userId'";
        
        $flag=false;
        $result=$conn->query($sql);
        if(!$result) return -1;
        
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if($row["password"]==$password){
                    $flag = true;
                    break;
                }
            }   
        }
        
        if($flag==true) return 1;
        else return 2;
    }
?>