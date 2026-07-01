<?php
	session_start();
	if (!isset($_SESSION['username'] )) {
		header("location: ../index.php");
	}
?>
<?php
	if(isset($_POST["staff"])){
		// This part will only execute if $_POST variables are passed to this page
		$check = 1;		
		$staff= $_POST['staff'];
		$jgrad= $_POST['jgrad'];
		$sgrad= $_POST['sgrad'];
		$id =$_POST['id'];
			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "library";
			$conn = mysqli_connect($server, $user, $pass, $db);
			if(!$conn) die(mysqli_error($conn));
			$query = "UPDATE facts set jgrad = '$jgrad',sgrad = '$sgrad',staff = '$staff'   where establish = '$id'";
			mysqli_query($conn, $query);
			mysqli_close($conn);
			 echo "<script>";
   			echo "location='../Admin/adminIndex.php'";
    		echo "</script>";
			exit;
		}
?>
<!DOCTYPE html>
<!-- CUSTOMER DATABASE EDIT -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EDIT BOOK INFORMATION</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="../css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../css/magnific-popup.css">

	<!-- Bootstrap DateTimePicker -->
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<header>
	<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div id="gtco-logo"><a href="../Admin/adminIndex.php">Hello Admin  </a></div>
					</div>
					<div class="col-xs-8 text-right menu-1">
						<ul>
							<li><a href="../Admin/adminAbout.php">About</a></li>
							<li class="has-dropdown">
								<a href="#">Books</a>
								<ul class="dropdown">
									<li><a href="../Admin/adminBooks.php">All books</a></li>
								<li><a href="../Admin/adminCurrentlyBorrowedBooks.php">Currently Borrowed</a></li>
								<li><a href="../Admin/adminTransactionHistory.php">Transaction History</a></li>
								</ul>
							</li>
							<li><a href="../Admin/adminContact.php">Contact</a></li>
							<li><a class = "nav-link" href="../Admin/bookcart.php"> <i class='fa fa-shopping-cart'></i></a></li>
							<li class="btn-cta"><a href="../includes/logout.inc.php"><span>Log out</span></a></li>
						</ul>	
					</div>
				</div>
				
			</div>
	</nav>
</header>
	<section class="editBookbanner">
		<div id="center">
			<div class="editBookform">
				<h3 class="cursive-font primary-color" style="font-size: 200%;text-align: center;">Edit Facts  
				</h3> 
					<div class="formna">
				
<form action="./editfacts.php" method="post">
	<!-- Use hidden input if you want to pass POST variables that are not inputted by user -->
	<input type="hidden" name="id" value=<?php echo  $_GET['id']; ?>>
	<?php
		$server = "localhost";
		$user = "root";
		$pass = "";
		$db = "library";
		$conn = mysqli_connect($server, $user, $pass, $db);
		if(!$conn) die(mysqli_error($conn));
		
		$query = "select * from facts where establish = ".$_GET['id'];
		$result = mysqli_query($conn,$query);
		$orig = mysqli_fetch_assoc($result);
		// Set original info of pet as default inputs
		echo "<span class='design'>Number of Junior High School Graduates</span> <input type='text' name='jgrad'class='title' value='".$orig['jgrad']."' required><br>";
		echo "<span class='design'>Number of Senior High School Graduates</span><input type='text' name='sgrad'class='title' value='".$orig['sgrad']."' ><br>";
		echo "<span class='design'>Number of Teachers and Staff</span><input type='text' name='staff'class='title' value='".$orig['staff']."' required><br>";
		?>
       <br>
	<div style="text-align: center;">
		<input type="submit" value="Edit Facts" class='btn btn-danger'>
	<?php echo "<button type='button' class='btn btn-danger'	 onclick=\"location.href='../Admin/adminindex.php'\" >Go back</button>"; ?>
	</div>
</form>
 
			</div>
			</div>
		</div>
<br>
	</section>

</body>
</html>
<script>
function hidebutton() {
  var z = document.getElementById("buttonadd");
  z.style.display = "none";
  
}
</script>
</body>
</html>

<style>
    .editBookbanner {
	width: 100%;
    height: calc(100vh - 100px);
    background-image: url(../images/school_building.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    display: table;
}
.editBookform{
	position: relative;
	width: 50%;
	box-shadow: 0 0 4px 0 black;
	border-radius: 20px;
	background: white;
	padding: 20px;
	margin: 8% auto 0;
}
.editBookform h1 {
    color: black;
    text-shadow: 1px 1px 3px white;
    font-size: 25px;
}
.editBookform h2 {
    color: black;
    text-shadow: 1px 1px 3px white;
    font-size: 20px;
}
.formna {
    color: black;
    text-shadow: 1px 1px 3px white;
    font-size: 15px;
}
.formna input {
    border-radius: 20px;
}
.formna button {
    border-radius: 20px;
}


.fname{
  width: 35%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}
.mname{
  width: 20%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}.tb{
  width: 90%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}
.cright{
  width: 30%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}
.place{
  width: 45%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}
.title{
  width: 30%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}.num{
  width: 30%;
  padding: 10px;
  margin: 10px 0;
  border: 2px solid black;
  text-align:left;
  border-radius: 20px;
  background: #E8E8E8;
}
.design {
	font-size: 120%;
	margin-top: 5px;
	padding-left: 2%;
	display: inline-block;
	width: 50%;
}
</style>
<?php
include "../footer.php";                
?>