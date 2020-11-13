<?php 
    $thisPage = "Profile"; 
    session_start();
    
     if (empty($_GET['page']))
        $_GET['page'] = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | My Blog</title>

</head>

<body>
   <?php include'components/nav-bar-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">My Blog</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>My Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
    <?php
    if(isset($_GET['msg'])) {
            echo '<div>';
                echo '<div class="row">';
                    echo '<div class="col-lg-11">';
                        echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px; width:100%">';
                            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="myblog.php" class="float-right pr-3">Close</a></h7>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<br/>';
        }
    ?>
    <div class="blog-area ">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <center>
                            <div class="single-blog-area mb-80">
                                <?php
                                if ($_SESSION['profile'] == null){
                                    $_SESSION['profile'] = "profile.png"; 
                                }
                           
                                    $image = null;
                
                                    if ($_SESSION['profile'] == null){
                                        $image = 'img/core-img/profile.png'; 
                                    }
                                    else{
                                        $image = 'img/core-img/'. $_SESSION['profile'];   
                                    }

                                        echo
                                    '<img src="'.$image.'" style="width:210px; height:210px; border-radius: 200px; border-style:solid;">';  
                                print'<h1> '.$_SESSION['uName'].' </h1>
                                    <br/>
                                    
                                    <ul>
                                        <li>
                                            <a href="myblog.php">
                                                <button type="button" class="mydashboard-btn" >
                                                    My Dashboard
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="main-chat.php">
                                                <button type="button" class="mycomments-btn">
                                                    Chat Messaging
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="insert-blog-recipe.php">
                                                <button type="button" class="mypost-btn">
                                                    Post Recipes
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="insert-blog-tips.php">
                                                <button type="button" class="mytips-btn">
                                                    Post Tips & Advices
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                    </button>
                            </div>
                            </center>
                        </div>
                         <div class="col-12 col-lg-8">
                    
                        <!-- Single Blog Area -->
                        <div class="blog-header">
                         <h3><i class="fa fa-columns"></i> My Dashboard</h3>
                         </div>
                         <br/>';
                         ?>
       
     <?php          
        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

        //Define thr query
        $sql = "SELECT * FROM tips_blog,user 
                WHERE tips_blog.user_id = user.user_id AND tips_blog.user_id = ".$_SESSION['user_id']."
                ORDER BY posted_at DESC LIMIT 1 OFFSET ". ((1 * $_GET['page']) - 1);

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

                print'  
                        <div class="single-blog-area">
                         
                             <!-- Thumbnail -->
                             <div class="blog-thumbnail">
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
                         print'     </b></div>
                                 <p style="text-align:justify; color:darkslategray;">'.$row['desp1'].'</p>
                                 <a href="manage-tips-blog.php?id='. $row['tblog_id'] .'" class="btn delicious-btn mt-30">
                                    Manage Blog <i class="fa fa-arrow-right"></i>
                                </a>
                                  <p style=" margin-top: 60px; font-size: 15px; float: right;"><i class="fa fa-comment"></i> <b>'. $count .' comment(s)</b></p>
                            </div>
                        </div>
                <br/>
                ';
                }

                        $tipsCount = null;
                        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                            $sql = 'SELECT COUNT(*) AS `tips_blog_count` FROM `tips_blog` WHERE tips_blog.user_id = '.$_SESSION['user_id'].'';
                            if($r = mysqli_query($conn,$sql)) {
                                if(mysqli_num_rows($r) > 0) {
                                    if ($row = mysqli_fetch_assoc($r)) {
                                        $tipsCount = $row['tips_blog_count'];
                                    }
                                }
                            }
                        }
                        
                define('COUNT_FROM_DB', $tipsCount);
                define('LIMIT', 1);

                    ?>
                     <hr style="border-top: 2px solid #ff6e40;">
                    <br/> 
      
                        <center>
                         <nav aria-label="Page navigation example">
                          <div class="blog-pagination">
                            <?php if ($_GET['page'] > 1): ?>
                                <li><a href="<?php echo 'myblog.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
                            <?php endif; ?>
                            <?php 
                            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                                echo '&nbsp;<li ><a class="active" href="myblog.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>';
                            } 
                            ?>
                            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                                <li><a href="<?php echo 'myblog.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
                            <?php endif; ?>
                        </div>
                    </nav>
                            </center>
                                         <br/>
            </div>

        <?php
            }else{
                
               print'  
                         <br/>
                         <div class="blog-context">
                         <img src="fonts/paper.svg" width="70px">
                         <h3 style="margin-top: 20px;"><i>There are no posts yet.</i></h3>
                         <h5><i>- Create one today! -</i></h5>
                         </div>
                        </div>
                </div>';
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

    </body>
</html>

