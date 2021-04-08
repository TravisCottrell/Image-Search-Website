<?php
require_once('config.php'); 



    

class DB extends PDO{
 
    public function __construct(){
        parent::__construct(DBCONNSTRING,DBUSER,DBPASS);
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // always disable emulated prepared statement when using the MySQL driver
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    
    public function get_all($table){
        $sql  = "SELECT * FROM $table";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        return $stmt->fetchAll();
    }

    public function get_for_singlepost_UID($id){
        //get the UID from travelpost
        $sql = 'SELECT * FROM travelpost WHERE PostID ="'. $id .'"';
        $result = $this->query($sql);
        return $result->fetch();
    }

    public function get_for_singlepost_names($id){
        //use UID to get the traveluserdetils for user details card 
        $sql = 'SELECT * FROM traveluserdetails WHERE UID ="' . $id . '"';
        $result = $this->query($sql);
        return $result->fetch();
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
                echo "<li class='list-group-item'>"."<a href='#'>".$countrynames["CountryName"]."</a>"."</li>";
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
                echo "<li class='list-group-item'>"."<a href='#'>".$citynames["AsciiName"]."</a>"."</li>";
            }   
        }
        
    }
    
}


?>