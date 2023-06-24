<?php

//namespace App\Controller;
//use App\Model\User;

require_once './App/Model/User.php';

class AuthController {
    
    public function login($username, $password) {
        $authenticated = User::login($username, $password);
        if($authenticated) {
            echo json_encode(["status" => "Authenticated", "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Authenticated", "ok" => false]);
        }
    }

}

?>