<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $pdo;

    private $host = 'sql103.infinityfree.com';
    private $dbname = 'if0_37598067_scandiweb';
    private $username = 'if0_37598067';
    private $password = 'Aley1607';

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

