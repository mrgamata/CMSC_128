
<!DOCTYPE HTML>

<?php
	session_start();
	if (!isset($_SESSION['username'] )) {
		header("location: ../index.php");
	}
?>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Teodoro Hernaez NHS &mdash; Currently Borrowed books</title>
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
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>

	<div class="gtco-loader"></div>
	
	<div id="page">	
	<!-- <div class="page-inner"> -->
		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div id="gtco-logo"><a href="adminIndex.php">Hello Admin  </a></div>
					</div>
					<div class="col-xs-8 text-right menu-1">
						<ul>
							<li><a href="adminProfile.php">Profile</a></li>
							<li><a href="adminAbout.php">About</a></li>
							<li class="has-dropdown">
								<a href="#">Books</a>
								<ul class="dropdown">
									<li><a href="adminBooks.php">All books</a></li>
								<li><a href="adminCurrentlyBorrowedBooks.php">Currently Borrowed</a></li>
								<li><a href="adminTransactionHistory.php">Transaction History</a></li>
								</ul>
							</li>
							<li><a href="adminContact.php">Contact</a></li>
							<li><a class = "nav-link" href="./bookcart.php"> <i class='fa fa-shopping-cart'></i></a></li>
							<li class="btn-cta"><a onclick="myFunction();"><span>Log out</span></a></li>
						</ul>	
					</div>
				</div>
				
			</div>
		</nav>
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