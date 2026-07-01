<?php

if (isset($_POST["submit"])) {

	$lastName = $_POST["lastName"];
	$firstName = $_POST["firstName"];
	$middleInitial = $_POST["middleInitial"];
	$contactNum = $_POST["contactNum"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdrepeat"];

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if (emptyInputSignup($lastName, $firstName, $middleInitial, $contactNum, $email, $username, $pwd, $pwdRepeat) !== false) {
		header("location: ../index.php?error=emptyinput");
		exit();
	}
	if (invalidUid($username) !== false) {
		header("location: ../index.php?error=invaliduid");
		exit();
	}
	if (invalidEmail($email) !==false) {
		header("location: ../index.php?error=invalidemail");
		exit();
	}
	if (invalidNum($contactNum) !== false) {
		header("location: ../index.php?error=invalidnumber");
		exit();
	}
	if (pwdMatch($pwd, $pwdRepeat) !== false) {
		header("location: ../index.php?error=passwordsdontmatch");
		exit();
	}
	if (uidExists($conn, $username) !== false) {
		header("location: ../sindex.php?error=usernametaken");
		exit();
	}

	createUser($conn, $lastName, $firstName, $middleInitial, $contactNum, $email, $username, $pwd);

}
else{
	header("location: ../index.php");
	exit();
}


?>