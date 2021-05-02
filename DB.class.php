<?php
require_once('config.php'); 
session_start();

class DB extends PDO{
 
    public function __construct(){
        parent::__construct(DBCONNSTRING,DBUSER,DBPASS);
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    
    public function get_all($table){
        $sql  = "SELECT * FROM $table";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        return $stmt->fetchAll();
    }
    //////////////////////////////////////////////
    //SinglePost.php functions
    //////////////////////////////////////////////
    public function get_for_singlepost_UID($id){
        //get the UID from travelpost
        $sql = 'SELECT * FROM travelpost WHERE PostID ="'. $id .'"';
        return $this->query($sql)->fetch();
        
    }

    public function get_for_singlepost_names($id){
        //use UID to get the traveluserdetils for user details card 
        $sql = 'SELECT * FROM traveluserdetails WHERE UID ="' . $id . '"';
        return $this->query($sql)->fetch();
         
    }

    public function get_for_singlepost_userposts($id){
        //use UID to get the travelpost for all posts from a user
        $sql = 'SELECT * FROM travelpost WHERE UID ="' . $id . '"';
        $postInfo = $this->prepare($sql);
        $postInfo->execute();
        $postInfo->setFetchMode(PDO::FETCH_ASSOC);
        return $postInfo->fetchAll();
    }

    public function get_for_singlepost_related_images($id){
        //get the imagesIDs associated with the postID
        $sql = 'SELECT * FROM travelpostimages WHERE PostID ="' . $id . '"';
        $postid = $this->query($sql);
        while($imageIDs = $postid->fetch(PDO::FETCH_ASSOC)){
            $sql = 'SELECT * FROM travelimage WHERE ImageID ="' . $imageIDs["ImageID"] . '"';
            $result1 = $this->query($sql);
            $imagePath = $result1->fetch(PDO::FETCH_ASSOC);
            
            $sql2 = 'SELECT * FROM travelimagedetails WHERE ImageID ="' . $imageIDs["ImageID"] . '"';
            $result2 = $this->query($sql2);
            $imagedetails = $result2->fetch(PDO::FETCH_ASSOC);  

            $image[] = array(
                'imagePath'=> $imagePath,
                'imageDetails'=> $imagedetails);  
        }

       return $image;
    }
    //////////////////////////////////////////////
    //sidebar functions
    //////////////////////////////////////////////
    public function get_for_sidebar_continents(){
         //continents 
        $sql = 'SELECT * FROM geocontinents Order By ContinentName';
        $continents = $this->query($sql);
        while($continent = $continents->fetch()){
            if($continent["ContinentCode"] != "AN" && $continent["ContinentCode"] != "AS" && $continent["ContinentCode"] != "OC" && $continent["ContinentCode"] != "SA"){
                echo "<li class='list-group-item'>"."<a href='Search.php?ContinentCode=".$continent["ContinentCode"]."'>".$continent["ContinentName"]."</a>"."</li>";
            }
        }
    }

    public function get_for_sidebar_countries(){
        $sql = "select * from travelimagedetails GROUP by CountryCodeISO ";
        $countrycodes = $this->query($sql);
        while($country = $countrycodes->fetch()){
            $sql = "select * from geocountries where ISO ='" . $country["CountryCodeISO"]. "'";
            $result = $this->query($sql);
            $countrynames = $result->fetch();
            
            if(isset($countrynames["CountryName"])){
                echo "<li class='list-group-item'>"."<a href='DisplaySingleCountry.php?ISO=".$country["CountryCodeISO"]."'>".$countrynames["CountryName"]."</a>"."</li>";
            }   
        }
    }

    public function get_for_sidebar_cities(){
        $sql = "select * from travelimagedetails GROUP by CityCode";
        $citycodes = $this->query($sql);
        while($city = $citycodes->fetch()){
            $sql = "select * from geocities where GeoNameID ='" . $city["CityCode"]. "'";
            $result = $this->query($sql);
            $citynames = $result->fetch();
            
            if(isset($citynames["AsciiName"])){
                echo "<li class='list-group-item'>"."<a href='DisplaySingleCity.php?ID=".$city["CityCode"] ."'>".$citynames["AsciiName"]."</a>"."</li>";
            }   
        }
        
    }
    //////////////////////////////////////////////
    // post/userlists.php functions
    //////////////////////////////////////////////
    public function get_for_PostList(){
        echo "<h2>Post List</h2>";
        $sql = "SELECT * FROM travelpost ORDER BY Title";
        $result = $this->query($sql);
        while ($row = $result->fetch()) {
            echo "<li><a href='SinglePost.php?id=" .$row["PostID"]. "'>" . $row["Title"]. "</a></li>"; 
        }
    }

    public function get_for_UserList(){
        echo "<h2>User List</h2>";
        $sql = "SELECT UID, FirstName, LastName FROM traveluserdetails Order BY FirstName";
        $result = $this->query($sql);
        while ($row = $result->fetch()) {
            $fullname = $row['FirstName'] ." ". $row["LastName"];
            echo "<li><a href='DisplaySingleUser.php?UID=".$row["UID"]."'>" . $fullname. "</a></li>"; 
        }
    }
    //////////////////////////////////////////////
    //DisplaySingleUser.php functions
    //////////////////////////////////////////////
    public function get_for_SingleUser_info($UID){
        $sql = "SELECT * FROM traveluserdetails WHERE UID = $UID";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_for_SingleUser_relatedimages($UID){
        $sql = "SELECT * FROM travelimage WHERE UID = $UID";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }
    //////////////////////////////////////////////
    //displaySingleCity.php functions
    //////////////////////////////////////////////
    public function get_for_SingleCity_cityinfo($cityID){
        $sql = "SELECT * FROM geocities WHERE GeoNameID = $cityID";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_for_SingleCity_imagedetails($CityID){
        $sql = "SELECT * FROM travelimagedetails WHERE CityCode = $CityID";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);  
    }

    public function get_for_SingleCity_image($ImageID){
        $sql = "SELECT * FROM travelimage WHERE ImageID = $ImageID";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);  
    }
    //////////////////////////////////////////////
    //displaySingleCountry.php functions
    //////////////////////////////////////////////
    public function get_for_SingleCountry_countryinfo($ISO){
        $sql = "SELECT * FROM geocountries WHERE ISO = '$ISO'";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_for_SingleCountry_imagedetails($ISO){
        $sql = "SELECT * FROM travelimagedetails WHERE CountryCodeISO = '$ISO'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);  
    }

    public function get_for_SingleCountry_image($ImageID){
        $sql = "SELECT * FROM travelimage WHERE ImageID = $ImageID";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);  
    }
    //////////////////////////////////////////////
    //browse-images.php functions
    //////////////////////////////////////////////
    public function get_for_browse_continents(){
         //dropdown bar select options based on Continent selection by the user
        $continent_code = NULL;
        $sql = 'SELECT * FROM geocontinents';
        $continents = $this->query($sql);
        while($continent = $continents->fetch()){
            echo "<option value='". $continent["ContinentCode"]."'>". $continent["ContinentName"] ." </option>";
        }
    }

    public function get_for_continent_code($continent_code){
        //use Continent name as select option value
        $sql = "SELECT * FROM `geocountries` WHERE Continent = '$continent_code'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);     
    }

    public function get_for_browse_countries(){
        //dropdown bar options for the country selection by the user
        $country_name = NULL;
        $sql = "SELECT * from travelimagedetails GROUP by CountryCodeISO";
        $countrycodes = $this->query($sql);
        while($country = $countrycodes->fetch()){
            $sql = "select * from geocountries where ISO ='" . $country["CountryCodeISO"]. "'";
            $result = $this->query($sql);
            $countrynames = $result->fetch();
            echo "<option value='". $countrynames["ISO"] ."'> ". $countrynames["CountryName"] ." </option>";
        } 
    }

    public function get_browse_country_name($country_name) {
        //query for countries that share the country name selected
        $sql = "SELECT * FROM 'geocountries' WHERE CountryName = '$country_name' ";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function get_browse_country_image($country_code_iso) {
        //query travelimages to find selections based off passed country iso
        $sql = "SELECT * FROM `travelimagedetails` WHERE CountryCodeISO = '$country_code_iso'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function get_country_img_by_Imageid($ImageID) {
        //query for image paths from the passed ImageID
        $sql = "SELECT * FROM `travelimage` WHERE ImageID = '$ImageID'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function get_all_images() {
        //query to output all images that have an existing image id and path
        $sql = "SELECT travelimagedetails.Title, travelimage.Path, travelimagedetails.ImageID FROM travelimagedetails, travelimage WHERE travelimagedetails.ImageID = travelimage.ImageID";
        $result = $this->query($sql);
        while ($row = $result->fetch()) {
            echo '<div class="card col-md-3 mb-1">';
            echo '<center><p><a href="SingleImage.php?id='.$row['ImageID'].'"> '.$row['Title'].'</a></p></center>';
            echo '<center><a href="SingleImage.php?id='.$row['ImageID'].'"><img src="images/square-medium/'.$row['Path'].'" class="img-thumbnail"></a></center>';
            echo '</div>';
        }
    }

    //////////////////////////////////////////////
    //login.php functions
    //////////////////////////////////////////////
    public function get_for_user_name($UserName, $pass) {
        $sql = "SELECT * FROM `traveluser` WHERE UserName = '$UserName' AND Pass = '$pass'";
        $result = $this->query($sql)->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            echo '<script>alert("These credentials are invalid")</script>';
        }else{
            header('Location: index.php');
            return $result;
        }
    }
    //////////////////////////////////////////////
    //favorites.php functions
    //////////////////////////////////////////////
    public function get_img_info_for_fav($ImgID) {
        $sql = "SELECT * FROM `travelimage` WHERE ImageID = '$ImgID'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function get_img_title_for_fav($ImgID) {
        $sql = "SELECT * FROM `travelimagedetails` WHERE ImageID = '$ImgID'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function get_post_info_for_fav($PostID) {
        $sql = "SELECT * FROM `travelpost` WHERE PostID = '$PostID'";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function get_sorted_asc_img_fav($ImgID) {
        $sql = "SELECT * FROM `travelimagedetails` WHERE ImageID = '$ImgID' ORDER by Title asc";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    //////////////////////////////////////////////
    //search.php functions
    //////////////////////////////////////////////

    public function get_for_search_posts($filtertext){
        $sql = 'SELECT PostID, Title, Message FROM travelpost where Title LIKE "%' . $filtertext . '%" order by Title';
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }


    //search images options
    public function get_for_search_imagestitle($filtertext){
        $sql = 'SELECT * FROM travelimagedetails where Title LIKE "%' . $filtertext . '%" order by Title';
        $images = $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
        if($images == null){
            return null;
        }

        $sql = 'SELECT * FROM (travelimage inner join travelimagedetails on travelimage.ImageID = travelimagedetails.ImageID)';
        $result = $this->query($sql);
        while($travelimages = $result->fetch(PDO::FETCH_ASSOC)){
            foreach($images as $image){
                if($travelimages["ImageID"] == $image["ImageID"]){
                    $imageinfo[] = $travelimages;
                }
            }
        } 
        return $imageinfo;
    }

    //city images
    public function get_for_search_imagescity($cityID){
        $sql = 'SELECT * FROM travelimagedetails where CityCode ="' .$cityID . '" order by Title';
        $images = $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
        if($images == null){
            return null;
        }

        $sql = 'SELECT * FROM (travelimage inner join travelimagedetails on travelimage.ImageID = travelimagedetails.ImageID)';
        $result = $this->query($sql);
        while($travelimages = $result->fetch(PDO::FETCH_ASSOC)){
            foreach($images as $image){
                if($travelimages["ImageID"] == $image["ImageID"]){
                    $imageinfo[] = $travelimages;
                }
            }
        } 
        return $imageinfo;
    }

    //country images
    public function get_for_search_imagescountry($countryID){
        $sql = 'SELECT * FROM travelimagedetails where CountryCodeISO ="' .$countryID . '" order by Title';
        $images = $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
        if($images == null){
            return null;
        }

        $sql = 'SELECT * FROM (travelimage inner join travelimagedetails on travelimage.ImageID = travelimagedetails.ImageID)';
        $result = $this->query($sql);
        while($travelimages = $result->fetch(PDO::FETCH_ASSOC)){
            foreach($images as $image){
                if($travelimages["ImageID"] == $image["ImageID"]){
                    $imageinfo[] = $travelimages;
                }
            }
        } 
        return $imageinfo;
    }

    //continents images
    public function get_for_search_imagescontinent($continentID){
        $sql = 'SELECT * FROM ( travelimagedetails inner join geocountries on travelimagedetails.CountryCodeISO = geocountries.ISO) order by Title';
        $allcountries = $this->query($sql);
        
         foreach($allcountries as $country){
            if($country["Continent"] == $continentID){
                $continents[] = $country;
            }
         }
        if($continents == null){
            return null;
        }
        foreach($continents as $continent){
            $sql = 'SELECT * FROM travelimage where ImageID ="' .$continent["ImageID"] . '"';
            $images[] = $this->query($sql)->fetch(PDO::FETCH_ASSOC);
        }
    return $images;
    }

    //dropdown for cities with images
    public function get_for_search_citiesdropdown(){
        $sql = "select * from travelimagedetails GROUP by CityCode";
        $citycodes = $this->query($sql);
        while($city = $citycodes->fetch(PDO::FETCH_ASSOC)){
            $sql = "select * from geocities where GeoNameID ='" . $city["CityCode"]. "'";
            $result = $this->query($sql);
            $citynames[] = $result->fetch(PDO::FETCH_ASSOC);
        }
        return $citynames;
    }

    //dropdown for countries with images
    public function get_for_search_countriesdropdown(){
        $sql = "select * from travelimagedetails GROUP by CountryCodeISO";
        $countrycodes = $this->query($sql);
        while($country = $countrycodes->fetch(PDO::FETCH_ASSOC)){
            $sql = "select * from geocountries where ISO ='" . $country["CountryCodeISO"]. "'";
            $result = $this->query($sql);
            $countrynames[] = $result->fetch(PDO::FETCH_ASSOC);
        }
        return $countrynames;
    } 

        public function get_only_the_best_images() {
        //query to output all images that have an existing image id and path
        $sql = "SELECT DISTINCT travelimagerating.Rating, travelimage.ImageID, travelimage.Path FROM travelimagerating, travelimage WHERE travelimagerating.ImageID = travelimage.ImageID AND travelimagerating.Rating = '5'";
        $result = $this->query($sql);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card">';
            echo '<center><a href="SingleImage.php?id='.$row['ImageID'].'"><img src="images/square-small/'.$row['Path'].'" class="img-thumbnail"></a></center>';
            
            echo '<center><p><a href="SingleImage.php?id='.$row['ImageID'].'">Rating: '.$row['Rating'].'</a></p></center>';
           
            echo '</div>';
        }
    }

    //////////////////////////////////////////////
    //register.php functions
    //////////////////////////////////////////////
    public function create_new_user($email,$pass){
        //check to see if username already exists
        $sql = "SELECT UserName FROM traveluser WHERE UserName ='" . $email . "'";
        $result = $this->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($result) return false; 

        date_default_timezone_set("America/New_York");
        $state = 1;
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO traveluser(Username, Pass, State, DateJoined, DateLastModified) VALUES(?,?,?,?,?)";
        $insert = $this->prepare($sql);
        $result = $insert->execute([$email,$pass, $state, $date, $date]);
        
        if($result){
        //get the new users UID
        $sql = "SELECT UID, UserName FROM traveluser WHERE UserName ='" . $email . "'";
        $getUID = $this->query($sql)->fetch(PDO::FETCH_ASSOC);
        //create traveluserdetails for new user
        $sql = "INSERT INTO traveluserdetails(UID, Email, Privacy) VALUES(?,?,?)";
        $insert = $this->prepare($sql);
        $insert->execute([$getUID['UID'], $email, $state]);
            return true;
        }else{
            return false;
        }
    }

    //////////////////////////////////////////////
    //MyAccount.php functions
    //////////////////////////////////////////////
    public function insert_userinfo(){
        $sql = "INSERT INTO traveluserdetails(UID, Email, Privacy) VALUES(?,?,?)
                SELECT * FROM traveluserdetails WHERE UID = TEMP";//fill out temp
    }

    
    //////////////////////////////////////////////
    //SingleImage.php functions
    //////////////////////////////////////////////
    public function get_imageinfo($imageID){
        //inner joins of info related to imageId
        $sql = 'SELECT * FROM (travelimage inner join travelimagedetails on travelimage.ImageID = travelimagedetails.ImageID)';
        $result = $this->query($sql);
        while($travelimages = $result->fetch(PDO::FETCH_ASSOC)){
            if($travelimages["ImageID"] == $imageID){
                return $travelimages; 
            }
        }
    }

    public function get_imagerating($imageID){
        $sql = "SELECT avg(Rating), count(ImageID) FROM `travelimagerating` WHERE ImageID = $imageID";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_imagecity($citycode){
        //get city info
        $sql = "SELECT * FROM geocities WHERE GeoNameID = $citycode";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_imagecountry($countrycode){
        //get country info
        $sql = "SELECT * FROM geocountries WHERE ISO = '$countrycode'";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_imageposter($UID){
        //get poster info
        $sql = "SELECT * FROM traveluserdetails WHERE UID = '$UID'";
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC); 
    }

    public function insert_new_review($imageID, $rating, $reviewtext, $username){
        //check if the user has already left a review for this image
        $sql = "SELECT * FROM traveluser WHERE UserName ='$username'";
        $user = $this->query($sql)->fetch(PDO::FETCH_ASSOC);
        
        $sql = 'SELECT * FROM travelimagerating WHERE ImageID ='.$imageID.' AND UID ='.$user['UID'];
        $result = $this->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($result){
            echo '<script>alert("sorry, You have already left a review for this image.")</script>';
            return false;
        } 

        date_default_timezone_set("America/New_York");
        $date = date("Y-m-d H:i:s");
       
        $sql = "INSERT INTO travelimagerating(ImageID, Rating, UID, Review, ReviewTime) Values(?,?,?,?,?)";
        $insert = $this->prepare($sql);
        $insert->execute([$imageID, $rating, $user['UID'], $reviewtext, $date]);
        return true; 
    }

    public function get_image_reviews($imageID){
        $sql = "SELECT * FROM `travelimagerating` where ImageID = $imageID ORDER BY travelimagerating.ReviewTime DESC";
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }

    public function delete_review($imageRatingID){
        $sql = "DELETE FROM travelimagerating WHERE travelimagerating.ImageRatingID = $imageRatingID";
        $this->query($sql);
    }
    //function to display two of the most recent reviews left by users
    public function latest_user_review() {
        function custom_echo($x, $length)
            {
              if(strlen($x)<=$length)
              {
                echo $x;
              }
              else
              {
                $y=substr($x,0,$length) . '...';
                echo $y;
              }
            }
        $sql ="SELECT travelimagerating.Rating, travelimagerating.Review, travelimagerating.ReviewTime, travelimage.Path, travelimage.ImageID FROM travelimagerating JOIN travelimage ON travelimagerating.ImageID = travelimage.ImageID ORDER by ReviewTime DESC LIMIT 2";
        $result = $this->query($sql);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <a href="SingleImage.php?id=<?php echo $row['ImageID']; ?>"><h2><button class="button btn-outline-info btn-sm">User Rating: <span class="badge badge-light"><?php echo $row['Rating']; ?></span></button></h2></a>
            <ul class="list-unstyled">
              <li class="media">
                <a href="SingleImage.php?id=<?php echo $row['ImageID']; ?>"><img class="mr-3" src="images/thumb/<?php echo $row['Path']; ?>" alt="Generic placeholder image"></a>
                <div class="media-body">
                  <h3 class="mt-0 mb-1">Date Posted: <?php echo strstr($row['ReviewTime'],' ',true); ?></h3>
                  <?php custom_echo($row['Review'],100); ?>
                </div>
              </li>
            </ul>
            <?php
        }
    }




}
?>