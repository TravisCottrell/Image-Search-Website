<?php 
require_once("DB.class.php");
$dbhandle = new DB();

if(isset($_GET["UID"])){
    $userinfo = $dbhandle->get_for_SingleUser_info($_GET["UID"]);
    $postInfo = $dbhandle->get_for_singlepost_userposts($_GET["UID"]);
    $images = $dbhandle->get_for_SingleUser_relatedimages($_GET["UID"]);
    


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
                    <h2><?php echo $userinfo["FirstName"] . " ". $userinfo["LastName"]; ?></h2>
                </div>
            </div>
                <!-- temp -->
                <div class="row">
                    <div class="col-md-9" >
                                       
                    <?php
                        //get the images associated with the imageIDs
                        foreach($images as $imageIDs){     
                    ?> 
                        <div class="col-md-3">
                            
                                
                                    <!-- image with link -->
                                    <?php echo "<a href='SingleImage.php?id=" .$imageIDs["ImageID"] ."'>"."<img src='images/square-medium/" . $imageIDs['Path'] ."' class='img-thumbnail'></a>"; ?>
                                
                            
                        </div> <!--end card-deck -->
                    <?php } ?> <!--end foreach loop -->
                    </div>
                      
                    <div class="col-md-3" >
                        <!-- user details card -->
                        <div class="card">
                            <div class="card-header" >
                             User Details
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Country: <?php echo $userinfo["Country"];?>
                                </li>
                                <li class="list-group-item">
                                    City: <?php echo $userinfo["City"]; ?>
                                 </li>
                                <li class="list-group-item">
                                    Address: <?php echo $userinfo["Address"];?>
                                </li>
                                <li class="list-group-item">
                                    Email: <?php echo $userinfo["Email"];?>
                                </li>
                                <li class="list-group-item">
                                    Phone: <?php echo $userinfo["Phone"];?>
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



                <!-- temp -->
            
        </div>
        

    <?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>