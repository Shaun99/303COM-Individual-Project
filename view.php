<?php 
    $thisPage = "Page"; 
     session_start();
     
    if (empty($_GET['page']))
    $_GET['page'] = 1;
    
    if(isset($_SESSION['uName']) && $_SESSION['uName'] == "Shaun") {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Main View</title>
</head>

<body>
    <?php include'components/nav-bar-admin-login.php';?>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Main View</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
    <div class="filter-container">
        <form action="view.php" method="get">
            <div class="row" >
                <div class="col-lg-1" >
                    <h6 style="float:right;"> Filter by: </h6>
                </div>
                <?php
                 $dbc = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($dbc,"cooking_corner");

                $query_count = 'SELECT COUNT(*) as r_count FROM recipe WHERE difficulty =1';
                $diff_count = mysqli_query($dbc,$query_count);
                $r_count = mysqli_fetch_assoc($diff_count);

                $query_count2 = 'SELECT COUNT(*) as r_count2 FROM recipe WHERE difficulty =2';
                $diff_count2 = mysqli_query($dbc,$query_count2);
                $r_count2 = mysqli_fetch_assoc($diff_count2);

                $query_count3 = 'SELECT COUNT(*) as r_count3 FROM recipe WHERE difficulty =3';
                $diff_count3 = mysqli_query($dbc,$query_count3);
                $r_count3 = mysqli_fetch_assoc($diff_count3);

           print'     <div class="col-lg-4" >
                    <select name="difficulty" id="difficulty">
                        <option value="0"'; if(empty($_GET["difficulty"])){echo "selected disabled";}print'>-- Difficulty --</option>
                        <option value="1"'; if(isset($_GET["difficulty"]) && !isset($_GET['submit2'])){echo $_GET["difficulty"] == 1 ? "selected" : "";}print'>Easy ('.$r_count['r_count'].')</option>
                        <option value="2"'; if(isset($_GET["difficulty"]) && !isset($_GET['submit2'])){echo $_GET["difficulty"] == 2 ? "selected" : "";}print'>Medium ('.$r_count2['r_count2'].')</option>
                        <option value="3"'; if(isset($_GET["difficulty"]) && !isset($_GET['submit2'])){echo $_GET["difficulty"] == 3 ? "selected" : "";}print'>Hard ('.$r_count3['r_count3'].')</option>
                    </select>
                </div>';

                $query_count = 'SELECT COUNT(*) as r_count FROM recipe WHERE dish =1';
                $dish_count = mysqli_query($dbc,$query_count);
                $r_count = mysqli_fetch_assoc($dish_count);

                $query_count2 = 'SELECT COUNT(*) as r_count2 FROM recipe WHERE dish =2';
                $dish_count2 = mysqli_query($dbc,$query_count2);
                $r_count2 = mysqli_fetch_assoc($dish_count2);

                $query_count3 = 'SELECT COUNT(*) as r_count3 FROM recipe WHERE dish =3';
                $dish_count3 = mysqli_query($dbc,$query_count3);
                $r_count3 = mysqli_fetch_assoc($dish_count3);

                $query_count4 = 'SELECT COUNT(*) as r_count4 FROM recipe WHERE dish =4';
                $dish_count4 = mysqli_query($dbc,$query_count4);
                $r_count4 = mysqli_fetch_assoc($dish_count4);

                $query_count5 = 'SELECT COUNT(*) as r_count5 FROM recipe WHERE dish =5';
                $dish_count5 = mysqli_query($dbc,$query_count5);
                $r_count5 = mysqli_fetch_assoc($dish_count5);

                $query_count6 = 'SELECT COUNT(*) as r_count6 FROM recipe WHERE dish =6';
                $dish_count6 = mysqli_query($dbc,$query_count6);
                $r_count6 = mysqli_fetch_assoc($dish_count6);

                $query_count7 = 'SELECT COUNT(*) as r_count7 FROM recipe WHERE dish =7';
                $dish_count7 = mysqli_query($dbc,$query_count7);
                $r_count7 = mysqli_fetch_assoc($dish_count7);

                $query_count8 = 'SELECT COUNT(*) as r_count8 FROM recipe WHERE dish =8';
                $dish_count8 = mysqli_query($dbc,$query_count8);
                $r_count8 = mysqli_fetch_assoc($dish_count8);

                $query_count9 = 'SELECT COUNT(*) as r_count9 FROM recipe WHERE dish =9';
                $dish_count9 = mysqli_query($dbc,$query_count9);
                $r_count9 = mysqli_fetch_assoc($dish_count9);

                $query_count10 = 'SELECT COUNT(*) as r_count10 FROM recipe WHERE dish =10';
                $dish_count10 = mysqli_query($dbc,$query_count10);
                $r_count10 = mysqli_fetch_assoc($dish_count10);

                $query_count11 = 'SELECT COUNT(*) as r_count11 FROM recipe WHERE dish =11';
                $dish_count11 = mysqli_query($dbc,$query_count11);
                $r_count11 = mysqli_fetch_assoc($dish_count11);

                $query_count12 = 'SELECT COUNT(*) as r_count12 FROM recipe WHERE dish =12';
                $dish_count12 = mysqli_query($dbc,$query_count12);
                $r_count12 = mysqli_fetch_assoc($dish_count12);

           print'<div class="col-lg-4" >
                    <select name="dish" id="dish">
                        <option value="0"'; if(empty($_GET["dish"])){echo "selected disabled";}print'>-- All Recipes Categories --</option>
                        <option value="1"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 1 ? "selected" : "";}print'>Vegetarian ('.$r_count['r_count'].')</option>
                        <option value="2"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 2 ? "selected" : "";}print'>Baked Goods ('.$r_count2['r_count2'].')</option>
                        <option value="3"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 3 ? "selected" : "";}print'>BBQ ('.$r_count3['r_count3'].')</option>
                        <option value="4"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 4 ? "selected" : "";}print'>Noodles ('.$r_count4['r_count4'].')</option>
                        <option value="5"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 5 ? "selected" : "";}print'>Rice ('.$r_count5['r_count5'].')</option>
                        <option value="6"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 6 ? "selected" : "";}print'>Seafood ('.$r_count6['r_count6'].')</option>
                        <option value="7"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 7 ? "selected" : "";}print'>Juice ('.$r_count7['r_count7'].')</option>
                        <option value="8"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 8 ? "selected" : "";}print'>Coffee & Tea ('.$r_count8['r_count8'].')</option>
                        <option value="9"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 9 ? "selected" : "";}print'>Non-Coffee ('.$r_count9['r_count9'].')</option>
                        <option value="10"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 10 ? "selected" : "";}print'>Smoothies ('.$r_count10['r_count10'].')</option>
                        <option value="11"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 11 ? "selected" : "";}print'>Cocktails ('.$r_count11['r_count11'].')</option>
                        <option value="12"'; if(isset($_GET["dish"]) && !isset($_GET['submit2'])){echo $_GET["dish"] == 12 ? "selected" : "";}print'>Milkshake ('.$r_count12['r_count12'].')</option>
                    </select>
                </div>';
        ?>

                <div class="col-lg-3" >

                    <button type="submit" name="submit" class="category-btn">
                        <i class="fa fa-caret-right fa-lg"></i>&nbsp;Apply
                    </button>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <button type="button" class=" btn-warning category-btn">
                    <i class="fa fa-power-off"></i>&nbsp;Reset
                    </button>
                    </a>
                </div>
            </div>
        </form>
    </div>
       <?php
        $recipesCount = null;
        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            $sql = 'SELECT COUNT(*) AS `recipes_blog_count` FROM `recipe`';
            if (!empty($_GET['difficulty'])) {
                    $sql .= " WHERE difficulty = '". $_GET['difficulty'] ."'";
                }
                if (!empty($_GET['dish'])) {
                    $tmp = !empty($_GET['difficulty']) ? "AND" : "WHERE";
                    $sql .= " $tmp dish = '". $_GET['dish'] ."'";
                }
            if($r = mysqli_query($conn,$sql)) {
                if(mysqli_num_rows($r) > 0) {
                    if ($row = mysqli_fetch_assoc($r)) {
                        $recipesCount = $row['recipes_blog_count'];
                    }
                }
            }
        }

        define('COUNT_FROM_DB', $recipesCount);
        define('LIMIT', 6);

    ?>
    <?php if (!isset($_GET['submit']) && !isset($_GET['submit2']) && !isset($_GET['submit3'])): ?>
    <br/><br/>
    <center>
        <nav aria-label="Page navigation example">
            <div class="blog-pagination">
            <?php if ($_GET['page'] > 1): ?>
                <li><a href="<?php echo 'view.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
            <?php endif; ?>
            <?php 
            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                echo '&nbsp;<li ><a class="active" href="view.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>';
            } 
            ?>
            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                <li><a href="<?php echo 'view.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
            <?php endif; ?>
            </div>
        </nav>
    </center>
<?php endif; ?>
    <br/>
        <hr style="border-top: 2px solid #ff6e40;">
    <br/>
     <?php
 
      if(isset($_GET['msg'])) {
            echo '<div>';
                echo '<div class="row">';
                    echo '<div class="col-lg-11">';
                        echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px; width:100%">';
                            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="view.php" class="float-right pr-3">Close</a></h7>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<br/>';
        }
       
        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            
        if(isset($_GET['submit'])){

                $sql = 'SELECT * FROM recipe,admin WHERE recipe.admin_id = admin.admin_id';
                
                if (!empty($_GET['difficulty'])) {
                    $sql .= " AND difficulty = '". $_GET['difficulty'] ."'";
                }
                if (!empty($_GET['dish'])) {
                    $sql .= " AND dish = '". $_GET['dish'] ."'";
                }
                $sql.=' LIMIT 6 OFFSET '. ((6 * $_GET['page']) - 6);
               
            //Run the query
            if($r = mysqli_query($conn,$sql)){
                if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
   
                print'<div class="ft-recipe"> 
                        <a href="deleteRecipe.php?recipe_id='. $row['recipe_id'] .'" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">
                        <button type="button" class="close" aria-label="Close">
                            <span class="Close" aria-hidden="true" title="Remove recipe">&times;</span>
                        </button>
                        </a>
                        <img src="img/recipe-img/'.$row['re_image1'].'">
                        <div class="text-block">';
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
                print'</div>
                    <div class="ft-recipe__content">
                    <br/>
                        <h3 class="recipe-title"> '. $row['re_name'] .' </h3>
                        <p> By&nbsp;
                            <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['admin_profile'].'" alt="profile"/>
                            <b> The Cooking Corner Team </b> 
                        </p>
                        <hr style="border-style: solid; border-color: darkgray;">
                        <div class="user-rating"></div>
                        <div class="row">
                            <div class="col-lg-4">
                                <span class="value"> 
                                    <img src="fonts/clock-regular.svg" width="20px">
                                    '. $row['cooking'] .' 
                                </span> 
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
                                    '. $row['serving'] .' 
                                </span>
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
                            <a href="manage.php?id='. $row['recipe_id'] .'">
                                <button class="manage-recipe-btn">
                                     Manage Recipe 
                                </button>
                            </a>
                        </div>
                </div>
        </div>';
                }
            }else{
                    echo'<center><img src="img/core-img/no-results.png" width="170px"/></center>';
                    echo'<center><h3><i>- No Results Found -</i></h3></center>';
                    echo'<center><h6><i>Sorry, we couldnt find any matches you were looking for.</i></h6></center>';
            }
        }
                
        }else if(isset($_GET['submit2'])){
         $include = $_GET['include'];
         $exclude = $_GET['exclude'];
         $sql = " SELECT * FROM recipe,admin WHERE recipe.admin_id = admin.admin_id AND
                ingredient LIKE '%$include%' AND ingredient NOT LIKE '%$exclude%'";
         
        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
  
                print'<div class="ft-recipe"> 
                    <a href="deleteRecipe.php?recipe_id='. $row['recipe_id'] .'" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">
                      <button type="button" class="close" aria-label="Close">
                          <span class="Close" aria-hidden="true" title="Remove recipe">&times;</span>
                      </button>
                      </a>
                     <img src="img/recipe-img/'.$row['re_image1'].'">
                        <div class="text-block">';
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
                print'</div>
                <div class="ft-recipe__content">
                <br/>
                    <h3 class="recipe-title"> '. $row['re_name'] .' </h3>
                        <p> By&nbsp;
                        <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['admin_profile'].'" alt="profile"/>

                        <b> The Cooking Corner Team </b> 
                        </p>
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
                        <a href="manage.php?id='. $row['recipe_id'] .'">
                                <button class="manage-recipe-btn">
                                     Manage Recipe 
                                </button>
                            </a>
                    </div>
                </div>
                </div>';
                }
             }else{
                echo'<center><img src="img/core-img/no-results.png" width="170px"/></center>';
                echo'<center><h3><i>- No Results Found -</i></h3></center>';
                echo'<center><h6><i>Sorry, we couldnt find any matches you were looking for.</i></h6></center>';
            }
            }
        }else if(isset($_GET['submit3'])){
         $search = $_GET['search'];
         $sql = " SELECT * FROM recipe,admin WHERE recipe.admin_id = admin.admin_id AND
                    re_name LIKE '%$search%'";
         
        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
  
                print'<div class="ft-recipe"> 
                    <a href="deleteRecipe.php?recipe_id='. $row['recipe_id'] .'" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">
                      <button type="button" class="close" aria-label="Close">
                          <span class="Close" aria-hidden="true" title="Remove recipe">&times;</span>
                      </button>
                      </a>
                     <img src="img/recipe-img/'.$row['re_image1'].'">
                        <div class="text-block">';
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
                print'</div>
                <div class="ft-recipe__content">
                <br/>
                    <h3 class="recipe-title"> '. $row['re_name'] .' </h3>
                        <p> By&nbsp;
                        <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['admin_profile'].'" alt="profile"/>

                        <b> The Cooking Corner Team </b> 
                        </p>
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
                        <a href="manage.php?id='. $row['recipe_id'] .'">
                                <button class="manage-recipe-btn">
                                     Manage Recipe 
                                </button>
                            </a>
                    </div>
                </div>
                </div>';
                }
             }else{
                echo'<center><img src="img/core-img/no-results.png" width="170px"/></center>';
                echo'<center><h3><i>- No Results Found -</i></h3></center>';
                echo'<center><h6><i>Sorry, we couldnt find any matches you were looking for.</i></h6></center>';
            }
            }
        }
        else{

        //Define thr query WHERE difficulty ='.$_POST['difficulty'].'
        $sql = 'SELECT * FROM recipe, admin WHERE recipe.admin_id = admin.admin_id ORDER BY re_name ASC 
                LIMIT 6 OFFSET '. ((6 * $_GET['page']) - 6);

        //Run the query
        if($r = mysqli_query($conn,$sql)){
             if(mysqli_num_rows($r) > 0) {
                //Retieve and run the record
                while($row = mysqli_fetch_assoc($r)){
        
    print'<div class="ft-recipe"> 
        <a href="deleteRecipe.php?recipe_id='. $row['recipe_id'] .'" onclick="return confirm(\'Are you sure you want to delete this recipe?\');">
        <button type="button" class="close" aria-label="Close">
            <span class="Close" aria-hidden="true" title="Remove recipe">&times;</span>
        </button>
        </a>
      <img src="img/recipe-img/'.$row['re_image1'].'">
            <div class="text-block">';
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
    print'</div>
        
    <div class="ft-recipe__content">
    <br/>
        <h3 class="recipe-title"> '. $row['re_name'] .' </h3>
             <p> By&nbsp;
            <img width="30px" height="30px" style="border-radius: 100px;" src="img/core-img/'.$row['admin_profile'].'" alt="profile"/>
            <b> The Cooking Corner Team </b> 
            </p>
            <hr style="border-style: solid; border-color: darkgray;">
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
            <a href="manage.php?id='. $row['recipe_id'] .'">
                <button class="manage-recipe-btn">
                     Manage Recipe 
                </button>
            </a>
        </div>
    </div>
                            </div>';
                            }
                        }
            }
        }
        }
    ?>
    
     <br/>
        <hr style="border-top: 2px solid #ff6e40;">
    <br/> 
      
    <?php if (!isset($_GET['submit']) && !isset($_GET['submit2']) && !isset($_GET['submit3'])): ?>
    <center>
        <nav aria-label="Page navigation example">
            <div class="blog-pagination">
            <?php if ($_GET['page'] > 1): ?>
                <li><a href="<?php echo 'view.php?page='. ($_GET['page'] - 1); ?>">&laquo; Prev</a></li>
            <?php endif; ?>
            <?php 
            for ($i = 0; $i < COUNT_FROM_DB / LIMIT; $i++) {
                echo '&nbsp;<li ><a class="active" href="view.php?page='. ($i + 1) .'">'. ($i + 1) .'</a></li>';
            } 
            ?>
            <?php if ($_GET['page'] < (COUNT_FROM_DB / LIMIT)): ?>
                <li><a href="<?php echo 'view.php?page='. ($_GET['page'] + 1); ?>">Next &raquo;</a></li>
            <?php endif; ?>
            </div>
        </nav>
    </center>
<?php endif; ?>
    
    <br/><br/>
    
     <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
</body>

</html>
<?php } 
else{ 
        echo '<script>alert("Access Denied. Only for Authorised Admin.")</script>';
    } 
?>