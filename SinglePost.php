<?php 
require_once("DB.class.php");
$dbhandle = new DB();


if(isset($_GET["id"])){
     //get the UID from database with PostID 
    $travelPost = $dbhandle->get_for_singlepost_UID($_GET["id"]);

     //use UID to get the traveluserdetils
    $userInfo = $dbhandle->get_for_singlepost_names($travelPost["UID"]);

      //use UID to get the travelpost
    $postInfo = $dbhandle->get_for_singlepost_userposts($travelPost['UID']);
    
    //get the imagesIDs associated with the postID
    $images = $dbhandle->get_for_singlepost_related_images($_GET["id"]);
}
?>

<html>
<title>Single Post</title>

<body>
<?php include 'header-sidebar.inc.php'; ?>


        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <br>
                <h2><?php echo $travelPost["Title"]; ?></h2>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-9" >
                    <p> <?php echo $travelPost["Message"]; ?> </p>            
                    </div>
                      
                    <div class="col-md-3" >
                        <!-- Add post to favorites -->
                        <?php echo '<a href="favorites.php?postid='. $travelPost["PostID"] .'"><button type="button" class="btn btn-outline-secondary btn-sm"><span class="bi bi-heart-fill nav-link"> Add to Favorites</button></a><br>';?> <br>
                        <!-- Post details card -->
                        <div class="card">
                            <div class="card-header" >
                             Post Details
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Date: <?php echo $travelPost["PostTime"]; ?>
                                 </li>
                                <li class="list-group-item">
                                    Posted By: 
                                    <?php 
                                        $fullName = "<a href='DisplaySingleUser.php?UID=".$userInfo["UID"]."'>" . $userInfo["FirstName"] . " " . $userInfo["LastName"] . "</a>";
                                        echo $fullName;
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <!-- other posts card -->
                        <div class="card">
                            <div class="card-header" >
                                Posts from this user
                            </div>
                            <ul class="list-group list-group-flush">
                                <?php
                                    foreach($postInfo as $posts){
                                        echo "<a href='SinglePost.php?id=".$posts["PostID"]."'><li class='list-group-item'>". $posts["Title"] ."</li></a>";
                                    }
                                ?> 
                            </ul>
                        </div>
                    </div>
                </div>

            <div class="row">
                
                    <h3>Travel images for this post </h3>
                
            </div>

            <div class="row">
                
                    <?php
                        //get the images associated with the imageIDs
                        foreach($images as $imageIDs){     
                    ?> 
                        <div class="col-md-3">
                            <div class="card border-dark mb-3">
                                <center>
                                    <!-- image with link -->
                                    <?php echo "<a href='SingleImage.php?id=" .$imageIDs["imagePath"]["ImageID"] ."'>"."<img src='images/square-medium/" . $imageIDs["imagePath"]['Path'] ."' class='img-thumbnail'></a>"; ?>

                                    <!-- title with link -->
                                    <p> <?php echo "<a href='SingleImage.php?id=" .$imageIDs["imagePath"]["ImageID"] ."'>".  $imageIDs["imageDetails"]["Title"] ."</a>";?>
                                    </p>

                                    <!-- view button with link -->
                                    <?php echo "<a href='SingleImage.php?id=" .$imageIDs["imagePath"]["ImageID"]. "'><button type='button' class='btn btn-dark'>
                                    View</a>";?>
                                    </button>
                                    <?php echo '<a href="favorites.php?id='. $imageIDs["imagePath"]["ImageID"] .'">'; ?>
                                        <button type="button" class="btn btn-secondary">Fav</button>
                                    <?php echo '</a>'; ?>
                                    <br>
                                </center>
                            </div>
                        </div> <!--end card-deck -->
                    <?php } ?> <!--end foreach loop -->
                
            </div>
        </div>
</div>

<?php include 'footer-sidebar.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>