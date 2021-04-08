<?php 

require_once('config.php'); 
try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}
?>


<html>
<title>Post List</title>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/mystyle.css" />
    
</head>


<body  >
<?php include 'header.inc.php'; ?>
<div class="container">
    
    <ul>
        <h2>Post List</h2>
        <?php 
        $sql = "SELECT * FROM travelpost ORDER BY Title";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo "<li><a href=' Part02_SinglePost.php?id=" .$row["PostID"]. "'>" . $row["Title"]. "</a></li>"; 
        }
        ?>
    </ul>
</div>

<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>