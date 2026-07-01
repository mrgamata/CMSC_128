<?php
	session_start();
	if (!isset($_SESSION['username'] )) {
		header("location: ../index.php");
	}
?>
<?php
	if(isset($_POST["fname"])){
		// This part will only execute if $_POST variables are passed to this page
		$check = 1;		
		$fname= $_POST['fname'];
		$mname= $_POST['mname'];
		$lname= $_POST['lname'];
		$title =$_POST['title'];
		$pubplace =$_POST['pubplace'];
		$publisher =$_POST['publisher'];
		$copyright=$_POST['copyright'];
		$pages=$_POST['pages'];
		$id=$_POST['id'];
		$volume =$_POST['volume'];
		$remarks =$_POST['remarks'];
		$avail =$_POST['avail'];
		$borrowed =$_POST['borrowed'];

			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "library";
			$conn = mysqli_connect($server, $user, $pass, $db);
			if(!$conn) die(mysqli_error($conn));
			$query = "UPDATE books set author_fname = '$fname',author_mname = '$mname',author_lname = '$lname', title = '$title', pub_place = '$pubplace' , publisher = '$publisher', copyright = '$copyright' , pages = '$pages',volume = '$volume',remarks = '$remarks',times_borrowed = '$borrowed',avail = '$avail' where access_num = '$id'";
			mysqli_query($conn, $query);
			mysqli_close($conn);
			 echo "<script>";
   			echo "location='../Admin/adminBookInfo.php?id=$id'";
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
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	

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
							<li class="btn-cta"><a onclick="myFunction();"><span>Log out</span></a></li>	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
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
	<section class="editBookbanner">
		<div id="center">
			<div class="editBookform">
				<h3 class="cursive-font primary-color" style="font-size: 200%;text-align: center;">Edit Book #  <?php echo $_GET['id']; ?> 
				<?php
					if(!isset($_POST['id']) && !isset($_GET['id'])){
						header("Location: ./main.php");
						exit;
					}?></h3> 
					<div class="formna">
					
<form action="./editbooks.php" method="post">
	<!-- Use hidden input if you want to pass POST variables that are not inputted by user -->
	<input type="hidden" name="id" value=<?php echo  $_GET['id']; ?>>
	<?php
		$server = "localhost";
		$user = "root";
		$pass = "";
		$db = "library";
		$conn = mysqli_connect($server, $user, $pass, $db);
		if(!$conn) die(mysqli_error($conn));
		
		$query = "select * from books where access_num = ".$_GET['id'];
		$result = mysqli_query($conn,$query);
		$orig = mysqli_fetch_assoc($result);
		// Set original info of pet as default inputs
		echo "<span class='design'>Book title</span><input type='text' name='title' class='title'value='".$orig['title']."' required><br>";
		echo "<span class='design'>Author First Name:</span> <input type='text' name='fname'class='title' value='".$orig['author_fname']."' required><br>";
		echo "<span class='design'>Author Middle Initial: </span><input type='text' name='mname'class='title' value='".$orig['author_mname']."' ><br>";
		echo "<span class='design'>Author Last Name: </span><input type='text' name='lname'class='title' value='".$orig['author_lname']."' required><br>";
		echo "<span class='design'>Place of Publication: </span><input type='text' name='pubplace'class='title' value='".$orig['pub_place']."' required><br>";
		echo "<span class='design'>Publisher:</span> <input type='text' name='publisher'class='title' value='".$orig['publisher']."' required><br>";
		echo "<span class='design'>Copyright:</span> <input type='text' name='copyright'class='title' value='".$orig['copyright']."' required><br>"; ?>
      
		<?php 
		 if ($orig['volume']==0) {
					$vol=null;
				}else{
					$vol=$orig['volume'];
				}
		echo "<span class='design'>Number of Pages: </span><input type='number' class='title'name='pages' value='".$orig['pages']."' required><br>";
		echo "<span class='design'>Volume:</span> <input type='number' class='title'name='volume' value='$vol'><br>";
		echo "<span class='design'>  'Remarks:</span> ";?>
		 <select name='remarks' class="title" required>
        	 <?php 
        	  echo "<option value='".$orig['remarks']."' >".$orig['remarks']."</option>";
                   
	        		 if ($orig['remarks']=="Donation") {
                        echo "<option value='DEPED Issued' >DEPED Issued</option>";
                        echo "<option value='Others' >Others</option> ";
					}else if ($orig['remarks']=="DEPED Issued") {
						echo "<option value='Donation'>Donation</option>";
                        echo "<option value='Others' >Others</option> ";
					}else if ($orig['remarks']=="Others") {
                        echo "<option value='Donation'>Donation</option>";
                        echo "<option value='DEPED Issued' >DEPED Issued</option>";
					} else{
						echo "<option value='Donation'>Donation</option>";
                        echo "<option value='DEPED Issued' >DEPED Issued</option>";
                        echo "<option value='Others' >Others</option> ";
					}
                ?>
		</select><br><?php
		echo "<span class='design'>No. of times book was borrowed: </span><input type='number'class='title' name='borrowed' value='".$orig['times_borrowed']."' required><br>";
		echo "<span class='design'>Availability:</span>"; ?>
        <select name='avail' class="title" required>
        	 <?php 
	        		 if ($orig['avail']==1) {
						$av="Available";
					}else{
						$av="Borrowed";
					}
                    echo "<option value='".$orig['avail']."' >".$av."</option>";
                   
                      if($orig['avail']==1){
                        echo "<option value='0' >Borrowed</option>";
                      }else{
                        echo "<option value='1'>Available</option>";
                      }
                   
                ?>
		</select><br>
       <br>
	<div style="text-align: center;">
		<input type="submit" value="Edit Book info" class='btn btn-danger'>
	<?php echo "<button type='button' class='btn btn-danger'	 onclick=\"location.href='../Admin/adminBookInfo.php?id=" .$_GET['id']."'\" >Go back</button>"; ?>
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
  width: 65%;
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
	width: 30%;
}
</style>
<?php
include "../footer.php";                
?>