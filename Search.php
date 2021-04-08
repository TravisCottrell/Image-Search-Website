<?php



function printsearch(){

    require_once('config.php'); 
try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}

    
    if(isset($_GET["filteroption"])){
       
        

            if($_GET["filteroption"] == "option1"){
                if(isset($_GET["filtertext"]) && $_GET["filtertext"] != '' ){
                    $sql = 'SELECT PostID, Title, Message FROM travelpost where Title LIKE "%' . $_GET["filtertext"] . '%"';
                    $result = $pdo->query($sql);
                    while($listview = $result->fetch()){
                        echo '<div class="row ">';
                        echo '<a href="Part02_SinglePost.php?id='. $listview["PostID"] .'"' . '<h3>' . $listview["Title"] . '</h3></a>';
                        echo '<p>' . $listview["Message"] . '</p>';
                        echo '</div><br>';
                    } 
                   
                }else{
                    echo "<h3>Please Enter Search Criteria</h3>";
                }
            }

            if($_GET["filteroption"] == "option2"){
                if(isset($_GET["filtertext"]) && $_GET["filtertext"] != '' ){
                    $sql = 'SELECT PostID, Title, Message FROM travelpost where Message LIKE "%' . $_GET["filtertext"] . '%"';
                    $result = $pdo->query($sql);
                    while($listview = $result->fetch(PDO::FETCH_ASSOC)){ 
                        $replace = "<mark>". $_GET["filtertext"] . "</mark>";
                        $listview["Message"] = str_ireplace($_GET["filtertext"],$replace,$listview["Message"], $i);
                        echo '<div class="row ">';
                        echo '<a href="Part02_SinglePost.php?id='. $listview["PostID"] .'"' . '<h3>' . $listview["Title"] . '</h3></a>';
                        echo '<p>' . $listview["Message"] . '</p>';
                        echo '</div><br>';
                    }  
                     
                }
                else{
                    echo "<h3>Please Enter Search Criteria</h3>";
                }
            }
  
           
        
           
        


        if($_GET["filteroption"] == "option3"){
        //get the travel post info 
        $sql = 'SELECT PostID, Title, Message FROM travelpost';
        $result = $pdo->query($sql);
        while($listview = $result->fetch()){
            echo '<div class="row ">';
            echo '<a href="Part02_SinglePost.php?id='. $listview["PostID"] .'"' . '<h3>' . $listview["Title"] . '</h3></a>';
            echo '<p>' . $listview["Message"] . '</p>';
            echo '</div><br>';
        }
        }
    
    }
}
    


    

?>


<html>
<title>About page</title>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/mystyle.css" />
</head>
<style>

</style>

<body  >
    <?php include 'header.inc.php'; ?>
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
                        <input class="form-check-input" type="radio" name="filteroption" id="filtertitle" value="option1" checked>
                        <label class="form-check-label" for="filtertitle">Filter by Title</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filteroption" id="filtermessage" value="option2">
                        <label class="form-check-label" for="filtermessage">Filter by Message</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filteroption" id="nofilter" value="option3" >
                        <label class="form-check-label" for="nofilter">No Filter</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div><br>
        <!-- search form end -->

        <?php
            printsearch();
        ?>

    </div>

    <?php include 'footer.inc.php'; ?>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>