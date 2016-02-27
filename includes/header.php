<?php
session_start();

include('./functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App</title>
    <link href="css/main.css" rel="stylesheet" />
</head>
<body>
    <div id="header">
        <div class="container">
            <span id="logo">BMS</span>
            <ul id="mainNav" class="unstyled">
            <?php
                if (isset($_SESSION['user_session'])) {
                    echo '<li><a href="#">All Users</a></li>
                          <li><a href="#">My Profile</a></li>
                          <li><a href="./logout.php">Logout</a></li>';
                }
            ?>
            </ul>
         </div>
    </div>
    <div class="container">
    