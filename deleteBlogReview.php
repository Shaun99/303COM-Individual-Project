<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['breview_id'])) {
		$id = $_GET['breview_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
        
	$sql = "DELETE FROM blog_reply WHERE breview_id = $id;";
	$sql_1= "DELETE FROM blog_review WHERE breview_id = $id;";
        
         
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1)) {
                header('location: manage-tips-blog.php?id='. $_GET["tblog_id"].'');
                exit();
            }
	}
?>
