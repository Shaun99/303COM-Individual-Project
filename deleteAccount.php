<?php
	session_start();
	
	$id = NULL;
	
	if(isset($_GET['user_id'])) {
		$id = $_GET['user_id'];
	} else {
		exit('<p>This page has been accessed in error</p>');
	}
        
        $sql   = "DELETE FROM blog_reply WHERE user_id = $id;";
        $sql_1 = "DELETE FROM blog_review WHERE user_id = $id;";
        $sql_2 = "DELETE FROM tips_blog WHERE user_id = $id;";
        $sql_3 = "DELETE FROM recipe_blog WHERE user_id = $id;";
        $sql_4 = "DELETE FROM review WHERE user_id = $id;";
        $sql_5 = "DELETE FROM saved_recipe WHERE user_id = $id;";
        $sql_6 = "DELETE FROM shopping_list WHERE user_id = $id;";
        $sql_7 = "DELETE FROM contact_us WHERE user_id = $id;";
        $sql_8 = "DELETE FROM chat_message WHERE to_user_id = $id;";
        $sql_9 = "DELETE FROM chat_message WHERE from_user_id = $id;";
        $sql_10 = "DELETE FROM login_details WHERE user_id = $id;";
        $sql_11 = "DELETE FROM user WHERE user_id = $id;";
	
	if($conn = mysqli_connect('localhost', 'root', '', 'cooking_corner')) {
            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql_1) && mysqli_query($conn, $sql_2)
               && mysqli_query($conn, $sql_3) && mysqli_query($conn, $sql_4) && mysqli_query($conn, $sql_5)
                && mysqli_query($conn, $sql_6) && mysqli_query($conn, $sql_7) && mysqli_query($conn, $sql_8)
                && mysqli_query($conn, $sql_9) && mysqli_query($conn, $sql_10) && mysqli_query($conn, $sql_11)) {
                    session_unset();
                    session_destroy();
                    header('location: index.php?msg3=Your account has been deleted successfully.');
                    exit();
            }
	}
?>

