<?php

session_start();

session_unset();
    echo'<link href="style.css" type="text/css" rel="stylesheet">';
    echo '<div class="preloaded-logout">';
    echo '<div class="preloaded-container">';
    echo '<br/>';
    echo "<script>setTimeout(\"location.href = 'index.php'\",2500);</script>";
    echo "<b><h3>You have been logged out.</h3>";
    echo "<h6 style=\"color:#673405;\">Redirecting to homepage...</b></h6>";
    echo '<br/>';
    echo '</div>';
    echo '</div>';
    exit();
session_destroy();

?>


