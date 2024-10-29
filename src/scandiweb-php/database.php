<?php

class Database {
    private $pdo;

    public function __construct() {
        $sname = 'sql103.infinityfree.com';
        $uname = 'if0_37598067';
        $pass = 'Aley1607';
        $db_name = 'if0_37598067_scandiweb';

        try {
            $this->pdo = new PDO("mysql:host=$sname;dbname=$db_name;charset=utf8", $uname, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
