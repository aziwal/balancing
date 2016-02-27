<?php

class User {
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $balance;

    function __construct($data){
        $this->id = $data['id'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->email = $data['email'];
        $this->balance = $data['balance'];
    }
    
    public static function getUserData($id){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = $conn->prepare("SELECT first_name, last_name, email, balance FROM users WHERE user_id = ?");
        $stmt->bind_param('s', $id);
        $query = $stmt->execute();
        $stmt->bind_result($fistName, $lastName, $email, $balance);
        if ( !$query ) {
          die('<div class="error">execute() failed: ' . htmlspecialchars($stmt->error) . '</div>');
        } else if ($stmt->fetch()) {
            return new User([
                'id' => $id, 
                'firstName' => $fistName, 
                'lastName' => $lastName, 
                'email' => $email, 
                'balance' => $balance
            ]);
        } 
        $stmt->close();
    }

    public function transferBalance($amount, $transferTo) {
        if ( isset($amount) && isset($transferTo) ) {
            $this->balance -= $amount;
            $transferTo->balance += $amount;
        }
    }        
}

?>
