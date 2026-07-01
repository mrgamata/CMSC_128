
<?php
include "../header.php"; 
if (isset($_GET['success'])) {
	if ($_GET['success']==1) {
		echo "<script>
			 Swal.fire({
			  icon: 'success',
			  title: 'Log in Successful',
				  text: 'Hello Admin!',
				   confirmButtonColor: '#d33',
				  width: '40%'
			});
     		</script>";
	}
}               
?>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(../images/index.jpg)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">Teodoro Hernaez National High School</a></span>
							<h1 class="cursive-font">Shape a better future !</h1>	
						</div>
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
					<a href="../images/JHS.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="../images/JHS.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Junior High School</h2>
							<p>Teodoro Hernaez National High School welcomes Junior High School Students and transferees.</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="../images/SHS.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="../images/SHS.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2>Senior High School</h2>
							<p>Teodoro Hernaez National High School welcomes Senior High School Students and transferees. We offer 4 academic strands specifically Science, Technology, Engineering and  Mathematics (STEM), Accountancy, Business and Management (ABM), Humanities and Social Sciences (HUMSS), and General Academic Strand (GAS).</p>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="../images/ELEM.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="../images/ELEM.jpg" alt="Image" class="img-responsive">
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

	<div class="gtco-cover gtco-cover-sm" style="background-image: url(../images/beacon.jpg)"  data-stellar-background-ratio="0.5">
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
		echo "<a class=\"btn btn-default btn-sm\" style=\"float: right;\" onclick=\"location.href='../edit/editfacts.php?id=".$row['establish']."'\">Edit Facts</a>";
		?>
		
		
	</div>

				<?php 
				   } 
		                    }
				?>
	<?php
include "../footer.php";                
?>