<?php 
    $thisPage = "Register"; 
      session_start();
	
    // Check for submission
	if(isset($_POST['submit1'])){
            function post_captcha($user_response) {
                $fields_string = '';
                $fields = array(
                    'secret' => '6LeYuuAZAAAAAGrtJwAvO4Wb5aJJ4x8hl5-SkCbI',
                    'response' => $user_response
                );
                foreach($fields as $key=>$value)
                $fields_string .= $key . '=' . $value . '&';
                $fields_string = rtrim($fields_string, '&');

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
                curl_setopt($ch, CURLOPT_POST, count($fields));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

                $result = curl_exec($ch);
                curl_close($ch);

                return json_decode($result, true);
            }
            
            //Modify
            $date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

            $sql1 = "SELECT *
                            FROM user
                            WHERE uname='". $_POST['uName'] ."';";

            $conn = NULL;
            $error = false;

            if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                    if($result = mysqli_query($conn, $sql1)) {
                            if(mysqli_num_rows($result) > 0) {
                                    $error = true;
                            }
                    }
            }

            if($error) {
 
                //Username exist
                echo '<script>alert("Username already existed!")</script>';
                header('refresh:0.1; url=register.php');
                exit();					

            } else {

                // Store user credentials details
                $sql1 = "INSERT INTO user 
                        (uname, email, pword, date, phone, gender) VALUES
                        ('". $_POST['uName'] ."', '". $_POST['eMail'] ."', '". $_POST['pWord'] ."', '". $date."', 
                         '". $_POST['phoneNum'] ."', '". $_POST['gender'] ."');
                        ";

                if(mysqli_query($conn, $sql1)) {
                        
                        $sql2 = "INSERT INTO login_details 
                        (user_id, last_activity) VALUES
                        (LAST_INSERT_ID(), NOW());
                        ";
                        
                        if(mysqli_query($conn, $sql2)) {
  
                            //Successfully registered
                            echo '<script>alert("New user account created successfully!")</script>';
                            header('refresh:0.1; url=user.php');
                            exit();
                        }
                }
            }
	}
        
        if(isset($_POST['submit2'])){

            //Modify
            $date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

            $sql2 = "SELECT *
                            FROM admin
                            WHERE uname='". $_POST['uName'] ."';";

            $conn = NULL;
            $error = false;

            if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
                    if($result = mysqli_query($conn, $sql2)) {
                            if(mysqli_num_rows($result) > 0) {
                                    $error = true;
                            }
                    }
            }

            if($error) {
                //Username exist
                echo '<script>alert("Username already existed!")</script>';
                header('refresh:0.1; url=register.php');
                exit();					

            } else {
                // Store user credentials details
                $sql2 = "INSERT INTO admin 
                        (uname, email, pword, cpword, date, phone) VALUES
                        ('". $_POST['uName'] ."', '". $_POST['eMail'] ."', '". $_POST['pWord'] ."', '". $_POST['cpWord'] ."', '". $date."', 
                         '". $_POST['phoneNum'] ."');
                        ";

                if(mysqli_query($conn, $sql2)) {
                        //Successfully registered
                        echo '<script>alert("New admin account created successfully!")</script>';
                        header('refresh:0.1; url=admin.php');
                        exit();
                }
            }
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Register</title>
 
    <style>
        ul.list {
            overflow-y: scroll !important; 
            height: 250px !important;
        }
    </style>
</head>

<body>
   <?php require_once './components/nav-bar-general.php'; ?>
    
      <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php">Home</a></li>                                  
                 <li class="breadcrumb-item active">Register</li>
             </ol>
         </div>
     </div>
    
      <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    
    <br/><br/>
        <form name="registerForm" action="register.php"  onsubmit="return validateForm()" method="post">
        <div class="register-container bg-overlay2">
                <br>
                <div class="col-12 paragraph">	  
                    <label><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<strong>Username:</strong></label><br>
                    <input type="text" class="form-control"  placeholder="Enter Name" name="uName" id="uName"/>
                </div>
                <div class="col-12 paragraph">
	            <br>	    
                    <label><i class="fa fa-envelope"></i>&nbsp;<strong>Email:</strong></label><br>
                    <input type="text"  class="form-control" placeholder="Enter Email" name="eMail" id="eMail"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Exp: characters@characters.domain"/>
                </div>
                <div id="message2">
                    <h5>Email must contain the following:</h5>
                    <p id="symbol" class="invalid"> An <b>at (@)</b> sign</p>
                    <p id="dot" class="invalid">Minimum 1 <b>dot (.)</b> or more</p>
                </div>
                <div class="col-12 paragraph">
                    <br>	    
                    <label><i class="fa fa-lock"></i>&nbsp;<strong>Password:</strong></label><br>
                    <input type="password" class="form-control" placeholder="Enter Password" id="pWord" name="pWord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/> <br>
                <div class="password">
                    <input type="checkbox" onclick="myFunction()"> Show Password
                </div>
                </div><br>
                <div id="message">
                    <h5>Password must contain the following:</h5>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>
                <br/>
                <div class="col-12 paragraph">	     
                    <label><i class="fa fa-key"></i>&nbsp;<strong>Confirm Password:</strong></label><br>
                    <input type="password" class="form-control" placeholder="Enter Confirm Password" id="cpWord" name="cpWord"/>
                    <div class="password">
                    <br/>
                    <input type="checkbox" onclick="myFunction2()"> Show Confirm Password
                    </div>
                    <br/><br/>
                </div>
                <div class="col-12 paragraph">
                    <label><i class="fa fa-birthday-cake"></i>&nbsp;<strong>Birthday:</strong></label>
                </div>
                     <div class=" col-3 birthday">
                        <select name = "day" id="day" >
	                <option value = "0">Day</option>
                        <?php  
                            //Generate number of days 
                            for ($d=1; $d<=31; $d++){
                            echo "<option value=\"$d\">$d</option>\n";
                            }
                        ?>
	                </select>
                    </div>
                    <div class=" col-3 birthday">
	                <select name = "month" id="month">
	                <option value = "0">Month</option>
                        <?php  
                            //Generate number of months
                            for ($m=1; $m<=12; $m++){
                            echo "<option value=\"$m\">$m</option>\n";
                            }
                        ?>
	                </select>
                    </div>
                    <div class=" col-3 birthday">
                        <select name = "year" id="year">
	                <option value = "0">Year</option>
                        <?php  
                            //Generate number of years
                            for ($y=2020; $y>=1920; $y--){
                            echo "<option value=\"$y\">$y</option>\n";
                            }
                        ?>
	                </select>   
                    </div>
                <div class="row">
                <div class=" col-7 paragraph">
	            <br>	     
                    <label><i class="fa fa-phone"></i>&nbsp;<strong>Tel. Number:</strong></label><br>
                    <input type="text"  class="form-control" placeholder="Enter Telephone Number" name="phoneNum" id="phoneNum"/>
                </div>
                <div class=" col-5 paragraph">
	            <br/>     
                    <label style="padding-bottom: 10px;"><i class="fa fa-venus-mars fa-lg"></i>&nbsp;<strong>Gender:</strong></label><br/> 
                     <div class="radio-inline">
                        <label style="font-size: 20px;"><input type="radio" name="gender" id="gender" value="1">&nbsp; Male</label>
                    </div>
                    <div class="radio-inline">
                        <label style="font-size: 20px;"><input type="radio" name="gender" id="gender" value="2">&nbsp; Female</label>
                    </div>
                </div>
                </div>
                <div class=" col-12 paragraph">
		    <br>	   
               
                    By creating an account you are agree to our <a href="#" class="text-info" data-toggle="modal" data-target="#t_and_c_m"><b>terms &amp; conditions</b></a> including our Cookie Use.
                    <br><br>
                </div>
                <div class=" col-12 paragraph">
                    <div class="g-recaptcha" data-sitekey="6LeYuuAZAAAAAAf2zZhsZTdGnj0brLaffwSXnsa8"></div>
                </div>
                <br/>
                <div class="row">
                <div class="col-lg-6 d-flex justify-content-center">
                <button type="submit" name="submit1" class="user-register-btn"><b>Register as User</b></button>
                 </div>
                    
                 <div class="col-lg-6 d-flex justify-content-center">
                <button type="submit" class="admin-register-btn" name="submit2"><b>Register as Admin</b></button>
                 </div>
                </div><br>
            <div class="signin">
                <p style="color:black; font-size: 16px;">Already have an account? <a href="user.php" class="text-danger"><i>Sign In</i></a></p>
            </div>
        </div>
        </form>
    
        <br/><br/>

        <div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
			</div>
			<div class="modal-body">
			<h6><strong>CONDITIONS OF USE</strong></h6>
			<p class="modal-text">Welcome to our online cooking recipes website! The Cooking Corner and its associates provide their services to you subject to the following conditions. 
			   If you visit or shop within this website, you accept these conditions. Please read them carefully. </p>
			<h6><strong>PRIVACY</strong></h6>
			<p class="modal-text"> Please review our Privacy Notice, which also governs your visit to our website, to understand our practices. </p>
			<h6><strong>COPYRIGHT</strong></h6>
			<p class="modal-text">All content included on this site, such as text, graphics, logos, button icons, images, data compilations, and software, 
			   is the property of The Cooking Corner or its content suppliers and protected by international copyright laws. The 
			   compilation of all content on this site is the exclusive property of The Cooking Corner, with copyright authorship for 
			   this collection by The Cooking Corner, and protected by international copyright laws.</p>
			<h6><strong>SITE POLICIES, MODIFICATION, AND SEVERABILITY</strong></h6>
			<p class="modal-text">Please review our other policies posted on this site. These policies also govern your
   			   visit to The Cooking Corner. We reserve the right to make changes to our site, policies, and these Conditions of Use at 
			   any time. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall 
			   be deemed severable and shall not affect the validity and enforceability of any remaining condition.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal" onclick="agree();">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div>
    
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        var agreed = false;
	
	function agree() {
		agreed = true;
	}
        
        //Get the button
        var mybutton = document.getElementById("myBtn");

        function validateForm() {
     
            var a = document.forms["registerForm"]["uName"].value;
            var b = document.forms["registerForm"]["eMail"].value;
            var c = document.forms["registerForm"]["pWord"].value;
            var d = document.forms["registerForm"]["cpWord"].value;
            var e = document.getElementById("day");
            var strDay = e.options[e.selectedIndex].value;
            var f = document.getElementById("month");
            var strMonth = f.options[f.selectedIndex].value;
            var g = document.getElementById("year");  
            var strYear = g.options[g.selectedIndex].value;
            var h = document.forms["registerForm"]["phoneNum"].value;
            var i = document.forms["registerForm"]["gender"].value;
            
                if (a == "" && b == "" && c == "" && d == "" && strDay=="0" && strMonth=="0" && strYear=="0" 
                    && h == "" && i == "") {
                  alert("All fields must be filled out");
                  return false;
                }else if (a == "") {
                  alert("Username must be filled out");
                  return false;
                }else if (b == "") {
                  alert("Email must be filled out");
                  return false;
                }else if (c == "") {
                  alert("Password must be filled out");
                  return false;
                }else if (d == "") {
                  alert("Confirm Password must be filled out");
                  return false;
                }else if (strDay=="0") {
                  alert("Birthday: Day must be filled out");
                  return false;
                }else if (strMonth == "0") {
                  alert("Birthday: Month must be filled out");
                  return false;
                }else if (strYear == "0") {
                  alert("Birthday: Year must be filled out");
                  return false;
                }else if (h == "") {
                  alert("Phone Number must be filled out");
                  return false;
                }else if (i == "") {
                  alert("Gender must be filled out");
                  return false;
                }else if (c != d) {
                  alert("Password and Confirm Password does not match!");
                  return false;
                }
                if(agreed) {
                    return true;
		} else {
			alert('Please agree to the terms and conditions to continue');
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
        
        var myInput = document.getElementById("pWord");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        var myInput2 = document.getElementById("eMail");
        var symbol = document.getElementById("symbol");
        var dot = document.getElementById("dot");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
          document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
          document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }

          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }

          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }

          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }
        
        // When the user clicks on the email field, show the message box
        myInput2.onfocus = function() {
          document.getElementById("message2").style.display = "block";
        }

        // When the user clicks outside of the email field, hide the message box
        myInput2.onblur = function() {
          document.getElementById("message2").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput2.onkeyup = function() {
          // Validate at sign 
          var atSign = /[@]/g;
          if(myInput2.value.match(atSign)) {  
            symbol.classList.remove("invalid");
            symbol.classList.add("valid");
          } else {
            symbol.classList.remove("valid");
            symbol.classList.add("invalid");
          }

          // Validate dot sign
          var dotSign = /[.]/g;
          if(myInput2.value.match(dotSign)) {  
            dot.classList.remove("invalid");
            dot.classList.add("valid");
          } else {
            dot.classList.remove("valid");
            dot.classList.add("invalid");
          }
      }
  </script>
  	   

</body>

</html>
