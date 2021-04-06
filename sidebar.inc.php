<?php 


try {
    //sidebar info
    //continents 
    $sql = 'SELECT * FROM geocontinents';
    $continents = $pdo->query($sql);

    //countries
    $sql = "select * from travelimagedetails GROUP by CountryCodeISO";
    $countrycodes = $pdo->query($sql);

    //cities
    $sql = "select * from travelimagedetails GROUP by CityCode";
    $citycodes = $pdo->query($sql);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}

?>



        
<div class="col-md-2" >
    <div class="card w-75 ml-auto">
        <div class="card-header" >Continents</div>
        <ul class="list-group">
            <?php 
                while($continent = $continents->fetch()){
                    echo "<li class='list-group-item'>"."<a href='#'>".$continent["ContinentName"]."</a>"."</li>";
            }
            ?>
        </ul>
        <div class="card-header" >Countries</div>
        <ul class="list-group">
        <?php 
                    while($country = $countrycodes->fetch()){
                        $sql = "select * from geocountries where ISO ='" . $country["CountryCodeISO"]. "'";
                        $result = $pdo->query($sql);
                        $countrynames = $result->fetch();
                        
                        if(isset($countrynames["CountryName"])){
                            echo "<li class='list-group-item'>"."<a href='#'>".$countrynames["CountryName"]."</a>"."</li>";
                        }   
                    }
                ?>
        
        </ul>
        <div class="card-header" >Cities</div>
        <ul class="list-group">
                <?php 
                    while($city = $citycodes->fetch()){
                        $sql = "select * from geocities where GeoNameID ='" . $city["CityCode"]. "'";
                        $result = $pdo->query($sql);
                        $citynames = $result->fetch();
                        
                        if(isset($citynames["AsciiName"])){
                            echo "<li class='list-group-item'>"."<a href='#'>".$citynames["AsciiName"]."</a>"."</li>";
                        }   
                    }
                ?>

        </ul>
    </div>
</div>
            



