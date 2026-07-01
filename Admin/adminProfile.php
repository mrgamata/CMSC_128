<?php
	include "../header.php";


?>
	<style type="text/css">
		h4{
			font-size: 30px !important;
			padding: -15px;
		}
		h5{
			font-size: 170% !important;
			line-height: 0.1;
		}
		h6{
			font-size: 150% !important;
			color: black;
			padding-left: 5%;
			padding-top: 1%;
			padding-right: 1%;
			padding-bottom: 1%;
			border: 1px solid black;
			width: 80%;
			border-radius: 5px;
		}

		#pwchange{
			background-color: #301010;
			border: 2px solid rgba(255, 255, 255, 0.5);
  			padding: 4px 20px;
  			color: #fff;
  			display: -moz-inline-stack;
  			display: inline-block;
  			zoom: 1;
  			*display: inline;
  			-webkit-transition: 0.3s;
  			-o-transition: 0.3s;
  			transition: 0.3s;
  			-webkit-border-radius: 4px;
  			-moz-border-radius: 4px;
  			-ms-border-radius: 4px;
  			border-radius: 4px;
		}
		.title{
		  width: 80%;
		  padding: 10px;
		  margin: 10px 0;
		  border: 2px solid black;
		  font-size: 150% !important;
		  text-align:left;
		  border-radius: 20px;
		  background: #E8E8E8;
		}
	</style>

	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-color: #602020" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
						<br><br><br><br><br><br>
						<h1 class="cursive-font">Hello! <?php echo $_SESSION['username']?></h1>	
					</div>
				</div>
			</div>
		</div>
	</header>

	
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row" style="text-align: center;" id="info"> 
				<h2 class="cursive-font">Account Information</h2> <br>
				<?php 
					$server = "localhost:3306";
	                $user = "root";
	                $pass = "";
	                $db = "library";
	                $conn = new mysqli($server, $user, $pass, $db);
	                if ($conn->connect_error) {
						die($conn->connect_error);
					}

					$sql = $conn->prepare("SELECT * FROM account where username=?");
					$sql->bind_param("s", $_SESSION['username']);
					$sql->execute();
					$result = $sql->get_result();
					if(mysqli_num_rows($result) > 0){
						$row = $result->fetch_assoc();
						$sql2 = $conn->prepare("SELECT * FROM user where username=?");
						$sql2->bind_param("s", $_SESSION['username']);
						$sql2->execute();
						$result2 = $sql2->get_result();
						if(mysqli_num_rows($result2) > 0){
							$row2 = $result2->fetch_assoc();
						
					
				?>
				<div style=" display: flex; flex-direction: row; flex-wrap: wrap;text-align: center; color: black" >
					<div style="flex: 1 1 0;text-align: left;">
							<h5 class="cursive-font"> First Name </h5> 
							<h6><?php echo $row2['user_fName'];?></h6>
							 <br>
							<h5 class="cursive-font"> Last Name </h5>
							 <h6><?php echo $row2['user_lName'];?></h6>
							 <br>
							<h5 class="cursive-font"> Email </h5> 
							 <h6><?php echo $row['user_email'];?></h6>
							 <br>
					</div>
					<div style="flex: 100%;  order: 3;text-align: left;">					
						<?php 
							echo "<button class=\"btn btn-danger\"  onclick=\"location.href='./changePassword.php'\"  > Change Password</button>";
							echo "<button class=\"btn btn-danger\" onclick=\"showform()\" id='edit' > Edit Account Information </button>";
						?>
					</div>
					<div style="flex: 1 1 0;text-align: left;">
						<h5 class="cursive-font"> Middle Initial </h5>
							 <h6><?php echo $row2['user_mName'];echo "&nbsp;" ?></h6>
							 <br>
						<h5 class="cursive-font"> Username </h5>
							 <h6><?php echo $row2['username'];?></h6>
							 <br>
						<h5 class="cursive-font"> Phone Number </h5>
							 <h6>0<?php echo $row2['user_cNum'];?></h6>
							 <br>
					</div> 

						<?php
								}	
							}
						?>		
				</div> 
			</div>
			<div class="row" style="text-align: center;display: none "id="info2"> 
					<h2 class="cursive-font">Account Information</h2> <br>
				<div style=" display: flex; flex-direction: row; flex-wrap: wrap;text-align: center; color: black; ">
						<div style="flex: 1 1 0;text-align: left;">
							
							<form action="adminProfile.php" method="POST" id="editinfo">
								<?php echo "<input type='hidden' name='id1'   value='". $row2['user_ID']."' >";?>
								<?php echo "<input type='hidden' name='id2'   value='". $row['account_ID']."' >";?>
								<h5 class="cursive-font"> First Name </h5> 
								<?php echo "<input type='text' name='fname' id='fname' class='title' value='". $row2['user_fName']."' oninput='submitbutton();' required><br>";?>
								 <br>
								<h5 class="cursive-font"> Last Name </h5>
								<?php echo "<input type='text' name='lname' id='lname' class='title' value='". $row2['user_lName']."' oninput='submitbutton();' required><br>";?>
								 <br>
								<h5 class="cursive-font"> Email </h5> 
								<?php echo "<input type='text' name='email' id=\"email\"  oninput='check_email();' class='title' value='". $row['user_email']."' required><br>";?>
								 <br>
						</div>
						<div style="flex: 100%;  order: 3;text-align: left;">
							<p style="color: red" id="message2"></p>
							<p style="color: red" id="message3"></p>
					
							<?php 
							echo "<button class=\"btn btn-danger\"  type=\"button\" name=\"submits\"   onclick=\"submitForm();\"> Save Changes </button>";
						?>
						</div>
						<div style="flex: 1 1 0;text-align: left;">
							<h5 class="cursive-font"> Middle Initial </h5>
							<?php echo "<input type='text' name='mname'  id='mname' class='title' value='". $row2['user_mName']."' oninput='submitbutton();' required><br>";?>
								 <br>
							<h5 class="cursive-font"> Username </h5>
								<?php echo "<input type='text' name='username' id='username' class='title' value='". $row2['username']."' oninput='submitbutton();' required><br>";?>
								 <br>
							<h5 class="cursive-font"> Phone Number </h5>
								<?php echo "<input type='text' name='cnum' id='num' oninput='check_num();'class='title' value='0". $row2['user_cNum']."' required><br>";?>
								 <br>
						</div>			
					</form>
				</div> 


				<script type="text/javascript">
					function submitForm() {
					  Swal.fire({
						 title: 'Are you sure you want to save changes?',
						text: "",
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes',
						cancelButtonText: 'No'
						}).then((result) => {
						  if (result.isConfirmed) {
						document.getElementById("editinfo").submit();
						  	
						  }
						});
						return false;
					}


					function check_email() {
						var x = document.getElementById('email').value;
						var re = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/;
						let z = re.test(x);
					    if (z==true){
					    	document.getElementById("message2").innerHTML = ""; 
					    	submitbutton();
						   
					    }
					    else{
						    document.getElementById('submits').disabled = true;
					    	document.getElementById("message2").innerHTML = "**Enter a Valid Email Address";  
					    }  
					}	
					function check_num() {
						var x = document.getElementById('num').value;
					    if ((x>=09000000000) && (x<=09999999999) ){
					    	document.getElementById("message3").innerHTML = ""; 
						    submitbutton();
					    }
					    else{
						    document.getElementById('submits').disabled = true;
					    	document.getElementById("message3").innerHTML = "**Enter a Valid Phone Number";  
					    }  
					}	
					function submitbutton(){
						var x = document.getElementById('email').value;
						var re = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})*$/;
						let z = re.test(x);
						var c = document.getElementById('num').value;
						var d = document.getElementById('username').value.length;
						var e = document.getElementById('mname').value.length;
						var f = document.getElementById('fname').value.length;
						var g = document.getElementById('lname').value.length;
						if (z==true &&(c>=09000000000) && (c<=09999999999)&& (d>0)&& (e>0) && (f>0)&& (g>0)){
					    	document.getElementById('submits').disabled = false;
						}
						else{
						    document.getElementById('submits').disabled = true;
						}
					}	
				</script>
			</div>
			<?php 
	if(isset($_POST["fname"])){	
		$fname= $_POST['fname'];
		$mname= $_POST['mname'];
		$lname= $_POST['lname'];
		$cnum =$_POST['cnum'];
		$id1 =$_POST['id1'];
		$id2 =$_POST['id2'];
		$email=$_POST['email'];
		$username=$_POST['username'];

			$_SESSION['username'] = $username;
			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "library";
			$conn = mysqli_connect($server, $user, $pass, $db);
			if(!$conn) die(mysqli_error($conn));
			$query = "UPDATE account set user_email = '$email',username = '$username' where account_ID = '$id2'";
			mysqli_query($conn, $query);

			$query2 = "UPDATE user set user_fName = '$fname',user_mName = '$mname',user_lName = '$lname',user_cNum = '$cnum'   where user_ID = '$id1'";
			mysqli_query($conn, $query2);
			mysqli_close($conn);
			 echo "<script>";
   			echo "location='../Admin/adminProfile.php'";
    		echo "</script>";
			exit;
		}
	?>
			<div class="row">
				
			</div>

			<script type="text/javascript">
				function showform() {
				 var x = document.getElementById("info");
				 var y = document.getElementById("info2");
				    x.style.display = "none";
				    y.style.display = "block";
				}

			</script>
		</div>
	</div>

	
	<?php include "../footer.php";?>