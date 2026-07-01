
<!-- LOG IN SESSION -->
<?php 
session_start();
	if(isset($_SESSION["attempt_again"])){
		$now = time();
		if($now > $_SESSION["attempt_again"]){
			unset($_SESSION["attempt"]);
			unset($_SESSION["attempt_again"]);
		}
	}
 ?>

<?php
include "studentHeader.php";                
?>

<style type="text/css">
	
	/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}

</style>

	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/index.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">Teodoro Hernaez National High School</a></span>
							<h1 class="cursive-font">Shape a better future !</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">

											<?php 
												$host = "localhost"; /* Host name */
												$user = "root"; /* User */
												$password = ""; /* Password */
												$dbname = "library"; /* Database name */

												$conn = mysqli_connect($host, $user, $password,$dbname);
												// Check connection
												if (!$conn) {
												  die("Connection failed: " . mysqli_connect_error());
												}

												$sql = "SELECT * FROM account;";
												$stmt = mysqli_stmt_init($conn); 

												if (!mysqli_stmt_prepare($stmt, $sql)) {
													header("location: ../signup.php?error=stmtfailed1");
													exit();
												}
												
												mysqli_stmt_execute($stmt);

												$resultData = mysqli_stmt_get_result($stmt);
												$row = mysqli_fetch_array($resultData, MYSQLI_ASSOC);


												$sql = "SELECT * FROM account;";
												$stmt = mysqli_stmt_init($conn); 
												if (!mysqli_stmt_prepare($stmt, $sql)) {
													header("location: ../signup.php?error=stmtfailed");
													exit();
												}
												mysqli_stmt_execute($stmt);

												$resultData = mysqli_stmt_get_result($stmt);

												if ($row = mysqli_fetch_assoc($resultData)) {
											?>	
												<h3 class="cursive-font">Sign In</h3>
												<form action="includes/login.inc.php" class = "register-form" method="post">
													<div class="row form-group">
														<div class="col-md-12">
															<label for="activities">Librarian</label>
															<input type="text" name="username" class="form-control" placeholder="Username...">
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-12">
															<label for="password-start">Password</label>
															<input type="password" name="pwd" id="password" class="form-control" placeholder="Password...">
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-12">
															<input type="submit" name="submit" class="btn btn-primary btn-block" value="Log in">
														</div>
													</div>

													<center>
											 	<div>
												 	<?php 
													 if (isset($_GET["error"])) {
													 	if ($_GET["error"] == "emptyinput") {
													 		echo "<p> Fill in all Fields!</p>";
													 		if (isset($_SESSION["attempt"])) {
													 			echo "Attempt Remaining:";
													 			echo(5-$_SESSION["attempt"]);
													 		}
													 		if (isset($_SESSION["attempt_again"])) {
													 			echo("<br>");
													 			echo "Try again in: ";
													 			echo($_SESSION["attempt_again"]-time());
													 		}


													 		
													 	}
													 	else if ($_GET["error"] == "wronglogin") {
													 		echo "<p> Incorrect Username or Password! </p>";
													 		if (isset($_SESSION["attempt"])) {
													 			echo "Attempt Remaining:";
													 			echo(5-$_SESSION["attempt"]);
													 		}
													 		if (isset($_SESSION["attempt_again"])) {
													 			echo("<br>");
													 			echo "Try again in: ";
													 			echo($_SESSION["attempt_again"]-time());
													 		}

													 	}
													 }
													 ?>
											 	</div>
											 </center>


											<?php 
												}
												else{
											?>

												<h3 class="cursive-font">Sign Up</h3>
												<form action="includes/signup.inc.php" class = "register-form" method="post">

												<div class="column">
													<div class="row form-group">
														<div class="col-md-12">
															<input type="text" name="lastName" class="form-control" placeholder="Last Name...">
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-12">
															<input type="text" name="firstName" id="password" class="form-control" placeholder="First Name...">
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-12">
															<input type="text" name="middleInitial" class="form-control" placeholder="Middle Initial...">
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-12">
															<input type="text" name="contactNum" class="form-control" placeholder="Contact Number...">
														</div>
													</div>
												  </div>
												  <div class="column">
														<div class="row form-group">
															<div class="col-md-12">
																<input type="text" name="email" class="form-control" placeholder="Email...">
															</div>
														</div>
														<div class="row form-group">
															<div class="col-md-12">
																<input type="text" name="username" class="form-control" placeholder="Username...">
															</div>
														</div>
														<div class="row form-group">
															<div class="col-md-12">
																<input type="password" name="pwd" class="form-control" placeholder="Password...">
															</div>
														</div>
														<div class="row form-group">
															<div class="col-md-12">
																<input type="password" name="pwdrepeat" class="form-control" placeholder="Repeat Password...">
															</div>
														</div>
												  </div>

													
													
													<div class="row form-group">
														<div class="col-md-12">
															<input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign up">
														</div>
													</div>

													 <center>
												 	<div>
													 	<?php 
														 if (isset($_GET["error"])) {
														 	if ($_GET["error"] == "emptyinput") {
														 		echo "<p> Fill in all Fields!</p>";
														 	}
														 	else if ($_GET["error"] == "invaliduid") {
														 		echo "<p> Choose a proper username! </p>";
														 	}
														 	else if ($_GET["error"] == "invalidemail") {
														 		echo "<p> Choose a proper email! </p>";
														 	}
														 	else if ($_GET["error"] == "passwordsdontmatch") {
														 		echo "<p> Passwords doesn't match! </p>";
														 	}
														 	else if ($_GET["error"] == "stmtfailed") {
														 		echo "<p> Something went wrong, try again </p>";
														 	}
														 	else if ($_GET["error"] == "usernametaken") {
														 		echo "<p> Username is already taken! </p>";
														 	}
														 	else if ($_GET["error"] == "invalidemail") {
														 		echo "<p> Email invalid </p>";
														 	}
														 	else if ($_GET["error"] == "invalidnumber") {
														 		echo "<p> Input a valid number </p>";
														 	}
														 	else if ($_GET["error"] == "none") {
														 		echo "<p> You have been signed up! </p>";
														 		echo "<script>
													            	 alert('Account Created');
													     		</script>";
														 	}
														 }
														 ?>
												 	</div>
 </center>
											<?php 
												}
											?>
											

											</form>	
										</div>	
									</div>
								</div>
							</div>
						</div>
						<!-- LOG IN PHP -->

					</div>
				</div>
			</div>
		</div>
	</header>

	
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Education</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/JHS.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/JHS.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Junior High School</h2>
							<p>Teodoro Hernaez National High School welcomes Junior High School Students and transferees.</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/SHS.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/SHS.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Senior High School</h2>
							<p>Teodoro Hernaez National High School welcomes Senior High School Students and transferees. We offer 4 academic strands specifically Science, Technology, Engineering and  Mathematics (STEM), Accountancy, Business and Management (ABM), Humanities and Social Sciences (HUMSS), and General Academic Strand (GAS).</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="images/ELEM.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/ELEM.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Special Programs</h2>
							<p>Teodoro Hernaez National High School offers special programs like Special Math Class (SMC), Alternative Learning System Balik-  Paaralan para sa Out-of-School Adults ( ALS BP-OSA), and Special Education (SPED)</p>
						</div>
					</a>
				</div>

			</div>
		</div>
	</div>

	<div class="gtco-cover gtco-cover-sm" style="background-image: url(images/beacon.jpg)"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>&ldquo;Beacon of Wisdom and Value&rdquo;</h1>
					<p>TEODORO HERNAEZ NATIONAL HIGH SCHOOL</p>
				</div>	
			</div>
		</div>
	</div>

	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2 class="cursive-font primary-color">Fun Facts</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<?php 
							$server = "localhost:3306";
		                    $user = "root";
		                    $pass = "";
		                    $db = "library";
		                    $results_per_page = 10;
		                    $conn = mysqli_connect($server, $user, $pass, $db);
		                    if(!$conn) die(mysqli_error($conn));
							$sql = "SELECT * FROM facts ";
							$result = mysqli_query($conn,$sql);
					 		if(mysqli_num_rows($result) > 0){ 
		                        while($row = mysqli_fetch_assoc($result)){
		                             echo "<span class=\"counter js-counter\" data-from=\"0\" data-to=".$row['establish']." data-speed=\"5000\" data-refresh-interval=\"50\">1</span>";
		                     
						?>
						
						<span class="counter-label">Year Started</span>

					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<?php echo "<span class=\"counter js-counter\" data-from=\"0\" data-to= ".$row['jgrad']."  data-speed=\"5000\" data-refresh-interval=\"50\">1</span>"; ?>
						<span class="counter-label">Total Number of Graduated Junior High School Students</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<?php echo "<span class=\"counter js-counter\" data-from=\"0\" data-to= ".$row['sgrad']."  data-speed=\"5000\" data-refresh-interval=\"50\">1</span>"; ?>
						<span class="counter-label">Total Number of Graduated Senior High School Students</span>

					</div>
				</div>	
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						
						<?php echo "<span class=\"counter js-counter\" data-from=\"0\" data-to= ".$row['staff']."  data-speed=\"5000\" data-refresh-interval=\"50\">1</span>"; ?>
						<span class="counter-label">Total Number of current Teachers and Staff</span>
					</div>
				</div>
			</div>
		</div><?php 
	
		?>
		
		
	</div>

				<?php 
				   } 
		                    }
				?>

	<?php
	include "studentFooter.php";                
	?>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<script src="js/moment.min.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>


	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>