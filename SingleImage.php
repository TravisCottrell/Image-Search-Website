<?php 
require_once("DB.class.php");
$dbhandle = new DB();

if(isset($_GET["id"])){
    //inner joins of info related to imageId
    $imageinfo = $dbhandle->get_imageinfo($_GET['id']);

    //get rating info
    $ratinginfo = $dbhandle->get_imagerating($imageinfo["ImageID"]);
    
    if(isset($imageinfo["CityCode"])){
        //get city info
        $cityinfo = $dbhandle->get_imagecity($imageinfo["CityCode"]);
    }else{
        $cityinfo['AsciiName'] = "not available";
        $cityinfo['Latitude']= "not available";
        $cityinfo['Longitude']= "not available";
    }
        //get country info
        $countryinfo = $dbhandle->get_imagecountry($imageinfo["CountryCodeISO"]);
        //get poster info
        $userinfo = $dbhandle->get_imageposter($imageinfo["UID"]);
}

if(isset($_POST['submit'])){

}

function writereview(){
    //rating stars: used the code from: https://codepen.io/hesguru/pen/BaybqXv
    echo '<div class="row" id="searchform">
            <div class="col-md-10">
                <h5>Leave a Review</h5>
                <form method="post">
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" required/>
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="reviewtext" rows="3"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </div>';
}
?>

<title>Single Image</title>
<head>  
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of location
       <?php echo "var location = { lat: " . $cityinfo['Latitude'] ."," ."lng: " .$cityinfo['Longitude']. "};" ; ?>
        // The map, centered at location
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: location,
        });
        // The marker, positioned at location
        var marker = new google.maps.Marker({
          position: location,
          map: map,
        });
      }
    </script>
</head>

<body>
<?php include 'header.inc.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- title, name, fav button -->
            <h2><?php echo $imageinfo["Title"]; ?></h2>                            
            <p>By: <?php echo  "<a href='DisplaySingleUser.php?UID=".$userinfo["UID"]."'>" . $userinfo["FirstName"]." ". $userinfo["LastName"]; ?> </p>
            <?php echo '<a href="favorites.php?id='. $imageinfo["ImageID"] .'"><button type="button" class="btn btn-secondary">Fav</button></a><br>';?><br>
        </div>           
        <div class="col-md-8">
            <a href="#myModal" role="button" data-toggle="modal">
                <!-- image -->
                <img src="images/medium/<?php echo $imageinfo['Path']?>" class="rounded" >
            </a>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-xl"  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $imageinfo["Title"]; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <img src="images/large/<?php echo $imageinfo['Path']?>" class="rounded" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                    
                        </div>
                    </div>
                </div>
            </div>

            <!-- review box and stars if logged in-->
            <?php if(isset($_SESSION['name'])){writereview();}?>
            
        </div>

        <div class="col-md-4">    
            <div class="card"> <!-- START Rating Card -->
                <div class="card-header" > 
                    Rating
                </div>           
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?php echo $ratinginfo["avg(Rating)"]."(". $ratinginfo["count(ImageID)"]. " votes)";  ?></li>
                </ul>                          
            </div> <!-- END Rating Card -->
            <br>
            <div class="row"> <!-- START Image info Card -->
                <div class="col">                          
                    <div class="card">
                        <div class="card-header" >Image Details</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Country: <?php echo "<a href='DisplaySingleCountry.php?ISO=".$countryinfo["ISO"]."'>".$countryinfo["CountryName"]."</a>"; ?></li>
                            <li class="list-group-item">City: <?php echo "<a href='DisplaySingleCity.php?ID=".$cityinfo["GeoNameID"] ."'>". $cityinfo['AsciiName']."</a>"; ?></li>
                        </ul>
                    </div><!-- END Image info Card     -->
                    <br> 
                    <div class="row"> <!-- map -->
                        <div class="col">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" >
                                        <a class="card-link" data-toggle="collapse" href="#collapseMap">
                                            Map <span class="bi bi-caret-down-fill"></span>
                                        </a>
                                    </div>
                                    <div id="collapseMap" class="collapse" data-parent="#accordion">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><div id="map"></div></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- map -->

                </div>               
            </div>       
        </div>
        
    </div>
   

  </div>
</div>

 <?php include 'footer.inc.php'; ?> 

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGJYrKkzXNu85MzeBlb0-6qirxXoMuwsA&callback=initMap"> </script>

</body>

</html>
