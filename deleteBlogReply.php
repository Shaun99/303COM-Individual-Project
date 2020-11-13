<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['breply_id'])) {
		$id = $_GET['breply_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
	
	$sql = "DELETE FROM blog_reply WHERE breply_id = $id;";
	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql)) {
                header('location: manage-tips-blog.php?id='. $_GET["tblog_id"].'');
                exit();
            }
	}
?>

