<?php 
require_once("DB.class.php");
$dbhandle = new DB();
// $city_code = $_GET['city_code']??false;
// $country_code = $_GET['country_code']??false;
// $continent_code = $_GET['continent_code']??false;

// $search_query = $_POST['q']??false;
?>
<title>Images</title>

<body>
<?php include 'header-sidebar.inc.php'; ?>


<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="index.php">Home</a> / <a href="browse-images.php">Browse</a> / Images
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">     
          <form class="form-inline" action="browse-images.php" method="get">
            <div class="form-group">
                <select class="form-control" name="continent_code">
                    <option value="" selected>Filter by Continent</option>
                    <?php $dbhandle->get_for_browse_continents(); ?>                  
                </select>
              </div>   
               <button type="submit" name="submit" class="btn btn-info">Filter</button>
             
    		  <div class="form-group">
    		    <select class="form-control" name="country_code">
    		    	<option value="" selected>Filter by Country</option>
                    <?php $dbhandle->get_for_browse_countries(); ?>
    		    </select>
    		  </div>
    		  <button type="submit" name="submit_2" class="btn btn-info">Filter</button>

              <button type="submit" name="submit_3" class="btn btn-outline-dark">View All Images</button>
             
    		</form>    

            
        </div>
    </div>
    
   <div class="row">  
    <?php
    if(isset($_GET['submit'])) {
        $selected_cont = $_GET['continent_code'];
        // echo $selected_cont;   
        $pass_continentCode = $dbhandle->get_for_continent_code($selected_cont);
        foreach ($pass_continentCode as $value) {
            $CountryNames = $value['ISO'];
            // print_r($CountryNames); gives array of all countires on a specific continent
            $img_out_on_iso = $dbhandle->get_browse_country_image($CountryNames);
            foreach ($img_out_on_iso as $iso_val) {
                $spec_cont_img = $iso_val['ImageID'];
                echo '<div class="card col-md-3 mb-1">';
                echo '<center><p><a href="SingleImage.php?id='.$spec_cont_img.'"> '.$iso_val['Title'].'</a></p></center>';
                $img_output = $dbhandle->get_country_img_by_Imageid($iso_val['ImageID']);
                    foreach ($img_output as $img_links) {
                    echo '<center><a href="SingleImage.php?id='.$img_links['ImageID'].'"><img src="images/square-medium/'.$img_links['Path'].'" class="img-thumbnail"></a></center>'; 
                    echo '</div>';
                    }
            }

        }
    }

    if(isset($_GET['submit_2'])) {    
        $selected_country = $_GET['country_code'];
        $selected_country;
        $selected_country_data = $dbhandle->get_browse_country_image($selected_country);
        foreach ($selected_country_data as $single_output) {
            $img_id = $single_output['ImageID'];
            echo '<div class="card col-md-3 mb-1">';
            echo '<center><p><a href="SingleImage.php?id='.$img_id.'"> '.$single_output['Title'].'</a></p></center>';
            $img_output = $dbhandle->get_country_img_by_Imageid($single_output['ImageID']);
            foreach ($img_output as $img_links) {
            echo '<center><a href="SingleImage.php?id='.$img_links['ImageID'].'"><img src="images/square-medium/'.$img_links['Path'].'" class="img-thumbnail"></a></center>'; 
            echo '</div>';
            }
        }
    }
    
    if(isset($_GET['submit_3'])) {  
    $dbhandle->get_all_images();
    }
    ?>                    
    </div>   
</div>

<?php include 'footer-sidebar.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>