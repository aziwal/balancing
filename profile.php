<?php
    session_start();
    require_once('./config.php');
    require_once('./classes/User.php');

    $loggedInUser = User::getUserData($_SESSION['user_session']);

?>
    
<div id="user">
    <div>First Name: <?php echo $loggedInUser->firstName ?></div>
    <div>Last Name: <?php echo $loggedInUser->lastName ?></div>
    <div>Email: <?php echo $loggedInUser->email ?></div>
    <div>Balance: <?php echo $loggedInUser->balance ?></div>
</div>
    