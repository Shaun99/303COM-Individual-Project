<?php 
    $thisPage = "Manage"; 
    session_start();
    
     //Connect and select
    $dbc = mysqli_connect('localhost','root','');
    mysqli_select_db($dbc, 'cooking_corner');

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
            //Define query
            $query = "SELECT * FROM recipe WHERE recipe_id ='". $_GET['id'] ."'";

            if ($r = mysqli_query($dbc, $query)){ //Run the query
                    $row = mysqli_fetch_array($r); //Retrieve the information
            }
            else{
                    print '<p style ="color:red;">Could not retrieve the website entry because:<br/>'.mysqli_error($dbc);
            }
    }
    elseif (isset($_POST['submit'])){
        
            //Define the query
            $query = "UPDATE recipe SET re_name='{$_POST['recipeName']}', dish='{$_POST['dish']}', 
                      preparation='{$_POST['preparation']}', serving='{$_POST['servings']}',
                      cooking='{$_POST['cooking']}', difficulty='{$_POST['difficulty']}',
                      ingredient='{$_POST['ingredients']}', direction='{$_POST['directions']}',
                      description='{$_POST['description']}', re_image1='{$_FILES['re_image1']['name']}',
                      re_image2='{$_FILES['re_image2']['name']}'
                      WHERE recipe_id='{$_POST['id']}'";

            //Execute the query
            $r = mysqli_query($dbc, $query);

            //Report on the result
            if (mysqli_affected_rows($dbc) ==1){
                    header('location: manage.php?id='. $_POST['id'].'');
                    exit();
            } else {
                    print '<p style="color: red;">Could not edit the website entry because: '. mysqli_error($dbc).
                    '<br/>';
            }
    }
    else {

            print '<p style="color:red;">This page has been accessed in error.</p>';
    }

    mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Edit Recipe</title>
</head>

<body>
   <?php include'components/nav-bar-admin-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>
                      <?php echo '<li class="breadcrumb-item"><a href="manage.php?id='. $_GET['id'].'"> '.$row['re_name'].' </a></li>';?>
                 <li class="breadcrumb-item active">Edit Recipe</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Edit Recipe</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
     <br/><br/>
    
      <form name="recipeEditForm" action="edit.php"  method="post" enctype="multipart/form-data">
        <div class="edit-recipe-container">
                <br>
                <div class ="row">
                <div class ="col-6">	  
                    <label><img src="fonts/recipe-book.svg" width="25px">&nbsp;<strong>Recipe Name:</strong></label><br>
                    <input type="text" class="form-control"  value="<?php echo $row["re_name"] ?>" name="recipeName" id="recipeName"/>
                </div>
                <div class="col-6">	    
                    <label><img src="fonts/meal.svg" width="25px">&nbsp;<strong>Dish Type:</strong></label><br>
                    <select name="dish" id="dish">
                        <option selected>Please select</option>
                        <option value="1" <?php echo $row["dish"] == "1" ? "selected" : "" ?>>Vegetarian</option>
                        <option value="2" <?php echo $row["dish"] == "2" ? "selected" : "" ?>>Baked Goods</option>
                        <option value="3" <?php echo $row["dish"] == "3" ? "selected" : "" ?>>BBQ</option>
                        <option value="4" <?php echo $row["dish"] == "4" ? "selected" : "" ?>>Noodles</option>
                        <option value="5" <?php echo $row["dish"] == "5" ? "selected" : "" ?>>Rice</option>
                        <option value="6" <?php echo $row["dish"] == "6" ? "selected" : "" ?>>Seafood</option>
                        <option value="7" <?php echo $row["dish"] == "7" ? "selected" : "" ?>>Juice</option>
                        <option value="8" <?php echo $row["dish"] == "8" ? "selected" : "" ?>>Coffee & Tea</option>
                        <option value="9" <?php echo $row["dish"] == "9" ? "selected" : "" ?>>Non-Coffee</option>
                        <option value="10" <?php echo $row["dish"] == "10" ? "selected" : "" ?>>Smoothies</option>
                        <option value="11" <?php echo $row["dish"] == "11" ? "selected" : "" ?>>Cocktails</option>
                        <option value="12" <?php echo $row["dish"] == "12" ? "selected" : "" ?>>Milkshake</option>
                    </select>
                </div>
                </div>
                <div class ="row">
                <div class="col-6 ">
                    <br>	    
                    <label><img src="fonts/preparation.svg" width="25px">&nbsp;<strong>Preparation Time:</strong></label><br>
                    <input type="text" class="form-control" value="<?php echo $row["preparation"] ?>" id="preparation" name="preparation"/>         
                </div>
                <br/>
                <div class="col-6 ">
                    <br/>
                    <label><img src="fonts/serve.svg" width="25px">&nbsp;<strong>No. of Servings:</strong></label><br>
                    <input type="number" class="form-control" value="<?php echo $row["serving"] ?>" id="servings" name="servings"/>
                <br/>
                </div>
                </div>
                <div class ="row">
                    <div class="col-6">
                        <label><img src="fonts/cooking-time.svg" width="25px">&nbsp;<strong>Cooking Time</strong></label>
                        <input type="text" class="form-control" value="<?php echo $row["cooking"] ?>" id="cooking" name="cooking"/>
                    </div>
                    <div class=" col-6">	     
                        <label><img src="fonts/levels.svg" width="25px">&nbsp;<strong>Difficulty:</strong></label><br>
                        <div class="radio-inline">
                            <label><input type="radio" name="difficulty" id="difficulty" value="1" <?php echo $row["difficulty"] == "1" ? "checked" : "" ?>>&nbsp; Easy</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="difficulty" id="difficulty" value="2" <?php echo $row["difficulty"] == "2" ? "checked" : "" ?>>&nbsp; Medium</label>
                        </div>
                        <div class="radio-inline">
                            <label><input type="radio" name="difficulty" id="difficulty" value="3" <?php echo $row["difficulty"] == "3" ? "checked" : "" ?>>&nbsp; Hard</label>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/ingredients.svg" width="25px">&nbsp;<strong>Ingredients:</strong></label><br>
                        <textarea class="form-control" rows="5"  name="ingredients" id="ingredients" "><?php echo $row["ingredient"] ?></textarea>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Directions:</strong></label><br>
                        <textarea class="form-control" rows="5" name="directions" id="directions" ><?php echo $row["direction"] ?></textarea>
                    </div>
                </div>
                
                <div class ="row">
                    <div class="col-12">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Description:</strong></label><br>
                        <textarea class="form-control" rows="5" name="description" id="description"><?php echo $row["description"] ?></textarea>
                    </div>
                </div>
                 <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 1:</strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="re_image1" name="re_image1" 
                            value="<?php echo $row['re_image1']['name'] ?>">
                             <label class="custom-file-label" for="customFile"><?php echo $row['re_image1'] ?></label>
                           </div>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 2:</strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="re_image2" name="re_image2" value="<?php echo $row["re_image2"]['name'] ?>">
                             <label class="custom-file-label" for="customFile"><?php echo $row["re_image2"] ?></label>
                           </div>
                    </div>
                </div>
                <hr>
                <br/>
                <div class="wrapper">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                    <button type="submit" name="submit" class="edit-recipe-btn"><b>Update Recipe</b></button>
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


