<?php
include "../header.php";                
?>
<style type="text/css">
	table, tr,th,td{
		border: none !important;
	}
	h6{
			font-size: 150% !important;
			color: black;
			padding-left: 5%;
			padding-top: 1%;
			padding-right: 1%;
			padding-bottom: 1%;
			border: 1px solid black;
			border-radius: 5px;
		}
</style>
<div class="gtco-section" style="background-color: 	#602020">   
		<div class="gtco-container">
			<div class="row" >
				<br>
					<br>
					<br>
					<br>
					
				<?php 
					$server = "localhost:3306";
	                $user = "root";
	                $pass = "";
	                $db = "library";
	                $conn = new mysqli($server, $user, $pass, $db);
	                if ($conn->connect_error) {
						die($conn->connect_error);
					}

					$sql = $conn->prepare("SELECT * FROM borrower where b_id=?");
					$sql->bind_param("s", $_GET['id']);
					$sql->execute();
					$result = $sql->get_result();
					if(mysqli_num_rows($result) > 0){
						$row = $result->fetch_assoc();
						
					
				?>	

				<div style="box-shadow: 0 0 4px 0 black; border-radius: 20px; background: white; ">
					<br>
					<h2 class="cursive-font">Borrower's Information</h2> 
					<hr style="border: 1px solid gray; margin-left: 5%;margin-right: 5%">
					<table style="color: black;width:90%; " >
						<tr>
	                        <th class="cursive-font"  style="width: 30%;text-align: left;font-size: 170%">First Name </th>
	                        <th class="cursive-font"  style="width: 30%;text-align: left;font-size: 170%">Middle Initial</th>
	                        <th class="cursive-font"  style="width: 30%;text-align: left;font-size: 170%">Last Name </th>
	                    </tr>
	                    <tr>
	                    	<td style="text-align: left;"><h6><?php echo $row['b_fname'];?></h6></td>
	                    	<td  style="text-align: left;"><h6> <?php echo $row['b_mname'];echo "&nbsp;";  ?></h6></td>
	                    	<td  style="text-align: left;"><h6><?php echo $row['b_lname'];?></h6></td>
	                    </tr>
					</table>
					<table style="color: black;width:90%; " >
						<tr>
	                        <th class="cursive-font"  style="width: 33%;text-align: left;font-size: 170%">Grade Level</th>
	                        <th class="cursive-font"  style="width: 70%;text-align: left;font-size: 170%">Contact Number</th>
	                    </tr>
	                    <tr>
	                    	<td style="text-align: left;"><h6><?php echo $row['year_level'];?></h6></td>
	                    	<td  style="text-align: left;"> <h6>0<?php echo $row['b_cnum'];?></h6></td>
	                    </tr>
					</table>
					<br>
					<table style="color: black;width:90%; " >
						<tr>
	                        <th class="cursive-font"  style="width: 100%;text-align: center;font-size: 170%"><?php 
						echo "<button class=\"btn btn-danger\"  onclick=\"history.back()\" > Go Back</button>";
						?></th>
	                        
	                    
					</table>

				</div>
				<br>


	
					
				 
						<?php
							}
						?>	
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
include "../footer.php";                
?>