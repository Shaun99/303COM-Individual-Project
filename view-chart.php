<?php 
    $thisPage = "RecipeChart"; 
    session_start();
 if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {

    $query = "SELECT difficulty, count(*) as number FROM recipe GROUP BY difficulty";  
    $result = mysqli_query($conn, $query); 
    
    $query2 = "SELECT dish, count(*) as number FROM recipe GROUP BY dish";  
    $result2 = mysqli_query($conn, $query2); 
    
    $query3 = "SELECT rating, count(*) as number FROM review GROUP BY rating";  
    $result3 = mysqli_query($conn, $query3); 
 }
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
                 <li class="breadcrumb-item active">Recipe Stats Details</li>
             </ol>
         </div>
     </div>
    
    <!-- ##### Breadcumb Area Start ##### -->
     <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Recipe Stats Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->
    <br/>
    <div class="row">
    <div class="col-6">
        <div class="difficulty-chart-container">
            <div id="piechart" style="width: 550px; height: 350px;"></div>  
        </div>
    </div>
    <div class="col-6">
        <div class="dish-chart-container">
            <div id="piechart2" style="width: 550px; height: 350px;"></div>  
        </div>
    </div>
    </div>
     <br/>

    <div class="row">
  
        <div class="rating-chart-container">
            <div id="piechart3" style="width: 550px; height: 350px;"></div>  
        </div>

    </div>
    <br/>
    <?php require_once './components/footer.php'; ?>

    <?php require_once './components/js-include-bottom.php'; ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript">  
    google.charts.load('current', {'packages':['corechart']});  
    google.charts.setOnLoadCallback(drawChart);  
    google.charts.setOnLoadCallback(drawChart2);
    google.charts.setOnLoadCallback(drawChart3); 
     function drawChart()  
    {  
         var data = google.visualization.arrayToDataTable([  
                 ['Difficulty', 'Number'],  
                 
                 <?php  
                 while($row = mysqli_fetch_array($result))  
                 {  
                      echo "['"; 
                      switch($row['difficulty']) {
                            case 1:
                                    echo 'Easy ';
                                    break;

                            case 2:
                                    echo 'Medium';
                                    break;

                            case 3:
                                    echo 'Hard';
                    }
                      echo"', ".$row["number"]."],";  
                 }  
                 ?>
            ]);  
         var options = {  
               title: 'Recipe Difficulty',  
               //is3D:true,  
               pieHole: 0.4  
              };  
         var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
         chart.draw(data, options);  
    }  
    function drawChart2()  
    {  
         var data = google.visualization.arrayToDataTable([  
                 ['Dish', 'Number'],  
                 
                 <?php  
                 while($row = mysqli_fetch_array($result2))  
                 {  
                      echo "['"; 
                      switch($row['dish']) {
                            case 1:
                                    echo 'Vegetarian';
                                    break;
                            case 2:
                                    echo 'Baked Goods';
                                    break;
                            case 3:
                                    echo 'BBQ';
                                    break;
                            case 4:
                                    echo 'Noodles';
                                    break;                                      
                            case 5:
                                    echo 'Rice';
                                    break;
                            case 6:
                                    echo 'Seafood';
                                    break;
                            case 7:
                                    echo 'Juice';
                                    break;
                            case 8:
                                    echo 'Coffee & Tea';
                                    break;
                            case 9:
                                    echo 'Non-Coffee';
                                    break;
                            case 10:
                                    echo 'Smoothies';
                                    break;                                      
                            case 11:
                                    echo 'Cocktails';
                                    break;
                            case 12:
                                    echo 'Milkshake';
                    }
                      echo"', ".$row["number"]."],";  
                 }  
                 ?>
            ]);  
         var options = {  
               title: 'Recipe Categories',  
               //is3D:true,  
               pieHole: 0.4  
              };  
         var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
         chart.draw(data, options);  
    }  
     function drawChart3()  
    {  
         var data = google.visualization.arrayToDataTable([  
                 ['Rating', 'Number'],  
                 
                 <?php  
                 while($row = mysqli_fetch_array($result3))  
                 {  
                      echo "['"; 
                       switch($row['rating']) {
                            case 1:
                                echo '1 star';
                                break;

                            case 2:
                                echo '2 stars';
                                break;

                            case 3:
                                echo '3 stars';
                                break;

                            case 4:
                                echo '4 stars';
                                break;

                            case 5:
                                echo '5 stars'; 
                        }
                      echo"', ".$row["number"]."],";  
                 }  
                 ?>
            ]);  
         var options = {  
               title: 'Recipe Ratings',  
               //is3D:true,  
               pieHole: 0.4  
              };  
         var chart = new google.visualization.PieChart(document.getElementById('piechart3'));  
         chart.draw(data, options);  
    }  
    </script>  
        
</body>
</html>

