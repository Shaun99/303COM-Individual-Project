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
            <form action="recipes.php" name="SearchForm" method="get">
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
                        <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt="" width="200px"></a>

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
                                    <li <?php if ($thisPage == "Home") {echo " class=\"active\"";} ?>>
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li <?php if ($thisPage == "Page") {echo " class=\"active\"";} ?>>
                                        <a href="#">Pages</a>
                                                     <ul class="dropdown">
                                            <li>
                                                <a href="index.php"><i class="fa fa-home"></i>&nbsp; Home</a>
                                            </li>
                                            <li>
                                                <a href="about.php"><i class="fa fa-info-circle"></i>&nbsp; About Us</a>
                                            </li>
                                            <li>
                                                <a href="recipes.php"><i class="fa fa-book"></i>&nbsp; All Recipes</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-clone"></i>&nbsp; Recipe Blog</a>
                                                 <ul class="dropdown">
                                                    <li>
                                                        <a href="blog-post.php">View Recipe Blog</a>
                                                    </li>
                                                    <li>
                                                        <a href="blog-post-tips.php">View Tips & Advices</a>
                                                    </li>   
                                                </ul>
                                            </li>            
                                            <li>
                                                <a href="contact.php"><i class="fa fa-address-book"></i>&nbsp; Contact Us</a>
                                            </li>          
                                           
                                            <li><a href="#"><i class="fa fa-plus"></i>&nbsp; More</a>
                                                <ul class="dropdown" style="height: 100px;">
                                                    <li>
                                                        <a href="converter.php">Cooking Conversion Calculator</a>
                                                    </li>     
                                                   
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if ($thisPage == "About Us") {echo "class=\"active\"";} ?>>
                                        <a href="about.php">About Us</a>
                                    </li>
                                    <li <?php if ($thisPage == "Recipes") {echo " class=\"active\"";} ?>>
                                        <a href="recipes.php">All Recipes</a>
                                    </li>
                                      <li <?php if ($thisPage == "BPost" || $thisPage == "BView") {echo " class=\"active\"";} ?>>
                                        <a href="#">Recipe Blog</a>
                                         <ul class="dropdown">
                                            <li <?php if ($thisPage == "BView") {echo " class=\"active\"";} ?>>
                                                <a href="blog-post.php">View Recipe Blog</a>
                                            </li>
                                            <li <?php if ($thisPage == "BView") {echo " class=\"active\"";} ?>>
                                                <a href="blog-post-tips.php">View Tips & Advices</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if ($thisPage == "Contact Us") {echo " class=\"active\"";} ?>>
                                        <a href="contact.php">Contact Us</a>
                                    </li>
                                    <li <?php if ($thisPage == "User" || $thisPage == "Admin") {echo " class=\"active\"";} ?>>
                                        <a href="#">Login</a>
                                         <ul class="dropdown">
                                            <li <?php if ($thisPage == "User") {echo " class=\"active\"";} ?>>
                                                <a href="user.php">User</a>
                                            </li>
                                            <li <?php if ($thisPage == "Admin") {echo " class=\"active\"";} ?>>
                                                <a href="admin.php">Admin</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if ($thisPage == "Register") {echo " class=\"active\"";} ?>>
                                        <a href="register.php">Register</a>
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
              alert(" Search box need to be filled out");
              return false;
            }
    }

</script>





