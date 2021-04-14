<html>
<title>Home page</title>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/mystyle.css" />
    
</head>
<style type="text/css">
  * {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}


/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.image_caro {
 background:
        /* top, transparent black, faked with gradient */ 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        /* bottom, image */
        url(http://localhost:7882/xampp/WP2HO4/WP2PR01/Ch12-project2/imgcara/camera.jpg);
 width: 100%;
                  
}

</style>
<body>
  <?php include 'header.inc.php'; ?>

  <div class="container">
    <div class="row" id="hometitle">
      <div class="col" >
        <h1>Final Project</h1><br>
        <p>This is a project for web programming 2</p>
      </div>
    </div>
  </div>
  <div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img class="image_caro" src="http://localhost:7882/xampp/WP2FinalProject/images/img_caros/station-839208_1920.jpg">
  <div class="text"><h3 >Be Prepared</h3></div>
    <div class="refcenter">
        
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="browse-images.php">Browse</a>
            <a href="country.php?id=CA">Countries</a>
            <a href="travel-image.php?id=46">Travel</a>
            <a href="upload.php">Upload</a>    
                          
     </div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img class="image_caro" src="http://localhost:7882/xampp/WP2FinalProject/images/img_caros/canal-1209808_1920.jpg">
  <div class="text"><h3 >To Travel The World</h3></div>
   <div class="refcenter">
        
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="browse-images.php">Browse</a>
            <a href="country.php?id=CA">Countries</a>
            <a href="travel-image.php?id=46">Travel</a>
            <a href="upload.php">Upload</a>   
                          
     </div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img class="image_caro" src="http://localhost:7882/xampp/WP2FinalProject/images/img_caros/bora-bora-3023437_1920.jpg">
  <div class="text" ><h3 >In a Digital Manner</h3></div>
   <div class="refcenter">
        
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="browse-images.php">Browse</a>
            <a href="country.php?id=CA">Countries</a>
            <a href="travel-image.php?id=46">Travel</a>
            <a href="upload.php">Upload</a>     
                          
     </div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div >
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>


  <?php include 'footer.inc.php'; ?>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>

</html>