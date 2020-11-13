<?php 
    $thisPage = "Feedback"; 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | User Feedback</title>
</head>

<body>
   <?php include'components/nav-bar-admin-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>                                  
                 <li class="breadcrumb-item active">User Feedback</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>User Feedback</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
    <?php 
      if(isset($_GET['msg'])) {
            echo '<div>';
                echo '<div class="row">';
                    echo '<div class="col-lg-11">';
                        echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px; width:100%">';
                            echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="feedback.php" class="float-right pr-3">Close</a></h7>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<br/>';
        }
        
    //Connect and select:
    $dbc = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($dbc,"cooking_corner");
	
    //Define thr query
    $query = 'SELECT * FROM contact_us, user WHERE contact_us.user_id = user.user_id ORDER BY name ASC';
	
    //Run the query
    if($r = mysqli_query($dbc,$query)){
		
        //Retieve and run the record
        while($row = mysqli_fetch_array($r)){
            print  '  
                    <div class="w3-card-4" style="width:40%">
                        <header class="w3-container w3-light-grey">
                            <div class="row">
                                <div class="col-3">
                                    <img width="60px" height="60px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
                                </div>
                                <div class="col-9" style="margin-left: -50px;">
                                    <h3>'.$row['name'].'</h3>
                                    <h7>'.$row['email'].'</h7>
                                </div>
                            </div>
                        </header>
                    <div class="w3-container">
                        <p style="font-size: 20px; color:black;">'.$row['subject'].'</p>
                        <hr style="border: 1px solid black;">
                        <p style="font-size: 18px; color:black;">'.$row['messagebox'].'</p><br>
                    </div>
                    <a href="deleteFeedback.php?id='. $row['id'] .'" onclick="return confirm(\'Are you sure you want to remove this feedback?\');" title="Remove">
                        <button class="w3-button w3-block w3-dark-grey">Delete Feedback</button>
                    </a>
                    </div>';
        }
    }
        mysqli_close($dbc);
    ?>  
    
    <br/>
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
</body>

</html>