<?php 
require_once("DB.class.php");
$dbhandle = new DB();


?>

<html>
<title>Admin</title>

<body>
<?php include 'header.inc.php'; ?>
<div class="container">
    <div class="row">

		<ul><?php $dbhandle->get_for_adminUserList(); ?></ul>

	</div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

<?php include 'footer.inc.php'; ?>
