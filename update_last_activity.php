<?php

include('components/database_connection.php');

session_start();

$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE user_id = '".$_SESSION["user_id"]."'
";

$result = $conn->query($query);

//$statement = $conn->prepare($query);
//
//$statement->execute();

?>

