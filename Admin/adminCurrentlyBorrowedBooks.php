	
	<?php
include "../header.php";                
?>

	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(../images/mama.jpg)" data-stellar-background-ratio="0.5">
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
	
			<?php
	if (isset($_GET["page"])) { 
		$page  = $_GET["page"];
		$year = $_GET["year"];
		$month = $_GET["month"]; 
	} 
	else { 
		$page=1; 
	 	$year=date('Y');
	 	$month=date('n');  
	};



	if (isset($_POST["year"])){
    		$year=$_POST["year"];
    		$month=$_POST["month"]; 
	} 

	if (isset($_POST["month"])){
    		$year=$_POST["year"];
    		$month=$_POST["month"]; 
			
			
	} 


?>
	
	<div class="gtco-section">   
		<div class="gtco-container2">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading" style="width:90%">
					<h2 class="cursive-font primary-color">Currently Borrowed Books</h2>
					<div style="right: 0;width: 95%;text-align: right;">

				        <form method="post">
		                    <input type="text" placeholder="Search a book title..." name="search">
		                    <button type="submit" name="submitss"><i class="fa fa-search"></i></button>
		                </form>
						 <form action="./adminCurrentlyBorrowedBooks.php" method="post">
						 	<input type="hidden"  value="<?php echo  $month; ?>" name="month">
				                Select Year: <select style="width: 10%" name="year" onchange="this.form.submit()">
				                <?php 
				                    echo "<option value='".$year."'>".$year."</option>";
				                for($i = 2019 ; $i <= date('Y'); $i++){

				                      echo "<option value='$i'>$i</option>";
				                }
				                ?>
				            </select> 
				        </form>
	      
						 <form action="./adminCurrentlyBorrowedBooks.php" method="post">
							<input type="hidden" value="<?php echo  $year; ?>" name="year">
				                Select Month: <select style="width: 10%" name="month" onchange="this.form.submit()">
				                <?php 
				                  $monthNum  = $month;
						$dateObj   = DateTime::createFromFormat('!m', $monthNum);
						$monthName = $dateObj->format('F');
				                    echo "<option value='".$month."'>".$monthName."</option>";
				                 echo "<option value='1'>January</option>";
				                 echo "<option value='2'>February</option>";
				                 echo "<option value='3'>March</option>";
				                 echo "<option value='4'>April</option>";
				                 echo "<option value='5'>May</option>";
				                 echo "<option value='6'>June</option>";
				                 echo "<option value='7'>July</option>";
				                 echo "<option value='8'>August</option>";
				                 echo "<option value='9'>September</option>";
				                 echo "<option value='10'>October</option>";
				                 echo "<option value='11'>November</option>";
				                 echo "<option value='12'>December</option>";
				                ?>
				            </select> 
				        </form>  
					</div>
                    
					<!-- The form -->

									<?php
									if (isset($_POST["submitss"])) {
										$server = "localhost:3306";
					                    $user = "root";
					                    $pass = "";
					                    $db = "library";
					                    $results_per_page = 10;
					                    $search = $_POST['search'];
					                    $conn = mysqli_connect($server, $user, $pass, $db);
					                    if(!$conn) die(mysqli_error($conn));
					                    $start_from = ($page-1) * $results_per_page;
										$sql = "SELECT * FROM transaction natural join books natural join borrower where  (title like '$search' or title like '$search %' or title like '% $search' or title like '% $search %' or author_fname like '$search' or author_fname like '$search %' or author_fname like '% $search' or author_fname like '% $search %' or author_mname like '$search' or author_mname like '$search %' or author_mname like '% $search' or author_mname like '% $search %' or author_lname like '$search' or author_lname like '$search %' or author_lname like '% $search' or author_lname like '% $search %' or b_fname like '$search' or b_fname like '% $search' or b_fname like '$search %' or b_fname like '% $search %' or b_lname like '$search' or b_lname like '% $search' or b_lname like '$search %' or b_lname like '% $search %')                 
										 order by tran_id ASC LIMIT $start_from, ".$results_per_page;
										$result = mysqli_query($conn,$sql);
										

					                    if(mysqli_num_rows($result) > 0){
					                        echo "<table class = \"sortable\" style =\"width:90%\">
					                        <tr>
					                            <th style=\"width: 5%\">Transaction ID</th>
					                            <th>Accession Number</th>
					                            <th>Title</th>
					                            <th>Borrower ID</th>
					                            <th>Borrower </th>
					                            <th>Date Borrowed </th>
					                            <th>Date Returned</th>
					                            <th> </th>
					                        </tr>";
					                        while($row = mysqli_fetch_assoc($result)){
					                            echo "<tr class = \"item\">
					                                <td>".$row['tran_id']."</a></td>
					                                <td><a href='./adminBookInfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
					                                <td>".$row['title']."</td>
					                                <td><a href='./adminBorrower.php?id=".$row['b_id']."'>".$row['b_id']."</a></td>
					                                <td>".$row['b_fname']." ".$row['b_mname']." ".$row['b_lname']."</td>
					                                <td>".$row['borrow_date']."</td>
					                                <td>".$row['return_date']."</td>";
					                                $ID=$row['tran_id'];
					                                echo "<td><button class=\"btn btn-danger\"  onclick=\"myFunction($ID)\"> Mark as Returned</button></td>";
					                                
					                            echo"</tr>";
					                        }
					                        echo "</table>";
					                    }
					                    
					                    else{
					                    	echo " <table class = \"sortable\" style =\"width:90%\">
					                        <tr>
					                            <th>Transaction ID</th>
					                            <th>Accession Number</th>
					                            <th>Title</th>
					                            <th>Borrower ID</th>
					                            <th>Borrower </th>
					                            <th>Date Borrowed </th>
					                            <th>Date Returned </th>
					                        </tr>
					                        
					                        </table>";
					                        ;
					                    }
					                    $sql = "select COUNT(tran_id) as total from transaction where YEAR(borrow_date) = $year  AND MONTH(borrow_date) = $month";
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
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$f."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
											}else{
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$f."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
											}
											$m=$page-1;
											echo "<a href='adminCurrentlyBorrowedBooks.php?page=".$m."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back."</button></a> ";
										}
										for ($i=$page ; $i<=$page + 10; $i++) {
											if ($i>$total_pages) {
												break;
											}
										    echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$i."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white;\">".$i." </button></a>";
										};
										if($page!=$total_pages && $total_pages!=0){
											$k=$page+1;
											echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$k."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l."</button></a> ";
											$q=$page+10;
											if ($q>$total_pages) {
												$q=$total_pages;
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$q."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
											}else{
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$q."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
											}	
											
											
					                    }
					                    echo "<br>";
	                   					echo "<br>";
										echo "<button class=\"btn btn-danger\" onclick=\"location.href='adminCurrentlyBorrowedBooks.php'\" > Back to complete list </button>";
									}
									else{
					                    $server = "localhost:3306";
					                    $user = "root";
					                    $pass = "";
					                    $db = "library";
					                    $results_per_page = 10;
					                    $conn = mysqli_connect($server, $user, $pass, $db);
					                    if(!$conn) die(mysqli_error($conn));
					                    $start_from = ($page-1) * $results_per_page;
										$sql = "SELECT * FROM transaction natural join books natural join borrower where YEAR(borrow_date) = $year  AND MONTH(borrow_date) = $month
										 order by tran_id ASC LIMIT $start_from, ".$results_per_page;
										$result = mysqli_query($conn,$sql);
										

					                    if(mysqli_num_rows($result) > 0){
					                        echo "<table class = \"sortable\" style =\"width:90%\">
					                        <tr>
					                            <th>Transaction ID</th>
					                            <th>Accession Number</th>
					                            <th>Title</th>
					                            <th>Borrower ID</th>
					                            <th>Borrower </th>
					                            <th>Date Borrowed </th>
					                            <th>Date Returned</th>
					                            <th> </th>
					                        </tr>";
					                        while($row = mysqli_fetch_assoc($result)){
					                            echo "<tr class = \"item\">
					                                <td>".$row['tran_id']."</a></td>
					                                <td><a href='./adminBookInfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
					                                <td>".$row['title']."</td>
					                                <td><a href='./adminBorrower.php?id=".$row['b_id']."'>".$row['b_id']."</a></td>
					                                <td>".$row['b_fname']." ".$row['b_mname']." ".$row['b_lname']."</td>
					                                <td>".$row['borrow_date']."</td>
					                                <td>".$row['return_date']."</td>";
					                                $ID=$row['tran_id'];
					                                echo "<td><button class=\"btn btn-danger\"  onclick=\"myFunction($ID)\"> Mark as Returned</button></td>";
					                                
					                            echo"</tr>";
					                        }
					                        echo "</table>";
					                    }

					                    else{
					                    	echo " <table class = \"sortable\" style =\"width:90%\">
					                        <tr>
					                            <th>Transaction ID</th>
					                            <th>Accession Number</th>
					                            <th>Title</th>
					                            <th>Borrower ID</th>
					                            <th>Borrower </th>
					                            <th>Date Borrowed </th>
					                            <th>Date Returned </th>
					                        </tr>
					                        
					                        </table>";
					                        ;
					                    }
					                    $sql = "select COUNT(tran_id) as total from transaction where YEAR(borrow_date) = $year  AND MONTH(borrow_date) = $month";
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
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$f."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
											}else{
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$f."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
											}
											$m=$page-1;
											echo "<a href='adminCurrentlyBorrowedBooks.php?page=".$m."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back."</button></a> ";
										}
										for ($i=$page ; $i<=$page + 10; $i++) {
											if ($i>$total_pages) {
												break;
											}
										    echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$i."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white;\">".$i." </button></a>";
										};
										if($page!=$total_pages && $total_pages!=0){
											$k=$page+1;
											echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$k."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l."</button></a> ";
											$q=$page+10;
											if ($q>$total_pages ) {
												$q=$total_pages;
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$q."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
											}else{
												echo "<a href='./adminCurrentlyBorrowedBooks.php?page=".$q."&year=".$year."&month=".$month."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
											}	
											
											
					                    }
					                }
					?>

				<script>
				function myFunction($ID) {
					var x = $ID;
					Swal.fire({
					icon: 'warning',
					title: 'Are you sure the book was returned?',
					text: "You won't be able to revert this!",
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes',

					cancelButtonText: 'No'
				}).then((result) => {
				  if (result.isConfirmed) {
				  	
					Swal.fire({
					icon: 'success',
					title: 'Book was returned',
					text: "Book was now available for borrowing",
					confirmButtonColor: '#d33',
					width: '40%',
					}).then((result) => {
						if (result.isConfirmed) {
							location='./returnedbook.php?id='+ x;
						}else{
							location='./returnedbook.php?id='+ x;

						}	
				});
						}
				});

				
				}
			</script>
				</div>
			</div>
		</div>
	</div>

	</div>
	<?php
include "../footer.php";                
?>