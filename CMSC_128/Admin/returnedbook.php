<?php
	session_start();
	if (!isset($_SESSION['username'] )) {
		header("location: ../index.php");
	}
?>
<?php
session_start();
?>
<?php
if(isset($_GET["id"])){
	$id = $_GET['id'];
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "library";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));
	$query="select * from transaction where tran_id = $id";
	$result = mysqli_query($conn,$query); 
	$row = mysqli_fetch_assoc($result);
	$bid=$row['b_id'];
	$bookid=$row['access_num'];
	$bdate=$row['borrow_date'];
	$rdate = date("Y-m-d");
	$query3="insert into past_transaction values ('$id','$bid','$bookid','$bdate','$rdate')";
	mysqli_query($conn, $query3);
	$query4 = "UPDATE books set avail = 1 where access_num= '$bookid'";
	mysqli_query($conn, $query4);
	$query5 = "delete from transaction where tran_id = '$id'";
	mysqli_query($conn, $query5);
	mysqli_close($conn);
}
			header('Location: ./adminTransactionHistory.php');
exit;
?>