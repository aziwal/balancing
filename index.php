<?php
if (isset($_SESSION['loggedIn']) === '') {
    header('Location: ./login.php');
}
?>

<?php include('./includes/header.php'); ?>
you are registered.

<?php include('./includes/footer.php') ?>
