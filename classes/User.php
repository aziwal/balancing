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

    public static function transferBalance($id, $transferTo_ID, $amount) {
        
        // Get user's current balance

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $stmt = $conn->prepare("SELECT balance FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($balance);
        $stmt->fetch();

        $stmt->close();
        
        //Transfer if user have enough balance and update for both users

        if ($balance > $amount) {
            $deduct = $conn->prepare("UPDATE users SET balance = (@cur_value := balance) - ? WHERE user_id = ?");
            $deduct->bind_param('di', $amount, $id);
            $deduct->execute();
            $deduct->close();

            $transfer = $conn->prepare("UPDATE users SET balance = (@cur_value := balance) + ? WHERE user_id = ?");
            $transfer->bind_param('di', $amount, $transferTo_ID);
            $transfer->execute();
            $transfer->close();
        
            // Finally get the updated balances
            
            $updatedBalances = [];
            $getBalances = $conn->prepare("SELECT user_id, balance FROM users WHERE user_id = ? OR user_id = ?");
            $getBalances->bind_param('ii', $id, $transferTo_ID);
            $getBalances->execute();
            $result = $getBalances->get_result();
            while ( $row = $result->fetch_assoc() ) {
                $updatedBalances[] = $row;
            }
            
            $getBalances->close();
            return $updatedBalances;
        }
    }        
}

?>
