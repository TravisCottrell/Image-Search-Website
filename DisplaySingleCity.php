<?php 
require_once("DB.class.php");
$dbhandle = new DB();

if(isset($_GET["ID"])){
$cityinfo = $dbhandle->get_for_SingleCity_cityinfo($_GET["ID"]);
$imagesdetails = $dbhandle->get_for_SingleCity_imagedetails($_GET["ID"]);
}

?>
<html>
<title>Single City</title>
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
    <?php include 'header-sidebar.inc.php'; ?>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h2><?php echo $cityinfo["AsciiName"]; ?></h2>
                </div>
            </div>
                
                <div class="row">
                    <div class="col-md-8">            
                        <?php
                            //get the images associated with the imageIDs
                            foreach($imagesdetails as $image){  
                                $imageIDs = $dbhandle->get_for_SingleCity_image($image["ImageID"]);
                        ?> 
                        <!-- image with link -->
                        <?php echo "<a href='SingleImage.php?id=" .$imageIDs["ImageID"] ."'>"."<img src='images/square-medium/" . $imageIDs['Path'] ."' class='img-thumbnail'></a>"; ?> 
                        <?php } ?> <!--end foreach loop -->
                    </div><!--end card-deck -->
                      
                    <div class="col-md-4" >
                        <!-- City details card -->
                        <div class="card">
                            <div class="card-header" >
                            <?php echo $cityinfo["AsciiName"]; ?> Details
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Country: <?php echo $cityinfo["CountryCodeISO"];?>
                                </li>
                                <li class="list-group-item">
                                    Population: <?php echo $cityinfo["Population"]; ?>
                                 </li>
                                <li class="list-group-item">
                                    Elevation: <?php echo $cityinfo["Elevation"];?>
                                </li>
                            </ul>
                        </div>
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
        

    <?php include 'footer-sidebar.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGJYrKkzXNu85MzeBlb0-6qirxXoMuwsA&callback=initMap"> </script>
</body>

</html>