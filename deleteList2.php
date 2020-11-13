<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['list_id'])) {
		$id = $_GET['list_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
	$sql = "DELETE FROM shopping_list WHERE user_id =".$_SESSION['user_id']." AND recipe_id = $id;";
	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql)) {
                header('location: recipe-post.php?id='. $_GET["recipe_id"].'');
                exit();
            }
	}
?>
