<?php 
    $thisPage = "BView"; 
     session_start();
     
    $id = NULL;
	
    if(isset($_GET['id'])) {
            $id = $_GET['id'];
    } 
    
    if (empty($_GET['page']))
        $_GET['page'] = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Tips & Advices Blog</title>
</head>

<body>
   <?php 
        if (isset($_SESSION["user_id"]) == false) {
            include('components/nav-bar-general.php');
        }
        else if ($_SESSION["user_id"] == true) {
            include('components/nav-bar-login.php');
        }
    ?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">Tips & Advices Blog</li>
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
                        <h2>Tips & Advices Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->


    <!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-80-0">
        <div class="container">
            <div class="row">
                        <?php

             $tipsCount = null;
             if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                 $sql = 'SELECT COUNT(*) AS `tips_blog_count` FROM `tips_blog`';
                 if($r = mysqli_query($conn,$sql)) {
                     if(mysqli_num_rows($r) > 0) {
                         if ($row = mysqli_fetch_assoc($r)) {
                             $tipsCount = $row['tips_blog_count'];
                         }
                     }
                 }
             }

                define('COUNT_FROM_DB', $tipsCount);
                define('LIMIT', 2);
            ?>
                <div class="col-12 col-lg-8">

                    <center>
                        <nav aria-label="Page navigation example">
                        <div class="blog-pagination ">
                            <?php if ($_GET['page'] > 1): ?>
                                <li><a href="<?php echo 'blog-post-tips.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
                            <?php endif; ?>
                            <?php 
                            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                                echo '<li ><a class="active" href="blog-post-tips.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>&nbsp;';
                            } 
                            ?>
                            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                                <li><a href="<?php echo 'blog-post-tips.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
                            <?php endif; ?>
                        </div>
                        </nav>
                    </center>
                    <br/>
                    <hr style="border-top: 2px solid #ff6e40;">
                    <br/>
                    <div class="blog-posts-area">
            

                        <!-- Single Blog Area -->
                <?php
                    if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                        
                        $query = "";
                        if (isset($_GET['blog_category'])) {
                            $query = "AND cat = ".$_GET['blog_category']."";
                        }
                      
                    //Define thr query
                    $sql = "SELECT * FROM tips_blog,user  WHERE tips_blog.user_id = user.user_id ". $query ." ORDER BY posted_at DESC LIMIT 2 OFFSET ". ((2 * $_GET['page']) - 2);
                    
                    //Run the query
                    if($r = mysqli_query($conn,$sql)){
                         if(mysqli_num_rows($r) > 0) {
                            //Retieve and run the record
                            while($row = mysqli_fetch_assoc($r)){
                                
                                $sql = "SELECT COUNT(*) AS tips_count FROM blog_review WHERE tblog_id = ". $row['tblog_id'];
                                $count = 0;
                                
                                if($r1 = mysqli_query($conn,$sql)){
                                    if(mysqli_num_rows($r1) > 0) {
                                        //Retieve and run the record
                                        while($row1 = mysqli_fetch_assoc($r1)){
                                            $count = $row1['tips_count'];
                                        }
                                    }
                                }
      
                            print' <!-- Single Blog Area -->
                             <div class="single-blog-area mb-80">
                                 <!-- Thumbnail -->
                                 <div class="blog-thumbnail">
                                     <img  src="img/blog-img/'.$row['rblog_image1'].'" alt="" >
                                     <!-- Post Date -->
                                     <div class="post-date"><b>';
                                         echo date("d <\b\\r> M <\b\\r> Y", strtotime($row['posted_at'])) . "<br>";
                            print'</b> </div>
                                 </div>
                                 <!-- Content -->
                                 <div class="blog-content">
                                     <a href="#" class="post-title">'.$row['rblog_name'].'</a>
                                     <div class="meta-data">
                                     by 
                                     <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                                     <a href="#">
                                      '.$row['name'].'
                                     </a> on '.$row['posted_at'].' | <b>';
                                    switch($row['cat']) {

                                        case 1:
                                                echo 'Restaurants';
                                                break;
                                        case 2:
                                                echo 'Food & Drinks';
                                                break;
                                        case 3:
                                                echo 'Vegans';
                                                break;
                                        case 4:
                                                echo 'Events & Lifestyle';
                                                break;                                      
                                        case 5:
                                                echo 'Uncategorized';

                                    }
                                print' </b>    </div>
                                     <p style="text-align:justify; color:darkslategray;     overflow: hidden;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 4;
                                        -webkit-box-orient: vertical;">
                                        '.$row['desp1'].'</p>
                                     <a href="tips-blog-view.php?id='. $row['tblog_id'] .'" class="btn delicious-btn mt-30">
                                        Continue Reading <i class="fa fa-arrow-right"></i>
                                    </a>
                                        <p style=" margin-top: 60px; font-size: 15px; float: right;"><i class="fa fa-comment"></i> <b>'. $count .' comment(s)</b></p>
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
                        <div class="blog-pagination ">
                            <?php if ($_GET['page'] > 1): ?>
                                <li><a href="<?php echo 'blog-post-tips.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
                            <?php endif; ?>
                            <?php 
                            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                                echo '<li ><a class="active" href="blog-post-tips.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>&nbsp;';
                            } 
                            ?>
                            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                                <li><a href="<?php echo 'blog-post-tips.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
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

                    <?php
                        $dbc = mysqli_connect('localhost', 'root', '');
                        mysqli_select_db($dbc,"cooking_corner");

                        $query_count = 'SELECT COUNT(*) as r_count FROM tips_blog';
                        $dish_count = mysqli_query($dbc,$query_count);
                        $r_count = mysqli_fetch_assoc($dish_count);

                        print'
                        <div class="single-widget mb-80">
                            <h6>Categories</h6>
                            <ul class="list">
                                <li><a href="blog-post-tips.php">Show All ('.$r_count['r_count'].')</a></li>
                                <li><a href="blog-post-tips.php?blog_category=1">Restaurants</a></li>
                                <li><a href="blog-post-tips.php?blog_category=2">Food &amp; Drinks</a></li>
                                <li><a href="blog-post-tips.php?blog_category=3">Vegans</a></li>
                                <li><a href="blog-post-tips.php?blog_category=4">Events &amp; Lifestyle</a></li>
                                <li><a href="blog-post-tips.php?blog_category=5">Uncategorized</a></li>
                            </ul>
                        </div>';
                        
                        ?>

                     
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
