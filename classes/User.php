<?php

class User {
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $balance = 100;

    function __construct($data){
        $this->id = $data['id'];
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->email = $data['email'];
    }

    public function transferBalance($amount, $transferTo) {
        if ( isset($amount) && isset($transferTo) ) {
            $this->balance -= $amount;
            $transferTo->balance += $amount;
        }
    }        
}

?>