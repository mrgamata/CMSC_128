<?php
    session_start();

    if (isset($_POST["submit"])) {
        $username = $_SESSION["username"];
        $currpassword =$_POST["currpassword"];
        $newpassword =$_POST["newpassword"];
        $conpassword =$_POST["conpassword"];
        
        require_once 'dbh.inc.php';
    
        if(count($_POST) > 0){
            $result = mysqli_query($conn, "SELECT * FROM account WHERE username='" . $username . "'");
            $row = mysqli_fetch_array($result);
    
            if($_POST["currpassword"] == $row["password"]){
                mysqli_query($conn, "UPDATE account SET password='" . $newpassword . "' WHERE username='" . $username . "'");
            } else {
                echo "something not rite";
            }
        }
    }
    else{
        header("location: ../Admin/adminProfile.php");
        exit();
    }
?>