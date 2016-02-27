<?php    
    session_start();
    require_once('./config.php');
    require_once('./functions.php');

    if (isset($_POST['login'])) {
        $email = checkInput($_POST['login_email']);
        $password = checkInput($_POST['login_password']);
        $salt = 'peoiwfhsoidhf98423424sdaljf';
        $password = sha1($password . $salt);
        
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND password = ?");

        $stmt->bind_param('ss', $email, $password);

        $query = $stmt->execute();
        $stmt->bind_result($id);
        if ( !$query ) {
          die('<div class="error">execute() failed: ' . htmlspecialchars($stmt->error) . '</div><a href="#" id="login">Try again</a>');
        } else if ($stmt->fetch()) {
            
            $_SESSION['user_session'] = $id;
        } else {
            echo '<p>Username or password is incorrect. Please <a href="#" id="login">try again</a></p>';
        }

        $stmt->close();
    }
?>
