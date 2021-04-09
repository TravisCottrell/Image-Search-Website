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
    //inner joins of info related to imageId
    $sql = 'SELECT * FROM (travelimage inner join travelimagedetails on travelimage.ImageID = travelimagedetails.ImageID)';
    $result = $pdo->query($sql);
    while($travelimages = $result->fetch()){
        if($travelimages["ImageID"] == $_GET["id"]){
            $imageinfo = $travelimages; 
            
        }
    }

    //get rating info
    $sql = "SELECT avg(Rating), count(ImageID) FROM `travelimagerating` WHERE ImageID =" . $imageinfo["ImageID"];
    $result = $pdo->query($sql);
    $ratinginfo = $result->fetch();
    
    if(isset($imageinfo["CityCode"])){
        //get city info
        $sql = "SELECT * FROM geocities WHERE GeoNameID =" . $imageinfo["CityCode"];
        $result = $pdo->query($sql);
        $cityinfo = $result->fetch();
    }else{
        $cityinfo['AsciiName'] = "not available";
        $cityinfo['Latitude']= "not available";
        $cityinfo['Longitude']= "not available";
    }
        //get country info
        $sql = "SELECT * FROM geocountries WHERE ISO ="."'" . $imageinfo["CountryCodeISO"]."'";
        $result = $pdo->query($sql);
        $countryinfo = $result->fetch();

        //get poster info
        $sql = "SELECT * FROM traveluserdetails WHERE UID ="."'" . $imageinfo["UID"]."'";
        $result = $pdo->query($sql);
        $userinfo = $result->fetch();   
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
<?php include 'header.inc.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $imageinfo["Title"]; ?></h2>                            
            <p> <?php echo "By: " . $userinfo["FirstName"]." ". $userinfo["LastName"]; ?> </p>
        </div>           
            <div class="col-md-8">
                <a href="#myModal" role="button" data-toggle="modal">
                    <img src="images/medium/<?php echo $imageinfo['Path']?>" class="rounded" >
                </a>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-xl"  role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $imageinfo["Title"]; ?>
                                    </h5>
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
                                <div class="card-header" >
                                    Image Details
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Country: <?php echo $countryinfo['CountryName']; ?></li>
                                    <li class="list-group-item">City: <?php echo $cityinfo['AsciiName']; ?></li>
                                    <li class="list-group-item">Latitude: <?php echo $cityinfo['Latitude']; ?></li>
                                    <li class="list-group-item">Longitude: <?php echo $cityinfo['Longitude']; ?></li>
                                </ul>
                            </div>
                        </div>               
                </div>       <!-- END Image info Card     --> 
            </div>
    </div>
</div>

<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
</script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>