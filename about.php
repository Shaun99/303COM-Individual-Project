<?php 
    $thisPage = "About Us"; 
     session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | About</title>
</head>

<body>
   <?php 
        if (isset($_SESSION["user_id"]) == false) {
            include('components/nav-bar-general.php');
        }
        else if ($_SESSION["user_id"] == true) {
            include('components/nav-bar-login.php');
        }
         $dbc = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($dbc,"cooking_corner");

        $query_count = 'SELECT COUNT(*) as r_count FROM recipe';
        $recipe_count = mysqli_query($dbc,$query_count);
        $r_count = mysqli_fetch_assoc($recipe_count);

        $query_count2 = 'SELECT COUNT(*) as r_count2 FROM tips_blog';
        $tblog_count = mysqli_query($dbc,$query_count2);
        $r_count2 = mysqli_fetch_assoc($tblog_count);
        
        $query_count3 = 'SELECT COUNT(*) as r_count3 FROM recipe_blog';
        $rblog_count = mysqli_query($dbc,$query_count3);
        $r_count3 = mysqli_fetch_assoc($rblog_count);
        
        $blog_count = intval($r_count2['r_count2']+$r_count3['r_count3']);
  
    print'
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">About Us</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### About Area Start ##### -->
    <section class="about-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Who we are?</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="sub-heading pb-5">The Cooking Corner features the largest collection of professionally-tested 
                        recipes online from food experts at the magazines and cookbooks you love and trusts
                        Find the food you need for any occasion with our recipe finder. Easily 
                        refine your search with any of nearly 20 recipe categories. The site delivers every type of 
                        recipe you could want, from decadent desserts and authentic cuisines to great-tasting healthy 
                        favorites with nutrition information that is reviewed by registered dietitians.</h6>

                    <p class="text-center" style="color: black;">
                        Save your favorite recipes. Build and create your own shopping lists and blogs. Create and
                        pass around menus for upcoming get-togethers. Rate the recipes and discover new must-try dishes 
                        from hundreds of reviews from fellow cooks.
                    </p>
                </div>
            </div>
    
            <div class="row align-items-center mt-100">
                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-cool-fact">
                        <img src="img/core-img/salad.png" alt="">
                        <h3><span class="counter">'.$r_count['r_count'].'</span></h3>
                        <h6>Astonishing Recipes</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-cool-fact">
                        <img src="img/core-img/hamburger.png" alt="">
                        <h3><span class="counter">'.$blog_count.'</span></h3>
                        <h6>Amazing Food Blogs</h6>
                    </div>
                </div>

                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-cool-fact">
                        <img src="img/core-img/rib.png" alt="">
                        <h3><span class="counter">12</span></h3>
                        <h6>Categories of Recipes</h6>
                    </div>
                </div>';
?>
            <div class="row">
                <div class="col-12">
                    <img class="mb-70" src="img/bg-img/about.png" alt="">
                      <div class="row">
                        <div class="col-12">
                            <div class="section-heading">
                                <h3>Where we get the recipes?</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-center" style="color: black;">
                        We develop most of our recipes in-house (The Cooking Corner staff and 
                        contributors), inspired by what is growing in the garden, and seasonal produce we find at the 
                        market.If we have pulled a recipe from another source, we do our best to attribute the source. The 
                        recipes we share use mostly whole food ingredients but we also believe there is a time and a place 
                        for healthy canned, frozen, and other prepared ingredients. We believe in a varied, healthy diet, 
                        using extra virgin olive oil, real butter and cream, eggs, lots of green vegetables, and protein from 
                        meat, fish, beans, and cheese.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Area End ##### -->

    <!-- ##### Follow Us Instagram Area Start ##### -->
    <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Follow Us Instragram</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        <div class="insta-feeds d-flex flex-wrap">
            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta1.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta2.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta3.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta4.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta5.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta6.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta7.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Follow Us Instagram Area End ##### -->

   <?php require_once './components/footer.php'; ?>

   <?php require_once './components/js-include-bottom.php'; ?>
</body>

</html>

