<?php

include('components/database_connection.php');

session_start();

$query = "
SELECT * FROM user 
WHERE user_id != '".$_SESSION['user_id']."' 
";

$result = $conn->query($query);

$output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>People</td>
  <td>Status</td>
  <td>Action</td>
 </tr>
';

foreach($result as $row)
{
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 20 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label success">Online</span>';
 }
 else
 {
  $status = '<span class="label danger" >Offline</span>';
 }
 
 $output .= '
 <tr>
  <td><img width="50px" height="50px" style="border-radius: 100px;" src="img/core-img/'.$row['profile'].'" alt="profile"/>
        &nbsp;'.$row['uname'].'&nbsp;'.count_unseen_message($row['user_id'], $_SESSION['user_id'], $conn).'</td>
  <td>'.$status.'</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['uname'].'" data-touserprofile="img/core-img/'.$row['profile'].'">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;

?>
