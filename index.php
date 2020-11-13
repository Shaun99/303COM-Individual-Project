<?php 
    $thisPage = "Home"; 
     session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Home</title>
</head>

<body>
    <?php 
        if (isset($_SESSION["user_id"]) == false) {
            include('components/nav-bar-general.php');
        }
        else if ($_SESSION["user_id"] == true) {
            include('components/nav-bar-login.php');
        }
    
     if(isset($_GET['msg3'])) {
        echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px 0px 50px;">';
            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg3'] .' <a href="index.php" class="float-right pr-3" style="color:white;">Close</a></h7>';
        echo '</div>';
    }
    
   
    ?>
    <br/>
    
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <?php
             if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    
    $sql = 'SELECT * FROM recipe WHERE dish = 4 LIMIT 1';
    
     //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
                    print ' <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/recipe-img/'.$row['re_image1'].');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">'. $row['re_name'] .'</h2>
                                <p data-animation="fadeInUp" data-delay="700ms" style="text-align:justify;">'. $row['description'] .'</p>
                                <a href="recipe-post.php?id='. $row['recipe_id'] .'" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                }
             }
        }
             }
        ?>
            
           

    <?php
     if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

    $sql = 'SELECT * FROM recipe WHERE dish = 3 LIMIT 1';
    
     //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
                    print ' <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/recipe-img/'.$row['re_image1'].');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">'. $row['re_name'] .'</h2>
                                <p data-animation="fadeInUp" data-delay="700ms" style="text-align:justify;">'. $row['description'] .'</p>
                                <a href="recipe-post.php?id='. $row['recipe_id'] .'" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                }
             }
        }
             }
        ?>
             <?php
     if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

    $sql = 'SELECT * FROM recipe WHERE dish = 11 LIMIT 1';
    
     //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
                    print ' <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/recipe-img/'.$row['re_image1'].');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">'. $row['re_name'] .'</h2>
                                <p data-animation="fadeInUp" data-delay="700ms" style="text-align:justify;">'. $row['description'] .'</p>
                                <a href="recipe-post.php?id='. $row['recipe_id'] .'" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">See Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                }
             }
        }
             }
        ?>
        </div>
    </section>        
    <!-- ##### Hero Area End ##### -->

    
    <!-- ##### Top Catagory Area Start ##### -->
    <section class="top-catagory-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <?php
                if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

                $sql = 'SELECT * FROM recipe WHERE dish = 2 LIMIT 2';

                 //Run the query
                    if($r = mysqli_query($conn,$sql)){
                         if(mysqli_num_rows($r) > 0) {
                            //Retieve and run the record
                            while($row = mysqli_fetch_assoc($r)){
                print'<!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="img/recipe-img/'.$row['re_image1'].'" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>'. $row['re_name'] .'</h3>
                            <h6>Simple &amp; Delicious</h6>
                            <a href="recipe-post.php?id='. $row['recipe_id'] .'" class="btn delicious-btn">See Full Recipes</a>
                        </div>
                    </div>
                </div>';
                            }
                         }
                    }
                }
    ?>
  
            </div>
        </div>
    </section>  <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### Best Receipe Area Start ##### -->
    <section class="best-receipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>- The best Recipes -</h3>
                    </div>
                </div>
            </div>

            <div class="row">
        <?php
             if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    
            $sql = 'SELECT * FROM recipe WHERE dish = 1 LIMIT 2';

             //Run the query
                if($r = mysqli_query($conn,$sql)){
                     if(mysqli_num_rows($r) > 0) {
                        //Retieve and run the record
                        while($row = mysqli_fetch_assoc($r)){
                            
                 print'       
                <!-- Single Best Receipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-receipe-area mb-30">
                        <img src="img/recipe-img/'.$row['re_image1'].'" alt="">
                        <div class="receipe-content">
                            <a href="recipe-post.php?id='. $row['recipe_id'] .'">
                                <h5>'. $row['re_name'] .'</h5>
                            </a>
                            <div class="ratings">';
                                 switch($row['difficulty']) {
                                    case 1:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 2:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 3:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                }
                  print'    </div>
                        </div>
                    </div>
                </div>';
                        }
                     }
                }
             }
                 ?>

               <?php
             if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    
            $sql = 'SELECT * FROM recipe WHERE dish = 5 LIMIT 2';

             //Run the query
                if($r = mysqli_query($conn,$sql)){
                     if(mysqli_num_rows($r) > 0) {
                        //Retieve and run the record
                        while($row = mysqli_fetch_assoc($r)){
                            
                 print'       
                <!-- Single Best Receipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-receipe-area mb-30">
                        <img src="img/recipe-img/'.$row['re_image1'].'" alt="">
                        <div class="receipe-content">
                            <a href="recipe-post.php?id='. $row['recipe_id'] .'">
                                <h5>'. $row['re_name'] .'</h5>
                            </a>
                            <div class="ratings">';
                                 switch($row['difficulty']) {
                                    case 1:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 2:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 3:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                }
                  print'    </div>
                        </div>
                    </div>
                </div>';
                        }
                     }
                }
             }
                 ?>

              
               <?php
             if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    
            $sql = 'SELECT * FROM recipe WHERE dish = 7 LIMIT 1';

             //Run the query
                if($r = mysqli_query($conn,$sql)){
                     if(mysqli_num_rows($r) > 0) {
                        //Retieve and run the record
                        while($row = mysqli_fetch_assoc($r)){
                            
                 print'       
                <!-- Single Best Receipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-receipe-area mb-30">
                        <img src="img/recipe-img/'.$row['re_image1'].'" alt="">
                        <div class="receipe-content">
                            <a href="recipe-post.php?id='. $row['recipe_id'] .'">
                                <h5>'. $row['re_name'] .'</h5>
                            </a>
                            <div class="ratings">';
                                 switch($row['difficulty']) {
                                    case 1:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 2:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 3:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                }
                  print'    </div>
                        </div>
                    </div>
                </div>';
                        }
                     }
                }
             }
                 ?>

                <?php
             if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    
            $sql = 'SELECT * FROM recipe WHERE dish = 8 ORDER BY re_name ASC LIMIT 1 ';

             //Run the query
                if($r = mysqli_query($conn,$sql)){
                     if(mysqli_num_rows($r) > 0) {
                        //Retieve and run the record
                        while($row = mysqli_fetch_assoc($r)){
                            
                 print'       
                <!-- Single Best Receipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-best-receipe-area mb-30">
                        <img src="img/recipe-img/'.$row['re_image1'].'" alt="">
                        <div class="receipe-content">
                            <a href="recipe-post.php?id='. $row['recipe_id'] .'">
                                <h5>'. $row['re_name'] .'</h5>
                            </a>
                            <div class="ratings">';
                                 switch($row['difficulty']) {
                                    case 1:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 2:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                            break;

                                    case 3:
                                            echo ' <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                }
                  print'    </div>
                        </div>
                    </div>
                </div>';
                        }
                     }
                }
             }
                 ?>
        </div>
    </section>
    <!-- ##### Best Receipe Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <section class="cta-area bg-img bg-overlay" style="background-image: url(img/bg-img/bg4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content text-center">
                        <h2>The Cooking Corner Recipes</h2>
                        <p> Discover delicious recipe ideas, food inspiration and meals for the whole family
                        as well as handy food guides and fresh ideas for cooking at home.</p>
                        <a href="recipes.php" class="btn delicious-btn">Discover all the recipes <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### CTA Area End ##### -->
    <br/><br/>
  
    <!-- ##### Quote Subscribe Area Start ##### -->
    <section class="quote-subscribe-adds">
        <div class="container">
            <div class="row align-items-end">
                <!-- Quote -->
                <div class="col-12 col-lg-4">
                    <div class="quote-area text-center">
                        <span>"</span>
                        <h4>Nothing is better than going home to family and eating good food and relaxing</h4>
                        <p>John Smith</p>
                        <div class="date-comments d-flex justify-content-between">
                            <div class="date">January 04, 2018</div>
                            <div class="comments">2 Comments</div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-12 col-lg-4">
                    <div class="newsletter-area">
                        <h4>Subscribe to our newsletter</h4>
                        <!-- Form -->
                        <div class="newsletter-form bg-img bg-overlay" style="background-image: url(img/bg-img/bg1.jpg);">
                            <form action="#" method="post">
                                <input type="email" name="email" placeholder="Subscribe to newsletter">
                                <button type="submit" class="btn delicious-btn w-100">Subscribe</button>
                            </form>
                            <p>Fusce nec ante vitae lacus aliquet vulputate. Donec sceleri sque accumsan molestie. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>
                        </div>
                    </div>
                </div>

                <!-- Adds -->
                <div class="col-12 col-lg-4">
                    <div class="delicious-add">
                        <img src="img/bg-img/add.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Quote Subscribe Area End ##### -->

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

