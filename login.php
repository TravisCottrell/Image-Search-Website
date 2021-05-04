<?php 
require_once("DB.class.php");
$dbhandle = new DB();

if(isset($_POST['submit'])) {

	$_SESSION['name'] = htmlentities($_POST['name']);
	$_SESSION['password'] = htmlentities($_POST['password']);

	$username = $_SESSION['name'];
	$userpass = $_SESSION['password'];

	$username = stripcslashes($username);
	$userpass = stripcslashes($userpass);

	$userlogin = $dbhandle->get_for_user_name($username, $userpass);
	$_SESSION['UID'] = $userlogin['UID'];
	$_SESSION['State'] = $userlogin['State'];
	

	// $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	// $result = $mysqli->query("SELECT * FROM `traveluser` WHERE UserName = '$username' AND Pass = '$userpass'");	
	// 	if($result->num_rows == 0) {
	// 	    echo '<script>alert("These credentials are invalid")</script>';
	// 	    session_destroy();
	// 	} else {
	// 	    header('Location: index.php');
	// 	}
	// $mysqli->close();
}

if(isset($_POST['submit_2'])) {
	session_destroy();
	header("location: index.php");
}

?>

<html>
	<title>Login</title>
<?php include 'header.inc.php'; ?>
<body>

<div class="centered">
  <a href="https://www.kayak.com/horizon/sem/hotels/general?lang=en&skipapp=true&destination=c39163&kw=-1&gclid=Cj0KCQjwvr6EBhDOARIsAPpqUPGOb3WYX8PIVFIRqHe_joXdmXi2bfd7TUFlOZB1J-5NqvmdQJwOVs4aAp1kEALw_wcB&g_kw=kayak&aid=103175289976" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>

<div class="fixright">
  <a href="http://www.priceline.com/?vrid=2406db20bf6d2767d32ad1a14f909e82" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad3.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12"><br></div>
		</div>

		<div class="card border-secondary">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
					<center><h2>Login</h2></center>
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
									<input type="text" class="form-control" name="name" placeholder="Enter email">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="password" placeholder="Enter Password">
								</div>
								<div class="form-group">
									<input type="submit" class="form-control btn btn-outline-info" name="submit" value="Log In">
								</div>
								<div class="form-group">
									<input type="submit" class="form-control btn btn-outline-danger" name="submit_2" value="Log Out">
								</div>
							</form>
						</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</div>

	</div>
</body>
<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>


</html>