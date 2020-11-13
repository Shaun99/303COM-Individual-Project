<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['saved_id'])) {
		$id = $_GET['saved_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
	$sql = "DELETE FROM saved_recipe WHERE saved_id = $id;";
	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql)) {
                header('location: saved-recipe.php?msg=The recipe has been removed from the save lists.');
                exit();
            }
	}
?>

