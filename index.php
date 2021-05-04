<?php 
require_once("DB.class.php");
  $dbhandle = new DB();
  
  $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
 
?>
<html>
<title>Home</title>

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

  <div class="wrapper">
  <div class="section parallax image1"><center><h1 id="para-text">It is better to travel well than to arrive.</h1></center></div>
<div class="section static">
  <div class="container">
    <center><h2>Our Latest User Reviews</h2></center><?php $dbhandle->latest_user_review(); ?>
  </div>
</div>
<div class="section parallax image2"><center><h1 id="para-text">A mind that is stretched by a new experience can never go back to its old dimensions</h1></center></div>
 <div class="section static">

<div class="container">
  <center><h2>Check Out The highest Rated images by our World Travelers</h2></center>
  <div class="fixleft">
        <a href="https://www.royalcaribbean.com/?ecid=ps_43700055460434106&country=USA&gclid=Cj0KCQjwvr6EBhDOARIsAPpqUPFhnbfa3qw-QtMEJE_M_NAo5PfYG63S33anMrjG65BWSIAzsGnchi4aAkbNEALw_wcB&gclsrc=aw.ds"><img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad11.png"></a>
</div>
</div>

<div class="row">
  <?php $dbhandle->get_only_the_best_images(); ?>
</div>
</div>
</div>
</div>


<div class="centered">
  <a href="http://www.priceline.com/?vrid=2406db20bf6d2767d32ad1a14f909e82" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad7.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>

  <?php include 'footer.inc.php'; ?>

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
  <script type="text/javascript">
    window.onload = initBannerLink;

var thisAd = 0;

function initBannerLink() {
  if (document.getElementById("adBanner").parentNode.tagName == "A") {
    document.getElementById("adBanner").parentNode.onclick = newLocation;
  }
  
  rotate();
}

function newLocation() {
  var adURL = new Array("priceline.com/?vrid=2406db20bf6d2767d32ad1a14f909e82","baidu.com","so.com");
  document.location.href = "http://www." + adURL[thisAd];
  return false;
}

function rotate() {
  var adImages = new Array("https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad7.png","https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad6.png","https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad5.png");

  thisAd++;
  if (thisAd == adImages.length) {
    thisAd = 0;
  }
  document.getElementById("adBanner").src = adImages[thisAd];

  setTimeout(rotate, 3 * 1000);
}
  </script>

</body>

</html>