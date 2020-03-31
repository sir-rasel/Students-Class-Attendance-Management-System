<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        echo "complete";
    }
    else {
        header("Location: index.php");
        exit();
    }
?>