<?php 
    $thisPage = "Profile"; 
     session_start();
     
      if(isset($_SESSION['uName'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | My Shopping List</title>
    <style>
        ul li {
            list-style-type: circle !important;
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
    ?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">My Shopping List</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>My Shopping List</h2>
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

    $query_count = 'SELECT COUNT(*) as r_count FROM shopping_list WHERE shopping_list.user_id = '.$_SESSION['user_id'].'';
    $recipe_count = mysqli_query($dbc,$query_count);
    $r_count = mysqli_fetch_assoc($recipe_count);
    print'
    <div class="saved-container">
        <h5>Total List: '.$r_count['r_count'].' Shopping List(s)</h5>
        <br/>
    <hr style="border-top: 2px solid #ff6e40;">
    </div>';
    ?>
    <?php
    if(isset($_GET['msg'])) {
                echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="shopping-list.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        }
    
     if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
        //Define thr query
        $sql = 'SELECT * FROM shopping_list, recipe 
                WHERE shopping_list.recipe_id = recipe.recipe_id 
                AND user_id = '.$_SESSION['user_id'].'';

        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
        
    print'<div class="ft-list"> 
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="img-container2">
                  <img src="img/recipe-img/'.$row['re_image1'].'"><br/>
                    <div class="wrapper">
                    <a href="deleteList.php?list_id='. $row['list_id'] .'" onclick="return confirm(\'Do you wish to remove the list?\');">
                    <button type="button" class="remove-list-btn">
                        <b> Remove </b>
                    </button>
                    </a>
                    </div>
                </div>
            </div>
        
            <div class="col-12 col-lg-7" >
            <div class="ft-list_content" style="margin-left: -15px;">
                <h3 class="recipe-title"> '. $row['re_name'] .' </h3>
                <h5 class="recipe-title">For '. $row['serving'] .' serving(s)</h5>
                <hr style="border-style: solid; border-color: darkgray;">
                
                <h7 class="description2"><b>'; 
                    $data = explode('<br />',  $row['ingredient']);  

                    foreach ($data as $idx => $d) {
                        //echo '<li>'. $d .'</li>';
                         echo '<input class="chkBox" id="data-'. $idx .'" type="checkbox">';
                         echo '&emsp;<label for="data-'. $idx .'">'. $d .'</label>';
                         echo '<br />';
                    }
            print'</b></h7>
            </div>
        </div>
        </div>
    </div>';
                            }
                        }else{
                echo'<center><img src="img/core-img/no-list.png" width="150px"/></center>';
                echo'<center><h4><i>- No Added Shopping List -</i></h4></center>';
                echo'<center><h5 style="color: darkslategray;"><i>Add recipes ingredients and we will organize the list for you!</i></h5></center>';
                echo'<br/>';
                }
            }
        }
    ?>
    <?php
         if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
        //Define thr query
        $sql = 'SELECT * FROM shopping_list, recipe_blog 
                WHERE shopping_list.rblog_id = recipe_blog.rblog_id 
                AND shopping_list.user_id = '.$_SESSION['user_id'].'';

        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
        
    print'<div class="ft-blog-list"> 
        <div class="row">
            <div class="col-5">
                <div class="img-container2">
                  <img src="img/blog-img/'.$row['rblog_image1'].'"><br/>
                    <div class="wrapper">
                    <a href="deleteList.php?list_id='. $row['list_id'] .'" onclick="return confirm(\'Do you wish to remove the list?\');">
                    <button type="button" class="remove-list-btn">
                        <b> Remove </b>
                    </button>
                    </a>
                    </div>
                </div>
            </div>
        
            <div class="col-7">
            <div class="ft-list_content" style="margin-left: -35px;">
                <h3 class="recipe-title"> '. $row['rblog_name'] .' </h3>
                <h5 class="recipe-title">For '. $row['serving'] .' serving(s)</h5>
                <hr style="border-style: solid; border-color: darkgray;">
                
                <h7 class="description2"><b>'; 
                   $data = explode('<br />',  $row['ingredient']);  

                    foreach ($data as $idx => $d) {
                        //echo '<li>'. $d .'</li>';
                         echo '<input class="chkBox" id="data-'. $idx .'" type="checkbox">';
                         echo '&emsp;<label for="data-'. $idx .'">'. $d .'</label>';
                         echo '<br />';
                    }
            print'</b></h7>
            </div>
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
    
    <script>
        $('.chkBox').each(function () {
            $(this).change(function() {
                if ($(this).prop('checked')) {
                    $(this).next('label').css('text-decoration', 'line-through');
                } else {
                    $(this).next('label').css('text-decoration', 'none');
                }
            });
        });      
    </script>
</body>

</html>
<?php } 
else{ 
        echo '<script>alert("Access Denied. Only for Login Users.")</script>';
    } 
?>