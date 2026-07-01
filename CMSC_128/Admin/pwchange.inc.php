<?php
    session_start();

    if (isset($_POST["submit"])) {
        $username = $_SESSION["username"];
        $pwd = $_POST["currPwd"];
        $newPwd = $_POST["newPwd"];
        $conPwd = $_POST["conPwd"];

        if($newPwd != $conPwd){
            header("location: ../changePassword.php?error=differentPwds");
            exit();
        }
        
        require_once 'dbh.inc.php';

        $stmt = $conn->prepare("SELECT * FROM account WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result1 = $stmt->get_result();





        $pwdHashed = $result1->fetch_assoc();
		$checkPwd = password_verify($pwd, $pwdHashed["password"]);

        if ($checkPwd === false) {
            session_start();
            $_SESSION["attempt"] += 1;
                //set the time to allow login if third attempt is reach
            if($_SESSION["attempt"] === 5){
                $_SESSION["attempt_again"] = time() + (1*60);
                //note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
            }
            header("location: ../changePassword.php?error=wrongPwd");
            exit();
        } else if ($checkPwd === true){
            $result2 = mysqli_query($conn, "SELECT * FROM account WHERE username='" . $username . "'");
            $row=mysqli_fetch_array($result2); 

            $newHashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);

            mysqli_query($conn,"UPDATE account SET password='" . $newHashedPwd . "' WHERE username='" . $username . "'");
            header("location: ../changePassword.php?success=pwdChanged");
            exit();
        }
    
        
    }
    else{
        header("location: ../adminProfile.php");
        exit();
    }
?>