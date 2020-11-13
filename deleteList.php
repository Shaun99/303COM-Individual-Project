<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['list_id'])) {
		$id = $_GET['list_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
	$sql = "DELETE FROM shopping_list WHERE list_id = $id;";
	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
		if(mysqli_query($conn, $sql)) {
			header('location: shopping-list.php?msg=The recipe has been removed from the shopping lists.');
			exit();
		}
	}
?>
