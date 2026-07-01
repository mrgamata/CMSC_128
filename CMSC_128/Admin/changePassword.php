<?php include "../header.php"?>

    <header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-color: #602020" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<h2>Change password for</h2>
							<h1 class="cursive-font">
								<?php echo $_SESSION['username']?>
							</h1>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<form class="register-form" action="includes/pwchange.inc.php" method="post" onsubmit="return confirm('Are you sure you want to change your password?');"><div class="row form-group">
						<div class="col-md-12">
							<label for="currPwd">Current Password</label>
							<input type="password" name="currPwd" id="currPwd" class="form-control" placeholder="Current Password..." required>
						</div>
					</div>

					<div align="center">
						<?php
							if (isset($_GET["error"])) {
								if ($_GET["error"] == "wrongPwd") {
									echo "<p> Incorrect Password! </p>";
									if (isset($_SESSION["attempt"])) {
										echo "Attempt Remaining: ";
										echo(5-$_SESSION["attempt"]);
									}
									if (isset($_SESSION["attempt_again"])) {
										echo("<br>");
										echo "Try again in: ";
										echo($_SESSION["attempt_again"]-time());
									}

								}
							}
						?>
					</div>
					
					<div class="row form-group">
						<div class="col-md-12">
							<label for="newPwd">New Password</label>
							<input type="password" name="newPwd" id="newPwd" class="form-control" placeholder="New Password..." required>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label for="conPwd">Confirm New Password</label>
							<input type="password" name="conPwd" id="conPwd" class="form-control" placeholder="Confirm New Password..." required>
						</div>
					</div>

					<div align="center">
						<?php
							if (isset($_GET["error"])) {
								if ($_GET["error"] == "differentPwds") {
									echo "<p>Please confirm password correctly.</p>";									
								}
							}
						?>
					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<input type="submit" name="submit" class="btn btn-primary btn-block" value="Change Password">
						</div>
					</div>

					<div align="center">
						<?php
							if (isset($_GET["success"])) {
								if ($_GET["success"] == "pwdChanged") {
									echo "<p>Password changed successfully.</p>";									
								}
							}
						?>
					</div>
                    
                </form>
			</div>
		</div>
	</div>


<?php include "../footer.php";?>