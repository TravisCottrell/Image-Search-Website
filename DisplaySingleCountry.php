<?php 
require_once("DB.class.php");
$dbhandle = new DB();

if(isset($_GET["ISO"])){
    $countryinfo = $dbhandle->get_for_SingleCountry_countryinfo($_GET["ISO"]);
    $imagesdetails = $dbhandle->get_for_SingleCountry_imagedetails($_GET["ISO"]);
}



?>
<html>
<title>Single Country</title>

<body>
    <?php include 'header-sidebar.inc.php'; ?>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h2><?php echo $countryinfo["CountryName"]; ?></h2>
                </div>
            </div>
                
                <div class="row">
                    <div class="col-md-8">            
                        <?php
                            //get the images associated with the imageIDs
                            foreach($imagesdetails as $image){  
                                $imageIDs = $dbhandle->get_for_SingleCountry_image($image["ImageID"]);
                        ?> 
                        <!-- image with link -->
                        <?php echo "<a href='SingleImage.php?id=" .$imageIDs["ImageID"] ."'>"."<img src='images/square-medium/" . $imageIDs['Path'] ."' class='img-thumbnail'></a>"; ?> 
                        <?php } ?> <!--end foreach loop -->
                    </div><!--end card-deck -->
                      
                    <div class="col-md-4" >
                        <!-- City details card -->
                        <div class="card">
                            <div class="card-header" >
                            <?php echo $countryinfo["CountryName"]; ?> Details
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Capital: <?php echo $countryinfo["Capital"]; ?>
                                 </li>
                                 <li class="list-group-item">
                                    Area: <?php echo $countryinfo["Area"]; ?>
                                 </li>
                                <li class="list-group-item">
                                    Population: <?php echo $countryinfo["Population"]; ?>
                                 </li>
                                <li class="list-group-item">
                                    Currency: <?php echo $countryinfo["CurrencyCode"];?>
                                </li>
                                <li class="list-group-item">
                                    flag: <?php echo "temp";?>
                                </li>
                            </ul>
                        </div>
 
                    </div>
                </div>



                
            
        </div>
        

    <?php include 'footer-sidebar.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>

</body>

</html>