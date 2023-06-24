<?php

//namespace App\Model;
require_once './App/Model/BaseModel.php';


class User extends BaseModel {
    private $id;
    private $name;
    private $username;
    private $type;

    public function __construct($id, $name, $username, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->type = $type;
    }

    // Get all the users
    public static function getAll() {
        $list = [];
        $sql = 'SELECT * FROM users';
        $query = self::$conn->prepare($sql);
        $query->execute();

        foreach($query->fetchAll() as $user) {
            $list[] = new User($user['id'], $user['name'], $user['username'], $user['type']);
        }
        return $list;
    }

    public static function getUserByUsername($username) {
        $users = self::getAll();
        foreach($users as $user) {
            if($user->username == $username) {
                return $user;
            }
        }
    }

    public static function login($username, $password) {
        $username == 'admin' && $password == 'admin' ? $ok = true : $ok = false;
        return $ok;
    }
    
}

?>