<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['reply_id'])) {
		$id = $_GET['reply_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
	$sql = "DELETE FROM reply WHERE reply_id = $id;";
	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql)) {
                header('location: manage.php?id='. $_GET["recipe_id"].'');
                exit();
            }
	}
?>
