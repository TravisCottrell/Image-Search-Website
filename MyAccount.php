<html>
	<title>My Account</title>
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

<div class="centered">
  <a href="https://www.agoda.com/?cid=1735414&tag=40510_102bc8d10a8f10a072d1cfaa433781" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>

<div class="fixright">
  <a href="http://www.priceline.com/?vrid=2406db20bf6d2767d32ad1a14f909e82" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad4.png" id="adBanner" alt="Ad Banner" /> </center>
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
					<center><h2>User Information</h2></center>
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
									<input type="text" class="form-control" name="firstname" placeholder="First Name" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
								</div>
                                <div class="form-group">
									<input type="text" class="form-control" name="Address" placeholder="Address" required>
								</div>
                                <div class="form-group">
									<input type="text" class="form-control" name="City" placeholder="City" required>
								</div>
                                <div class="form-group">
									<input type="text" class="form-control" name="Region" placeholder="Region" required>
								</div>
                                <div class="form-group">
									<input type="text" class="form-control" name="Country" placeholder="Country" required>
								</div>
                                <div class="form-group">
									<input type="text" class="form-control" name="Postal" placeholder="Postal" required>
								</div>
                                <div class="form-group">
									<input type="text" class="form-control" name="Phone" placeholder="Phone Number" required>
								</div>
                                <div class="form-group">
                                    <h5>Privacy</h5>
									<input type="radio" class="form-check-input" name="Privacy" value="1">
                                    <label class="form-check-label" for="1">show info</label><br>
                                    <input type="radio" class="form-check-input" name="Privacy" value="2">
                                    <label class="form-check-label" for="2">hide info</label>
								</div>
								<div class="form-group">
									<input type="submit" class="form-control btn btn-outline-info" name="userinfo" value="Submit">
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
 <script type="text/javascript">
    window.onload = initBannerLink;

var thisAd = 0;

function initBannerLink() {
  if (document.getElementById("adBanner").parentNode.tagName == "A") {
    document.getElementById("adBanner").parentNode.onclick = newLocation;
  }
  
  rotate();
}

function newLocation() {
  var adURL = new Array("priceline.com/?vrid=2406db20bf6d2767d32ad1a14f909e82","baidu.com","so.com");
  document.location.href = "http://www." + adURL[thisAd];
  return false;
}

function rotate() {
  var adImages = new Array("https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png","https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png","https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png");

  thisAd++;
  if (thisAd == adImages.length) {
    thisAd = 0;
  }
  document.getElementById("adBanner").src = adImages[thisAd];

  setTimeout(rotate, 3 * 1000);
}
  </script>


</html>