<?php
require_once("DB.class.php");
$dbhandle = new DB();
?>
<html>
<title>Favorites</title>
<body>
<?php include'header.inc.php'; ?>
<div class="container">
    <div class="row">
        <div class="co-md-12" >
          <h2>Your favorite posts and pictures</h2>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
         <form method="get">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filteroption" id="filterposts" value="option1" checked>
                        <label class="form-check-label" for="filterposts">Filter by Posts</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="filteroption" id="filterimages" value="option2">
                        <label class="form-check-label" for="filterimages">Filter by Images</label>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="submit" name="sort_asc" class="btn btn-outline-info">Sort in Ascending order</button>
                    <button type="submit" name="sort_desc" class="btn btn-outline-info">Sort in Descending order</button>
                  
                </form>
      </div>
      
        <?php 
//function to restrict length of strings
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

// Favorites for images
$user_id = $_GET['id'] ?? null;
  if (!isset($_SESSION['favorites'])) {
    $fav_array = array();
    $_SESSION['favorites'] = $fav_array;
}
  
  array_push($_SESSION['favorites'], $user_id);

  $clean_array_img = array_unique($_SESSION['favorites']);
         
    if((isset($_GET["filteroption"]))&&($_GET["filteroption"] == "option2")){
     
        foreach($clean_array_img as $prep_array) {
          $prep_fav_img = $dbhandle->get_img_info_for_fav($prep_array);
          $prep_fav_img_info = $dbhandle->get_img_title_for_fav($prep_array);
            foreach($prep_fav_img_info as $fav_title_out){
              $fav_img_title = $fav_title_out['Title'];
              echo '<br>';
              echo '<div class="col-md-3">';
              echo '<div class="card mb-1">';
              echo '<div class="card-header">';
              echo '<center><a href="SingleImage.php?id='.$fav_title_out['ImageID'].'">'.$fav_img_title.'</a></center>';
              echo '</div>';
                foreach($prep_fav_img as $fav_img_out) {
                  $fav_img = $fav_img_out['Path'];
                  $fav_img_id = $fav_img_out['ImageID'];
                    echo '<div class="card-body">';
                  echo '<center><a href="SingleImage.php?id='.$fav_img_id.'"><img src="images/square-medium/'.$fav_img.'" class="rounded"></a></center>';
                  echo '</div>';
                  echo '<div class="card-footer">';
                  echo '<form action="favorites.php" method="get">';
                  echo '<center><button type="submit" name="submit" value="'.$fav_img_id.'" class="btn btn-sm btn-outline-danger">Remove From Favorites</button></center>';
                  echo '</form>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                   if(isset($_GET['submit'])) {
                     if (($key = array_search($_GET['submit'], $_SESSION['favorites'])) !== false) {
                          unset($_SESSION['favorites'][$key]);
                          header("Refresh:0");                         
                      }
                    }
                  }
              }
          }
      }


      if((isset($_GET["sort_asc"]))&&($_GET["filteroption"] == "option2")){

     
        foreach($clean_array_img as $prep_array) {
          $prep_fav_img = $dbhandle->get_img_info_for_fav($prep_array);
          $prep_fav_img_info = $dbhandle->get_img_title_for_fav($prep_array);
            
            foreach($prep_fav_img_info as $fav_title_out){
              $fav_img_title = $fav_title_out['Title'];
              
              echo '<br>';
              echo '<div class="col-md-3">';
              echo '<div class="card mb-1">';
              echo '<div class="card-header">';
              echo '<center><a href="SingleImage.php?id='.$fav_title_out['ImageID'].'">'.$fav_img_title.'</a></center>';
              echo '</div>';
                foreach($prep_fav_img as $fav_img_out) {
                  $fav_img = $fav_img_out['Path'];
                  $fav_img_id = $fav_img_out['ImageID'];
                    echo '<div class="card-body">';
                  echo '<center><a href="SingleImage.php?id='.$fav_img_id.'"><img src="images/square-medium/'.$fav_img.'" class="rounded"></a></center>';
                  echo '</div>';
                  echo '<div class="card-footer">';
                  echo '<form action="favorites.php" method="get">';
                  echo '<center><button type="submit" name="submit" value="'.$fav_img_id.'" class="btn btn-sm btn-outline-danger">Remove From Favorites</button></center>';
                  echo '</form>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                   if(isset($_GET['submit'])) {
                     if (($key = array_search($_GET['submit'], $_SESSION['favorites'])) !== false) {
                          unset($_SESSION['favorites'][$key]);
                          header("Refresh:0");                         
                      }
                    }
                  }
              }
          }
      }
        
          
  // Favorites for Posts
  $post_id = $_GET['postid'] ?? null;
if (!isset($_SESSION['favorites_post'])) {
    $fav_array_post = array();
    $_SESSION['favorites_post'] = $fav_array_post;
}

array_push($_SESSION['favorites_post'], $post_id);

$clean_array_post = array_unique($_SESSION['favorites_post']);
 
if((isset($_GET["filteroption"]))&&($_GET["filteroption"] == "option1")){
        
  foreach($clean_array_post as $prep_array_post) {
    $prep_fav_post = $dbhandle->get_post_info_for_fav($prep_array_post);
      foreach($prep_fav_post as $fav_post_out){
        $fav_post_title = $fav_post_out['Title'];
        $fav_post_id = $fav_post_out['PostID'];
          echo '<br>';
          echo '<div class="col-md-3">';
          echo '<div class="card mb-1">';
          echo '<div class="card-header">';
          echo '<center><a href="SinglePost.php?id='.$fav_post_id.'">'.$fav_post_title.'</a></center>';
          echo '</div>';
          echo '<div class="card-body">';
          custom_echo($fav_post_out['Message'], 100);
          echo '</div>';
          echo '<div class="card-footer">';
          echo '<form action="favorites.php" method="get">';
          echo '<center><button type="submit" name="submit_post" value="'.$fav_post_id.'" class="btn btn-sm btn-outline-danger">Remove From Favorites</button></center>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
         if(isset($_GET['submit_post'])) {
           if (($key = array_search($_GET['submit_post'], $_SESSION['favorites_post'])) !== false) {
                unset($_SESSION['favorites_post'][$key]);
                header("Refresh:0");             
            }
          }
      }
  }
}
            
              
if(!isset($_GET["filteroption"])) {
    //show all posts unsorted
  foreach($clean_array_post as $prep_array_post) {
            $prep_fav_post = $dbhandle->get_post_info_for_fav($prep_array_post);
      foreach($prep_fav_post as $fav_post_out){
                $fav_post_title = $fav_post_out['Title'];
                $fav_post_id = $fav_post_out['PostID'];
                echo '<br>';
                echo '<div class="col-md-3">';
                echo '<div class="card mb-1">';
                echo '<div class="card-header">';
                echo '<center><a href="SinglePost.php?id='.$fav_post_id.'">'.$fav_post_title.'</a></center>';
                echo '</div>';
                echo '<div class="card-body">';
                custom_echo($fav_post_out['Message'], 100);
                echo '</div>';
                echo '<div class="card-footer">';
                echo '<form action="favorites.php" method="get">';
                echo '<center><button type="submit" name="submit_post" value="'.$fav_post_id.'" class="btn btn-sm btn-outline-danger">Remove From Favorites</button></center>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                 if(isset($_GET['submit_post'])) {
                      if (($key = array_search($_GET['submit_post'], $_SESSION['favorites_post'])) !== false) {
                        unset($_SESSION['favorites_post'][$key]);
                        header("Refresh:0");                        
                      }
                  }
        }
  }            
      //show all images unsorted
  foreach($clean_array_img as $prep_array) {
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
                  echo '<div class="card-body">';
                  echo '<center><a href="SingleImage.php?id='.$fav_img_id.'"><img src="images/square-medium/'.$fav_img.'" class="rounded"></a></center>';
                  echo '</div>';
                  echo '<div class="card-footer">';
                  echo '<form action="favorites.php" method="get">';
                  echo '<center><button type="submit" name="submit" value="'.$fav_img_id.'" class="btn btn-sm btn-outline-danger">Remove From Favorites</button></center>';
                  echo '</form>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  if(isset($_GET['submit'])) {
                      if (($key = array_search($_GET['submit'], $_SESSION['favorites'])) !== false) {
                        unset($_SESSION['favorites'][$key]);
                        header("Refresh:0");                       
                      }
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