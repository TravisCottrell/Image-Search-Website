<?php 
require_once("DB.class.php");
$dbhandle = new DB();

if(isset($_GET["id"])){
     //get the UID from database 
    $travelPost = $dbhandle->get_for_singlepost_UID($_GET["id"]);

     //use UID to get the traveluserdetils
    $userInfo = $dbhandle->get_for_singlepost_names($travelPost["UID"]);

      //use UID to get the travelpost
    $postInfo = $dbhandle->get_for_singlepost_userposts($travelPost['UID']);
    
    //get the imagesIDs associated with the postID
    $images = $dbhandle->get_for_singlepost_related_images($_GET["id"]);
   
//     //check if the query was succesful
//     $count = $result->rowCount();
//     if($count  <= 0){
//         // redirect to error page if query wasn't succesful 
//         header("Location: error.php");
//         exit();
//     }
}
?>


<html>
<title>Single Post</title>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/mystyle.css" />
    
</head>


<body  >
<?php include 'header.inc.php'; ?>
<div class="container-fluid"><br>
    <div class="row" >

        <?php include 'sidebar.inc.php'; ?>

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
                        foreach($images as $imageIDs){
                          
                    ?> 
                    <div class="card">
                        <?php echo "<a href='Part03_SingleImage.php?id=" .$imageIDs["imagePath"]["ImageID"] ."'>"."<img src='images/square-medium/" . $imageIDs["imagePath"]['Path'] ."' class='card-img-top'></a>"; ?>
                        <div class="card-body  flex-column">
                            <p class="card-text"> <?php echo "<a href='Part03_SingleImage.php?id=" .$imageIDs["imagePath"]["ImageID"] ."'>".  $imageIDs["imageDetails"]["Title"] ."</a>";?></p>
                            <?php echo "<a class='mt-auto btn btn-primary'   href='Part03_SingleImage.php?id=" .$imageIDs["imagePath"]["ImageID"]. "' role='button'>View</a>";?>
                            <button type="button" class="btn btn-secondary">fav</button>
                        </div>
                    </div>
                    <?php } ?> <!--end foreach loop -->
                </div> <!--end card-deck -->
            </div>
        </div>
            
        
        <div class="col-md-2" >
            <!-- Post details card -->
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
            </div><br>

            <!-- other posts card -->
            <div class="card">
                <div class="card-header" >posts from this user</div>
                <ul class="list-group">
                    <?php
                        foreach($postInfo as $posts){
                            echo "<a href='SinglePost.php?id=".$posts["PostID"]."'><li class='list-group-item'>". $posts["Title"] ."</li></a>";
                        }
                    ?> 
                </ul>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>