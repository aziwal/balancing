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

    public function transferBalance($amount, $transferTo) {
        if ( isset($amount) && isset($transferTo) ) {
            $this->balance -= $amount;
            $transferTo->balance += $amount;
        }
    }        
}

?>
