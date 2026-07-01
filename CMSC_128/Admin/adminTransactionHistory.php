<?php
include "../header.php";                
?>


		<?php
	if (isset($_GET["page"])) { 
		$page  = $_GET["page"];
		$year = $_GET["year"];
		$month = $_GET["month"];
		$_SESSION['taon'] = $year;
	 	$_SESSION['buwan'] = $month;
	} 
	else { 
		$page=1; 
	 	$year=date('Y');
	 	$month=date('n'); 
	 	$_SESSION['taon'] = $year;
	 	$_SESSION['buwan'] = $month;
	};




	if (isset($_POST["monthsyear"])){
			$months = $_POST['monthsyear'];
			$temp = new DateTime($months.'-01');                 
    		$year=date_format($temp,'Y'); 
    		$month=date_format($temp,'m');
			
			
	} 


?>
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../images/hakdog.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1 class="cursive-font">Welcome to the library!</h1>	
						</div>
						
					</div>
							
					
				</div>
			</div>
		</div>
	</header>

	<div class="gtco-section">   
		<div class="gtco-container2">
			<div class="row">
				
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading" style="width:90%">
					<br>
					<h2 class="cursive-font primary-color">Transaction History</h2>




					<div style="right: 0;width: 95%;text-align: right;">
						
	      	
						 <form action="./adminTransactionHistory.php" method="post" >
							Select Month: <input type="month"  name="monthsyear" value="<?php echo $year.'-'.$month ?>" onchange="this.form.submit()">
				        </form>
						
				        
					</div>
					<br>
					<?php
                    $server = "localhost:3306";
                    $user = "root";
                    $pass = "";
                    $db = "library";
                    $results_per_page = 10;
                    $conn = mysqli_connect($server, $user, $pass, $db);
                    if(!$conn) die(mysqli_error($conn));
                    $start_from = ($page-1) * $results_per_page;
					$sql = "SELECT * FROM past_transaction natural join books natural join borrower where YEAR(return_date) = $year  AND MONTH(return_date) = $month
					order by trans_id ASC LIMIT $start_from, ".$results_per_page;
					$result = mysqli_query($conn,$sql);
					

                    if(mysqli_num_rows($result) > 0){
                        echo "<table class = \"sortable\" style =\"width:90%\">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Accession Number</th>
                            <th>Title</th>
                            <th>Borrower ID</th>
                            <th>Borrower </th>
                            <th>Date Borrowed</th>
                            <th>Date Returned</th>
                        </tr>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr class = \"item\">
                                <td>".$row['trans_id']."</a></td>
                                <td><a href='./adminBookInfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
                                <td>".$row['title']."</td>
					            <td><a href='./adminBorrower.php?id=".$row['b_id']."'>".$row['b_id']."</a></td>
                                <td>".$row['b_fname']." ".$row['b_mname']." ".$row['b_lname']."</td>
                                <td>".$row['borrow_date']."</td>
                                <td>".$row['return_date']."</td>";
                                
                            echo"</tr>";
                        }
                        echo "</table>";
                    }else{
                    	 echo "<table class = \"sortable\" style =\"width:90%\">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Accession Number</th>
                            <th>Title</th>
                            <th>Borrower ID</th>
                            <th>Borrower </th>
                            <th>Date Borrowed</th>
                            <th>Date Returned</th>
                        </tr>
                        </table>";
                    }
                    $sql = "select COUNT(trans_id) as total from past_transaction where YEAR(borrow_date) = $year  AND MONTH(borrow_date) = $month";
					$result = mysqli_query($conn,$sql);
					$row =  mysqli_fetch_assoc($result);
					$total_pages = ceil($row["total"] / $results_per_page);
					$l = ">";
					$l2 = ">>";
					$back="<";
					$back2="<<";
					echo "<br>";
					if($page>1){
						$f=$page-10;
						if ($f<1) {
							$f=1;
							echo "<a href='./adminTransactionHistory.php?page=".$f."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
						}else{
							echo "<a href='./adminTransactionHistory.php?page=".$f."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
						}
						$m=$page-1;
						echo "<a href='adminTransactionHistory.php?page=".$m."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back."</button></a> ";
					}
					for ($i=$page ; $i<=$page + 10; $i++) {
						if ($i>$total_pages) {
							break;
						}
					    echo "<a href='./adminTransactionHistory.php?page=".$i."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white;\">".$i." </button></a>";
					};
					if($page!=$total_pages && $total_pages!=0){
						$k=$page+1;
						echo "<a href='./adminTransactionHistory.php?page=".$k."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l."</button></a> ";
						$q=$page+10;
						if ($q>$total_pages) {
							$q=$total_pages;
							echo "<a href='./adminTransactionHistory.php?page=".$q."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
						}else{
							echo "<a href='./adminTransactionHistory.php?page=".$q."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
						}	
						
						
                    }
					?>
					<div style="text-align: right;width: 95%" >
						<br>
					<button class="btn btn-danger" id="btns" onclick="showform()">Generate Report of Transactions</button>
						<form action="../PDF/pdf.php" method="post" style="display: none" id="genform">	
							<input type="hidden"  value="<?php echo  $month; ?>" name="month">
							<input type="hidden" value="<?php echo  $year; ?>" name="year">
							<span class="desg" >From: </span><input type="date"   name="from" ><br>
							<span class="desg" >To:   </span><input type="date" id="birthday" name="to"><br><br>
							<input  class="btn btn-danger"  type="submit" name="submit" id="submit" value="Generate PDF">
						</form>
					</div>	
				</div>
				<script>
					function showform() {
		  				var x = document.getElementById("genform");
					    x.style.display = "block";
		  				var x = document.getElementById("btns");
					    x.style.display = "none";
					  
					  
					}
				</script>
				<style >
					.desg {
						text-align: center;
						margin-top: 1%;
						display: inline-block;
						width: 5%;
					}
				</style>
						
			</div>
		</div>
	</div>
<?php
include "../footer.php";                
?>