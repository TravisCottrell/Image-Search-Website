<?php
require_once("DB.class.php");
$dbhandle = new DB();
$citydropdown = $dbhandle->get_for_search_citiesdropdown();
$countrydropdown = $dbhandle->get_for_search_countriesdropdown();

function printsearch(){
    $dbhandle = new DB();
    if(isset($_GET["ContinentCode"])){
        $filteredimages = $dbhandle->get_for_search_imagescontinent($_GET["ContinentCode"]);

        if($filteredimages != null){
            echo '<div class="row ">';
            foreach($filteredimages as $image){
                echo '<div class="card col-md-3 mb-1">';
               // echo '<center><p><a href="SingleImage.php?id='.$image['ImageID'].'"> '.$image['Title'].'</a></p></center>';
                echo '<center><a href="favorites.php?id='. $image["ImageID"] .'"><button type="button" class="btn btn-secondary">Fav</button></a> </center><br>';
                echo '<center><a href="SingleImage.php?id='.$image['ImageID'].'"><img src="images/square-medium/'.$image['Path'].'" class="img-thumbnail"></a></center>';
                echo '</div>'; 
            }    
            echo '</div>';
        }else{echo "<h3>No Matches</h3>";}  
    }

    //posts filter
    if(isset($_GET["filteroption"])){
        if($_GET["filteroption"] == "option1"){
            if(isset($_GET["filtertext"]) && $_GET["filtertext"] != '' ){
                $posts = $dbhandle->get_for_search_posts($_GET["filtertext"]);
                if($posts != null){
                    //print posts
                    foreach($posts as $post){
                        echo '<div class="row ">';
                        echo '<a href="SinglePost.php?id='. $post["PostID"] .'"' . '<h3>' . $post["Title"] . '</h3></a>';
                        echo '<p>' . $post["Message"] . '</p>';
                        echo '</div><br>';
                    }
                }else{echo "<h3>No Matches</h3>";}   
            }else{echo "<h3>Please Enter Search Criteria</h3>";}
        }

        //images filter
        if($_GET["filteroption"] == "option2" ){
            //filter by text/city/country
            if(isset($_GET["filtertext"]) && $_GET["filtertext"] != '' ){
                $filteredimages = $dbhandle->get_for_search_imagestitle($_GET["filtertext"]);
            }elseif(isset($_GET["cityID"]) && $_GET["cityID"] != '' ){
                $filteredimages = $dbhandle->get_for_search_imagescity($_GET["cityID"]);
            }elseif(isset($_GET["countryID"]) && $_GET["countryID"] != '' ){
                $filteredimages = $dbhandle->get_for_search_imagescountry($_GET["countryID"]);
            }else{
                echo "<h3>Please Enter Search Criteria</h3>";
                $filteredimages = null;
            }

            //print images
            if($filteredimages != null){
                echo '<div class="row ">';
                foreach($filteredimages as $image){
                    echo '<div class="card col-md-3 mb-1">';
                    echo '<center><p><a href="SingleImage.php?id='.$image['ImageID'].'"> '.$image['Title'].'</a></p></center>';
                    echo '<center><a href="favorites.php?id='. $image["ImageID"] .'"><button type="button" class="btn btn-secondary">Fav</button></a> </center><br>';
                    echo '<center><a href="SingleImage.php?id='.$image['ImageID'].'"><img src="images/square-medium/'.$image['Path'].'" class="img-thumbnail"></a></center>';
                    echo '</div>'; 
                }    
                echo '</div>';
            }else{echo "<h3>No Matches</h3>";}  
        } 
    }
}
?>

<html>
<title>Search</title>
<body>
    <?php include 'header.inc.php'; ?>
   <div class="fixright">
        <a href="https://www.expedia.com/"><img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad4.png"></a>
      </div>
    <div class="container"> <br>
        <div class="row">
            <h3> Search Results </h3>
        </div>
        
        <!-- search form  -->
        <div class="row " id="searchform" >
            <div class="col"><br>
                <form method="get">
                    <div class="form-group ">
                        <input type="text" class="form-control" name="filtertext" id="textinput" placeholder="Search" >
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filteroption" id="filterposts" value="option1" checked>
                        <label class="form-check-label" for="filterposts">Filter by Posts</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filteroption" id="filterimages" value="option2">
                        <label class="form-check-label" for="filterimages">Filter by Images</label>
                    </div>
                    <div class="form-inline">
    		            <select class="form-control" name="cityID">
    		    	        <option value="">filter Cities Images</option>
                            <?php 
                                foreach($citydropdown as $cities){
                                    echo "<option value='". $cities["GeoNameID"] ."'> ". $cities["AsciiName"] ." </option>"; 
                                }
                            ?>
                        </select>
                        <select class="form-control" name="countryID">
    		    	        <option value="">filter Countries Images</option>
                            <?php 
                                foreach($countrydropdown as $countries){
                                    echo "<option value='". $countries["ISO"] ."'> ". $countries["CountryName"] ." </option>"; 
                                }
                            ?>
                        </select>
    		        </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div><br>
        <!-- search form end -->

        <?php printsearch(); ?>
    </div>

     <div class="fixbottom">
          <a href="https://www.germany.travel/en/home.html"><img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad34.png"></a>
      </div>
    <?php include 'footer.inc.php'; ?>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>