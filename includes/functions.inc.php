<?php

	function emptyInputSignup($lastName, $firstName, $middleInitial, $contactNum, $email, $username, $pwd, $pwdRepeat){
		$result;
		if (empty($lastName) || empty($firstName) || empty($middleInitial)  || empty($contactNum) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
			$result = true;
		}
		else{
			$result = false;
		}

		return $result;
	}

	

	function invalidUid($username){
		$result;
		if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			$result = true;
		}
		else{
			$result = false;
		}

		return $result;
	}
	
	function invalidEmail($email){
		$result;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}

	function pwdMatch($pwd, $pwdRepeat){
		$result;
		if ($pwd !== $pwdRepeat) {
			$result = true;
		}
		else{
			$result = false;
		}

		return $result;
	}

	function uidExists($conn, $username){
		$sql = "SELECT * FROM account WHERE username = ?;";
		$stmt = mysqli_stmt_init($conn); 
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signup.php?error=stmtfailed1");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		else{
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);

	}

	function uidExistsManager($conn, $username){
		$sql = "SELECT * FROM Manager WHERE Username = ?;";
		$stmt = mysqli_stmt_init($conn); 
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signup.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)) {
			$result = true;
			return $result;
		}
		else{
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);
		
	}

	function createUser($conn,$lastName, $firstName, $middleInitial,$contactNum, $email, $username, $pwd){
		$sql = "INSERT INTO account (user_email,username, password) VALUES (?,?,?);";
		$sql1 = "INSERT INTO user (username, user_fName, user_mName,user_lName, user_cNum) VALUES (?,?,?,?,?);";
		
		$stmt = mysqli_stmt_init($conn); 
		$stmt1 = mysqli_stmt_init($conn); 
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}
		if (!mysqli_stmt_prepare($stmt1, $sql1)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "sss",$email,$username, $hashedPwd);
		mysqli_stmt_bind_param($stmt1, "sssss", $username, $firstName, $middleInitial, $lastName, $contactNum);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_execute($stmt1);
		mysqli_stmt_close($stmt);
		mysqli_stmt_close($stmt1);
		header("location: ../index.php?error=none");
			exit();
	}

	function createUserAdmin($conn, $lastName, $firstName, $middleInitial,$address, $contactNum, $email, $branchName, $username, $pwd){
		$sql = "INSERT INTO Account (Username, Password) VALUES (?,?);";
		$sql1 = "INSERT INTO Manager (Manager_LastName, Manager_FirstName, Manager_MiddleInitial,Manager_Address, Manager_ContactNum, Manager_Email, Branch_Name, Username) VALUES (?,?,?,?,?,?,?,?);";
		
		$stmt = mysqli_stmt_init($conn); 
		$stmt1 = mysqli_stmt_init($conn); 
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signupAdmin.php?error=stmtfailed");
			exit();
		}
		if (!mysqli_stmt_prepare($stmt1, $sql1)) {
			header("location: ../signupAdmin.php?error=stmtfailed");
			exit();
		}

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "ss",$username, $hashedPwd);
		mysqli_stmt_bind_param($stmt1, "ssssssss",$lastName, $firstName, $middleInitial,$address,$contactNum, $email, $branchName, $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_execute($stmt1);
		mysqli_stmt_close($stmt);
		mysqli_stmt_close($stmt1);
		header("location: ../signupAdmin.php?error=none");
			exit();
	}

	

	function emptyInputLogin($username, $pwd){
		session_start();
		//set login attempt if not set
		if(!isset($_SESSION["attempt"])){
			$_SESSION["attempt"] = 0;
		}
 
		//check if there are 5 attempts already
		if($_SESSION["attempt"] === 5){
			$_SESSION["error"] = 'Attempt limit reach';
		}
		else{
			$result;
			if (empty($username) || empty($pwd)) {
				$_SESSION["error"] = 'Password incorrect';
				$_SESSION["attempt"] += 1;
					//set the time to allow login if third attempt is reach
				if($_SESSION["attempt"] === 5){
					$_SESSION["attempt_again"] = time() + (1*60);
					//note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
				}
				$result = true;
			}
			else{
				$result = false;
			}

			return $result;
		}

	}

	function loginUser($conn, $username, $pwd){
		session_start();
		//set login attempt if not set
		if(!isset($_SESSION["attempt"])){
			$_SESSION["attempt"] = 0;
		}
 
		//check if there are 3 attempts already
		if($_SESSION["attempt"] === 5){
			$_SESSION["error"] = 'Attempt limit reach';
		}
		else{
			$uidExists = uidExists($conn, $username);

			if ($uidExists ===false) {
				session_start();
				$_SESSION["attempt"] += 1;
					//set the time to allow login if third attempt is reach
				if($_SESSION["attempt"] === 5){
					$_SESSION["attempt_again"] = time() + (1*60);
					//note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
				}
				header("location: ../index.php?error=wronglogin");
				exit();
			}

			$pwdHashed = $uidExists["password"];
			$checkPwd = password_verify($pwd, $pwdHashed);

			if ($checkPwd === false) {
				session_start();
				$_SESSION["attempt"] += 1;
					//set the time to allow login if third attempt is reach
				if($_SESSION["attempt"] === 5){
					$_SESSION["attempt_again"] = time() + (1*60);
					//note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
				}
				header("location: ../index.php?error=wronglogin");
				exit();
			}
			else if ($checkPwd === true){
				//Pwede ako dito mag hanap ng entity
			
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION["useruid"] = $uidExists["Username"];
					$_SESSION["entity"] = "sender";
					$_SESSION['last_login_timestamp'] = time();

					$_SESSION["success"] = "Login successful";
						//unset our attempt
					unset($_SESSION["attempt"]);
					
					header("location: ../Admin/adminIndex.php?success=1");
					exit();
				//}
			}
		}

		
	}

function invalidNum($contactNum){
		$result;
		if (!preg_match("/^\d+$/", $contactNum)) {
			$result = true;
		} 
		else {
  			$result = false;
		}
		return $result;
	}

function changePass($conn, $username, $pwd){
		session_start();
		//set login attempt if not set
		if(!isset($_SESSION['attempt'])){
			$_SESSION["attempt"] = 0;
		}
 
		//check if there are 3 attempts already
		if($_SESSION["attempt"] === 5){
			$_SESSION["error"] = 'Attempt limit reach';
		}
		else{
			$uidExists = uidExists($conn, $username);

			if ($uidExists ===false) {
				session_start();
				$_SESSION["attempt"] += 1;
					//set the time to allow login if third attempt is reach
				if($_SESSION["attempt"] === 5){
					$_SESSION["attempt_again"] = time() + (1*60);
					//note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
				}
				header("location: ../login.php?error=wronglogin");
				exit();
			}

			$pwdHashed = $uidExists["Password"];
			$checkPwd = password_verify($pwd, $pwdHashed);

			if ($checkPwd === false) {
				session_start();
				$_SESSION["attempt"] += 1;
					//set the time to allow login if third attempt is reach
				if($_SESSION["attempt"] === 5){
					$_SESSION["attempt_again"] = time() + (1*60);
					//note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60
				}
				header("location: ../login.php?error=wronglogin");
				exit();
			}
			else if ($checkPwd === true){
				//Pwede ako dito mag hanap ng entity

				if ($uidExists["Username"] === "SuperAdmin") {
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION["useruid"] = $uidExists["Username"];
					$_SESSION["entity"] = $uidExists["Username"];
					$_SESSION["last_login_timestamp"] = time();

						//unset our attempt
					unset($_SESSION["attempt"]);

					header("location: ../homepage.php");
					exit();
				}
				elseif(uidExistsManager($conn, $username)){
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION["useruid"] = $uidExists["Username"];
					$_SESSION["entity"] = "manager";
					$_SESSION['last_login_timestamp'] = time();

						//unset our attempt
					unset($_SESSION["attempt"]);

					header("location: ../homepage.php");
					exit();
				}
				elseif (uidExistsRider($conn, $username)) {
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION["useruid"] = $uidExists["Username"];
					$_SESSION["entity"] = "rider";
					$_SESSION['last_login_timestamp'] = time();

					$_SESSION["success"] = "Login successful";

						//unset our attempt
					unset($_SESSION["attempt"]);
					
					header("location: ../homepage.php");
					exit();
				}
				elseif (uidExistsStaff($conn, $username)) {
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION["useruid"] = $uidExists["Username"];
					$_SESSION["entity"] = "staff";
					$_SESSION['last_login_timestamp'] = time();

						//unset our attempt
					unset($_SESSION["attempt"]);
					
					header("location: ../homepage.php");
					exit();
				}
				else{
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION["useruid"] = $uidExists["Username"];
					$_SESSION["entity"] = "sender";
					$_SESSION['last_login_timestamp'] = time();

					$_SESSION["success"] = "Login successful";
						//unset our attempt
					unset($_SESSION["attempt"]);
					
					header("location: ../homepage.php");
					exit();
				}
			}
		}

		
	}


?>