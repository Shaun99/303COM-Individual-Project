

<?php
$thisPage = "Page";
session_start();

$id = NULL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$value = false;
// Check for submission
if (isset($_POST['submit'])) {
    $review = $_POST['submit'];
    $sql = "INSERT INTO reply (reply_id, review_id, recipe_id , reply, admin_id) 
                VALUES ('', $review, $id, '" . $_POST['reply'] . "',  '".$_SESSION['admin_id']."');";

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
        <title>The Cooking Corner | Manage Recipes</title>
        <style>
            ul li {
                list-style-type: disc !important;
            }
            ol li {
                list-style-type: decimal !important;
            }
        </style>
    </head>

    <body>
        <?php include'components/nav-bar-admin-login.php'; ?>

        <?php
        if (isset($_GET['msg'])) {
            echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
            echo '<p class="p-1 pl-3" style="color:#FFF;">' . $_GET['msg'] . ' <a href="manage.php" class="float-right pr-3">Close</a></p>';
            echo '</div>';
        }

        if ($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

            $sql = "SELECT * FROM recipe WHERE recipe_id = " . $id . ";";

            if ($result = mysqli_query($conn, $sql)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    print'
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <div class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>   
                 <li class="breadcrumb-item active">' . $row['re_name'] . '</li>
             </div>
         </div>
     </div>
     
        <!-- Receipe Slider -->
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="receipe-slider owl-carousel">
                        <img src="img/recipe-img/' . $row['re_image1'] . '" >
                        <img src="img/recipe-img/' . $row['re_image2'] . '" >
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
                            <span style="font-size: 16px;">Posted by <img width="40px" height="40px" style="border-radius: 100px;" src="img/core-img/' . $_SESSION['admin_profile'] . '" alt="profile"/>
                            <b> The Administrator of the Cooking Corner </b> on  <b>' . $row['created_at'] . '</b></span>
                            <br/>
                            <h2>' . $row['re_name'] . '</h2>
                            <div class="receipe-duration">
                              <div class="row">
                                <div class="col-6">
                                <h6>Difficulty    : ';

                    switch ($row['difficulty']) {
                        case 1:
                            echo 'Easy';
                            break;

                        case 2:
                            echo 'Medium';
                            break;

                        case 3:
                            echo 'Hard';
                    }

                    print ' 
                                </h6>
                                <h6>Category    : ';
                    switch ($row['dish']) {
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
                                <h6>Yields  : ' . $row['serving'] . ' serving(s)</h6>
                                 </div>
                                <div class="col-6">
                                    <h6>Preparation    : ' . $row['preparation'] . ' minutes</h6>
                                    <h6>Cooking    : ' . $row['cooking'] . ' minutes</h6>
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
                            <a href="edit.php?id=' . $row['recipe_id'] . '">
                                <button class=" edit-btn"><b>Edit Recipe</b></button><br /><br />
                            </a>
                             <a href="deleteRecipe.php?recipe_id=' . $row['recipe_id'] . '" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">
                                <button class=" delete-recipe-btn"><b>Delete Recipe</b></button>
                            </a>
                        </div>
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
            print'           </div>
                    </div>
                    <div class="col-12 col-lg-1">
                    </div>
                    <!-- Ingredients -->
                    <div class="col-12 col-lg-4">
                        <h4>Ingredients</h4><hr>
                        <div class="ingredients">        
                             <div class="ingredient">';
                                $data = explode('<br />', $row['ingredient']);

                                echo '<ul>';
                                foreach ($data as $d) {
                                    echo '<li>' . $d . '</li>';                
                                }
                                echo '</ul>';
                    print'            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="text-left">
                            ';

                    //Connect and select:
                    $dbc = mysqli_connect('localhost', 'root', '');
                    mysqli_select_db($dbc, "cooking_corner");

                    //Define thr query
                    $query = 'SELECT * FROM review, user WHERE review.user_id = user.user_id AND recipe_id = ' . $_GET['id'] . ' ORDER BY posted_at DESC';
                    $query_reply = 'SELECT * FROM reply, review, user, admin WHERE reply.review_id = review.review_id AND review.user_id = user.user_id AND review.recipe_id = ' . $_GET['id'] . ' AND reply.admin_id = admin.admin_id';
                    $reply_result = mysqli_query($dbc, $query_reply);

                    $query_count = 'SELECT COUNT(*) as r_count FROM review WHERE recipe_id = ' . $_GET['id'] . '';
                    $review_count = mysqli_query($dbc, $query_count);
                    $r_count = mysqli_fetch_assoc($review_count);

                    //Run the query
                    if ($r = mysqli_query($dbc, $query)) {
                        print'<h4>This Post has ' . $r_count['r_count'] . '  review(s)</h4><br/>';
                        $count = 0;
                        if (mysqli_num_rows($r) > 0) {
                            //Retieve and run the record
                            while ($row = mysqli_fetch_array($r)) {
                                $query_count2 = 'SELECT COUNT(*) as r_count2 FROM reply
                                                WHERE recipe_id = '. $_GET['id'] .' AND review_id = '. $row['review_id'] .'';
                                $reply_count = mysqli_query($dbc, $query_count2);
                                $r_count2 = mysqli_fetch_assoc($reply_count);
                                print '<div class="review-container" style="width:70%">         
                                                <div class="w3-container">
                                                <div class="row">
                                                <div class="col-3" style="margin-left: 15px;">
                                                <img width="80px" height="80px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                                                </div> 
                                                    <div class="col-6" style="margin-left: -80px;">
                                                        <h5>'.$row['rev_name'].'</h5>
                                                        <h7>'.$row['rev_subject'].'</h7>
                                                    </div>
                                                    <div class="col-3" style="color:#FFAE42; margin-left: 50px;" >
                                                      <a href="deleteReview.php?review_id=' . $row['review_id'] . '&recipe_id=' . $_GET['id'] . '" onclick="return confirm(\'Are you sure you want to remove this user review?\');">
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
                                                        
                                    print'          </div>
                                                </div>
                                            
                                            <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-10">
                                            <hr>
                                            <p style="font-size: 15px; color:black;">'.$row['rev_message'].'</p><br>
                                            
                                            <p style="float:right;" title="'.$row['posted_at'].'">Posted <b>
                                            '; 
                                                date_default_timezone_set('Asia/Kuala_Lumpur');  
                                                echo review_time_ago($row['posted_at']); 
                                    print '</b></p>';
                                        echo '<a data-toggle="collapse" href="#collapse'. $count .'" role="button" aria-expanded="false" aria-controls="collapse">'.'
                                            <p><b><i class="fa fa-share"></i> ' . $r_count2['r_count2'] . ' Reply(s)</b></p></a>';
                                         echo '<div class="collapse" id="collapse'. $count++ .'">'; 
                                        while ($row_reply = mysqli_fetch_array($reply_result)) {
                                    if ($row_reply['review_id'] == $row['review_id']) {
                                        echo '<hr>';
                                        echo '<div class="row">';
                                        echo '<div class="col-2">';
                                        echo '<img width="50px" height="50px" style="border-radius: 100%;" src="img/core-img/' . $row_reply['admin_profile'] . '" alt="profile"/>';
                                        echo '</div>';
                                        echo '<div class="col-10">';
                                        echo '<div class="reply-container">';
                                        echo '<p style="color: darkslategrey;"><b>The Cooking Corner</b> <i class="fa fa-check-circle fa-lg" title="Verified"></i>';
                                        echo '<a href="deleteRecipeReply.php?reply_id=' . $row_reply['reply_id'] . '&recipe_id=' . $_GET['id'] . '" class="" style="float:right;"  onclick="return confirm(\'Are you sure you want to undo this reply?\');">';
                                        echo '<img width="20px" height="20px" src="fonts/ellipsis.svg" title="Delete">';
                                        echo '</a>';
                                        echo "<br/>". $row_reply['reply'] . "</p>";
                                        echo '</div>';
                                        date_default_timezone_set('Asia/Kuala_Lumpur');
                                        echo '<p class="reply-time" title="'.$row_reply['replied_at'].'">&bull; Replied '.review_time_ago($row_reply['replied_at']).'</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                                echo '</div>';
                                $reply_result = mysqli_query($dbc, $query_reply);
                                print '<hr>
                                        <div class="comment">

                                            <button class="btn btn-reply" value = ' . $row['review_id'] . '><b><i class="fa fa-reply"></i> Reply </b></button>

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
                        } else {
                            echo'<center><img src="img/core-img/comment.png" width="80px"/></center>';
                            echo'<center><h5><i>- No new comments -</i></h5></center>';
                            echo'<center><h6><i>Check again later for new comments!</i></h6></center>';                        }
                    }
                    mysqli_close($dbc);

                    print'</div>
                    </div>
                </div>
                <br/>
                <hr>
               <!--onsubmit="return validateReplyForm()"-->
    </div>';
                }
            }
        }
        ?>
        <br/>


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
                } else if (w == "") {
                    alert("Username must be filled out");
                    return false;
                } else if (x == "") {
                    alert("Subject must be filled out");
                    return false;
                } else if (y == "") {
                    alert("Message must be filled out");
                    return false;
                }
            }
        </script>
        <?php

        function review_time_ago($timestamp) {
            $time_ago = strtotime($timestamp);
            $current_time = time();
            $time_difference = $current_time - $time_ago;
            $seconds = $time_difference;
            $minutes = round($seconds / 60);           // value 60 is seconds  
            $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
            $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
            $weeks = round($seconds / 604800);          // 7*24*60*60;  
            $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
            $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
            if ($seconds <= 60) {
                return "Just Now";
            } else if ($minutes <= 60) {
                if ($minutes == 1) {
                    return "one minute ago";
                } else {
                    return "$minutes minutes ago";
                }
            } else if ($hours <= 24) {
                if ($hours == 1) {
                    return "an hour ago";
                } else {
                    return "$hours hrs ago";
                }
            } else if ($days <= 7) {
                if ($days == 1) {
                    return "yesterday";
                } else {
                    return "$days days ago";
                }
            } else if ($weeks <= 4.3) { //4.3 == 52/12  
                if ($weeks == 1) {
                    return "a week ago";
                } else {
                    return "$weeks weeks ago";
                }
            } else if ($months <= 12) {
                if ($months == 1) {
                    return "a month ago";
                } else {
                    return "$months months ago";
                }
            } else {
                if ($years == 1) {
                    return "one year ago";
                } else {
                    return "$years years ago";
                }
            }
        }
        ?>  
    </body>

</html>

