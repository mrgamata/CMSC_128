<?php
include "../header.php";     
if (isset($_GET["page"])) { 
		$page  = $_GET["page"];
		$id = $_GET["id"];
	} 
	else { 
		$page=1; 
	};           
?>

<div class="gtco-section" >   
		<div class="gtco-container">
			<div class="row">
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
								echo "<button class=\"btn btn-danger\" onclick=\"location.href='../edit/editbooks.php?id=".$row['access_num']."'\"   > Edit</button>";
								echo "<button class=\"btn btn-danger\"  onclick=\"myFunction($is)\"  > Delete</button>";
								echo "<button class=\"btn btn-danger\" onclick=\"history.back()\"> Go back </button>";
							?>
						</div>
						 <script>
							function myFunction($ID) {
								var x = $ID;
								  Swal.fire({
									  title: 'Are you sure you want to remove this book from the library database?',
									  text: "You won't be able to revert this!",
									  icon: 'warning',
									  showCancelButton: true,
									  confirmButtonColor: '#3085d6',
									  cancelButtonColor: '#d33',
									  confirmButtonText: 'Yes, remove it!'
									}).then((result) => {
									  if (result.isConfirmed) { 
									  	location='../delete/deletebook.php?id='+ x;
									    
									  }
									  
									})
							  
							}
						</script>



						<div style="flex: 1 1 0;">
							
							<?php
								
							 $results_per_page = 10; 
							  $start_from = ($page-1) * $results_per_page;
							$query = "select * from books natural join past_transaction natural join borrower where access_num = ". $_GET["id"]." order by return_date LIMIT $start_from, ".$results_per_page;
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
		                    <div style="text-align: center;"><?php
		                    	$sql = "select COUNT(*) as total from books natural join past_transaction natural join borrower  where access_num = ". $_GET["id"];
							$result = mysqli_query($conn,$sql);
							$row =  mysqli_fetch_assoc($result);
							$total_pages = ceil($row["total"] / $results_per_page);
							$l = ">";
							$l2 = ">>";
							$back="<";
							$back2="<<";
							$id=$_GET["id"];
							echo "<br>";
							if($page>1){
								$f=$page-10;
								if ($f<1) {
									$f=1;
									echo "<a href='adminBookinfo.php?page=".$f."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
								}else{
									echo "<a href='adminBookinfo.php?page=".$f."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
								}
								$m=$page-1;
								echo "<a href='adminBookinfo.php?page=".$m."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back."</button></a> ";
							}

							for ($i=$page; $i<=$page+10; $i++) {
								if ($i>$total_pages) {
									break;
								}
						    	echo "<a href='adminBookinfo.php?page=".$i."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$i. "</button></a> ";
							}
							if($page!=$total_pages && $total_pages!=0){
								$k=$page+1;
								echo "<a href='adminBookinfo.php?page=".$k."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l."</button></a> ";
								$q=$page+10;
								if ($q>$total_pages) {
									$q=$total_pages;
									echo "<a href='adminBookinfo.php?page=".$q."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
								}else{
									echo "<a href='adminBookinfo.php?page=".$q."&id=".$id."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
								}	
								
								
			                }
							?>
		                    </div>
						</div>

							
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
include "../footer.php";                
?>