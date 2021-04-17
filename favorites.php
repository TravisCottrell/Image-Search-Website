<?php
require_once("DB.class.php");
$dbhandle = new DB();
?>
<html>
<title>Favorites</title>
<body>
  <?php include 'header.inc.php'; ?>

<div class="container">
    <div class="row">
        <div class="co-md-12" >
          <h2>Your favorite posts and pictures</h2>
        </div>
    </div>



    <div class="row">
      
        <?php 
          $user_id = $_GET['id'] ?? null;
            if (!isset($_SESSION['favorites'])) {
              $fav_array = array();
              $_SESSION['favorites'] = $fav_array;
            }
          


          array_push($_SESSION['favorites'], $user_id);

          $clean_array = array_unique($_SESSION['favorites']);
         
          
          foreach($clean_array as $prep_array) {
            $prep_fav_img = $dbhandle->get_img_info_for_fav($prep_array);
            $prep_fav_img_info = $dbhandle->get_img_title_for_fav($prep_array);
              foreach($prep_fav_img_info as $fav_title_out){
                $fav_img_title = $fav_title_out['Title'];
                echo '<div class="col-md-3">';
                echo '<div class="card mb-1">';
                echo '<div class="card-header">';
                echo '<center><a href="SingleImage.php?id='.$fav_title_out['ImageID'].'">'.$fav_img_title.'</a></center>';
                echo '</div>';
                  foreach($prep_fav_img as $fav_img_out) {
                    $fav_img = $fav_img_out['Path'];
                    $fav_img_id = $fav_img_out['ImageID'];
                    echo '<center><a href="SingleImage.php?id='.$fav_img_id.'"><img src="images/square-medium/'.$fav_img.'" class="rounded"></a></center>';
                    echo '<form action="favorites.php" method="get">';
                    echo '<center><button type="submit" name="submit" value="'.$fav_img_id.'" class="btn btn-outline-danger">Remove From Favorites</button></center>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                     if(isset($_GET['submit'])) {
                       if (($key = array_search($_GET['submit'], $_SESSION['favorites'])) !== false) {
                            unset($_SESSION['favorites'][$key]);
                            header("Refresh:0"); 
                            break;
                        }
                      }
                    }
                }
            }
            
        
        ?>
      
    </div>
        


</div>

  <?php include 'footer.inc.php'; ?>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>


</html>