<?php include('./includes/header.php'); ?>

<div class="mainContent">
<?php
    if(!isset($_SESSION['user_session'])) {
        echo "<div id='index'><p>You are not logged in.</p>";
        echo "<div id='buttonWrap'><a id='login' class='button' href='#'>Login</a>&nbsp;&nbsp;or&nbsp&nbsp;"; 
        echo "<a id='register' class='button' href='#'>Register</a></div></div>";
    } else {
        echo "Logged In";
    }
?>
</div>

<?php include('./includes/footer.php') ?>
