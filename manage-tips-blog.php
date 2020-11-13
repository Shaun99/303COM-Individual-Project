<?php 
    $thisPage = "Profile"; 
     session_start();
    $id = NULL;
	
    if(isset($_GET['id'])) {
            $id = $_GET['id'];
    } 
    
    $value = false;
    // Check for submission
    if (isset($_POST['submit'])) {
        $review = $_POST['submit'];
        $sql = "INSERT INTO blog_reply (breply_id, breview_id, tblog_id , reply, user_id) 
                    VALUES ('', $review, $id, '" . $_POST['reply'] . "',  '".$_SESSION['user_id']."');";

        if ($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if (mysqli_query($conn, $sql)) {
                echo'<script>alert("Your reply has been posted!")</script>';
                $value = true;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Blog Tips & Advice</title>
</head>

<body>
   <?php 
        if (isset($_SESSION["user_id"]) == false) {
            include('components/nav-bar-general.php');
        }
        else if ($_SESSION["user_id"] == true) {
            include('components/nav-bar-login.php');
        }
    
 if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    $sql = "SELECT * FROM tips_blog,user WHERE tips_blog.user_id = user.user_id AND tblog_id = ". $id .";";

    if($result = mysqli_query($conn, $sql)) {
        if($row = mysqli_fetch_assoc($result)) {
            print'
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                     <li class="breadcrumb-item"><a href="myblog.php">My Blog</a></li>   
                    <li class="breadcrumb-item active"> '.$row['rblog_name'].' </li>
             </ol>
         </div>
     </div>';
        }
    }
 }
?>
    
      <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">
    <?php
         if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
    $sql = "SELECT * FROM tips_blog,user WHERE tips_blog.user_id = user.user_id AND tblog_id = ". $id .";";

    if($result = mysqli_query($conn, $sql)) {
        if($row = mysqli_fetch_assoc($result)) {
            print'

        <!-- Title -->
        <h1 class="mt-4">'.$row['rblog_name'].'</h1>

        <!-- Author -->
        <div class="row">
        <div class="col-5">
       <p class="lead" style="font-size: 18px;">
          by
          <img width="40px" height="40px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
          <a href="#" class="lead" style="font-size: 18px;">'.$row['uname'].'</a> &bull; <b>';
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
        print' </b></p>
            </div>
            <div class="col-7">
             <a href="editBlog.php?id=' . $row['tblog_id'] . '">
                <button class=" edit-blog-btn"><b>Edit Blog</b></button>
            </a>&emsp;
             <a href="deleteBlog.php?tblog_id=' . $row['tblog_id'] . '" onclick="return confirm(\'Are you sure you want to delete this blog?\');">
                <button class=" delete-blog-btn"><b>Delete Blog</b></button>
            </a>
            </div>
        </div>
        </p>
        <hr>

        <!-- Date/Time -->
        <div class="blog-time">
        <div class="row">
            <p>Posted on '.$row['posted_at'].'';
            
            if ($row['edited_on']== 0000){
                
            }else{
                echo'&emsp;|&emsp;<i>Last Edited on '.$row['edited_on'].'</i></p>';
            } 
        print'</div>
        </div>
        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="img/blog-img/'.$row['rblog_image1'].'" alt="">

        <hr>

       <p> '.$row['desp1'].' </p>
           
        <img class="img-fluid rounded" src="img/blog-img/'.$row['rblog_image2'].'" alt="">
            
        <p> '.$row['desp2'].' </p>

        <hr> ';
        //Connect and select:
        $dbc = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($dbc,"cooking_corner");

        //Define thr query
        $query = 'SELECT * FROM blog_review, user WHERE blog_review.user_id = user.user_id AND tblog_id = '. $_GET['id'] .' ORDER BY posted_at DESC';
        $query_reply = 'SELECT * FROM blog_reply, blog_review, user WHERE blog_reply.breview_id = blog_review.breview_id AND blog_reply.user_id = user.user_id AND blog_review.tblog_id = ' . $_GET['id'] . '';
        $reply_result = mysqli_query($dbc, $query_reply);

        $query_count = 'SELECT COUNT(*) as r_count FROM blog_review WHERE tblog_id = '. $_GET['id'] .'';
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
                                            WHERE tblog_id = '. $_GET['id'] .' AND breview_id = '. $row['breview_id'] .'';
                            $reply_count = mysqli_query($dbc, $query_count2);
                            $r_count2 = mysqli_fetch_assoc($reply_count);
                                print  '<div class="review-container" style="width:100%">         
                                            <div class="w3-container">
                                                <div class="row">
                                                    <div class="col-3" style="margin-left: 0px;">
                                                        <img width="80px" height="80px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                                                    </div> 
                                                    <div class="col-7" style="margin-left: -80px;">
                                                        <h5>'.$row['rev_name'].'</h5>
                                                        <h7>'.$row['rev_subject'].'</h7>
                                                     </div>
                                                    <div class="col-3" style="color:#FFAE42; margin-left: 10px;" >
                                                            <a href="deleteBlogReview.php?breview_id=' . $row['breview_id'] . '&tblog_id=' . $_GET['id'] . '" onclick="return confirm(\'Are you sure you want to remove this user review?\');">
                                                            <button type="button" class="close" aria-label="Close">
                                                                <span class="delete-review" aria-hidden="true" title="Remove recipe">&times;</span>
                                                            </button>
                                                            </a>';
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

                                print'     </div>
                                    </div>

                                 <div class="row">
                                    <div class="col-2">
                                    </div>
                                    <div class="col-10">
                                    <hr>
                                    <p style="font-size: 15px; color:black;">'.$row['rev_message'].'</p><br>
                                    <p style="float:right;">Posted <b>'; 
                                     date_default_timezone_set('Asia/Kuala_Lumpur');  
                                     echo review_time_ago($row['posted_at']); 
                            print   '</b></p>';
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
                                            echo '<a href="deleteBlogReply.php?breply_id=' . $row_reply['breply_id'] . '&tblog_id=' . $_GET['id'] . '" class="" style="float:right;"  onclick="return confirm(\'Are you sure you want to undo this reply?\');">';
                                            echo '<img width="20px" height="20px" src="fonts/ellipsis.svg" title="Delete">';
                                            echo '</a>';
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
                                          
        print'        <hr>
                                        <div class="comment">

                                            <button class="btn btn-reply" value = ' . $row['breview_id'] . '><b><i class="fa fa-reply"></i> Reply </b></button>

                                        </div>
                                        <div style="display:none">

                                            <form name="commentForm" action="#" id="commentForm" method="post">
                                                <textarea style="margin-top: 15px;" name="reply" id="reply" class="form-control" cols="35" placeholder=" Write a reply..."></textarea>                                                               
                                                <button id="replySubmitBtn" type="submit" name="submit"  class="btn-post btn-success" > Post </button>    
                                            </form>
                                        </div>              
            
                                    </div>
                                </div>
                        </div>
                    </div>';
                                }
                            }else{
                                echo'<center><img src="img/core-img/comment.png" width="80px"/></center>';
                                echo'<center><h5><i>- No new comments -</i></h5></center>';
                                echo'<center><h6><i>Check again later for new comments!</i></h6></center>';
                            }
                        }
                        mysqli_close($dbc);
    
                      
                }
            }
     }
?>
          <hr>
      </div>
    <div class="col-lg-4">
        <div class="more-blog-container2">
            <h3 class="mt-4" style="color:#ffc13b;">Manage your other blogs</h3>
            <hr style="border-top: 1px solid #ff6e40;"><br/>
        <?php
           if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            
        //Define thr query
        $sql = 'SELECT * FROM tips_blog,user WHERE tips_blog.user_id = user.user_id AND tips_blog.user_id = '.$_SESSION['user_id'].' ORDER BY posted_at DESC LIMIT 5';

        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
        
    print'<div class="ft-recipe-blog"> 
     
    <div class="ft-recipe__content">
     <img src="img/blog-img/'.$row['rblog_image1'].'"><br/><br/>
        <h3 class="recipe-title"> '. $row['rblog_name'] .' </h3><hr>
            <p> By&nbsp;
            <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
            <b> '. $row['uname'] .' </b> | &nbsp;<img src="fonts/clock.svg" width="15px">&nbsp; '. $row['posted_at'] .'
            </p>

        <div style="float:right;">
             <a href="manage-tips-blog.php?id='. $row['tblog_id'] .'" class="btn manage-blog-btn mt-30">
                Manage This <i class="fa fa-arrow-right"></i>
            </a>
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
        </div>
       </div>
     <?php require_once './components/footer.php'; ?>

   <?php require_once './components/js-include-bottom.php'; ?>
    
         <script>
            function validateReplyForm() {
              var a = document.forms["commentForm"]["reply"].value;

              if (a == "") {
                  alert("Reply must be filled out");
                  return false;
              }
          }

        var Reply = false;
        var Comment = {
            init: function () {
                $('.btn-reply').each(function () {
                    $(this).click(function () {
                        if (!Reply) {
                            $review_id = $(this).val();
                            $('#replySubmitBtn').val($review_id);
                            var form = $('#commentForm').clone();
                            $(this).parent().append(form);
                            Reply = true;
                        } else {
                            if ($(this).parent().find('#commentForm').length > 0) {
                                $(this).parent().find('#commentForm').remove();
                                Reply = false;
                            }
                        }
                    });
                });

            },
        };

        $(function () {
            Comment.init();
        });

        
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


