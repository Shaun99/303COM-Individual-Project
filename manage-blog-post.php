<?php 
    $thisPage = "BView"; 
     session_start();
     
    $id = NULL;
	
    if(isset($_GET['id'])) {
            $id = $_GET['id'];
    } 
    
    if (empty($_GET['page']))
        $_GET['page'] = 1;
    
     if(isset($_SESSION['uName']) && $_SESSION['uName'] == "Shaun") {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Manage Recipe Blog</title>
</head>

<body>
    <?php include'components/nav-bar-admin-login.php'; ?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>                                  
                 <li class="breadcrumb-item active"> Manage Recipe Blog</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <img src="img/core-img/cc.png" alt="" width="100px">
                        <h2>Manage Recipe Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
     <?php
       if(isset($_GET['msg'])) {
            echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px; margin-bottom: -40px;">';
                    echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="manage-blog-post.php" class="float-right pr-3">Close</a></p>';
            echo '</div>';
        }
    ?>

    <!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                <?php

                $recipeCount = null;
                if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                    $sql = 'SELECT COUNT(*) AS `recipe_blog_count` FROM `recipe_blog`';
                    if($r = mysqli_query($conn,$sql)) {
                        if(mysqli_num_rows($r) > 0) {
                            if ($row = mysqli_fetch_assoc($r)) {
                                $recipeCount = $row['recipe_blog_count'];
                            }
                        }
                    }
                }
   
                    define('COUNT_FROM_DB', $recipeCount);
                    define('LIMIT', 2);
                ?>
                    <center>
                        <nav aria-label="Page navigation example">
                        <div class="blog-pagination">
                            <?php if ($_GET['page'] > 1): ?>
                                <li><a href="<?php echo 'blog-post.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
                            <?php endif; ?>
                            <?php 
                            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                                echo '<li ><a class="active" href="blog-post.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>';
                            } 
                            ?>
                            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                                <li><a href="<?php echo 'blog-post.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
                            <?php endif; ?>
                        </div>
                        </nav>
                    </center>
                    <br/>
                    <hr style="border-top: 2px solid #ff6e40;">
                    <br/>
                    <div class="blog-posts-area">
                <?php
                    if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                        
                     $query = "";
                      if (isset($_GET['blog_category'])) {
                          $query = "AND cat = ".$_GET['blog_category']."";
                      }
            
                    //Define thr query
                    $sql = "SELECT * FROM recipe_blog,user  WHERE recipe_blog.user_id = user.user_id ". $query ." ORDER BY posted_at DESC LIMIT 2 OFFSET ". ((2 * $_GET['page']) - 2);

                    //Run the query
                    if($r = mysqli_query($conn,$sql)){
                         if(mysqli_num_rows($r) > 0) {
                            //Retieve and run the record
                            while($row = mysqli_fetch_assoc($r)){
                                
                                $sql = "SELECT COUNT(*) AS recipe_count FROM blog_review WHERE rblog_id = ". $row['rblog_id'];
                                $count = 0;
                                
                                if($r1 = mysqli_query($conn,$sql)){
                                    if(mysqli_num_rows($r1) > 0) {
                                        //Retieve and run the record
                                        while($row1 = mysqli_fetch_assoc($r1)){
                                            $count = $row1['recipe_count'];
                                        }
                                    }
                                }
        
                       print' <!-- Single Blog Area -->
                        <div class="single-blog-area mb-80">
                            <!-- Thumbnail -->
                            <div class="blog-thumbnail">
                             <a href="deleteUserRecipe.php?rblog_id='. $row['rblog_id'] .'" onclick="return confirm(\'Are you sure you want to delete this user blog?\');">
                                <button type="button" class="close" aria-label="Close">
                                    <span class="Close" aria-hidden="true" title="Remove recipe">&times;</span>
                                </button>
                            </a>
                                <img  src="img/blog-img/'.$row['rblog_image1'].'" alt="" >
                                <!-- Post Date -->
                               <div class="post-date"><b>';
                                     echo date("d <\b\\r> M <\b\\r> Y", strtotime($row['posted_at'])) . "<br>";
                         print'</b></div>
                            </div>
                            <!-- Content -->
                            <div class="blog-content">
                                <a href="#" class="post-title">'.$row['rblog_name'].'</a>
                                <div class="meta-data">
                                by 
                                <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                                <a href="#">
                                 '.$row['uname'].'
                                </a> on '.$row['posted_at'].' | <b>';
                                switch($row['dish']) {
                                        case 1:
                                                echo 'Vegetarian';
                                                break;
                                        case 2:
                                                echo 'Baked Goods';
                                                break;
                                        case 3:
                                                echo 'BBQ';
                                                break;
                                        case 4:
                                                echo 'Noodles';
                                                break;                                      
                                        case 5:
                                                echo 'Rice';
                                                break;
                                        case 6:
                                                echo 'Seafood';
                                                break;
                                        case 7:
                                                echo 'Juice';
                                                break;
                                        case 8:
                                                echo 'Coffee & Tea';
                                                break;
                                        case 9:
                                                echo 'Non-Coffee';
                                                break;
                                        case 10:
                                                echo 'Smoothies';
                                                break;                                      
                                        case 11:
                                                echo 'Cocktails';
                                                break;
                                        case 12:
                                                echo 'Milkshake';
                                }
                               print' </b> </div>
                                <p style="text-align:justify; color:darkslategray;">'.$row['description'].'</p>
                                <div class="row">
                                    <div class="col-8">
                                        <a href="recipe-blog-view.php?id='. $row['rblog_id'] .'" class="btn delicious-btn mt-30">
                                            See Full Recipe <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <p style=" margin-top: 60px; font-size: 15px; float: right;"><i class="fa fa-comment"></i> <b>'. $count .' comment(s)</b></p>
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
                    <hr style="border-top: 2px solid #ff6e40;">
                    <br/>
                    
                    <center>
                        <nav aria-label="Page navigation example">
                        <div class="blog-pagination">
                            <?php if ($_GET['page'] > 1): ?>
                                <li><a href="<?php echo 'blog-post.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
                            <?php endif; ?>
                            <?php 
                            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                                echo '<li ><a class="active" href="blog-post.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>';
                            } 
                            ?>
                            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                                <li><a href="<?php echo 'blog-post.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
                            <?php endif; ?>
                        </div>
                        </nav>
                    </center>
                    <br/>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="blog-sidebar-area">

                        <!-- Widget -->
                        <div class="single-widget mb-80">
                            <h6>Archive</h6>
                            <ul class="list">
                                <li><a href="#">March 2018</a></li>
                                <li><a href="#">February 2018</a></li>
                                <li><a href="#">January 2018</a></li>
                                <li><a href="#">December 2017</a></li>
                                <li><a href="#">November 2017</a></li>
                            </ul>
                        </div>

                        <!-- Widget -->
                        <div class="single-widget mb-80">
                            <h6>Categories</h6>
                            <ul class="list">
                                <li><a href="#">Vegetarian</a></li>
                                <li><a href="#">Baked Goods</a></li>
                                <li><a href="#">BBQ</a></li>
                                <li><a href="#">Noodles</a></li>
                                <li><a href="#">Rice</a></li>
                                <li><a href="#">Seafood</a></li>
                                <li><a href="#">Juice</a></li>
                                <li><a href="#">Coffee & Tea</a></li>
                                <li><a href="#">Non-Coffee</a></li>
                                <li><a href="#">Smoothies</a></li>
                                <li><a href="#">Cocktails</a></li>
                                <li><a href="#">Milkshake</a></li>
                            </ul>
                        </div>

                        <!-- Widget -->
                        <div class="single-widget mb-80">
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->

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
<?php } 
else{ 
        echo '<script>alert("Access Denied. Only for Authorised Admin.")</script>';
    } 
?>
