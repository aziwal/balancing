<?php include('includes/header.php') ?>

<?php

if (isset($_POST['register'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $salt = 'peoiwfhsoidhf98423424sdaljf';
    $password = $_POST['password'] . $salt;
    $password = sha1($password);
    $startingBalance = 100.00;
        
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, balance) 
                            values (?, ?, ?, ?, ?)");
    
    $stmt->bind_param('sssss', $firstName, $lastName, $email, $password, $startingBalance );

    $query = $stmt->execute();
    if ( !$query ) {
      die('execute() failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    
    $_SESSION['loggedIn'] = '1';
    
    header('Location: ./index.php');
}

?>
 
	 <div class="mainContent">
		<div id="register-form">
			<h1>User Registration</h1>
            <form method="post">
                <input type="text" name="first_name" value="" placeholder="First Name" required>
                <input type="text" name="last_name" value="" placeholder="Last Name" required>
                <input type="email" name="email" value="" placeholder="Email" required>
                <input type="password" name="password" value="" placeholder="Password" required>
                <input type="submit" name="register" value="Register">
            </form>
        </div>
        <a href="./login.php">Return to Login</a>
    </div>

<?php include('includes/footer.php') ?>
