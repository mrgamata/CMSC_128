<?php 
    include "../header.php";                 
	//include_once ".../css/login.css.php";
 ?>
<style type="text/css">
	
	/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 1000px) {
  .column {
    width: 100%;
  }
}

.formContainer{
	padding-top: 5%;
	padding-bottom: 10%;
}

.container2{
	width: 10%;
}
.container3{
	padding-top:0%;
}
.container1{
	padding-top: 5%;
	padding-right: 5%;
	padding-left: 5%;
}

</style>


<div class="login-page">

 <div class="formContainer">
 	<center>

 		<form action="includes/signup.inc.php" class = "register-form" method="post">
 			<div class="container1">
 				<h3 class="cursive-font">Create Account</h3>
 				<div class="container3">
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

 				</div>
 				<div class="container3">
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
 				</div>




 				<div class="row form-group">
 					<div class="container2">
 						<div class="col-md-12">
 							<input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign up">
 						</div>
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
 								echo "<p> New librarian account created! </p>";
 							}
 						}
 						?>
 					</div>
 				</center>	
 			</div>
 												
 	</center>
</div>	
</div>										
											
 

<?php 
	include "../footer.php";  
 ?>