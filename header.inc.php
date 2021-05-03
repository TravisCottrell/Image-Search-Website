<?php
    

    $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
?>
<header>
    <!-- top part of the header -->
    <nav class="navbar  navbar-expand-md" id="topheader">
        <li class="navbar-brand" id="nav-bar-logo" ><img src="https://webdev-stark.cs.kent.edu/~wwaller/WP2FinalProject/images/ads/logo.png"></li>
        <div class="collapse navbar-collapse">
            <ul class="nav nav-tabs ml-auto"> 
                <li class='nav-item'><a  href='favorites.php' role='button'><span class="bi bi-heart-fill nav-link"> favorites</span></a></li>
                <li class="nav-item"><a  href="MyAccount.php" class="nav-link">My Account</a></li>
                <li class="nav-item"><a  href="login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a  href="register.php" class="nav-link">Register</a></li>
            </ul>
        </div>
    </nav>

    <!-- lower part of the header -->
    <nav class="navbar navbar-expand-md" >
        <div class="collapse navbar-collapse">
            <ul class="nav nav-tabs mr-auto"> 
                <li class="navbar-brand" id="nav-bar-welcome" >Welcome <?php echo strstr($name, '@', true); ?></li>
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="AboutUs.php" class="nav-link">About</a></li>
                <li class="dropdown nav-item" > 
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse <span class="caret"></span></a>
                    <ul class="dropdown-menu" >
                        <li class="dropdown-item"><a href="PostList.php">Post/User List</a></li>
                        <li class="dropdown-item"><a href="browse-images.php">Images</a></li>
                        <li class="dropdown-item"><a href="SinglePost.php?id=20">Single Post</a> </li>
                        <li class="dropdown-item"><a href="SingleImage.php?id=53">Single Image</a> </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="Search.php" class="nav-link">Advanced Search</a></li>
                
            </ul>
            <form class="form-inline ml-auto"  action="Search.php" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="filtertext" placeholder="Search">
                    <input class="form-check-input" type="hidden" name="filteroption" id="filtertitle" value="option1" >
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </nav>
    
    <head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab+Highlight&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyle.css"/>
    
    </head>
</header>
