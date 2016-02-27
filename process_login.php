<?php    
    session_start();
    include('./config.php');
    include('./functions.php');
    include('./classes/User.php');

    if (isset($_POST['login'])) {
        $email = checkInput($_POST['login_email']);
        $password = checkInput($_POST['login_password']);
        $salt = 'peoiwfhsoidhf98423424sdaljf';
        $password = sha1($password . $salt);
        
        $stmt = $conn->prepare("SELECT user_id, first_name, last_name, email, balance FROM users WHERE email = ? AND password = ?");

        $stmt->bind_param('ss', $email, $password);

        $query = $stmt->execute();
        $stmt->bind_result($id, $fistName, $lastName, $email, $balance);
        if ( !$query ) {
          die('<div class="error">execute() failed: ' . htmlspecialchars($stmt->error) . '</div><a href="#" id="login">Try again</a>');
        } else if ($stmt->fetch()) {
            $loggedInUser =  new User([
                'id' => $id, 
                'firstName' => $fistName, 
                'lastName' => $lastName, 
                'email' => $email, 
                'balance' => $balance
            ]);
            $_SESSION['user_session'] = $id;
            echo "<a href='#' id='profile'>View profile</a> or <a href='#' id='listUsers'>view all users</a>";
        } else {
            echo '<p>Username or password is incorrect. Please <a href="#" id="login">try again</a></p>';
        }

        $stmt->close();
    }
?>
