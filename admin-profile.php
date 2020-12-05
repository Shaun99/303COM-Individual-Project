<?php 
    $thisPage = "Profile"; 
    session_start();
    
    //Connect and select
    $dbc = mysqli_connect('localhost','root','');
    mysqli_select_db($dbc, 'cooking_corner');

    
     if (isset($_POST['submit'])){
        
            //Define the query
            $query = "UPDATE admin SET pword='{$_POST['pWord']}', cpword='{$_POST['cpWord']}' 
                      WHERE admin_id = '{$_SESSION['admin_id']}'";

            //Execute the query
            $r = mysqli_query($dbc, $query);

            //Report on the result
            if (mysqli_affected_rows($dbc) ==1){
                    header ('location: admin-profile.php?msg= Your password has changed successfully!');
                    exit();
                   
            } else {
                    print '<p style="color: red;">Could not edit the website entry because: '. mysqli_error($dbc).
                    '<br/>';
            }
     }
            
            if (isset($_POST['submit2'])){
        
            //Define the query
            $query = "UPDATE admin SET email='{$_POST['NeweMail']}' 
                      WHERE admin_id = '{$_SESSION['admin_id']}'";

            //Execute the query
            $r = mysqli_query($dbc, $query);

            //Report on the result
            if (mysqli_affected_rows($dbc) ==1){
                    header ('location: admin-profile.php?msg2= Your email has changed successfully!');
                    exit();
                   
            } else {
                    print '<p style="color: red;">Could not edit the website entry because: '. mysqli_error($dbc).
                    '<br/>';
            }
            
            
    }
    
    if (isset($_POST['submit3'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES['admin_profile']['name']);
        $profile = ($_FILES['admin_profile']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // $img = file_get_contents($profile);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["admin_profile"]["tmp_name"]);
        
       
        if ($check !== false) { 
            $uploadOk = 1; 
            
        } 
        else { 
            $uploadOk = 0; 
            echo '<script>alert("File is not an image.")</script>';
        }
        
        // Check if file already exists
        if (file_exists($target_file)) { 
            echo '<script>alert("Sorry, file already exists.")</script>';
            $uploadOk = 0; 
            
        }
        
        // Check file size
        if ($_FILES["admin_profile"]["size"] > 500000) { 
            echo '<script>alert("Sorry, your file is too large.")</script>';
            $uploadOk = 0; 
            
        }
        
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<script>alert("Sorry, your file was not uploaded.")</script>';
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["admin_profile"]["tmp_name"], $target_file)) {
                 $query = "UPDATE admin SET admin_profile='$profile' WHERE admin_id= '{$_SESSION['admin_id']}'";

                if (mysqli_query($dbc, $query)) {
                    $_SESSION['admin_profile'] = $profile;
                    echo '<script>alert("Your Profile for ' . htmlspecialchars(basename($_FILES["admin_profile"]["name"])) . ' has been uploaded.")</script>';
                    $value = true;
                }
            } else {
                echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
            }
        }
    }

mysqli_close($dbc);

if(isset($_SESSION['uName']) && $_SESSION['uName'] == "Shaun") {
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Admin Profile</title>
</head>

<body>
   <?php include'components/nav-bar-admin-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>                                  
                 <li class="breadcrumb-item active">Admin Profile</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Admin Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
    <?php
    if(isset($_GET['msg'])) {
        echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px 0px 50px;">';
            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="admin-profile.php" class="float-right pr-3" style="color:white;">Close</a></h7>';
        echo '</div>';
    }elseif (isset($_GET['msg2'])) {
        echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px 0px 50px;">';
            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg2'] .' <a href="admin-profile.php" class="float-right pr-3" style="color:white;">Close</a></h7>';
        echo '</div>';
    }
    ?>
   <br/>
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                <center>
                <div class="row">
                     <div class="col-10">
                    <?php echo '<img src="img/core-img/'.$_SESSION['admin_profile'].'" style="width:210px; height:210px; border-radius: 200px; border-style:solid;">'; ?>
                     </div>
                     <div class="col-2">
                    <button class="edit-profile-picture" >
                    <i class="fa fa-pencil fa-lg" data-toggle="modal" data-target="#profile"></i> 
                    </button>
                     </div>
                </div>
                 <div class="row">
                     <div class="col-lg-10">
                <h1><?php echo $_SESSION['uName'] ?></h1>
                <?php 
                    print '
                    <a href="deleteAccount.php?user_id='. $_SESSION['admin_id'] .'" 
                    onclick="return confirm(\'Are you sure you want to delete this account?\');">
                    <button class="btn btn-danger"><b>Delete Account</b></button>
                    </a>'
                ?>
                </div>
                </div>     
                </center>        
            </div>
            <div class="col-md-9">
                <?php
                    //Connect and select:
                    $dbc = mysqli_connect('localhost', 'root', '');
                    mysqli_select_db($dbc,"cooking_corner");

                    //Define thr query
                    $query = 'SELECT * FROM admin WHERE admin_id = '.$_SESSION['admin_id'].';';

                    //Run the query
                    if($r = mysqli_query($dbc,$query)){

                        //Retieve and run the record
                        while($row = mysqli_fetch_array($r)){
                        print  '  <div class="col-md-12">
                        <table class="table table-bordered table-dark">
                            <tbody>
                                <tr>
                                    <th><h5>Admin ID</h5></th>
                                    <td class=""><h5> '. $row['admin_id'] .' <h5></td>
                                </tr>
                                <tr>
                                    <th><h5>Email</h5></th>
                                    <td class="">
                                    <h5>  
                                        '. $row['email'] .'                         
                                            <button class="edit-profile" title="Edit Email" data-toggle="modal" data-target="#email">
                                                <b>
                                                    Edit <i class="fa fa-pencil"></i>
                                                </b>
                                            </button>                                     
                                    <h5>        
                                    </td>
                                </tr>
                                 <tr>
                                    <th><h5>Password</h5></th>
                                    <td class="">
                                    <h5>  
                                        '. $row['pword'] .' 
                                            <button class="edit-profile" title="Change Password" data-toggle="modal" data-target="#password">
                                                <b>
                                                    Edit <i class="fa fa-pencil"></i>
                                                </b>
                                            </button>     
                                     <h5>        
                                    </td>
                                </tr>
                                <tr>
                                    <th><h5>Birthday</h5></th>
                                    <td class=""><h5> '. $row['date'] .'  <h5></td>
                                </tr>
                                 <tr>
                                    <th><h5>Phone</h5></th>
                                    <td class=""><h5>  '. $row['phone'] .'  <h5> </td>
                                </tr>
                            </tbody>
                        </table>
                        <h7 style="float:right;"> Account created on <b>'. $row['created_at'] .' </b> </h7>
                    </div> 
                    <br/><br/>';
                        }
                    }
                    mysqli_close($dbc);
            ?>  
            </div>
        </div> 
    </div>
    <form name="profilePasswordForm" action="admin-profile.php" onsubmit="return validatePasswordForm()" method="post">
    <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
           <div class="modal-content">
                   <div class="modal-header2">
                           <h5 class="modal-title2 "id="myModalLabel">&emsp;<i class="fa fa-lock"></i> Change Password</h5>
                   </div>
                   <div class="modal-body2">
                       <div class="col-12">
                            <label></i>&nbsp;<strong>Current Password: <?php echo $_SESSION['pWord'] ?></strong></label>
                            
                       </div>                    
                       <div class="col-12">
                            <label></i>&nbsp;<strong>New Password:</strong></label><br>
                            <input type="password" class="form-control" placeholder="Enter New Password" id="pWord" name="pWord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/> <br>
                            <div class="password">
                                <input type="checkbox" onclick="myFunction()"> Show Password
                            </div>
                       </div>
                        <br/>
                        <div class="col-12">	     
                            <label></i>&nbsp;<strong>Confirm New Password:</strong></label><br>
                            <input type="password" class="form-control" placeholder="Enter Confirm New Password" id="cpWord" name="cpWord"/>
                            <div class="password">
                            <br/>
                            <input type="checkbox" onclick="myFunction2()"> Show Confirm Password
                            </div>
                        </div>                     
                        <br/><br/>
                        <hr>
                        <div class="wrapper">
                            <button type="submit" name="submit" class="save-btn btn-primary" >Save Changes</button>
                        </div>
                   </div>    
           </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div>
     </form>
   
    <form name="profileEmailForm" action="admin-profile.php" onsubmit="return validateEmailForm()" method="post">
    <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header2">
                        <h5 class="modal-title2 "id="myModalLabel">&emsp;<i class="fa fa-envelope"></i> Edit Email</h5>
                </div>
                <div class="modal-body2">
                    <div class="col-12">
                         <label></i>&nbsp;<strong>Current Email: </strong></label><br>
                         <input type="text"  class="form-control" placeholder="Enter Current Email Address..." name="eMail" id="eMail"
                         pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Exp: characters@characters.domain"/>
                    </div>  
                    <br/>
                    <div class="col-12">
                         <label></i>&nbsp;<strong>New Email Address:</strong></label><br>
                         <input type="text"  class="form-control" placeholder="Enter New Email Address..." name="NeweMail" id="NeweMail"
                         pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Exp: characters@characters.domain"/>
                    </div>           
                     <br/>
                     <hr>
                     <div class="wrapper">
                         <button type="submit" name="submit2" class="save-btn btn-primary" >Save Changes</button>
                     </div>
                </div>    
           </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div>
     </form>
   
     <form name="profilePictureForm" action="admin-profile.php" onsubmit="return validateProfileForm()" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header2">
                        <h5 class="modal-title2 "id="myModalLabel">&emsp;<i class="fa fa-user-circle"></i> Change Profile Picture</h5>
                </div>
                <div class="modal-body2">
                    <br/>
                    <div class="row" style="padding: 0px 20px;">
                        <div class="col-4">
                      <?php echo '<img src="img/core-img/'.$_SESSION['admin_profile'].'" style="width:210px; height:210px; border-radius: 200px; border-style:solid;">'; ?>
                     </div>
                         <div class="col-8">
                         <label></i>&nbsp;<strong>Select Profile: </strong></label><br>
                         <div class="custom-file mb-3">
                           <input type="file" class="custom-file-input" id="admin_profile" name="admin_profile">
                             <label class="custom-file-label" for="customFile">Choose profile</label>
                             <p style="color: darkslategrey;"><i>*JPG, JPEG, PNG & GIF files only</i></p>
                     </div>
                         </div>
                     <br/>
                     </div>
                     <hr>
                     <div class="wrapper">
                         <button type="submit" name="submit3" class="save-btn btn-primary" >Upload Profile</button>
                     </div>
                </div>    
           </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div>
     </form>
   
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
    <script>
    function validateProfileForm(){
         var e = document.forms["profilePictureForm"]["admin_profile"].value;
         
         if (e == "") {
            alert("Please choose a profile photo to upload");
            return false;
        }
    }
    
    function validateEmailForm() {
    
        var c = document.forms["profileEmailForm"]["eMail"].value;
        var d = document.forms["profileEmailForm"]["NeweMail"].value;
        
        if (c == "" && d == "") {
            alert("All fields must be filled out");
            return false;
        }else if (c == d) {
            alert("Your new email must not be the same as your existing email");
            return false;
        }else if (c == "") {
            alert("Current email must be filled out");
            return false;
        }else if (d == "") {
            alert("New email must be filled out");
            return false;
        }   
    }
        
    function validatePasswordForm() {

        var a = document.forms["profilePasswordForm"]["pWord"].value;
        var b = document.forms["profilePasswordForm"]["cpWord"].value;
       
        if (a == "" && b == "") {
            alert("All fields must be filled out");
            return false;
        }else if (a != b) {
            alert("Your new password does not match with your confirm new password");
            return false;
        }else if (a == "") {
            alert("New Password must be filled out");
            return false;
        }else if (b == "") {
            alert("Confirm New Password must be filled out");
            return false;
        }

    }
      function myFunction() {
            var x = document.getElementById("pWord");
            
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
        
        function myFunction2() {
            var y = document.getElementById("cpWord");
           
            if (y.type === "password") {
              y.type = "text";
            } else {
              y.type = "password";
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
        echo '<script>alert("Access Denied. Only for Authorised Admin.")</script>';
    } 
?>
