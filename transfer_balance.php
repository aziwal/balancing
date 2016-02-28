<?php
    session_start();
    require_once('./config.php');
    require_once('./classes/User.php');

    $transferBalance = User::transferBalance($_SESSION['user_session'], $_POST['transferTo_ID'], $_POST['amount']);
    
    print_r(json_encode($transferBalance));
?>
