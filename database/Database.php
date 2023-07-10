<?php

namespace Database;

use Dotenv\Dotenv;
use PDO;
use PDOException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->host = $_SERVER['DB_HOST'];
        $this->db_name = $_SERVER['DB_NAME'];
        $this->username = $_SERVER['DB_USERNAME'];
        $this->password = $_SERVER['DB_PASSWORD'];
    }

    public function getDbName()
    {
        return $this->db_name;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';port=3306;dbname='. $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die('Connection Error: ' . $e->getMessage());
        }

        return $this->conn;
    }

}