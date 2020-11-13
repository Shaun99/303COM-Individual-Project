
<?php 
    $thisPage = "Manage"; 
    session_start();
    
    //Check for submission
    //Handle the form 
    //Connect and select:
    if (isset($_POST['submit'])){

        $dbc = mysqli_connect ('localhost','root','');
        mysqli_select_db($dbc,"cooking_corner");
        $problem = FALSE;
        $target_dir = "recipe/";
        $target_file = $target_dir.basename($_FILES['re_image1']['name']);
        $img = file_get_contents($re_image1);
        $img = file_get_contents($re_image2);
        //Validate the form data
        if (!empty($_POST['recipeName']) && isset($_POST['dish']) && !empty($_POST['preparation']) 
            && !empty($_POST['servings']) && !empty($_POST['cooking']) && isset($_POST['difficulty']) 
            && !empty($_POST['ingredients']) && !empty($_POST['directions']) && !empty($_POST['description']) 
            && !empty($_FILES['re_image1']['name']) && !empty($_FILES['re_image2']['name'])){
                
                $re_name        = ($_POST['recipeName']);
                $dish           = ($_POST['dish']);
                $preparation    = ($_POST['preparation']);
                $serving        = ($_POST['servings']);
                $cooking        = ($_POST['cooking']);
                $difficulty     = ($_POST['difficulty']);
                $ingredient     = nl2br($_POST['ingredients']);
                $direction      = nl2br($_POST['directions']);
                $description    = ($_POST['description']);
                $re_image1      = ($_FILES['re_image1']['name']);
                $re_image2      = ($_FILES['re_image2']['name']);
               
     
        }
        else{  
            header('location: insertRecipe.php?error=Please ensure to fill in all the required textfield.');
                exit();
                $problem = TRUE;
        }

        if(!$problem){
            //Define thr query
            $query = "INSERT INTO recipe(recipe_id, admin_id, re_name, dish, preparation, serving, cooking, difficulty, ingredient, direction, description, re_image1, re_image2) 
                        VALUES ('', '$_SESSION[admin_id]', '$re_name', '$dish', '$preparation', '$serving', '$cooking', '$difficulty', '$ingredient', '$direction', '$description', '$re_image1', '$re_image2')";

            //Execute the query
            if(@mysqli_query($dbc,$query)){
                    header ('location: insertRecipe.php?msg= The website entry has been added! Click <a href="view.php">here</a> to view.');
                    exit();
                
            }
            else{
                    header('location: insertRecipe.php?error=Could not add the entry because:<br/>'.mysqli_error($dbc).'');
                    exit();
            }
        }
        mysqli_close($dbc);
    }//End of form submission
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Insert Recipe</title>
</head>

<body>
   <?php include'components/nav-bar-admin-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>                                  
                 <li class="breadcrumb-item active">Insert Recipe</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Insert Recipe</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
     <br/>
    <?php
        if(isset($_GET['error'])) {
                echo '<div class="bg-danger" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['error'] .' <a href="insertRecipe.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        } elseif(isset($_GET['msg'])) {
                echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="insertRecipe.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        }
    ?>
    <br/>
    
      <form name="recipeForm" action="insertRecipe.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
        <div class="recipe-container">
                <br>
                <div class ="row">
                <div class ="col-6">	  
                    <label><img src="fonts/recipe-book.svg" width="25px">&nbsp;<strong>Recipe Name:</strong></label><br>
                    <input type="text" class="form-control"  placeholder="Enter recipe name" name="recipeName" id="recipeName"/>
                </div>
                <div class="col-6">	    
                    <label><img src="fonts/meal.svg" width="25px">&nbsp;<strong>Dish Type:</strong></label><br>
                    <select name="dish" id="dish">
                        <option selected>Please select</option>
                        <option value="1">Vegetarian</option>
                        <option value="2">Baked Goods</option>
                        <option value="3">BBQ</option>
                        <option value="4">Noodles</option>
                        <option value="5">Rice</option>
                        <option value="6">Seafood</option>
                        <option value="7">Juice</option>
                        <option value="8">Coffee & Tea</option>
                        <option value="9">Non-Coffee</option>
                        <option value="10">Smoothies</option>
                        <option value="11">Cocktails</option>
                        <option value="12">Milkshake</option>
                    </select>
                </div>
                </div>
                <div class ="row">
                <div class="col-6 ">
                    <br>	    
                    <label><img src="fonts/preparation.svg" width="25px">&nbsp;<strong>Preparation Time:</strong></label><br>
                    <input type="text" class="form-control" placeholder="Enter preparation time..." id="preparation" name="preparation"/>         
                </div>
                <br/>
                <div class="col-6 ">
                    <br/>
                    <label><img src="fonts/serve.svg" width="25px">&nbsp;<strong>No. of Servings:</strong></label><br>
                    <input type="number" class="form-control" placeholder="Enter number of servings..." id="servings" name="servings"/>
                <br/>
                </div>
                </div>
                <div class ="row">
                    <div class="col-6">
                        <label><img src="fonts/cooking-time.svg" width="25px">&nbsp;<strong>Cooking Time:</strong></label>
                        <input type="text" class="form-control" placeholder="Enter cooking time..." id="cooking" name="cooking"/>
                    </div>
                    <div class=" col-6">	     
                        <label><img src="fonts/levels.svg" width="25px">&nbsp;<strong>Difficulty:</strong></label><br>
                        <div class="radio-inline">
                            <label><input type="radio" name="difficulty" id="difficulty" value="1">&nbsp; Easy</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="difficulty" id="difficulty" value="2">&nbsp; Medium</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="difficulty" id="difficulty" value="3">&nbsp; Hard</label>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/ingredients.svg" width="25px">&nbsp;<strong>Ingredients:</strong></label><br>
                        <textarea class="form-control" rows="5"  name="ingredients" id="ingredients" placeholder="Enter list of ingredients..."></textarea>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Directions:</strong></label><br>
                        <textarea class="form-control" rows="5" name="directions" id="directions" placeholder="Enter steps of directions..."></textarea>
                    </div>
                </div>
                
                <div class ="row">
                    <div class="col-12">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Description:</strong></label><br>
                        <textarea class="form-control" rows="5" name="description" id="description" placeholder="Enter food description..."></textarea>
                    </div>
                </div>
                 <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 1:</strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="re_image1" name="re_image1">
                             <label class="custom-file-label" for="customFile">Choose recipe file 1</label>
                           </div>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 2:</strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="re_image2" name="re_image2">
                             <label class="custom-file-label" for="customFile">Choose recipe file 2</label>
                           </div>
                    </div>
                </div>
                <br/>
                <hr>
                <br/>
                <div class="wrapper">
                    <button type="submit" name="submit" class="insert-recipe-btn"><b>Submit Recipe</b></button>
                </div>
                <br/>
        </div>
        </form>
    
    <br/>
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
    <script>     
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>
