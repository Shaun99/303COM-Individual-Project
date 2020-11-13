<!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="img/core-img/cc.png" alt="">
    </div>

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times fa-2x" aria-hidden="true"></i></div>
        <div class="container">
            <form action="view.php" name="SearchForm" method="get">
            <div class="row">
                <div class="col-4">       
                    <input type="text" name="search" placeholder="Find a recipe...">
                    <button  type="submit" name="submit3" class="search-form-btn2" onclick="return validateSearchForm()">
                        <i class="fa fa-search" aria-hidden="true"></i> Search
                    </button>     
                </div>
                <div class="col-3">       
                    <input type="text" id="include" name="include" placeholder="Include Ingredient:">
                    <div class="search-form-btn"><i class="fa fa-plus-circle fa-lg"></i></div>       
                </div>
                <div class="col-3">       
                    <input type="text" id="exclude" name="exclude" placeholder="Exclude Ingredient:">
                    <div class="search-form-btn"><i class="fa fa-minus-circle fa-lg"></i></div>       
                </div>
                <div class="col-2">       
                    <button type="submit" name="submit2" class="search-btn2" onclick="return validateFilterForm()">
                        <i class="fa fa-filter fa-lg"></i>&nbsp;Filter
                    </button>      
                </div>   
            </div>
            </form>
        </div>
        
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <!-- Breaking News -->
                    <div class="col-12 col-sm-6">
                        <div class="breaking-news">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                    <li><a>Welcome to The Cooking Corner</a></li>
                                    <li><a>Start by searching any recipes now!</a></li>
                                    <li><a>Make something delicious today!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
          
                    <!-- Top Social Info -->
                    <div class=" col-sm-4">
                        <div class="top-social-info text-right">  
                            
                            <!-- Newsletter Form -->
                       
                                <button class="search-btn">
                                    <h6 style="color: white;">
                                <i class="fa fa-search" aria-hidden="true">&nbsp; Search Recipe</i>
                                    </h6>
                                 </button>
                              &emsp;   
                            
                            
                        </div>
                    </div>
                    <a class="nav-link text-center" style="color: black;" id="time"></a>
                </div>
            </div>
        </div>
        
        <!-- Navbar Area -->
        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="view.php"><img src="img/core-img/logo.png" alt="" width="200px"></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li <?php if ($thisPage == "View") {echo " class=\"active\"";} ?>>
                                        <a href="view.php">Main</a>
                                    </li>
                                    <li <?php if ($thisPage == "Manage") {echo " class=\"active\"";} ?>><a href="#">Manage Recipes</a>
                                        <ul class="dropdown">
                                            <li><a href="insertRecipe.php">Insert Recipe</a></li>
                                         
                                        </ul>
                                    </li>
                                    <li <?php if ($thisPage == "Registered Users") {echo "class=\"active\"";} ?>>
                                        <a href="registered.php">Registered Users</a>
                                    </li>
                                      <li <?php if ($thisPage == "BPost" || $thisPage == "BView") {echo " class=\"active\"";} ?>>
                                        <a href="#">Manage Blog</a>
                                         <ul class="dropdown">
 
                                            <li <?php if ($thisPage == "BView") {echo " class=\"active\"";} ?>>
                                                <a href="manage-blog-post.php"> Recipe Blog</a>
                                            </li>
                                            <li <?php if ($thisPage == "BView") {echo " class=\"active\"";} ?>>
                                                <a href="manage-blog-tips-post.php"> Tips & Advices  Blog</a>
                                            </li>
                                             <li <?php if ($thisPage == "BChart") {echo " class=\"active\"";} ?>>
                                                <a href="blog-chart.php"> View Blog Stats</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if ($thisPage == "Feedback") {echo " class=\"active\"";} ?>>
                                        <a href="feedback.php">Users Feedback</a>
                                    </li>
                                    <li <?php if ($thisPage == "Profile" || $thisPage == "MyBlog") {echo " class=\"active\"";} ?>>
                                        <a href="#"><?php echo'<img width="40px" height="40px" style="border-radius: 100px;" src="img/core-img/'.$_SESSION['admin_profile'].'" alt="profile"/>';?>
                                            <?php echo isset ($_SESSION['uName']) ?  $_SESSION['uName'] : "Login"; ?></a>
                                         <ul class="dropdown">
                                            <li <?php if ($thisPage == "Profile") {echo " class=\"active\"";} ?>>
                                                <a href="admin-profile.php"><i class="fa fa-user-circle"></i> &nbsp;Admin Profile</a>
                                            </li>
                                             <li <?php if ($thisPage == "RecipeChart") {echo " class=\"active\"";} ?>>
                                                <a href="view-chart.php"><i class="fa fa-folder-open"></i> &nbsp;View Recipe Stats</a>
                                            </li>
                                            <li>
                                                <a class="nav-link js-scroll-trigger" title="Logout" href="logout.php">
                                                <i class="fa fa-sign-out fa-lg"></i> Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                         
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

<script>
        function validateFilterForm() {
            var a = document.forms["SearchForm"]["include"].value;
            var b = document.forms["SearchForm"]["exclude"].value;

            if (a == "" && b == "") {
              alert("Include and Exclude ingredient need to be filled out");
              return false;
            }else if (a == "") {
              alert("Include ingredient must be filled out");
              return false;
            }else if (b == "") {
              alert("Exclude ingredient must be filled out");
              return false;
            }
        }
        
    function validateSearchForm() {
        var a = document.forms["SearchForm"]["search"].value;

            if (a == "") {
              alert(" need to be filled out");
              return false;
            }
    }
    </script>