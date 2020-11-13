<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['review_id'])) {
		$id = $_GET['review_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
        $sql = "DELETE FROM reply WHERE review_id = $id";
        $sql_1= "DELETE FROM review WHERE review_id = $id";

	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1)) {
                header('location: manage.php?id='. $_GET["recipe_id"].'');
                exit();
            }
	}
?>

