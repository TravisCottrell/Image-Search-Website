<?php 
require_once("DB.class.php");
$dbhandle = new DB();
?>


<html>
<title>Post List</title>
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/mystyle.css" />
    
</head>


<body  >
<?php include 'header.inc.php'; ?>
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