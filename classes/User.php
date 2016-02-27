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
        $stmt->execute();
        $stmt->bind_result($fistName, $lastName, $email, $balance);
        if ($stmt->fetch()) {
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
    
    public static function getAllUsers(){
        $users = [];
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = $conn->prepare("SELECT user_id, first_name, last_name, email, balance FROM users");
        $stmt->execute();
        $stmt->bind_result($id, $firstName, $lastName, $email, $balance);
        $result = $stmt->get_result();
        while( $row = $result->fetch_assoc() ){
            $users[] =  new User([
                'id' => $row['user_id'], 
                'firstName' => $row['first_name'], 
                'lastName' => $row['last_name'], 
                'email' => $row['email'], 
                'balance' => $row['balance']
            ]);
        }        
        $stmt->close();
        return $users;
    }

    public function transferBalance($amount, $transferTo) {
        if ( isset($amount) && isset($transferTo) ) {
            $this->balance -= $amount;
            $transferTo->balance += $amount;
        }
    }        
}

?>
