<?php

function checkInput ($input) {
    $input = stripslashes($input);
    $input = trim($input);
    $input = htmlspecialchars($input);
    return $input;
}

?>
