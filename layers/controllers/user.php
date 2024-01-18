<?php
class User {
    private $db;
    function __construct ($db) {
        $this->db = $db;
    }

    function get($email) {
        $res = $this->db->select('users',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "email" => $email
                ]
            ]
        ]);
        if($res) {
            return $this->db->fetch( $res );
        }else{
            return false;
        }
    }

    function createUser($data) {
        $email = $data['email']; 
        $fullname = $data['name'];
        $username = $data['username']; 
        $password = $data['password']; 

        $newUser = $this->db->addData('users',[
            "email" =>$email,
            "name" =>$fullname,
            "username" =>$username,
            "password" =>$password
        ]);

        return $newUser;
    }

    function updateAll($select, $data) {
        $update = $this->db->MultipleUpdate('users',[
            "data" => $data,
            "selector" => $select['selector'],
            "selector_value" => $select['value']
        ]);

        if($update) {
            return True;
        }else{
            return False;
        }
    
    }

    function change_password($data, $selector='email', $user) {
        $done = $this->db->singleUpdate([
            "table" => 'users',
            "column" => 'password',
            "value" => $data,
            "selector" => $selector,
            "selector_value" => $user
        ]);
        if($done) {
            return True;
        }else{
            return False;
        }
    }
}