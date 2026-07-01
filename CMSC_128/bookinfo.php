
<!DOCTYPE html>
<!-- BOOK INFO PAGE -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Book Information</title>
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
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Bootstrap DateTimePicker -->
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

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
						<div id="gtco-logo"><a href="index.php">Student  </a></div>
					</div>
					<div class="col-xs-8 text-right menu-1">
						<ul>
							<li><a href="about.php">About</a></li>
							<li class="has-dropdown">
								<a href="books.php">Books</a>
								<ul class="dropdown">
									<li><a href="books.php">All books</a></li>
								<li><a href="currentlyBorrowedBooks.php">Currently Borrowed</a></li>
								</ul>
							</li>
							<li><a href="contact.php">Contact</a></li>
							<li class="btn-cta"><a href="index.php"><span>Log in</span></a></li>
						</ul>	
					</div>
				</div>
				
			</div>
	</nav>
</header>

<div class="gtco-section">   
		<div class="gtco-container">
			<div class="row" style="">
					<br>
					<br>
					<br>
					<br>
					<br>
					<h2 class="cursive-font primary-color">Book Information</h2>
                    <br>

					 <div style=" display: flex; flex-direction: row; flex-wrap: wrap;">
						<div style="flex: 1 1 0;">
							<?php
							$server = "localhost:3306";
							$user = "root";
							$pass = "";
							$db = "library";
							$conn = mysqli_connect($server, $user, $pass, $db);
							if(!$conn) die(mysqli_error($conn));
							
							$query = "select * from books where access_num = ". $_GET["id"];
							$result = mysqli_query($conn,$query);
							if(mysqli_num_rows($result) > 0){
								$row = mysqli_fetch_assoc($result);
								echo "<table style =\"width:90%;color:black;\">
										<thead>
										  <tr>
										    <th colspan='2' style=\"font-size:175%;\">".$row['title']."</th>
										  </tr>
										</thead>
										<tbody>
										  <tr>
										    <td>Accession Number</td>
										    <td>".$row['access_num']." </td>
										  </tr>
										  <tr>
										    <td>Author</td>
										    <td>".$row['author_fname']." ".$row['author_mname']." ".$row['author_lname']."</td>
										  </tr>
										  <tr>
										    <td>Place of Publication</td>
										    <td>".$row['pub_place']." </td>
										  </tr>
										  <tr>
										    <td>Publisher</td>
										    <td> ".$row['publisher']."</td>
										  </tr>
										  <tr>
										    <td>Copyright</td>
										    <td>".$row['copyright']." </td>
										  </tr>
										  <tr>
										    <td>Pages</td>
										    <td> ".$row['pages']."</td>
										  </tr>
										  <tr>
										    <td>Volume</td>";

										    if ($row['volume']==0) {
											echo "<td> </td>";
										}else{
											echo "<td>".$row['volume']."</td>";
										}
										echo "
										  </tr>
										  <tr>
										    <td>Remarks</td>
										    <td>".$row['remarks']."</td>
										  </tr>
										  <tr>
										    <td>No. times book was Borrowed</td>
										    <td> ".$row['times_borrowed']."</td>
										  </tr>
										  <tr>
										    <td>Availability</td>";
										    if ($row['avail']==1) {
											echo "<td>Available</td>";
										}else{
											echo "<td>Borrowed</td>";
										}
										  echo"</tr>
										</tbody>
										</table><br>";

										
							}
							?>
						</div>
						<div style="flex: 100%;  order: 3;text-align: center; ">
							<?php 
								$is=$row['access_num'];
								echo "<button class=\"btn btn-danger\" onclick=\"history.back()\"> Go back </button>";
							?>
						</div>
						 <script>
							function myFunction($ID) {
								var x = $ID;
							  if (confirm("Are you sure you want to delete this book?") == true) {
							    location='../delete/deletebook.php?id='+ x;
							  } else {
							    location='./adminBookInfo.php?id='+x;
							  }
							}
						</script>



						<div style="flex: 1 1 0;">
							
							<?php
								
							
							$query = "select * from books natural join past_transaction natural join borrower where access_num = ". $_GET["id"];
							$result = mysqli_query($conn,$query);
							 echo "<table class = \"sortable\"style =\"width:90%;color:black;\">
							 <thead>
							  <tr>
							    <th colspan='3'style=\"font-size:175%;\">Previous Borrowers</th>
							  </tr>
							</thead>
	                        <tr>
	                            <th>Borrower's Name</th>
	                            <th>Date Borrowed </th>
	                            <th>Date Returned</th>
	                        </tr>";
							if(mysqli_num_rows($result) > 0){
	                       
	                        while($row = mysqli_fetch_assoc($result)){
	                            echo "<tr class = \"item\">
	                                <td>".$row['b_fname']." ".$row['b_mname']." ".$row['b_lname']."</td>
	                                <td>".$row['borrow_date']."</td>
	                                <td>".$row['return_date']."</td>";
	                            echo"</tr>";
	                        }
	                        echo "</table>";
		                    }else{
		                    	
	                        echo "</table>";
		                    }
							?>
						</div>
				
			</div>
		</div>
	</div>
</body>


<style type="text/css">
	body{
	font-family: georgia;
	}
	#center{
		margin: auto;
		width: 90%;
		text-align: center;

	}
	table, th, td {
	  border: 1px solid black;
	  padding: 7pt;
	  margin: auto;
	  border-collapse: collapse;
	  text-align: center;
	}
	h1,h2{
		text-align: center;
	}
	.add{
		padding: 15px;
	  	text-align: center;
	  	border: 1px solid black;
	}
	.emp{
		font-size:15px;
	}
</style>
<?php
include "studentFooter.php";                
?>