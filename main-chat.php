<?php

 $thisPage = "Profile"; 

include('components/database_connection.php');


session_start();

if(!isset($_SESSION['user_id']))
{
 header('location:user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './components/header.php'; ?>
    <!-- Title -->
    <title>The Cooking Corner | Chat Messenger</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    
    <style>
        .ui-dialog-titlebar-close {
            display: none !important;
        }
        
        .ui-dialog-title {
            display: none !important;
        }
        
        .ui-dialog-titlebar {
            display: none !important;
        }
    </style>
</head>

<body>
   <?php include'components/nav-bar-login.php';?>
    
    <div class="col-lg-12 p-l-0 title-margin-left">
         <div class="page-header">   
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                <li class="breadcrumb-item"><a href="myblog.php">My Blog</a></li>   
                <li class="breadcrumb-item active">Chat Messenger</li>
             </ol>
         </div>
     </div>

     <div class="blog-area ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <center>
                    <div class="single-blog-area mb-80">
                        <?php
                        if ($_SESSION['profile'] == null){
                            $_SESSION['profile'] = "profile.png"; 
                        }

                            $image = null;

                            if ($_SESSION['profile'] == null){
                                $image = 'img/core-img/profile.png'; 
                            }
                            else{
                                $image = 'img/core-img/'. $_SESSION['profile'];   
                            }

                        echo'<img src="'.$image.'" style="width:210px; height:210px; border-radius: 200px; border-style:solid;">';  
                        print'<h1> '.$_SESSION['uName'].' </h1>
                            <br/>

                            <ul>
                                <li>
                                    <a href="myblog.php">
                                        <button type="button" class="mydashboard-btn" >
                                            My Dashboard
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="main-chat.php">
                                        <button type="button" class="mycomments-btn">
                                            Chat Messenger
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="insert-blog-recipe.php">
                                        <button type="button" class="mypost-btn">
                                            Post Recipes
                                        </button>
                                    </a>
                                </li>
                                <li>
                                    <a href="insert-blog-tips.php">
                                        <button type="button" class="mytips-btn">
                                            Post Tips & Advices
                                        </button>
                                    </a>
                                </li>
                            </ul>
                            </button>';?>
                    </div>
                    </center>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="blog-header">
                         <h3><i class="fa fa-comments"></i> Chat Messenger</h3>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <h4 align="center">Available Users</h4>
                        <h7 align="left">Hi - <?php echo $_SESSION['uName'];  ?> </h7>
                        <div id="user_details"></div>
                        <div id="user_model_details"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>  
</html>  

<script>  
    $(document).ready(function(){
        
    var opened = false;

    fetch_user();
     
    setInterval(function(){
        update_last_activity();
        fetch_user();
        update_chat_history_data();
     }, 3000);

    function fetch_user()
    {
      $.ajax({
       url:"users-status.php",
       method:"POST",
       success:function(data){
        $('#user_details').html(data);
       }
      })
    }
     
    function update_last_activity()
    {
     $.ajax({
      url:"update_last_activity.php",
      success:function()
      {

      }
     })
    }
    
    function make_chat_dialog_box(to_user_id, to_user_name, to_user_profile)
    {         
        opened = true;
        var modal_content = '<div id="user_dialog_'+to_user_id+'">';
        modal_content += '<div class="chat-container"><img width="50px" style="border-radius: 100px;" src="'+to_user_profile+'" /> <b>'+to_user_name+'</b>';
        modal_content += '<button type="button" data-id="user_dialog_'+to_user_id+'" class="btn close" title="Close chat"><i class="fa fa-times fa-lg" style="color: darkred;"></i></button></div>';
        modal_content += '<div style="height:300px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
        modal_content += fetch_user_chat_history(to_user_id);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
        modal_content += '</div><div class="form-group" align="right">';
        modal_content += '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send <i class="fa fa-caret-right"></i></button></div></div>';
        $('#user_model_details').html(modal_content);

        call();

        $('.chat_history').each(function() {
            $(this).animate({ scrollTop: 999999 }, 1);
        });
    }

     $(document).on('click', '.start_chat', function(){
      var to_user_id = $(this).data('touserid');
      var to_user_name = $(this).data('tousername');
      var to_user_profile = $(this).data('touserprofile');
      make_chat_dialog_box(to_user_id, to_user_name, to_user_profile);
      $("#user_dialog_"+to_user_id).dialog({
       autoOpen:false,
       width:400
      });
      $('#user_dialog_'+to_user_id).dialog('open');
      $('#chat_message_'+to_user_id).emojioneArea({
        pickerPosition:"top",
        toneStyle: "bullet"
       });
     });
     
    function call() {
        $('.close').each(function() {
            $(this).click(function() {
                var id = $(this).data('id');
                $('#' + id).dialog('close');
                opened = false;
            })
        });
    }
     
    $(document).on('click', '.send_chat', function(){
    var to_user_id = $(this).attr('id');
    var chat_message = $('#chat_message_'+to_user_id).val();
    if(chat_message != '')
    {
        $.ajax({
         url:"insert_chat.php",
         method:"POST",
         data:{to_user_id:to_user_id, chat_message:chat_message},
         success:function(data)
         {
            //$('#chat_message_'+to_user_id).val('');
            var element = $('#chat_message_'+to_user_id).emojioneArea();
            element[0].emojioneArea.setText('');
            $('#chat_history_'+to_user_id).html(data);
         }
        })
    }
    else(alert("Please fill in this field"));
   });
   
    function fetch_user_chat_history(to_user_id)
    {       
        if (opened) {
            console.log("Updating");
            $.ajax({
             url:"fetch_user_chat_history.php",
             method:"POST",
             data:{to_user_id:to_user_id},
             success:function(data){
              $('#chat_history_'+to_user_id).html(data);
             }
            })
        }
    }
    
    function update_chat_history_data()
    {
     $('.chat_history').each(function(){
      var to_user_id = $(this).data('touserid');
      fetch_user_chat_history(to_user_id);
     });
    }
    
    $(document).on('click', '.remove_chat', function(){
    var chat_message_id = $(this).attr('id');
    if(confirm("Are you sure you want to remove this chat?"))
    {
     $.ajax({
      url:"remove_chat.php",
      method:"POST",
      data:{chat_message_id:chat_message_id},
      success:function(data)
      {
       update_chat_history_data();
      }
     })
    }
   });

});  

</script>

 <?php require_once './components/footer.php'; ?>

<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->

<!-- Popper js -->
<script src="js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>
<!-- Create Time -->
<script>
var element = document.getElementById('time');	

setInterval(function() {
        var date = new Date();
        element.innerHTML = (date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear()) + "<br/>";
        element.innerHTML += ((date.getHours() < 10) ? "0" + date.getHours() : date.getHours()) + ":" + ((date.getMinutes() < 10) ? "0" + date.getMinutes() : date.getMinutes()) + ":" + ((date.getSeconds() < 10) ? "0" + date.getSeconds() : date.getSeconds());
}, 1000);
</script>
</body>

</html>