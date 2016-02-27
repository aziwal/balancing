<?php include('./includes/header.php') ?>

<div class="mainContent">
    <div id="login-form">
        <h1>User Login</h1>
        <form method="post">
            <input type="text" name="login_email" value="" placeholder="Email">
            <input type="password" name="login_password" value="" placeholder="Password">
            <input type="submit" name="login" value="Login">
        </form>
    </div>
    <a id="register" href="./register.php">Register</a>
</div>

<?php include('./includes/footer.php') ?>
