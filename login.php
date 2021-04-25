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
}

?>

<html>
	<title>Login</title>
<?php include 'header.inc.php'; ?>
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