
<?php
	session_start();
	if (!isset($_SESSION['username'] )) {
		header("location: ../index.php");
	}
?>


<!DOCTYPE html>
<!-- ADD NEW BOOK -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add New Book</title>
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

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
	<script src="sweetalert.min.js"></script>
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
							
							<li class="btn-cta"><a onclick="myFunction();"><span>Log out</span></a></li>
						</ul>	
					</div>
				</div>
				
			</div>
	</nav>
    </header>
    <script>
			function myFunction() {
				Swal.fire({
				icon: 'warning',
				title: 'Are you sure you want to log out?',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes',

				cancelButtonText: 'No'
			}).then((result) => {
			  if (result.isConfirmed) {
			  	
				Swal.fire({
				icon: 'success',
				title: 'Logout Successful',
				confirmButtonColor: '#d33',
				width: '40%',
				}).then((result) => {
					if (result.isConfirmed) {
						location='../includes/logout.inc.php';
					}	else{
						
						location='../includes/logout.inc.php';
					}
			});
					}
			});

			
			}
		</script>
		<style type="text/css">
			
			.swal2-popup {
			  font-size: 1.6rem !important;
			  font-family: Georgia, serif;
			}
			.swal2-popup .swal2-styled:focus {
			    box-shadow: none !important;
			}
		</style>
	<section class = "addBookbanner">
		<div id="center">

			<div class="addBookform">

				<h5 class="cursive-font primary-color" style="text-align: center;font-size: 300%" >Welcome to Library System</h5>
				<h3 class="cursive-font primary-color" style="font-size: 200%">Add a New Book</h3>
				<div class="adform">
				<?php
					$conn = mysqli_connect("localhost","root","","library");
						if(isset($_POST["title"])){
						// This part will only execute if $_POST variables are passed
						$check = 1;
						$access_num = $_POST["access_num"];
						$title = $_POST["title"];
						$author_fname =  $_POST["author_fname"];
						$author_mname = $_POST["author_mname"];
						$author_lname = $_POST["author_lname"];
						$pub_place = $_POST["pub_place"];
						$publisher = $_POST["publisher"];
						$copyright = $_POST["copyright"];
                        $pages = $_POST["pages"];
                        $volume = $_POST["volume"];
                        $remarks = $_POST["remarks"];
                        $times_borrowed = $_POST["times_borrowed"];
                        $avail = $_POST["avail"];
						
						$server = "localhost:3306";
							$user = "root";
							$pass = "";
							$db = "library";
							$conn = mysqli_connect($server, $user, $pass, $db);
							if(!$conn) die(mysqli_error($conn));
							$sql = "SELECT * FROM books where access_num = ".$access_num;
							$result = mysqli_query($conn,$sql);
							if(mysqli_num_rows($result) > 0){
								echo "<script>
				            	 Swal.fire({
								  icon: 'error',
								  title: 'Accesion Number was already used by other book',
			  					  text: 'Please enter a different accession number ',
			  					   confirmButtonColor: '#d33',
			   					  width: '40%'
								});
								
				     		</script>";
							}else{
							$query = "insert into books values ('$access_num', '$title', '$author_fname', '$author_mname', '$author_lname', '$pub_place', '$publisher', '$copyright', '$pages', '$volume', '$remarks', '$times_borrowed', '$avail')";
							mysqli_query($conn, $query);
							$ids=mysqli_insert_id($conn);
							?> <script>
					             Swal.fire({
								  icon: 'success',
								  title: 'Book successfully added to the library database',
									   confirmButtonColor: '#d33',
									  width: '40%'
								}).then((result) => {
										if (result.isConfirmed) {
											location='../Admin/adminBooks.php';
										}	else{
											
											location='../Admin/adminBooks.php';
										}
								});
								</script>

								<?php
						}
						
	}
	
?>
<form action="addBook.php" method="post" id="addbok" style="color: black"  >
    <input type="number" name="access_num"  id="access_num" class="num" placeholder="Access Number" oninput="ablebutton();" required>
    <input type="text" name="title" id="title"  class="title" placeholder="Title" oninput="ablebutton();" required><br>
    <input type="text" name="author_fname" id="fname"  class="fname" placeholder="Author's First Name" oninput="ablebutton();" required>
    <input type="text" name="author_mname"    class="mname" placeholder="Author's Middle Name" oninput="ablebutton();">
    <input type="text" name="author_lname" id="lname"  class="fname" placeholder="Author's Last Name" oninput="ablebutton();" required><br>
    <input type="text" name="publisher" id="pub"  class="place" placeholder="Publisher" oninput="ablebutton();" required>
    <input type="text" name="pub_place" id="place"  class="place" placeholder="Publication Place" oninput="ablebutton();" required><br>
    <input type="number" class="cright" id="cright"  placeholder="Copyright" oninput="ablebutton();" name="copyright" >
    <input type="number" name="pages" id="pages"  class="cright" placeholder="Pages" oninput="ablebutton();" required>
    <input type="number" name="volume" class="cright" placeholder="Volume" ><br>
    <input type="number" name="times_borrowed" id="tb"  class="tb" placeholder="Times Borrowed" oninput="ablebutton();"  required><br>
    <select name='remarks' id="rm"  class="place"  onchange="ablebutton();"  style="color: gray">
        <option value='' disabled selected hidden > Remarks</option>
        <option value='Donation'>Donation</option>
        <option value='DEPED Issued' >DEPED Issued</option>
        <option value='Others' >Others</option> 
    </select>
    <select name='avail' id="avail"  class="place" onchange="ablebutton();"style="color: gray">
        <option value='' disabled selected hidden > Availability</option>
        <option value='1'>Available</option>
        <option value='0' >Borrowed</option> 
    </select><br>
    <br>
	<input type="button" id="submits" class="btn btn-danger"value="Add new Book" onclick="submitForm();" disabled> 
	<button type="button" class="btn btn-danger" onclick="location.href='../Admin/AdminBooks.php'">Go back </button>
</form>
</div>

</section>


<script>
function hidebutton() {
  var z = document.getElementById("buttonadd");
  z.style.display = "none";
  
}
function ablebutton(){

	var a = document.getElementById('access_num').value;
	var b = document.getElementById('title').value.length;
	var c = document.getElementById('pub').value.length;
	var d = document.getElementById('fname').value.length;
	var e = document.getElementById('lname').value.length;
	var f = document.getElementById('cright').value;
	var g = document.getElementById('pages').value;
	var h = document.getElementById('tb').value;
	var i = document.getElementById('place').value.length;
	var j = document.getElementById('rm').value.length;
	var k = document.getElementById('avail').value.length;     
	if (k>0){
		document.getElementById('avail').style.color = "#000";   
	}

	if (j>0){
		document.getElementById('rm').style.color = "#000";
	}
	if ( (a>0)&& (b>0) && (c>0)&& (d>0)&& (e>0) && (f>0)&& (g>0)&& (h>-1) && (i>0)&& (j>0) && (k>0)){
	    document.getElementById('submits').disabled = false;
    }
    else{
	    document.getElementById('submits').disabled = true;
    }
}
function submitForm() {
		  Swal.fire({
			 title: 'Add this book to the library database?',
			text: "",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
			}).then((result) => {
			  if (result.isConfirmed) {
			document.getElementById("addbok").submit();
			  	
			  }
			});
			return false;
		}
</script>
</body>

<style>
    .addBookbanner {
	width: 100%;
    height: calc(100vh - 100px);
    background-image: url(../images/school_building.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    display: table;
    padding-bottom: 5%;
}
.addBookform{

	position: relative;
	width: 50%;
	box-shadow: 0 0 4px 0 black;
	border-radius: 20px;
	background: white;
	padding: 20px;
	margin: 8% auto 0;
	text-align: center;
}
.addBookform h1 {
	font-family: 'Ghino';
    color: black;
    text-shadow: 1px 1px 3px white;
    font-size: 25px;
}
.addBookform h2 {
	font-family: 'Ghino-light';
    color: black;
    text-shadow: 1px 1px 3px white;
    font-size: 20px;
}
.formna {
	font-family: 'Sans-serif';
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
.adform{
	width: 100%;
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
  width: 60%;
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

</style>
<?php
include "../footer.php";                
?>