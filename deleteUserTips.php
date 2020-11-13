<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['tblog_id'])) {
		$id = $_GET['tblog_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
        $sql = "DELETE FROM blog_reply WHERE tblog_id = $id;";
        $sql_1 = "DELETE FROM blog_review WHERE tblog_id = $id;";
	$sql_2 = "DELETE FROM tips_blog WHERE tblog_id = $id;";

	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1) && mysqli_query($conn, $sql_2)) {
			header('location: manage-blog-tips-post.php?msg=The blog has been deleted');
			exit();
		}
	}
?>
