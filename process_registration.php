<?php     
    require_once('./config.php');
    require_once('./functions.php');

    if (isset($_POST['register'])) {
        $firstName = checkInput($_POST['first_name']);
        $lastName = checkInput($_POST['last_name']);
        $email = checkInput($_POST['email']);
        $password = checkInput($_POST['password']);
        $salt = 'peoiwfhsoidhf98423424sdaljf';
        $password = sha1($password . $salt);
        $startingBalance = checkInput(100.00);

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, balance) 
                                values (?, ?, ?, ?, ?)");

        $stmt->bind_param('ssssd', $firstName, $lastName, $email, $password, $startingBalance );

        $query = $stmt->execute();
        if ( !$query ) {
          die('<div class="error">execute() failed: ' . htmlspecialchars($stmt->error) . '</div><a href="#" id="register">Try again</a>');
        } else {
            echo "<p>Registraton successful. Please <a href='#' id='login'>Login</a></p>";
        }

        $stmt->close();
    }

?>