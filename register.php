<html>
	<title>Register</title>
<?php 
include 'header.inc.php'; 
require_once("DB.class.php");
$dbhandle = new DB();
$newaccount = false;
if(isset($_POST['create'])){
    $newaccount = $dbhandle->create_new_user($_POST['name'],$_POST['password']);
	if(!$newaccount) echo '<script>alert("sorry, there was a problem creating your account.")</script>';
}

?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12"><br></div>
		</div>

		<div class="card border-secondary">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
					<center><h2>Register</h2></center>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-md-3"></div>
						<div class="col-md-6">
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<div class="form-group">
									<input type="email" class="form-control" name="name" placeholder="Enter email" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="password" placeholder="Enter Password" required>
								</div>
								<div class="form-group">
									<input type="submit" class="form-control btn btn-outline-info" name="create" value="Create Account">
								</div>
                                <div class="container signin">
                                    <p>Already have an account? <a href="login.php">Log in</a>.</p>
                                </div>
							</form>
						</div>
					<div class="col-md-3"></div>
				</div>
				<?php
					if($newaccount){
						Echo "<center>Account Created!</center>";
					}
				?>
			</div>
		</div>

	</div>
		<div class="centered">
  <a href="https://www.opentable.com/" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>
</body>
<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>



</html>