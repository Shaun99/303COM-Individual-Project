<?php

//database_connection.php

$conn = new mysqli('localhost', 'root', '', 'cooking_corner');

date_default_timezone_set('Asia/Kuala_Lumpur');

function fetch_user_last_activity($user_id, $conn)
{
 $query = "
 SELECT * FROM login_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";


 $result = $conn->query($query);
 
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $conn)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp ASC
 ";

 $result = $conn->query($query);
 
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
    $user_name = '';
    $dynamic_background = '';
    $chat_message = '';
  if($row["from_user_id"] == $from_user_id)
  {
        if($row["status"] == '2')
        {
            $chat_message = '<em><i class="fa fa-ban"></i> This message has been removed</em>';
            $user_name = '<b class="text-success">You</b>';
        }
        else
        {
            $chat_message = $row['chat_message'];
            $user_name = '<b class="text-success">You</b><button type="button" style="float:right;" class="btn remove_chat" id="'.$row['chat_message_id'].'"><i class="fa fa-times"></i></button>';
        }
        $dynamic_background = 'background-color:#ffffe6;';
  } 
  else
  {
        if($row["status"] == '2')
        {
         $chat_message = '<em><i class="fa fa-ban"></i> This message has been removed</em>';
        }
        else
        {
         $chat_message = $row["chat_message"];
        }
        
    $user_name = '<b class="text-primary">'.get_user_name($row['from_user_id'], $conn).'</b>';
    $dynamic_background = 'background-color:#E6F3FF;';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc; padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
   <p style="margin-bottom: -5px; font-size: 15px; color:darkslategray;">'.$user_name.'<br/>'.$chat_message.'
    <div align="right" style="margin-bottom: -15px;">
     <p title="'.$row['timestamp'].'"> <em>Sent '. review_time_ago($row['timestamp']).' </em></p>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
$query = "
 UPDATE chat_message 
 SET status = '0' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 $result = $conn->query($query);
 return $output;
}

function get_user_name($user_id, $conn)
{
 $query = "SELECT uname FROM user WHERE user_id = '$user_id'";
 $result = $conn->query($query);
 foreach($result as $row)
 {
  return $row['uname'];
 }
}

function count_unseen_message($from_user_id, $to_user_id, $conn)
{
    $query = "
    SELECT * FROM chat_message 
    WHERE from_user_id = '$from_user_id' 
    AND to_user_id = '$to_user_id' 
    AND status = '1'
    ";

 $result =  $conn->query($query);

 $count = $result->num_rows;
 
 $output = '';
 
    if ($count>0)
    {
        $output = '<span class="label success">'.$count.'</span>';
    }
    return $output;
}

?>
<?php  
  date_default_timezone_set('Asia/Kuala_Lumpur');
 function review_time_ago($timestamp)  
 {  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes = round($seconds / 60 );           // value 60 is seconds  
      $hours   = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days    = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks   = round($seconds / 604800);          // 7*24*60*60;  
      $months  = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years   = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60)  
      {  
     return "Just Now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "1 minute ago";  
     }  
     else  
           {  
       return "$minutes minutes ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "1 hour ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3) //4.3 == 52/12  
      {  
     if($weeks==1)  
           {  
       return "a week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "a month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "one year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }  
 ?>  

