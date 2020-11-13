<?php 
    $thisPage = "Contact Us"; 
    session_start();
	
    $value = false;

    // Check for submission
    if(isset($_POST['submit'])){

        $sql = "INSERT INTO contact_us (user_id, name, email, subject, messagebox) VALUES ('".$_SESSION['user_id']."', '". $_POST['name'] ."', '". $_POST['email'] ."', 
        '". $_POST['subject'] ."', '". $_POST['messagebox'] ."');";

        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql)) {
                echo'<script>alert("Your feedback has been successfully sent!")</script>';
                    $value = true;
            }
        }
    }
?>
<!DOCTYPE html >
<html>
  <head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Contact Us</title>
    <style>
      #map {
        height: 100%;
        margin: 100px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
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
                 <li class="breadcrumb-item active">Contact Us </li>
             </ol>
         </div>
     </div>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <!-- ##### Breadcumb Area End ##### -->
    <!-- ##### Contact Information Area Start ##### -->
    <div class="contact-information-area">
        <div class="contact-container bg-overlay2">
            
        <!-- ##### Contact Form Area Start ##### -->
        <div class="contact-area section-padding-0-80">
            <div class="container">
                <div class="row">
                    <div class="col-7">
                        <div class="contact-heading">
                            <h3 style="margin-top:60px;">We'd love to hear from you</h3>
                        </div>
                    </div>
                    <div class="col-5 col-lg-5">
                    <div class="logo">
                        <img src="img/core-img/logo.png" alt="" width="60%" style="margin-left: 100px;">
                    </div>
                    <br/>
                </div>
                </div>

                <div class="row">
                    <div class="col-7">
                        <div class="contact-form-area">
                            <form name="contactForm" action="contact.php"  method="post">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                        <span></span>
                                    </div>
                                    <div class="col-12 ">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                    </div>
                                    <div class="col-12 ">
                                        <textarea name="messagebox" class="form-control" id="messagebox" cols="40" rows="20" placeholder="Enter your message here..."></textarea>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn delicious-btn mt-30" type="submit" name="submit" onclick="return validateForm()" >
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- Contact Text -->
                <div class="col-4 col-lg-5">
                    <div class="contact-text">
                        <h7>
                            We at The Cooking Corner know you had many options to choose from, we thank you for choosing 
                            us as your source for looking up various recipes we had to offer.<br/><br/>
                            Should you have any suggestions on how we can serve you better, please do not hesitate to drop us a feedback
                            in the form provided or feel free to contact us as we will be greatly appreciate to further
                            improve the website better.
                        </h7>
                    </div>
                    
                     <div class="logo2">
                         <img src="img/core-img/dish.png" alt="" width="40%" style="float:right;">
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- ##### Contact Form Area End ##### -->
        </div>
    </div>
    <!-- ##### Contact Information Area End ##### -->
    <br/><br/>
   
    <h2 class="col-lg-12 text-center">- Get In Touch With Us -</h2>
    <br/>
      <div class="row">
        <!-- Single Contact Information -->
        <div class="single-contact-information mb-30">
            <h6><i class="fa fa-map-marker"></i> Address:</h6>
            <p>Z-1, Lebuh Bukit Jambul, 
            <br>Bukit Jambul, 11900 Bayan Lepas,
            <br> Pulau Pinang</p>
        </div>
        <!-- Single Contact Information -->
        <div class="single-contact-information mb-30">
            <h6><i class="fa fa-phone"></i> Phone:</h6>
            <p>+604-5449583 <br>+016-8349323</p>
        </div>
        <!-- Single Contact Information -->
        <div class="single-contact-information mb-30">
            <h6><i class="fa fa-envelope"></i> Email:</h6>
            <p>leeshaun6699@ymail.com</p>
        </div>
    </div>
     <div id="map"></div>
   
    
      <!-- ##### Follow Us Instagram Area Start ##### -->
    <div class="follow-us-instagram">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5>Follow Us Instragram</h5>
                </div>
            </div>
        </div>
        <!-- Instagram Feeds -->
        <div class="insta-feeds d-flex flex-wrap">
            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta1.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta2.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta3.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta4.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta5.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta6.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Single Insta Feeds -->
            <div class="single-insta-feeds">
                <img src="img/bg-img/insta7.jpg" alt="">
                <!-- Icon -->
                <div class="insta-icon">
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Follow Us Instagram Area End ##### -->
    
    <?php require_once './components/footer.php'; ?>
    
    <?php require_once './components/js-include-bottom.php'; ?>

    <script>
        
        function validateForm() {
            var w = document.forms["contactForm"]["name"].value;
            var x = document.forms["contactForm"]["email"].value;
            var y = document.forms["contactForm"]["subject"].value;
            var z = document.forms["contactForm"]["messagebox"].value;
            
                if (w == "" && x == "" && y == "" && z == "") {
                  alert("All fields must be filled out");
                  return false;
                }else if (w == "") {
                  alert("Username must be filled out");
                  return false;
                }else if (x == "") {
                  alert("Email must be filled out");
                  return false;
                }else if (y == "") {
                  alert("Subject must be filled out");
                  return false;
                }else if (z == "") {
                  alert("Message box must be filled out");
                  return false;
                }
        }
        

    // Initialize and add the map
    function initMap() {
        // The location of Uluru
        var uluru = {lat: 5.3416038, lng: 100.279682};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
    }

      function doNothing() {}
    </script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDIgftE0ECmQupGmA6bOpSu4vzteM_rEg&callback=initMap">
    </script>
  </body>
</html>
