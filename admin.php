<?php 
    $thisPage = "Admin"; 
    
    session_start();

    if(isset($_POST['submit'])){
					
    $conn = mysqli_connect('localhost', 'root', '', 'cooking_corner');
    
  
    
    
    $sql = "SELECT * FROM admin WHERE uname = '". $_POST['uName'] ."' AND pword = '". $_POST['pWord'] ."'";

    if($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0) {
            
            $row = $result->fetch_assoc();

            //Successfully login
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['uName'] = $_POST['uName'];
            $_SESSION['pWord'] = $_POST['pWord'];
            $_SESSION['admin_profile'] = $row['admin_profile'];
            
            //Store username and password if checked "Remember Me"
            if(!empty($_POST["remember"])) {
                setcookie ("uname",$_POST["uName"],time()+ 3600);
                setcookie ("pword",$_POST["pWord"],time()+ 3600); 
            } else {
                setcookie("uname","");
                setcookie("pword","");        
            }

            // Register $UN, $PW and redirect to file "signin.php"
            echo '<link href="style.css" type="text/css" rel="stylesheet">';
            echo '<div class="preloaded-login">';
            echo '<div class="preloaded-container">';
            echo '<br/>';
            echo "<h2>Welcome back, ";
            echo $_SESSION['uName'] = $_POST['uName'];
            echo "</h2>";
            echo "<script>setTimeout(\"location.href = 'view.php'\",2500);</script>";
            echo "<h6 style=\"color:#673405;\">Sign in successful, we will redirect you to admin page...</h6><br>";
            echo '</div>';
            echo '</div>';
            exit();

        }
        else{
        // Print error message
        header('location: admin.php?error=Invalid username or password. Please try again.');
        exit(mysqli_error($conn));
        }
    }        
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Login - Admin</title>

</head>

<body>
    <?php require_once './components/nav-bar-general.php'; ?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">Admin Login</li>
             </ol>
         </div>
     </div>
    
      <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb6.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Admin Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
      <br/>       
        <?php
            if(isset($_GET['error'])) {
                    echo '<div class="bg-danger" style="border-radius: 5px; margin: 0px 50px 0px 50px; padding: 10px 0px;">';
                            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['error'] .' <a href="admin.php" class="float-right pr-3"><i class="fa fa-times fa-2x" aria-hidden="true"></i></a></h7>';
                    echo '</div>';
            }
        ?>
      <br/>
    <div class="admin-login-container bg-overlay2">
     <form name="loginForm" action="admin.php" onsubmit="return validateForm()" method="post">
          
            <div class="login">
            <img src="img/core-img/admin.png"  alt="login" width="100" height="100">
            </div>
            <div class="col-12 paragraph">	 
                <label> <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<strong>Admin ID:</strong></label><br>
                <input type="text" class="form-control" placeholder="Enter Admin ID" name="uName" id="uName" value="<?php if(isset($_COOKIE["uname"])) { echo $_COOKIE["uname"]; } ?>"/>
            </div>	
            <div class="col-12 paragraph">
                <br>
                <label><i class="fa fa-lock"></i>&nbsp;<strong>Password:</strong></label><br>
                <input type="password" class="form-control" placeholder="Enter Password" id="pWord" name="pWord" value="<?php if(isset($_COOKIE["pword"])) { echo $_COOKIE["pword"]; } ?>"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                <br/>
                <div class="password">
                <input type="checkbox" onclick="myFunction()"> Show Password
                </div>
            </div>          
            <br/><br/>
            <div class="login-paragraph">
            <input type="checkbox" checked="checked" name="remember" />
            Remember me 

            </div>
            
        <br>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
              <button type="submit" name="submit" class="admin-login-btn"><b>Login</b></button>  
            </div>
        </div><br>
      
       
        </form>
        <hr style="border: 2px solid brown;">
        <div class="col-lg-12 d-flex justify-content-center">
                 <a href="user.php"><button class="switch-user-btn"><b>Switch to User</b></button> </a> 
            </div>
         </div>
    <br/><br/>
   
    <?php require_once './components/footer.php'; ?>
    <?php require_once './components/js-include-bottom.php'; ?>
   
    <script>
        function validateForm() {
            var x = document.forms["loginForm"]["uName"].value;
            var y = document.forms["loginForm"]["pWord"].value;
            
                if (x == "" && y == "") {
                  alert("Username and Password must be filled out");
                  return false;
                }else if (x == "") {
                  alert("Username must be filled out");
                  return false;
                }else if (y == "") {
                  alert("Password must be filled out");
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

  </script>
</body>

</html>

