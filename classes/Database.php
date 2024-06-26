<?php

require_once(__DIR__ . '/../config/DBConfig.php');

class Database{
    public $pdo;

    public function __construct(){
        $this->pdo = new \PDO('mysql:host=' . DBConfig::$host . ';dbname=' . DBConfig::$db_name, DBConfig::$db_user, DBConfig::$db_password);
    }
}