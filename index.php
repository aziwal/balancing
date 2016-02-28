<?php include('./includes/header.php'); ?>

<div class="mainContent">
<?php
    if(!isset($_SESSION['user_session'])) {
        echo "<p>You are not logged in.</p>";
        echo "<a id='login' href='#'>Login</a> or "; 
        echo "<a id='register' href='#'>Register</a>";
    } else {
        echo "Logged In";
    }
?>
</div>

<?php include('./includes/footer.php') ?>
