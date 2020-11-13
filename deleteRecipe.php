<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['recipe_id'])) {
		$id = $_GET['recipe_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
        $sql = "DELETE FROM reply WHERE recipe_id = $id;";
        $sql_1 = "DELETE FROM review WHERE recipe_id = $id;";
        $sql_2 = "DELETE FROM saved_recipe WHERE recipe_id = $id;";
        $sql_3 = "DELETE FROM shopping_list WHERE recipe_id = $id;";
	$sql_4   = "DELETE FROM recipe WHERE recipe_id = $id;";
        
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1) && mysqli_query($conn, $sql_2)
                   && mysqli_query($conn, $sql_3) && mysqli_query($conn, $sql_4)) {
			header('location: view.php?msg=The recipe has been deleted');
			exit();
		}
	}
?>
