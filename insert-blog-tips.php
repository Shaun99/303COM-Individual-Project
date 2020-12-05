<?php 
    $thisPage = "BPost"; 
    session_start();
    
    //Check for submission
    //Handle the form 
    //Connect and select:
    if (isset($_POST['submit'])){

        $dbc = mysqli_connect ('localhost','root','');
        mysqli_select_db($dbc,"cooking_corner");
        $problem = FALSE;
        $target_dir = "recipe/";
        $target_file = $target_dir.basename($_FILES['rblog_image1']['name']);
        $img = file_get_contents($rblog_image1);
        $img = file_get_contents($rblog_image2);
                
        $rblog_name     = ($_POST['rblogName']);
        $name           = ($_POST['uname']);
        $cat            = ($_POST['cat']);
        $email          = ($_POST['email']);
        $description1   = ($_POST['description1']);
        $description2   = ($_POST['description2']);
        $rblog_image1   = ($_FILES['rblog_image1']['name']);
        $rblog_image2   = ($_FILES['rblog_image2']['name']);
      
        if(!$problem){
            //Define thr query
            $query = "INSERT INTO tips_blog(tblog_id, user_id, rblog_name, cat, name, email, desp1, desp2, rblog_image1, rblog_image2) 
                        VALUES ('', '$_SESSION[user_id]', '$rblog_name', '$cat','$name', '$email', '$description1', '$description2', '$rblog_image1', '$rblog_image2')";

            //Execute the query
            if(@mysqli_query($dbc,$query)){
                    header ('location: insert-blog-tips.php?msg= The website entry has been added! Click <a href="blog-post-tips.php">here</a> to view.');
                    exit();
                
            }
            else{
                    header('location: insert-blog-tips.php?error=Could not add the entry because:<br/>'.mysqli_error($dbc).'');
                    exit();
            }
        }
        mysqli_close($dbc);
    }//End of form submission
    
    if(isset($_SESSION['uName'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Insert Blog Tips & Advices</title>
</head>

<body>
   <?php include'components/nav-bar-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">                                          
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                <li class="breadcrumb-item"><a href="myblog.php">My Blog</a></li>
                <li class="breadcrumb-item active">Insert Blog Tips & Advices</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Insert Blog Tips & Advices</h2>
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
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['error'] .' <a href="insert-blog-tips.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        } elseif(isset($_GET['msg'])) {
                echo '<div class="bg-success" style="border-radius: 5px; padding:4px 2px 0px 2px; margin: 0px 50px 0px 50px;">';
                        echo '<p class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="insert-blog-tips.php" class="float-right pr-3">Close</a></p>';
                echo '</div>';
        }
    ?>
    <br/>
    
    
    <form name="tipsblogForm" action="insert-blog-tips.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
        <div class="blog-tips-container">
            <div class="insert-blog-tips-container">
                <div class="insert-blog-tips-header">
                Submit your blog to The Cooking Corner!
                </div>
                Cooking Corner is looking for food bloggers and wants to share YOUR helpful tips & advices on the website! <br/>
                Got an expert advice on food tips you would like to share? A new cooking tips you came up with?
            </div>
                <br/>
                <center><b><div style="font-size:20px;"> - Blog Details - </div></b></center>
                <hr class="blog">
                <br/>
                <div class ="row">
                <div class ="col-6">	  
                    <label><img src="fonts/recipe-book.svg" width="25px">&nbsp;<strong>Blog Title <div class="red-dot">*</div></strong></label><br>
                    <input type="text" class="form-control"  placeholder="Enter blog title..." name="rblogName" id="rblogName"/>
                </div>
                <div class ="col-6">	  
               <label><img src="fonts/meal.svg" width="25px">&nbsp;<strong>Blog Category <div class="red-dot">*</div></strong></label><br>
                    <select name="cat" id="cat">
                        <option selected>Please select</option>
                        <option value="1">Restaurants</option>
                        <option value="2">Food & Drinks</option>
                        <option value="3">Vegans</option>
                        <option value="4">Events & Lifestyle</option>
                        <option value="5">Uncategorized</option>
                    </select>
                </div>
                </div>
                <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Description 1 <div class="red-dot">*</div></strong></label><br>
                        <textarea class="form-control" rows="10" name="description1" id="description1" placeholder="Enter blog description..."></textarea>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Description 2</strong></label><br>
                        <textarea class="form-control" rows="10" name="description2" id="description2" placeholder="Enter blog description..."></textarea>
                    </div>
                </div>
                 <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 1 <div class="red-dot">*</div></strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="rblog_image1" name="rblog_image1">
                             <label class="custom-file-label" for="customFile">Choose blog image file 1</label>
                             <p style="color: #f5f0e1;"><i>*PNG or JPEG, max 10MB</i></p>
                           </div>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 2 </strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="rblog_image2" name="rblog_image2">
                             <label class="custom-file-label" for="customFile">Choose blog image file 2</label>
                             <p style="color: #f5f0e1;"><i>*PNG or JPEG, max 10MB</i></p>
                           </div>
                    </div>
                </div>
                <br/>
                <hr class="blog">
                <center><b><div style="font-size:20px;"> - Blog Credit - </div></b></center><br/>
                 <div class ="row">
                    <div class="col-6">
                        <label><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<strong>Name <div class="red-dot">*</div></strong></label><br>
                        <input type="text" class="form-control"  placeholder="Enter your name" name="uname" id="uname"/>
                        <p style="color: #f5f0e1;"><i>*Your name will not be able to changed once submitted</i></p>
                    </div>
                    <div class="col-6">
                        <label><i class="fa fa-envelope"></i>&nbsp;<strong>Email <div class="red-dot">*</div></strong></label><br>
                        <input type="email"  class="form-control" placeholder="Enter your email" name="email" id="email"
                              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Exp: characters@characters.domain"/>
                        <p style="color: #f5f0e1;"><i>*Your name will not be able to changed once submitted</i></p>
                        <span></span>
                    </div>
                </div>
                <br/>
                <hr>
                <br/>
                <div class="wrapper">
                    <button type="submit" name="submit" class="insert-blog-tips-btn"><b>Submit Your Blog</b></button>
                </div>
                <br/>
        </div>
        </form>
    
    <br/>
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
    <script> 
        function validateForm() {

           var a = document.forms["tipsblogForm"]["rblogName"].value;
           var b = document.forms["tipsblogForm"]["description1"].value;
           var c = document.forms["tipsblogForm"]["rblog_image1"].value;
           var d = document.forms["tipsblogForm"]["uname"].value;
           var e = document.forms["tipsblogForm"]["email"].value;

               if (a == "" && b == "" && c == "" && d == "" && e == "") {
                 alert("All fields must be filled out");
                 return false;
               }else if (a == "") {
                 alert("Blog title must be filled out");
                 return false;
               }else if (b == "") {
                 alert("At least One description must be filled out");
                 return false;
               }else if (c == "") {
                 alert("At least One image must be attached");
                 return false;
               }else if (d == "") {
                 alert("Name must be filled out");
                 return false;
               }else if (e == "") {
                 alert("Email must be filled out");
                 return false;
               }
        }
    
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>
<?php } 
else{ 
        echo '<script>alert("Access Denied. Only for Login Users.")</script>';
    } 
?>
