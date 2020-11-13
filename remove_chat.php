<?php

//remove_chat.php

include('components/database_connection.php');

if(isset($_POST["chat_message_id"]))
{
 $query = "
 UPDATE chat_message 
 SET status = '2' 
 WHERE chat_message_id = '".$_POST["chat_message_id"]."'
 ";

$result = $conn->query($query);
}

?>

