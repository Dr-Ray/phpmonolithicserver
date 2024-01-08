<?php
class Logic {
    private $user;
    private $messaging;

    function __construct($db) {
       $this->user = new User($db);
       if(ENABLE_MESSAGING) {
            $this->messaging = new Messaging();
       }
    }

    function hashData($data) {
        return sha1($data);
    }

    function validateInput($input, $type='string') {
        if($input == 'none') {
            return false;
        }
        if($type == 'string') {
            return strip_tags(filter_var($input, FILTER_SANITIZE_STRING));
        }
        if($type == 'email') {
            return strip_tags(filter_var($input, FILTER_VALIDATE_EMAIL));
        }
    }

    function verify_password($p1, $p2) {
        $p1 = $this->hashData($p1);
        $p2 = $this->hashData($p2);

        if($p1 === $p2) {
            return true;
        }else {
            return false;
        }
    }

    function Login($data) {
        $email = $this->validateInput($data['email'],'email');
        $password = $data['password'];
        $user = $this->user->get($email);

        if($user) {
            if($this->verify_password($user['password'], $password)) {
                // create a new session object 
                $_SESSION['id'] = $user['id'];
                return json_encode([
                    "status"=>"success",
                    "message"=>"Login successful"
                ]);
            }else{
                return json_encode([
                    "status"=>"error",
                    "message"=>"Incorrect email or password"
                ]);
            }
        }else{
            return json_encode([
                "status"=>"error",
                "message"=>"User not found"
            ]);
        }
    }

    function Register($data) {
        $data = [
            "email" => $this->validateInput($data['email'],'email'),
            "fullname" => $this->validateInput($data['fullname']),
            "phone" => $this->validateInput($data['phone']),
            "password" => $this->hashData($data['password'])
        ];

        $newUser = $this->user->createUser($data);
    }
}