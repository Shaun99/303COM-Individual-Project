<?php 
    $thisPage = "BView"; 
     session_start();
     
    $id = NULL;
	
    if(isset($_GET['id'])) {
            $id = $_GET['id'];
    } 
    
    $value = false;
    // Check for submission
    if(isset($_POST['submit'])){
        if(isset($_SESSION['user_id'])){
        $sql = "INSERT INTO blog_review (breview_id, rblog_id, user_id, rev_name, rev_subject, rating, rev_message) 
                VALUES ('', $id, '".$_SESSION['user_id']."','". $_POST['name'] ."', '". $_POST['subject'] ."', '". $_POST['rating'] ."','". $_POST['messagebox'] ."');";
        
            if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                if(mysqli_query($conn, $sql)) {
                    echo'<script>alert("Your review has been successfully posted!")</script>';
                        $value = true;
                }
            }
        }
        else{
        echo'<script>alert("Please login to post!")</script>';
        $value = true;
    }
    }
    
     if(isset($_POST['submit2'])){
        if(isset($_SESSION['user_id'])){
        $sql = "INSERT INTO saved_recipe (saved_id, rblog_id, user_id) 
                VALUES ('', $id, '".$_SESSION['user_id']."');";
        
            if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                if(mysqli_query($conn, $sql)) {
                        header ('location: recipe-blog-view.php?id='. $_GET["id"].'');     
                        $value = true;
                }
            }
        }
        else{
            echo '<script>alert("Please sign in first in order to save recipe.")</script>';
            header('refresh:0.01; url=recipe-blog-view.php?id='. $_GET["id"].'');
            exit();
    }
    }
    
      if(isset($_POST['submit3'])){
        if(isset($_SESSION['user_id'])){
        $sql = "INSERT INTO shopping_list (list_id, rblog_id, user_id) 
                VALUES ('', $id, '".$_SESSION['user_id']."');";
        
            if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                if(mysqli_query($conn, $sql)) {
                        header ('location: recipe-blog-view.php?id='. $_GET["id"].'');     
                        $value = true;
                }
            }
        }
        else{
            echo '<script>alert("Please sign in first in order to add into shopping list.")</script>';
            header('refresh:0.01; url=recipe-blog-view.php?id='. $_GET["id"].'');
            exit();
    }
    }
    if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
        if(isset($_SESSION['user_id'])){
        $sql = "SELECT * FROM saved_recipe WHERE rblog_id = ". $id ." AND user_id =".$_SESSION['user_id'].";";

        if($result = mysqli_query($conn, $sql)) {
            $numRow_saved = mysqli_num_rows($result);
        }
        }
    }
    
        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
        if(isset($_SESSION['user_id'])){
        $sql = "SELECT * FROM shopping_list WHERE rblog_id = ". $id ." AND user_id =".$_SESSION['user_id'].";";

        if($result = mysqli_query($conn, $sql)) {
                $numRow_saved2 = mysqli_num_rows($result);
        }
        }
    }
   
      
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Blog Recipes</title>
    <style>
        ul li {
            list-style-type: square !important;
        }
        ol li {
            list-style-type: decimal !important;
        }
    </style>
</head>

<body>
   <?php 
        if (isset($_SESSION["user_id"]) == false) {
            include('components/nav-bar-general.php');
        }
        else if ($_SESSION["user_id"] == true) {
            include('components/nav-bar-login.php');
        }
        
        if(isset($_GET['msg'])) {
                echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="insertRecipe.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        }
    ?>
     <?php

        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            $sql = "SELECT * FROM recipe_blog,user WHERE recipe_blog.user_id = user.user_id AND rblog_id = ". $id .";";

            if($result = mysqli_query($conn, $sql)) {
                if($row = mysqli_fetch_assoc($result)) {
                    print'
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <div class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                     <li class="breadcrumb-item"><a href="blog-post.php">Recipe Blog</a></li>   
                 <li class="breadcrumb-item active">'. $row['rblog_name'] .'</li>
             </div>
         </div>
     </div>
     
        <!-- Receipe Slider -->
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="receipe-slider owl-carousel">
                        <img src="img/blog-img/'.$row['rblog_image1'].'" >
                        <img src="img/blog-img/'.$row['rblog_image2'].'" >
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipe Content Area -->
        <div class="receipe-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="receipe-headline my-5">
                            <span style="font-size: 16px;">Posted by 
                            <img width="40px" height="40px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                            <b> '.$row['uname'].' </b> on  <b>'.$row['posted_at'].'</b></span>
                            <br/>
                            <h2>'. $row['rblog_name'] .'</h2>
                            <div class="receipe-duration">
                              <div class="row">
                                <div class="col-6">
                                <h6>Difficulty    : ';
                         
                                 switch($row['difficulty']) {
                                        case 1:
                                                echo 'Easy <i class="fa fa-star" aria-hidden="true"></i>';
                                                break;
                                        
                                        case 2:
                                                echo 'Medium <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                                break;

                                        case 3:
                                                echo 'Hard <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
                                }
                                
                        print ' 
                                </h6>
                                <h6>Category    : ';
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
                        print '
                                </h6>
                                <h6>Yields  : '. $row['serving'] .' serving(s)</h6>
                                 </div>
                                <div class="col-6">
                                    <h6>Preparation    : '. $row['preparation'] .'</h6>
                                    <h6>Cooking    : '. $row['cooking'] .' minutes</h6>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-12 col-md-3">
                        <div class="receipe-ratings text-right my-5">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class=" text-right my-5">';
                        if(isset($_SESSION['user_id'])){
                        if ($numRow_saved > 0) {
                            echo'   <a href="deleteSavedBlog.php?saved_id='. $_GET['id'] .'&rblog_id='. $_GET['id'] .'" onclick="return confirm(\'Do you wish to remove this saved recipe?\');">
                                    <button type="button" class="saved-btn2">
                                        <b><i class="fa fa-heart"></i> Saved</b>
                                    </button>
                                    </a>';
                        } else {
                            echo'<form name="saved" action="recipe-blog-view.php?id='. $_GET['id'] .'"  method="post">
                                    <button type="submit" name="submit2" class="saved-btn">
                                        <b><i class="fa fa-heart"></i> Save Recipe</b>
                                    </button>   
                                </form>';  
                                }
                        }else {
                            echo'<form name="saved" action="recipe-blog-view.php?id='. $_GET['id'] .'"  method="post">
                                    <button type="submit" name="submit2" class="saved-btn">
                                        <b><i class="fa fa-heart"></i> Save Recipe</b>
                                    </button>   
                                </form>';  
                        }
                       
     
                  print'      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <h4>Directions</h4><hr>
                        <div class="direction">';
                            $data = explode('<br />', $row['direction']);

                            echo '<ol>';
                            foreach ($data as $d) {
                                echo '<li>' . $d . '</li>';                
                            }
                            echo '</ol>';
            print'            </div>
                    </div>
                    <div class="col-12 col-lg-1">
                    </div>
                    <!-- Ingredients -->
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-5">
                                <h4>Ingredients</h4>
                            </div>
                            <div class="col-7">';
                        if(isset($_SESSION['user_id'])){
                        if ($numRow_saved2 > 0) {
                            echo'   <a href="deleteListBlog.php?list_id='. $_GET['id'] .'&rblog_id='. $_GET['id'] .'" onclick="return confirm(\'Do you wish to remove this added list?\');">
                                    <button type="button" class="shopping-list2">
                                        <b><i class="fa fa-check-circle fa-lg"></i> Added</b>
                                    </button>
                                    </a>';
                        }else {
                            echo' <form name="saved" action="recipe-blog-view.php?id='. $_GET['id'] .'"  method="post">
                                    <button type="submit" name="submit3" class="shopping-list">
                                        <b><i class="fa fa-list"></i> Add to List</b>
                                    </button>   
                                </form>';  
                        }
                        }else {
                            echo'<form name="saved" action="recipe-blog-view.php?id='. $_GET['id'] .'"  method="post">
                                    <button type="submit" name="submit3" class="shopping-list">
                                        <b><i class="fa fa-list"></i> Add to List</b>
                                    </button>   
                                </form>';  
                        }
                               
                        
                      print'      </div>
                        </div>
                            <hr>
                        <div class="ingredients">        
                             <div class="ingredient">';
                                  $data = explode('<br />', $row['ingredient']);

                                    echo '<ul>';
                                    foreach ($data as $d) {
                                        echo '<li>' . $d . '</li>';                
                                    }
                                    echo '</ul>';
                      print'      </div>
                        </div>
                    </div>
                </div>
                <br/>
                <hr>
                <div class="review-form-area bg-overlay3">
                    <div class="row">
                        <div class="col-12">
                            <div class=" text-left">
                                <h3>Leave a review <i class="fa fa-comment"></i></h3> 
                            </div><br/>
                        <form name="reviewForm" action="recipe-blog-view.php?id='. $_GET['id'] .'"  method="post">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="col-12 col-lg-4">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                </div>
                                <div class="col-12 col-lg-4">
                                    <select name="rating" id="rating">
                                        <option selected>Please select ratings</option>
                                        <option value="1">1 - Very Poor</option>
                                        <option value="2">2 - Poor</option>
                                        <option value="3">3 - Fair</option>
                                        <option value="4">4 - Good</option>
                                        <option value="5">5 - Excellent</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="messagebox" class="form-control" id="messagebox" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn delicious-btn mt-30" type="submit" name="submit" onclick="return validateReviewForm()">Post Comments</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                  <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="text-left">';
                        
                            //Connect and select:
                            $dbc = mysqli_connect('localhost', 'root', '');
                            mysqli_select_db($dbc,"cooking_corner");

                            //Define thr query
                            $query = 'SELECT * FROM blog_review, user WHERE blog_review.user_id = user.user_id AND rblog_id = '. $_GET['id'] .' ORDER BY posted_at DESC';
                            $query_reply = 'SELECT * FROM blog_reply, blog_review, user WHERE blog_reply.breview_id = blog_review.breview_id AND blog_reply.user_id = user.user_id AND blog_review.rblog_id = ' . $_GET['id'] . '';
                            $reply_result = mysqli_query($dbc, $query_reply);
                            
                            $query_count = 'SELECT COUNT(*) as r_count FROM blog_review WHERE rblog_id = '. $_GET['id'] .'';
                            $review_count = mysqli_query($dbc,$query_count);
                            $r_count = mysqli_fetch_assoc($review_count);
                            //Run the query
                            if($r = mysqli_query($dbc,$query)){
                                print'<h4> '.$r_count['r_count'].'  Review(s)</h4><br/>';
                                $count = 0;
                                if(mysqli_num_rows($r) > 0) {
                                //Retieve and run the record
                                while($row = mysqli_fetch_array($r)){
                                    $query_count2 = 'SELECT COUNT(*) as r_count2 FROM blog_reply
                                                        WHERE rblog_id = '. $_GET['id'] .' AND breview_id = '. $row['breview_id'] .'';
                                    $reply_count = mysqli_query($dbc, $query_count2);
                                    $r_count2 = mysqli_fetch_assoc($reply_count);
                                   print  '<div class="review-container" style="width:70%">         
                                                <div class="w3-container">
                                                <div class="row">
                                                <div class="col-3" style="margin-left: 15px;">
                                                <img width="80px" height="80px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                                                </div> 
                                                    <div class="col-7" style="margin-left: -80px;">
                                                        <h5>'.$row['rev_name'].'</h5>
                                                        <h7>'.$row['rev_subject'].'</h7>
                                                    </div>
                                                    <div class="col-2" style="color:#FFAE42; margin-left: 50px;" >';
                                                        switch($row['rating']) {
                                                            case 1:
                                                                echo '<i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                                break;

                                                            case 2:
                                                                echo '<i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                                break;

                                                            case 3:
                                                                echo '<i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                                break;

                                                            case 4:
                                                                echo '<i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                                break;

                                                            case 5:
                                                                echo '<i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                                      <i class="fa fa-star" aria-hidden="true"></i>'; 
                                                        }
                                                        
                                    print'          </div>
                                                </div>
                                            
                                            <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-10">
                                            <hr>
                                            <p style="font-size: 15px; color:black;">'.$row['rev_message'].'</p><br>
                                            
                                            <p style="float:right;">Posted <b>
                                            '; 
                                                date_default_timezone_set('Asia/Kuala_Lumpur');  
                                                echo review_time_ago($row['posted_at']); 
                                    print '</b></p>';
                                        echo '<a data-toggle="collapse" href="#collapse'. $count .'" role="button" aria-expanded="false" aria-controls="collapse">'.'
                                            <p><b><i class="fa fa-share"></i> ' . $r_count2['r_count2'] . ' Reply(s)</b></p></a>';
                                        echo '<div class="collapse" id="collapse'. $count++ .'">';
                                while ($row_reply = mysqli_fetch_array($reply_result)) {
                                    if ($row_reply['breview_id'] == $row['breview_id']) {
                                        echo '<hr>';
                                        echo '<div class="row">';
                                        echo '<div class="col-2">';
                                        echo '<img width="50px" height="50px" style="border-radius: 100%;" src="img/core-img/' . $row_reply['profile'] . '" alt="profile"/>';
                                        echo '</div>';
                                        echo '<div class="col-10">';
                                        echo '<div class="reply-container">';
                                        echo '<p style="color: darkslategrey;"><b>' . $row_reply['uname'] . '</b> &bull;  <i class="fa fa-bookmark"></i> <i>Author</i>';
                                        echo "<br/>". $row_reply['reply'] . "</p>";
                                        echo '</div>';
                                        date_default_timezone_set('Asia/Kuala_Lumpur');
                                        echo '<p class="reply-time">&bull; Replied '.review_time_ago($row_reply['replied_at']).'</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                                echo '</div>';
                                $reply_result = mysqli_query($dbc, $query_reply);
                                          
                    print'                    </div>
                        </div>
                        </div>
                                    </div>';
                                }
                            }else{
                                echo'<center><img src="img/core-img/comment.png" width="80px"/></center>';
                                echo'<center><h5><i>- No comments to display -</i></h5></center>';
                                echo'<center><h6><i>Be the first to add a comment!</i></h6></center>';
                            }
                        }
                                mysqli_close($dbc);
    
                        print'</div>
                    </div>
                </div>
                <br/>
    </div>';
                 }
                    }
                }
                ?>
    <br/>
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
    
     <script>
        
        function validateReviewForm() {
            var w = document.forms["reviewForm"]["name"].value;
            var x = document.forms["reviewForm"]["subject"].value;
            var y = document.forms["reviewForm"]["messagebox"].value;
            
                if (w == "" && x == "" && y == "") {
                  alert("All fields must be filled out");
                  return false;
                }else if (w == "") {
                  alert("Username must be filled out");
                  return false;
                }else if (x == "") {
                  alert("Subject must be filled out");
                  return false;
                }else if (y == "") {
                  alert("Message must be filled out");
                  return false;
                }
        }
    </script>
<?php  

 function review_time_ago($timestamp)  
 {  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "one minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "an hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }  
 ?>  
</body>

</html>
