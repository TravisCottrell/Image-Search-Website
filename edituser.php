<?php require_once("DB.class.php");
$dbhandle = new DB();


if(isset($_GET['UID'])) {
	$user_UID = $_GET['UID'];
	$user_info_to_edit = $dbhandle->edit_user_info($user_UID);
	$UID = $user_info_to_edit['UID'];
    $firstname = $user_info_to_edit['FirstName'];
    $lastname = $user_info_to_edit['LastName'];
    $address = $user_info_to_edit['Address'];
    $city = $user_info_to_edit['City'];
    $region = $user_info_to_edit['Region'];
    $country = $user_info_to_edit['Country'];
    $postal = $user_info_to_edit['Postal'];
    $phone = $user_info_to_edit['Phone'];
    $email = $user_info_to_edit['Email'];
	}

if(isset($_POST['submit'])) {
	$UID = $_POST['getid'];
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$region = $_POST['region'];
	$country = $_POST['country'];
	$postal = $_POST['postal'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$dbhandle->update_user($firstname,$lastname,$address,$city,$region,$country,$postal,$phone,$email,$UID);
}

?>
<html>
<title>Admin Edit Users</title>


<?php include 'header.inc.php'; ?>
<body>
<div class="container">
    <div class="row">
			<h2>Selected User Current Details</h2>
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">First name</th>
			      <th scope="col">Last name</th>
			      <th scope="col">Address</th>
			      <th scope="col">City</th>
			      <th scope="col">Region</th>
			      <th scope="col">Country</th>
			      <th scope="col">Postal</th>
			      <th scope="col">Phone</th>
			      <th scope="col">Email</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><?php echo $firstname; ?></td>
			      <td><?php echo $lastname; ?></td>
			      <td><?php echo $address; ?></td>
			      <td><?php echo $city; ?></td>
			      <td><?php echo $region; ?></td>
			      <td><?php echo $country; ?></td>
			      <td><?php echo $postal; ?></td>
			      <td><?php echo $phone; ?></td>
			      <td><?php echo $email; ?></td>
			    </tr>
			  </tbody>
			</table>
	</div>
	<br>

	<?php 
	if (isset($_POST['submit'])) {
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Account has been updated!!</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>'; 
	}
?>
<h2>Update User Details</h2>

<div class="row">
		<form method="post" action="edituser.php">
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="fname">Firstname</label>
		      <input type="text" class="form-control" id="fname" name="fname"  placeholder="Firstname">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="inputPassword4">Lastname</label>
		      <input type="text" class="form-control" id="lname" name="lname" placeholder="Lastname" required>
		    </div>
		  </div>

		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="address">Address</label>
		      <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="city">City</label>
		      <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
		    </div>
		  </div>

		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="region">Region</label>
		      <input type="text" class="form-control" id="region" name="region" placeholder="Region">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="inputPassword4">Country</label>
		      <input type="test" class="form-control" id="country" name="country" placeholder="Country" required>
		    </div>
		  </div>

		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="postal">Postal</label>
		      <input type="text" class="form-control" id="postal" name="postal" placeholder="Postal">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="phone">Phone</label>
		     <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
		    </div>
			</div>

			<div class="form-group">
		    <label for="email">Email</label>
		    <input type="email" class="form-control" id="email" name="email">
		  </div>
			<input type="hidden" name="getid" value="<?php echo $_GET['UID']??NULL; ?>">
		  <button type="submit" class="btn btn-outline-primary col-md-12" name="submit">Confirm Changes</button>
		</form>

</div>


	</div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
<?php include 'footer.inc.php'; ?>
