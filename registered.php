<?php 
    $thisPage = "Registered Users"; 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Registered Users</title>
   
</head>

<body>
   <?php include'components/nav-bar-admin-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="view.php">Main View</a></li>                                  
                 <li class="breadcrumb-item active">Registered Users</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Registered Users</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/> 
    <div class="user-chart-container">
    <center>
    <div id="piechart" style="width: 600px; height: 350px;"></div>  
    </center>
        </div>
    <?php
        if(isset($_GET['msg'])) {
          echo '<div class="bg-success" style="border-radius: 5px; padding:6px 2px 6px 2px; margin: 0px 50px 0px 50px;">';
              echo '<h7 class="p-1 pl-3" style="color:#FFF;">'. $_GET['msg'] .' <a href="registered.php" class="float-right pr-3" style="color:white;">Close</a></h7>';
          echo '</div>';
        }

        if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

        //Define thr query
        $sql = 'SELECT * FROM user ORDER BY uname ASC';
        $query = "SELECT gender, count(*) as number FROM user GROUP BY gender";  
        $result = mysqli_query($conn, $query); 
        
      
        //Run the query
        if($r = mysqli_query($conn,$sql)){
                echo '<br/>';
                    echo '<table  border=1 bordercolor="#b2b2b2" class="users-table">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th>&nbsp;</th>';
                                echo '<th>User ID</th>';
                                echo '<th>Name</th>';
                                echo '<th>Email</th>';
                                echo '<th>Date of Birth</th>';   
                                echo '<th>Phone</th>';
                                echo '<th>Gender</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        
                        if(mysqli_num_rows($r) > 0) {
                            //Retieve and run the record
                            while($row = mysqli_fetch_assoc($r)){
                                    echo '<tr>';
                                     echo '<td width="10%"><div class="wrapper"><a href="deleteUser.php?user_id='. $row['user_id'] .'"  
                                                onclick="return confirm(\'Are you sure you want to remove this user account?\');"><button class="btn btn-danger"><i class="fa fa-ban fa-2x"></i></button></a></div></td>';
                                     echo '<td width="10%">'. $row['user_id'] .'</td>';
                                     echo '<td width="20%"><img width="50px" height="50px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/> &nbsp;'. $row['uname'] .'</td>';
                                        echo '<td width="20%">'. $row['email'] .'</td>';
                                        echo '<td width="15%">'. $row['date'] .'</td>';
                                        echo '<td width="10%">'.$row['phone'].'</td>';
                                        echo '<td width="10%">';
                                    switch($row['gender']) {
                                          case 1:
                                                  echo 'Male';
                                                  break;

                                          case 2:
                                                  echo 'Female';
                                                  break;
                                    }
                                    print'</td>';
                                    echo '</tr>';       
                            
                		}
				echo '</tbody>';
                        	echo '</table>';
                        }
            }
        }
    ?>
    <br/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript">  
    google.charts.load('current', {'packages':['corechart']});  
    google.charts.setOnLoadCallback(drawChart);  
     function drawChart()  
    {  
         var data = google.visualization.arrayToDataTable([  
                 ['Gender', 'Number'],  
                 
                 <?php  
                 while($row = mysqli_fetch_array($result))  
                 {  
                      echo "['"; 
                      switch($row['gender']) {
                           case 0:
                                    echo 'None';
                                    break;
                            case 1:
                                    echo 'Male';
                                    break;
                            case 2:
                                    echo 'Female';
                                    break;
                      }
                      echo"', ".$row["number"]."],";  
                 }  
                 ?>
            ]);  
         var options = {  
               title: 'Percentage of Male and Female Users in the Cooking Corner',  
               //is3D:true,  
               pieHole: 0.4  
              };  
         var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
         chart.draw(data, options);  
    }  
    </script>  
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>
</body>

</html>
