<header>
        <nav class="navbar navbar-expand-md" >
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav nav-tabs"> 
                    <li class="navbar-brand" >Project 2</li>
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                    
                    <li class="dropdown nav-item" > 
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu" >
                            <li class="dropdown-item"><a href="#">Temp</a> </li>
                            <li class="dropdown-item"><a href="#">Temp</a></li>
                            <li class="dropdown-item"><a href="#">Temp</a> </li>
                            <li class="dropdown-item"><a href="#">Temp</a></li>
                        </ul>
                    </li>
                </ul>
                    <form class="form-inline ml-auto"  action="Part04_Search.php" method="get">
                        <div class="form-group">
                            <input type="text" class="form-control" name="filtertext" placeholder="Search">
                            <input class="form-check-input" type="hidden" name="filteroption" id="filtertitle" value="option1" >
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </nav>
    </header>