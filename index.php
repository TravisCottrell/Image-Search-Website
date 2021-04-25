<?php 
require_once("DB.class.php");
  $dbhandle = new DB();
  
  $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
 
?>
<html>
<title>Home</title>
<style type="text/css">
  .carousel-caption{
    
    top:25%;
}

#caro-size{
   width:100%;
   height: 900px !important;
}


.carousel-indicators li{
  width: 10px;
  height: 10px; 
  border-radius: 100%; 
}

.d-block {  filter: brightness(30%); }

#caro-text{
  font-family: 'Zilla Slab Highlight', cursive;
}
</style>

<body>
  <?php include 'header.inc.php'; ?>

<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators my-4">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" id="caro-size">
      <div class="carousel-item active">
        <img src="images/large/5855729828.jpg" class="d-block w-100" id="tinted" alt="...">
        <div class="carousel-caption d-none d-md-block ">
          <h2 id="caro-text">Hello <?php echo strstr($name, '@', true); ?></h2>
          
      </div>
      </div>
      <div class="carousel-item">
        <img src="images/large/6119130918.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block ">
          <h2 id="caro-text">Are you ready?</h2>
         
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/large/9493997865.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block ">
          <h2 id="caro-text">To Travel the World!</h2>
         
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<br>
  <center><h2>Check Out The highest Rated images by our World Travelers</h2></center>
  <br>
<div class="row">
  <?php $dbhandle->get_only_the_best_images(); ?>
</div>
  <?php include 'footer.inc.php'; ?>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>

</body>

</html>