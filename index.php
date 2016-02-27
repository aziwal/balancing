<?php

if (!isset($_SESSION['loggedIn'])) {
    header('Location: ./login.php');
}
?>

<?php include('./includes/header.php') ?>


<?php include('./includes/footer.php') ?>