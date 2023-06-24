<?php
// BaseModel.php

class BaseModel {
    protected static $conn;

    public function __construct() {
        if(!isset(self::$conn)) {
            self::$conn = new PDO('mysql: host=localhost; dbname=pontocivil', 'root', '');
        }
    }
}

?>