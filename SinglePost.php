<?php 

require_once('config.php'); 
try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}

if(isset($_GET["id"])){

    //get the UID from database 
    $sql = 'SELECT * FROM travelpost WHERE PostID ="' . $_GET["id"] . '"';
    $result = $pdo->query($sql);
    $travelPost = $result->fetch();

    //check if the query was succesful
    $count = $result->rowCount();
    if($count  <= 0){
        //if it wasnt, redirect to error page 
        header("Location: error.php");
        exit();
    }

    //use UID to get the traveluserdetils
    $sql = 'SELECT * FROM traveluserdetails WHERE UID ="' . $travelPost['UID'] . '"';
    $result = $pdo->query($sql);
    $userInfo = $result->fetch();
    

    //get the imagesIDs associated with the postID
    $sql = 'SELECT * FROM travelpostimages WHERE PostID ="' . $_GET["id"] . '"';
    $result = $pdo->query($sql);
    
}

?>


<html>
<title>Single Post</title>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="css/mystyle.css" />
    
</head>


<body  >
<?php include 'header.inc.php'; ?>
<div class="container-fluid"><br>
    <div class="row" >
        
        <div class="col-md-2" >
            <div class="card ">
                <div class="card-header" >Countries</div>
                <ul class="list-group">
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">United States</li>
                </ul>
                <div class="card-header" >Cities</div>
                <ul class="list-group">
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                    <li class="list-group-item">Temp</li>
                </ul>
            </div>
        </div>
            

        <div class="col-md-7" >
            <H2><?php echo $travelPost["Title"]; ?></h1>
            <div class="row">
                <div class="col">
                    <p> <?php echo $travelPost["Message"]; ?> </p>
                </div>
            </div>

            <div class="row" >
                <div class="col">
                    <h3>Travel images for this post </h3>
                </div>
            </div>
            <div class="row" >
                <div class="card-deck">
                    <?php
                        //get the images associated with the imageIDs
                        while($imageIDs = $result->fetch()){
                            $sql = 'SELECT * FROM travelimage WHERE ImageID ="' . $imageIDs["ImageID"] . '"';
                            $result1 = $pdo->query($sql);
                            $imagePath = $result1->fetch();
                            
                            $sql2 = 'SELECT * FROM travelimagedetails WHERE ImageID ="' . $imageIDs["ImageID"] . '"';
                            $result2 = $pdo->query($sql2);
                            $imagedetails = $result2->fetch();     
                    ?> 
                    <div class="card">
                        <?php echo "<a href='Part03_SingleImage.php?id=" .$imageIDs["ImageID"] ."'>"."<img src='images/square-medium/" . $imagePath['Path'] ."' class='card-img-top'></a>"; ?>
                        <div class="card-body  flex-column">
                            <p class="card-text"> <?php echo "<a href='Part03_SingleImage.php?id=" .$imageIDs["ImageID"] ."'>".  $imagedetails["Title"] ."</a>";?></p>
                            <?php echo "<a class='mt-auto btn btn-primary'   href='Part03_SingleImage.php?id=" .$imageIDs["ImageID"]. "' role='button'>View</a>";?>
                            <button type="button" class="btn btn-secondary">fav</button>
                        </div>
                    </div>
                    <?php } ?> <!--end while loop -->
                </div> <!--end card-deck -->
            </div>
        </div>
            
        <div class="col-md-2" >
            <div class="card">
                <div class="card-header" >Post Details</div>
                    <ul class="list-group">
                        <li class="list-group-item">Date: <?php echo $travelPost["PostTime"]; ?></li>
                        <li class="list-group-item">Posted By: 
                            <?php 
                                $fullName = "<a href='#'>" . $userInfo["FirstName"] . " " . $userInfo["LastName"] . "</a>";
                                echo $fullName;
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>