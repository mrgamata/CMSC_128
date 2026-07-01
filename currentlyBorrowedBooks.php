<?php
include "studentHeader.php";                
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Teodoro Hernaez NHS &mdash; Currently Borrowed books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Bootstrap DateTimePicker -->
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
	<?php
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	?>
		
	<div class="gtco-loader"></div>
	
	<div id="page">	
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/haha.jpg)" data-stellar-background-ratio="0.5">
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
		<div class="gtco-container">
			<div class="row" >
				<div   style=" text-align: center;">
					<h2 class="cursive-font primary-color" style="font-size: 300%">LIST OF CURRENTLY BORROWED BOOKS</h2>

                    <!-- The form -->
                    <form style="text-align: right;" method="post">
                    <input type="text" placeholder="Search a book title..." name="search">
                    <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <?php 

				        $server = "localhost:3306";
				        $user = "root";
				        $pass = "";
				        $db = "library";
				        $conn = mysqli_connect($server, $user, $pass, $db);

				        if (isset($_POST["submit"])) {
				       		$search = $_POST['search'];
							$query = "SELECT * FROM books where avail = '0' AND (title like '$search' or title like '$search %' or title like '% $search' or title like '% $search %' or author_fname like '$search' or author_fname like '$search %' or author_fname like '% $search' or author_fname like '% $search %' or author_mname like '$search' or author_mname like '$search %' or author_mname like '% $search' or author_mname like '% $search %' or author_lname like '$search' or author_lname like '$search %' or author_lname like '% $search' or author_lname like '% $search %')" ;
				            $result = mysqli_query($conn,$query); 	
				            if(mysqli_num_rows($result) > 0){
				            	echo "<br>";
				                echo "<table>
				                <tr>
				                    <th>Accession Number</th>
				                    <th>Title</th>
				                    <th>Author</th>
				                    <th>Copyright</th>
				                    <th>Volume</th> 
				                </tr>";
				                while($row = mysqli_fetch_assoc($result)){
				                    echo "<tr>
				                        <td><a href='./bookinfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
				                        <td>".$row['title']."</td>
				                        <td>".$row['author_fname']." ".$row['author_mname']." ".$row['author_lname']."</td>
				                        <td>".$row['copyright']."</td>
				                        <td>".$row['volume']."</td>";
				                        
				                    echo"</tr>";
				                }
				                echo "</table>";
				            }
				            
				    echo "<br>";
                    echo "<br>";
					echo "<button class=\"btn btn-danger\" onclick=\"location.href='currentlyBorrowedBooks.php'\" > Back to complete list </button>";
				        }
				        else{
				        $server = "localhost:3306";
				        $user = "root";
				        $pass = "";
				        $db = "library";
				        $results_per_page = 10;
				        $conn = mysqli_connect($server, $user, $pass, $db);	
				        $start_from = ($page-1) * $results_per_page;
						$sql = "SELECT * FROM books where avail = '0' order by access_num ASC LIMIT $start_from, ".$results_per_page;
						$result = mysqli_query($conn,$sql);
						
						?><script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
						<br>
						<?php
						$server = "localhost:3306";
				        $user = "root";
				        $pass = "";
				        $db = "library";
							
				        if(mysqli_num_rows($result) > 0){
				            echo "<table class = \"sortable\"style =\"width:100%\">
				             <tr style=\"height: 25%\">
	                            <th style=\"width: 5%\">Accession Number</th>
	                            <th style=\"width: 25%\">Title</th>
	                            <th style=\"width: 15%\" >Author</th>
	                            <th style=\"width: 5%\">Copyright</th>
	                            <th style=\"width: 5%\">Volume</th> 
	                        </tr>";
				            while($row = mysqli_fetch_assoc($result)){
				                echo "<tr class = \"item\">
				                    <td><a href='./bookinfo.php?id=".$row['access_num']."'>".$row['access_num']."</a></td>
				                    <td>".$row['title']."</td>
				                    <td>".$row['author_fname']." ".$row['author_mname']." ".$row['author_lname']."</td>
				                    <td>".$row['copyright']."</td>
				                    <td>".$row['volume']."</td>"; 
				                echo"</tr>";
				            }
				            echo "</table>";
				        }
				        $sql = "select COUNT(access_num) as total from books where avail = '0' ";
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
								echo "<a href='./currentlyBorrowedBooks.php?page=".$f."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
							}else{
								echo "<a href='./currentlyBorrowedBooks.php?page=".$f."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back2."</button></a> ";
							}
							$m=$page-1;
							echo "<a href='currentlyBorrowedBooks.php?page=".$m."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$back."</button></a> ";
						}
						for ($i=$page ; $i<=$page + 10; $i++) {
							if ($i>$total_pages) {
								break;
							}
						    echo "<a href='./currentlyBorrowedBooks.php?page=".$i."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white;\">".$i." </button></a>";
						};
						if($page!=$total_pages){
							$k=$page+1;
							echo "<a href='./currentlyBorrowedBooks.php?page=".$k."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l."</button></a> ";
							$q=$page+10;
							if ($q>$total_pages) {
								$q=$total_pages;
								echo "<a href='./currentlyBorrowedBooks.php?page=".$q."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
							}else{
								echo "<a href='./currentlyBorrowedBooks.php?page=".$q."'><button style=\"padding-left: 10px;padding-right: 10px;border: none;background-color: white; \">" .$l2."</button></a> ";
							}	
							
							
	                    }
				        }
				        
				     

				        
				    ?>
                    <br>
					<!-- INSERT TABLE HERE -->
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