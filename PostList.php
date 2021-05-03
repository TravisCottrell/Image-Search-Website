<?php 
require_once("DB.class.php");
$dbhandle = new DB();
?>


<html>
<title>Post List</title>

<body  >
<?php include 'header.inc.php'; ?>
<div class="centered">
  <a href="https://www.visitdubai.com/en/" target="_blank">
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad44.png" id="adBanner" alt="Ad Banner" /> </center>
  </a>
</div>
<div class="fixright">
    <a href="https://www.visitdubai.com/en/" >
   <center> <img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/travad55.png"  /> </center>
  </a>
</div>
<div class="container">
    <div class="row">
        <!-- List form  -->
            <div class="col" ><br>
            <div class="row" >
                <form method="get">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="listoption" id="posts" value="option1" checked>
                        <label class="form-check-label" for="posts">Post List</label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="listoption" id="users" value="option2">
                        <label class="form-check-label" for="users">User List</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Show List</button>
                </form>
            </div>
        <!-- List form end -->

            <div class="row">
                <ul>
                    <?php 
                    if(isset($_GET["listoption"])){
                        if($_GET["listoption"] == "option1"){
                            $dbhandle->get_for_PostList();
                        }else{
                            $dbhandle->get_for_UserList();
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.inc.php'; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>

</body>

</html>