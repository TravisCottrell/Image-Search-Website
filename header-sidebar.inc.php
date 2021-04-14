<header>
    <!-- top part of the header -->
    <nav class="navbar  navbar-expand-md" id="topheader">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-tabs ml-auto"> 
                <li class='nav-item'><a  href='#' role='button'><span class="bi bi-heart-fill nav-link"> favorites</span></a></li>
                <li class="nav-item"><a  href="#" class="nav-link">My Account</a></li>
                <li class="nav-item"><a  href="#" class="nav-link">Login</a></li>
                <li class="nav-item"><a  href="#" class="nav-link">Register</a></li>
            </ul>
        </div>
    </nav>

    <!-- lower part of the header -->
    <nav class="navbar navbar-expand-md" >
        <div class="collapse navbar-collapse">
            <ul class="nav nav-tabs mr-auto"> 
                <li class="navbar-brand" >Project 3</li>
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="AboutUs.php" class="nav-link">About</a></li>
                <li class="dropdown nav-item" > 
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                    <ul class="dropdown-menu" >
                        <li class="dropdown-item"><a href="PostList.php">Post/User List</a></li>
                        <li class="dropdown-item"><a href="browse-images.php">Browse</a></li>
                        <li class="dropdown-item"><a href="SinglePost.php?id=20">Single Post</a> </li>
                        <li class="dropdown-item"><a href="SingleImage.php?id=53">Single Image</a> </li>
                        <li class="dropdown-item"><a href="Search.php">Search</a></li>
                    </ul>
                </li>
                
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
</header>
 <main class="container">
        <div class="row">
            <?php include 'sidebar.inc.php'; ?>