<?php
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

?>

<?php
include "studentHeader.php";                
?>

		<?php
	if (isset($_GET["page"])) { 
		$page  = $_GET["page"]; 
		$opt  = $_GET["opt"]; 
	} else { 
		$page=1; 
		$opt  = 1;
	};


?>o
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/ELEM.jpg)" data-stellar-background-ratio="0.5">
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
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading" style="width: 90%;">
					<h2 class="cursive-font primary-color">LIST OF ALL OUR BOOKS</h2>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet"/>
                    <script>
                    	$("searchddl").chosen();
                    </script>

					<!-- THE FORM -->
                    <form style="text-align: right; "  method = "post">
                    <input   type="text" name="book_search"placeholder="Search a book title...">
                    <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                </form>

                <br>
                    <?php 

                    $server = "localhost:3306";
                    $user = "root";
                    $pass = "";
                    $db = "library";
                    $conn = mysqli_connect($server, $user, $pass, $db);

                    if (isset($_POST["submit"])) {
                   		$search = $_POST['book_search'];
						$query = "select * from books where title like '$search' or title like '$search %' or title like '% $search' or title like '% $search %' or author_fname like '$search' or author_fname like '$search %' or author_fname like '% $search' or author_fname like '% $search %' or author_mname like '$search' or author_mname like '$search %' or author_mname like '% $search' or author_mname like '% $search %' or author_lname like '$search' or author_lname like '$search %' or author_lname like '% $search' or author_lname like '% $search %'" ;
	                    $result = mysqli_query($conn,$query); 	
	                    if(mysqli_num_rows($result) > 0){
	                       echo "<table class = \"sortable\" style =\"width:100%\">
                        <tr style=\"height: 25%\">
                            <th style=\"width: 5%\">Accession Number</th>
                            <th style=\"width: 25%\">Title</th>
                            <th style=\"width: 15%\" >Author</th>
                            <th style=\"width: 5%\">Copyright</th>
                            <th style=\"width: 5%\">Volume</th>
                            <th style=\"width: 10%\">Availability</th>
                        </tr>";
	                        while($row = mysqli_fetch_assoc($result)){
	                            echo "<tr>
	                                <td><a href='./bookinfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
	                                <td>".$row['title']."</td>
	                                <td>".$row['author_fname']." ".$row['author_mname']." ".$row['author_lname']."</td>
	                                <td>".$row['copyright']."</td>
	                                <td>".$row['volume']."</td>";
	                                if ($row['avail']==1) {
	                                    echo "<td>Available</td>";
	                                }else{
	                                    echo "<td>Borrowed</td>";
	                                }
	                            echo"</tr>";
	                        }
	                        echo "</table>";
	                    }
 					echo "<br>";
                    echo "<br>";
					echo "<button class=\"btn btn-danger\" onclick=\"location.href='books.php'\" > Back to complete list </button>";
                    }

				   
                    else{
                     $server = "localhost:3306";
                    $user = "root";
                    $pass = "";
                    $db = "library";
                    $results_per_page = 10;
                    $conn = mysqli_connect($server, $user, $pass, $db);	
                    $start_from = ($page-1) * $results_per_page;
                    if($opt==1){
						$w = "access_num"; 
						$sql = "SELECT * FROM books order by $w ASC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==2){ 
						$w = "title";
						$sql = "SELECT * FROM books order by $w ASC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==3){
						$w = "author_fname";
						$sql = "SELECT * FROM books order by $w ASC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==4){ 
						$w = "copyright";
						$sql = "SELECT * FROM books order by $w ASC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==5){
						$w = "volume";
						$sql = "SELECT * FROM books order by $w ASC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==6){
						$w = "access_num"; 
						$sql = "SELECT * FROM books order by $w DESC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==7){ 
						$w = "title";
						$sql = "SELECT * FROM books order by $w DESC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==8){
						$w = "author_fname";
						$sql = "SELECT * FROM books order by $w DESC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==9){ 
						$w = "copyright";
						$sql = "SELECT * FROM books order by $w DESC LIMIT $start_from, ".$results_per_page;
                    }
                    if($opt==10){
						$w = "volume";
						$sql = "SELECT * FROM books order by $w DESC LIMIT $start_from, ".$results_per_page;
                    }
					$result = mysqli_query($conn,$sql);
					
					?><script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script><?php
						
                    if(mysqli_num_rows($result) > 0){
                        echo "<table style =\"width:100%\">
                        <tr style=\"height: 25%\">
                            <th style=\"width: 5%\">Accession Number<div style='display: inline-block;'>
							<p  style='line-height: 90%; font-size:10px;'><a href='books.php?page=1&opt=1'>  &#9650;   </a> <br > 
							<a href='books.php?page=1&opt=6'>  &#9660;   </a>		</p>					 
							</div></th>
                            <th style=\"width: 25%\">Title <div style='display: inline-block;'>
							<p  style='line-height: 90%; font-size:10px;'><a href='books.php?page=1&opt=2'>  &#9650;   </a><br>
							<a href='books.php?page=1&opt=7'>  &#9660;   </a>		</p>								 
							</div></th>
                            <th style=\"width: 15%\" >Author <div style='display: inline-block;'>
							<p  style='line-height: 90%; font-size:10px;'><a href='books.php?page=1&opt=3'>  &#9650;   </a><br>
							<a href='books.php?page=1&opt=8'>  &#9660;   </a>		</p>								 
							</div></th>
                            <th style=\"width: 5%\">Copright <div style='display: inline-block;'>
							<p  style='line-height: 90%; font-size:10px;'><a href='books.php?page=1&opt=4'>  &#9650;   </a><br>
							<a href='books.php?page=1&opt=9'>  &#9660;   </a>		</p>								 
							</div></th>
                            <th style=\"width: 5%\"> Volume <div style='display: inline-block;'>
							<p  style='line-height: 90%; font-size:10px;'><a href='books.php?page=1&opt=5'>  &#9650;   </a><br>
							<a href='books.php?page=1&opt=10'>  &#9660;   </a>		</p>								 
							</div></th>
                            <th style=\"width: 10%\">Availability</th>
                        </tr>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr class = \"item\">
                                <td><a href='./bookinfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
                                <td>".$row['title']."</td>
                                <td>".$row['author_fname']." ".$row['author_mname']." ".$row['author_lname']."</td>
                                <td>".$row['copyright']."</td>
                                <td>".$row['volume']."</td>";
                                if ($row['avail']==1) {
                                    echo "<td>Available</td>";
                                }else{
                                    echo "<td>Borrowed</td>";
                                }
                            echo"</tr>";
                        }
                        echo "</table>";
                    }
                    $sql = "select COUNT(access_num) as total from books";
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
							echo "<a href='books.php?page=".$f."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
						}else{
							echo "<a href='books.php?page=".$f."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
						}
						$m=$page-1;
						echo "<a href='books.php?page=".$m."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back."</button></a> ";
					}

					for ($i=$page; $i<=$page+10; $i++) {
						if ($i>$total_pages) {
							break;
						}
				    	echo "<a href='books.php?page=".$i."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$i. "</button></a> ";
					}
					if($page!=$total_pages){
						$k=$page+1;
						echo "<a href='books.php?page=".$k."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l."</button></a> ";
						$q=$page+10;
						if ($q>$total_pages) {
							$q=$total_pages;
							echo "<a href='books.php?page=".$q."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
						}else{
							echo "<a href='books.php?page=".$q."&opt=".$opt."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
						}	
						
						
                    }




                    }
                    
                 

                    
                    ?>
					
				</div>
			</div>
		</div>
	</div>

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