<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['rblog_id'])) {
		$id = $_GET['rblog_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
        $sql = "DELETE FROM blog_review WHERE rblog_id = $id;";
	$sql_1 = "DELETE FROM recipe_blog WHERE rblog_id = $id;";

	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1)) {
			header('location: manage-blog-post.php?msg=The blog has been deleted');
			exit();
		}
	}
?>
