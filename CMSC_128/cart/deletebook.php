
<?php
if(isset($_GET["id"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "library";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));
	$id = $_GET['id'];
	$query ="delete from cart where access_num = '$id'  " ;
	mysqli_query($conn, $query);
	mysqli_close($conn);
}
	header('Location: ../Admin/bookcart.php');
exit;
?>
