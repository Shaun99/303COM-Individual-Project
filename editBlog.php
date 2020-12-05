<?php 
    $thisPage = "Profile"; 
    session_start();
    
     //Connect and select
    $dbc = mysqli_connect('localhost','root','');
    mysqli_select_db($dbc, 'cooking_corner');

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
            //Define query
            $query = "SELECT * FROM tips_blog WHERE tblog_id ='". $_GET['id'] ."'";

            if ($r = mysqli_query($dbc, $query)){ //Run the query
                    $row = mysqli_fetch_array($r); //Retrieve the information
            }
            else{
                    print '<p style ="color:red;">Could not retrieve the website entry because:<br/>'.mysqli_error($dbc);
            }
    }
    elseif (isset($_POST['submit'])){
        
            //Define the query
            $query = "UPDATE tips_blog SET rblog_name='{$_POST['rblogName']}', desp1='{$_POST['description1']}', 
                      desp2='{$_POST['description2']}', rblog_image1='{$_FILES['rblog_image1']['name']}',
                      rblog_image2='{$_FILES['rblog_image2']['name']}'
                      WHERE tblog_id='{$_POST['id']}'";

            //Execute the query
            $r = mysqli_query($dbc, $query);

            //Report on the result
            if (mysqli_affected_rows($dbc) ==1){
                    header('location: manage-tips-blog.php?id='. $_POST['id'].'');
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
    
     if(isset($_SESSION['uName'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Edit Blog</title>
</head>

<body>
   <?php include'components/nav-bar-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                <li class="breadcrumb-item"><a href="myblog.php">My Blog</a></li>   
                <?php echo'<li class="breadcrumb-item"><a href="manage-tips-blog.php?id='. $_GET['id'].'"> '.$row['rblog_name'].'</a> </li>';?>
                <li class="breadcrumb-item active">Edit Blog</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Edit Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
     <br/><br/>
    
    <form name="recipeEditForm" action="editBlog.php"  method="post" enctype="multipart/form-data">
        <div class="edit-blog-tips-container">
           
                <center><b><div style="font-size:20px;"> - Edit Blog Details - </div></b></center>
                <hr class="blog">
                <br/>
                <div class ="row">
                <div class ="col-12">	  
                    <label><img src="fonts/recipe-book.svg" width="25px">&nbsp;<strong>Blog Title <div class="red-dot">*</div></strong></label><br>
                    <input type="text" class="form-control"  value="<?php echo $row["rblog_name"] ?>" name="rblogName" id="rblogName"/>
                </div>
              
                </div>
                <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Description 1 <div class="red-dot">*</div></strong></label><br>
                        <textarea class="form-control" rows="10" name="description1" id="description1"><?php echo $row["desp1"] ?></textarea>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/coffee-preparation.svg" width="25px">&nbsp;<strong>Description 2</strong></label><br>
                        <textarea class="form-control" rows="10" name="description2" id="description2"><?php echo $row["desp2"] ?></textarea>
                    </div>
                </div>
                 <div class ="row">
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 1 <div class="red-dot">*</div></strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="rblog_image1" name="rblog_image1">
                             <label class="custom-file-label" for="customFile"><?php echo $row["rblog_image1"] ?></label>
                             <p style="color: #f5f0e1;"><i>*PNG or JPEG, max 10MB</i></p>
                           </div>
                    </div>
                    <div class="col-6">
                        <br/>
                        <label><img src="fonts/image-file.svg" width="25px">&nbsp;<strong>Image 2 </strong></label><br>
                           <div class="custom-file mb-3">
                             <input type="file" class="custom-file-input" id="rblog_image2" name="rblog_image2">
                             <label class="custom-file-label" for="customFile"><?php echo $row["rblog_image2"] ?></label>
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
                        <input class="form-control"  value="<?php echo $row["name"] ?>" name="uname" id="uname" readonly/>
                        <p style="color: #f5f0e1;"><i>*Your name will not be able to changed once submitted</i></p>
                    </div>
                    <div class="col-6">
                        <label><i class="fa fa-envelope"></i>&nbsp;<strong>Email <div class="red-dot">*</div></strong></label><br>
                        <input  class="form-control" value="<?php echo $row["email"] ?>" name="email" id="email" readonly/>
                        <p style="color: #f5f0e1;"><i>*Your email will not be able to changed once submitted</i></p>
                        <span></span>
                    </div>
                </div>
                <br/>
                <hr>
                <br/>
                <div class="wrapper">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                    <button type="submit" name="submit" class="edit-blog-tips-btn"><b>Update Your Blog</b></button>
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
<?php } 
else{ 
        echo '<script>alert("Access Denied. Only for Login Users.")</script>';
    } 
?>
