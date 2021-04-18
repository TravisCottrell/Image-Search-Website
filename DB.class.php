<?php
require_once('config.php'); 


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
        $sql = 'SELECT * FROM geocontinents';
        $continents = $this->query($sql);
        while($continent = $continents->fetch()){
            echo "<li class='list-group-item'>"."<a href='#'>".$continent["ContinentName"]."</a>"."</li>";
        }
    }

    public function get_for_sidebar_countries(){
        $sql = "select * from travelimagedetails GROUP by CountryCodeISO";
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
            echo "<li><a href='DisplaySIngleUser.php?UID=".$row["UID"]."'>" . $fullname. "</a></li>"; 
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
            echo "<option value=". $continent_code ." ". $continent["ContinentCode"] ."> ". $continent["ContinentName"] ." </option>";
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
            echo "<option value=". $country_name ." ". $countrynames["ISO"] ."> ". $countrynames["CountryName"] ." </option>";
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
    public function get_for_user_name($UserName) {
        $sql = "SELECT * FROM `traveluser` WHERE UserName = '$UserName' AND Pass = 'abcd1234'";
        $result = $this->query($sql);
        if($result == 0) {
            echo "this user does not exist";
        } else {
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
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

    //////////////////////////////////////////////
    //search.php functions
    //////////////////////////////////////////////

    public function get_for_search_posts($filtertext){
        $sql = 'SELECT PostID, Title, Message FROM travelpost where Title LIKE "%' . $filtertext . '%"';
        return $this->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }


    //search images options
    public function get_for_search_imagestitle($filtertext){
        $sql = 'SELECT * FROM travelimagedetails where Title LIKE "%' . $filtertext . '%"';
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

    public function get_for_search_imagescity($cityID){
        $sql = 'SELECT * FROM travelimagedetails where CityCode ="' .$cityID . '"';
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

    public function get_for_search_imagescountry($countryID){
        $sql = 'SELECT * FROM travelimagedetails where CountryCodeISO ="' .$countryID . '"';
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
}
?>