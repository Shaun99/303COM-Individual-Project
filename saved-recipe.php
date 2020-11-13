<?php 
    $thisPage = "Profile"; 
     session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | My Saved Recipes</title>
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
                 <li class="breadcrumb-item active">My Saved Recipes</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>My Saved Recipes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <!-- ##### Breadcumb Area End ##### -->
    <?php
    $dbc = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($dbc,"cooking_corner");

    $query_count = 'SELECT COUNT(*) as r_count FROM saved_recipe WHERE saved_recipe.user_id = '.$_SESSION['user_id'].'';
    $recipe_count = mysqli_query($dbc,$query_count);
    $r_count = mysqli_fetch_assoc($recipe_count);
    print'
    <div class="saved-container">
        <h5>Total Saved: '.$r_count['r_count'].' recipe(s)</h5>
        <br/>
    <hr style="border-top: 2px solid #ff6e40;">
    </div>';
    ?>
    <?php
    if(isset($_GET['msg'])) {
                echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="saved-recipe.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        }
    
     if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
        //Define thr query
        $sql = 'SELECT * FROM saved_recipe, recipe 
                WHERE saved_recipe.recipe_id = recipe.recipe_id
                AND user_id = '.$_SESSION['user_id'].'';

        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
        
    print'<div class="ft-recipe"> 
        <div class="img-container">
          <img src="img/recipe-img/'.$row['re_image1'].'">
            <a href="deleteSaved.php?saved_id='. $row['saved_id'] .'" onclick="return confirm(\'Do you wish to remove this saved recipe?\');">
            <button type="button" class="save">
                <i class="fa fa-heart"></i>
            </button>
            </a>
        </div>
    <div class="ft-recipe__content">
        <h3 class="recipe-title"> '. $row['re_name'] .' </h3>
            <p> By <b> The Cooking Corner Team </b> </p>
            <hr style="border-style: solid; border-color: darkgray;">
            <div class="user-rating"></div>
            <div class="row">
                <div class="col-lg-4">
                     <span class="value"> 
                    <img src="fonts/clock-regular.svg" width="20px">
                   '. $row['cooking'] .' </span> 
                </div>
                <div class="col-lg-4">
                    <span class="value">
                    <img src="fonts/utensils-solid.svg" width="16px">&nbsp;';
                  
                      switch($row['difficulty']) {
                            case 1:
                                    echo 'Easy';
                                    break;

                            case 2:
                                    echo 'Med';
                                    break;

                            case 3:
                                    echo 'Hard';
                      }
                    
                 print'    </span>
                </div>   
                <div class="col-lg-4">
                    <span class="value"> 
                    <img src="fonts/user-friends-solid.svg" width="20px">
                    '. $row['serving'] .' </span>
                </div> 
            </div>  
            <div class="row">
                <div class="col-lg-4">
                    <span class="title"> Minutes </span>
                </div> 
                <div class="col-lg-4">
                    <span class="title"> Difficulty </span>
                </div> 
                <div class="col-lg-4">
                    <span class="title"> Servings </span>
                </div> 
            </div>
            <br/>
        <p class="description"> 
            '. $row['description'] .'
        </p>
        <div class="wrapper">
            <a href="recipe-post.php?id='. $row['recipe_id'] .'">
                <button class="view-recipe-btn">
                     View Recipe 
                </button>
            </a>
        </div>
    </div>
                </div>';
                }
            }else{
                echo'<center><img src="img/core-img/no-saved.jpg" width="150px"/></center><br/>';
                echo'<center><h4><i>- No Saved Recipes -</i></h4></center>';
                echo'<center><h5 style="color: darkslategray;"><i>Recipes mark as saved are shown here</i></h5></center>';
                echo'<br/>';
            }
            }
        }
    ?>
    <?php
        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
        //Define thr query
        $sql = 'SELECT * FROM saved_recipe, recipe_blog, user 
                WHERE saved_recipe.rblog_id = recipe_blog.rblog_id AND saved_recipe.user_id = user.user_id
                AND saved_recipe.user_id = '.$_SESSION['user_id'].'';
        
        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
        
    print'<div class="ft-blog"> 
        <div class="img-container">
          <img src="img/blog-img/'.$row['rblog_image1'].'">
            <a href="deleteSaved.php?saved_id='. $row['saved_id'] .'" onclick="return confirm(\'Do you wish to remove this saved recipe?\');">
            <button type="button" class="save">
                <i class="fa fa-heart"></i>
            </button>
            </a>
        </div>
    <div class="ft-recipe__content">
        <h3 class="recipe-title"> '. $row['rblog_name'] .' </h3>
            <hr style="border-style: solid; border-color: darkgray;">
            <div class="user-rating"></div>
            <div class="row">
                <div class="col-lg-4">
                     <span class="value"> 
                    <img src="fonts/clock-regular.svg" width="20px">
                   '. $row['cooking'] .' </span> 
                </div>
                <div class="col-lg-4">
                    <span class="value">
                    <img src="fonts/utensils-solid.svg" width="16px">&nbsp;';
                  
                      switch($row['difficulty']) {
                            case 1:
                                    echo 'Easy';
                                    break;

                            case 2:
                                    echo 'Med';
                                    break;

                            case 3:
                                    echo 'Hard';
                      }
                    
                 print'    </span>
                </div>   
                <div class="col-lg-4">
                    <span class="value"> 
                    <img src="fonts/user-friends-solid.svg" width="20px">
                    '. $row['serving'] .' </span>
                </div> 
            </div>  
            <div class="row">
                <div class="col-lg-4">
                    <span class="title"> Minutes </span>
                </div> 
                <div class="col-lg-4">
                    <span class="title"> Difficulty </span>
                </div> 
                <div class="col-lg-4">
                    <span class="title"> Servings </span>
                </div> 
            </div>
            <br/>
        <p class="description"> 
            '. $row['description'] .'
        </p>
        <div class="wrapper">
            <a href="recipe-blog-view.php?id='. $row['rblog_id'] .'">
                <button class="view-recipe-btn">
                     View Recipe 
                </button>
            </a>
        </div>
    </div>
                            </div>';
                            }
                        }
            }
        }
    ?>
    
     <?php require_once './components/footer.php'; ?>

   <?php require_once './components/js-include-bottom.php'; ?>
</body>

</html>

