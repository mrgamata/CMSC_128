<?php
if(isset($_GET["id"])){
	$server = "localhost:3306";
	$user = "root";
	$pass = "";
	$db = "library";
	$conn = mysqli_connect($server, $user, $pass, $db);
	if(!$conn) die(mysqli_error($conn));
	$id = $_GET['id'];
	$query3 ="select * from cart where access_num = '$id' " ;
	$result2 = mysqli_query($conn,$query3);
	$row2 = mysqli_fetch_assoc($result2);
	if ($row2>0){
		mysqli_close($conn);
		?>
		<script>
			var x =    "<?= $id ?>";
		  	location='../Admin/adminBooks.php?exist=1&acc=' +x;
     </script>

		<?php

	}else{
		$query ="select * from books where access_num = '$id' " ;
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);
		$access_num=$row['access_num'];
		$title=$row['title'];
		$query2 = "insert into cart values ('$access_num','$title')";
		mysqli_query($conn, $query2);
		mysqli_close($conn);
		?>
		<script>
			var x =    "<?= $id ?>";
		  	location='../Admin/adminBooks.php?exist=0&acc=' +x;
     </script>

		<?php

	}

	
}
	
exit;
?>