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
                    <div class="col-md-9">            
                        <?php
                            //get the images associated with the imageIDs
                            foreach($images as $imageIDs){     
                                //image with link 
                                echo "<a href='SingleImage.php?id=" .$imageIDs["ImageID"] ."'>"."<img src='images/square-medium/" . $imageIDs['Path'] ."' class='img-thumbnail'></a>"; 
                            } 
                         ?> <!--end foreach loop -->
                    </div><!--end card-deck -->
                      
                    <div class="col-md-3" >
                        <!-- user details card -->
                        <div class="card">
                            <div class="card-header" >
                             User Details
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Country: 
                                    <?php 
                                        echo $userinfo["Country"];
                                    ?>       
                                </li>
                                <li class="list-group-item">
                                    City: 
                                    <?php
                                        echo $userinfo["City"]; 
                                    ?>
                                 </li>
                                <li class="list-group-item">
                                    Address:
                                    <?php 
                                        if($userinfo["Privacy"] == "1"){
                                        echo $userinfo["Address"];
                                        }else{ echo "hidden";}
                                    ?>
                                </li>
                                <li class="list-group-item">
                                    Email: 
                                    <?php    
                                        if($userinfo["Privacy"] == "1"){
                                            echo $userinfo["Email"];
                                        }else{ echo "hidden";}    
                                    ?>                                    
                                        
                                </li>
                                <li class="list-group-item">
                                    Phone: 
                                    <?php    
                                        if($userinfo["Privacy"] == "1"){
                                            echo $userinfo["Phone"]; 
                                        }else{ echo "hidden";} 
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



                <!-- temp -->
            
        </div>
        
<div class="row">
    <div class="centered">
  <a href="https://www.southwesternrailway.com/" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad33.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>
    <?php include 'footer-sidebar.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>