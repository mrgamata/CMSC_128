
	<?php
include "../header.php";                
?>

	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../images/bookcartbg.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">

					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1 class="cursive-font">Are you up for borrowing a book?</h1>	
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
	</header>
	<div class="gtco-section">
        
		<div class="gtco-container"><h2 class="cursive-font primary-color" style="text-align: center;font-size: 300%" >Cart Details</h2>
			<div class="row">
				<div style="width: 48%; float:left;text-align: center;">
					
                    <!-- The form -->
                    <h3 class="cursive-font primary-color" style="font-size: 200%">List of Books</h3>
					<?php
                    $server = "localhost:3306";
                    $user = "root";
                    $pass = "";
                    $db = "library";
                    $conn = mysqli_connect($server, $user, $pass, $db);
                    if(!$conn) die(mysqli_error($conn));
                    
                    $query = "select * from cart";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result) > 0){
                        echo "<table >
                        <tr>
                            <th>Accession Number</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th></th>
                        </tr>";
                        while($row = mysqli_fetch_assoc($result)){
                        	$query2="select * from books where access_num = ".$row['access_num'];
                        	 $result2 = mysqli_query($conn,$query2);
                        	 $row2 = mysqli_fetch_assoc($result2);
                            echo "<tr>
                                <td>".$row['access_num']."</td>
                                <td>".$row['book_title']."</td>
                                <td>".$row2['author_fname']." ".$row2['author_mname']." ".$row2['author_lname']."</td>";
                                $is=$row['access_num'];
								echo "<td><button class=\"btn btn-danger\" onclick=\"myFunction($is)\" > Remove</button></td>";
                            	echo"</tr>";
                        }
                        echo "</table>";

                    }
                ?><br>
                <script>
				function myFunction($ID) {
					var x = $ID;
				 
				  Swal.fire({
					  title: 'Are you sure you want to remove this book from the cart?',
					  text: "You won't be able to revert this!",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, remove it!'
					}).then((result) => {
					  if (result.isConfirmed) {
					  	location='../cart/deletebook.php?id='+ x;
					    
					  }
					  
					})
				}
			</script>
            <a class="btn btn-danger" onclick="location.href='./adminbooks.php'"><i class="fa fa-plus"></i> Add more books</a>
				</div>
				<div  style="width: 48%; float:right;text-align: center;">
						<h3 class="cursive-font primary-color" style="text-align: center;font-size: 200%" >Borrower's Information</h3>
						<select  onchange="showform(this);">
							<option value='' disabled  selected hidden >Are you a previous borrower?</option>
						 	<option value='2' class="others">Yes</option>
						 	<option value='1' class="others" >No</option>
						</select>
						<?php $today = date("Y-m-d"); ?>
					<div class="borrower" id="form1">
							<form action="bookcart.php" style="color: black" method="POST" id="forms2">
								
							<input type="text" name="fname" class="fname" id="fname" placeholder="First Name" oninput="ablebutton();"  required>
							 <input type="text" name="mname" class="mname" id="mname" placeholder="Middle Initial"  oninput="ablebutton();" required>
							<input type="text" name="lname" class="fname" id="lname" placeholder="Last Name"  oninput="ablebutton();" required>
							<input type="hidden" name="bdate" value=<?php echo  $today; ?>>
							<input type="number" name="kontact" class="email" id="num" placeholder="Contact Number - 09" oninput='check_num();' required> 
							 <select name='grade' class='grade' id="grade" onchange="ablebutton();" required>
							 	<option value='' disabled  selected hidden >Grade Level</option>
							 	<option value='Grade 7' class="others">Grade 7</option>
							 	<option value='Grade 8' class="others" >Grade 8</option>
							 	<option value='Grade 9' class="others" >Grade 9</option>
							 	<option value='Grade 10' class="others" >Grade 10</option>
							 	<option value='Grade 11' class="others" >Grade 11</option>
							 	<option value='Grade 12' class="others" >Grade 12</option>
							 	<option value='Teacher' class="others" >Teacher</option>
							 </select>
							
							<p style="color: red" id="message2"></p>

							<button class="btn btn-danger" type="button" id="submits" onclick="  submitForm2();" disabled >Checkout</button>
						</form>
					</div>
					<div class="borrower" id="form2">
							<form action="bookcart.php" method="POST" id="forms" >
							
							<input type="hidden" name="bdate" value=<?php echo  $today; ?>>
							<input type="number" name="id" id="bid" class="contact" placeholder="Enter Borrower ID" oninput="showbut();"  required> <br>
							<p style="color: red" id="message3"></p>
							<button class="btn btn-danger" type="button" id="btt" onclick="  submitForm();" disabled>Checkout</button>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		function submitForm() {
		  Swal.fire({
			 title: 'Are you sure you want to checkout?',
			text: "",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
			}).then((result) => {
			  if (result.isConfirmed) {
			document.getElementById("forms").submit();
			  	
			  }
			});
			return false;
		}

		function submitForm2() {
		  Swal.fire({
			 title: 'Are you sure you want to checkout?',
			text: "",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			cancelButtonText: 'No'
			}).then((result) => {
			  if (result.isConfirmed) {
			document.getElementById("forms2").submit();
			  	
			  }
			});
			return false;
		}

		function showform(that) {
		  
		  if (that.value== "1") {
		  	var x = document.getElementById("form1");
		    x.style.display = "block";
		    var y = document.getElementById("form2");
		    y.style.display = "none";
		  } else {

		  	var x = document.getElementById("form1");
		    x.style.display = "none";
		    var y = document.getElementById("form2");
		    y.style.display = "block";
		  }
		  hidebutton();
		  
		}
		function showbut(){
			var x = document.getElementById('bid').value;
		    if (x>0){
		    	document.getElementById("message3").innerHTML = ""; 
			    document.getElementById('btt').disabled = false;
		    }else{
		    	document.getElementById("message3").innerHTML = "**Please enter a borrower id"; 
		    }
		}
		
		function check_num() {
			var x = document.getElementById('num').value;
		    if ((x>=09000000000) && (x<=09999999999) ){
		    	document.getElementById("message2").innerHTML = ""; 
		    	ablebutton();
		    }
		    else{
			    document.getElementById('submits').disabled = true;
		    	document.getElementById("message2").innerHTML = "**Enter a Valid Phone Number";  
		    }  
		}	
		
		function ablebutton(){

			var a = document.getElementById('fname').value.length;
			var y = document.getElementById('mname').value.length;
			var z = document.getElementById('lname').value.length;
			var b = document.getElementById('grade').value.length;
			var x = document.getElementById('num').value;
			if ((x>=09000000000) && (x<=09999999999) && (a>0)&& (y>0) && (z>0)&& (b>0) ){
		    	document.getElementById("message2").innerHTML = ""; 
			    document.getElementById('submits').disabled = false;
		    }
		    else{
			    document.getElementById('submits').disabled = true;
		    	document.getElementById("message2").innerHTML = "**Please complete the form ";  
		    }
		}
		
	</script>
	<br><br>
	<br><br>
	<br><br>
	<hr style="border-top: 2px  solid black">
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
						<div class="desc">
							<h3>WHY CHOOSE US?</h3>
							<p>Teodoro Hernaez National High School offers quality education programs and continuously pursuing excellence by enhancing its programs. THNHS offers Junior High School, Senior High School, and other Special Programs that assures students excellence in their pursued fields.</p> 
							<p>THNS is committed to bulding a community of excellent students, leaders, professionals, and scholars who will actively inspire, promote, and will be walking examples of students and professionals as a Beacon of Wisdom and Value.</p>
						</div>
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">
					
					<div class="gtco-contact-info">
						<h3>Contact Information</h3>
						<ul>
							<li class="address">Barangay Sabuanan, Santa Lucia, 2712 <br> Ilocos Sur, Philippines</li>
							<li class="phone"><a href="tel://09279331664">09279331664 - Susana V. Cabreros</a><br>
											  <a href="tel://09219245114">09219245114 - Daniel G. Cuenca</a></li>
						</ul>
					</div>


				</div>
				</div>
			</div>
		</div>
	</div>
<?php 
		if (isset($_POST['fname'])){
			$fname=$_POST['fname'];
			$mname=$_POST['mname'];
			$lname=$_POST['lname'];
			$grade=$_POST['grade'];
			$kontact=$_POST['kontact'];
			$bdate=$_POST['bdate'];
			$rdate=date('Y-m-d', strtotime($bdate. ' + 7 days'));
			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "library";
			$conn = mysqli_connect($server, $user, $pass, $db);			
			$query = "insert into borrower values (null, '$fname','$mname','$lname','$grade','$kontact')";
			mysqli_query($conn, $query);
			$id=mysqli_insert_id($conn);
			$query2 = "select * from cart";
			$result2 = mysqli_query($conn,$query2);
			if (mysqli_num_rows($result2) > 0) {
				while($row = mysqli_fetch_assoc($result2)){
					$query3="insert into transaction values (null,'$id',".$row["access_num"].",'$bdate','$rdate')";
					mysqli_query($conn, $query3);
					$query5 = "select * from books where access_num = ". $row["access_num"];
					$result5 = mysqli_query($conn,$query5);
					if(mysqli_num_rows($result5) > 0){
						$row5 = mysqli_fetch_assoc($result5);
						$num=$row5["times_borrowed"];
					}
					$num=$num+1;
					$query4 = "UPDATE books set avail = 0,times_borrowed ='$num' where access_num= ".$row["access_num"]."";
					mysqli_query($conn, $query4);
				}

				$deletetable="DELETE FROM cart";
				mysqli_query($conn,$deletetable);
			?><script>
				var x =  "<?= $id ?>";
				 Swal.fire({
				  icon: 'success',
				  title: 'Book/s successufully borrowed',
					  text: 'Your Borrower Id is #'+x,
					   confirmButtonColor: '#d33',
					  width: '40%',
					  footer:'Do not forget to give the transaction id/s to the borrower!',
				}).then((result) => {
				  if (result.isConfirmed) {
				  	
	             location='./adminCurrentlyBorrowedBooks.php';
				  }

						  else{
						  	location='./adminCurrentlyBorrowedBooks.php';
						  }
				});
	     		</script>


			<?php }
			else{
				echo "<script>
	            	 Swal.fire({
					  icon: 'error',
					  title: 'Cart has no entries',
  					  text: 'There must be a book to checkout!',
  					   confirmButtonColor: '#d33',
   					  width: '40%'
					});
					
	     		</script>";
			}
			
				
		}
		if (isset($_POST['id'])){
			$id=$_POST['id'];
			$bdate=$_POST['bdate'];
			$rdate=date('Y-m-d', strtotime($bdate. ' + 7 days'));
			$server = "localhost:3306";
			$user = "root";
			$pass = "";
			$db = "library";
			$conn = mysqli_connect($server, $user, $pass, $db);			
			$query2 = "select * from cart";
			$result2 = mysqli_query($conn,$query2);
			if (mysqli_num_rows($result2) > 0) {
				$query6 = "select * from transaction where b_id = $id";
				$result6 = mysqli_query($conn,$query6);
				$query7 = "select * from past_transaction where b_id = $id";
				$result7 = mysqli_query($conn,$query7);
				if (mysqli_num_rows($result6) > 0||mysqli_num_rows($result7) > 0) {
					while($row = mysqli_fetch_assoc($result2)){
							$query3="insert into transaction values (null,'$id',".$row["access_num"].",'$bdate','$rdate')";
							mysqli_query($conn, $query3);
							$query5 = "select * from books where access_num = ". $row["access_num"];
							$result5 = mysqli_query($conn,$query5);
							if(mysqli_num_rows($result5) > 0){
								$row5 = mysqli_fetch_assoc($result5);
								$num=$row5["times_borrowed"];
							}
							$num=$num+1;
							$query4 = "UPDATE books set avail = 0,times_borrowed ='$num' where access_num= ".$row["access_num"]."";
							mysqli_query($conn, $query4);
						}

						$deletetable="DELETE FROM cart";
						mysqli_query($conn,$deletetable);
						echo "<script>
						 Swal.fire({
						  icon: 'success',
						  title: 'Book/s successufully borrowed',
	  					  text: 'Do not forget to give the transaction id/s to the borrower!',
	  					   confirmButtonColor: '#d33',
	   					  width: '40%'
						}).then((result) => {
						  if (result.isConfirmed) {
						  	
			             location='./adminCurrentlyBorrowedBooks.php';
						  }
						  else{
						  	location='./adminCurrentlyBorrowedBooks.php';
						  }
						});
			     		</script>";
				}else{
					echo "<script>
	            	 Swal.fire({
					  icon: 'error',
					  title: 'Borrower does not exist',
  					  text: 'Please enter an existing borrower id!',
  					   confirmButtonColor: '#d33',
   					  width: '40%'
					});
					
	     		</script>";
				}
						
			}else{
				echo "";
				echo "<script>
	            	 Swal.fire({
					  icon: 'error',
					  title: 'Cart has no entries',
  					  text: 'There must be a book to checkout!',
  					   confirmButtonColor: '#d33',
   					  width: '40%'
					});
					
	     		</script>";
			}
		}
	?>
		<?php
include "../footer.php";                
?>