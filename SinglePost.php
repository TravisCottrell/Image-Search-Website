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
                                        $fullName = "<a href='DisplaySIngleUser.php?UID=".$userInfo["UID"]."'>" . $userInfo["FirstName"] . " " . $userInfo["LastName"] . "</a>";
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
                                    <button type="button" class="btn btn-secondary">Fav</button>
                                    <br>
                                </center>
                            </div>
                        </div> <!--end card-deck -->
                    <?php } ?> <!--end foreach loop -->
                
            </div>
        </div>
</div>

<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>