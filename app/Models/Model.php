<?php

namespace App\Models;

use Database\Database;

abstract class Model
{
    protected $db;
    protected $dbName;
    protected $tableName;

    public function __construct()
    {
        $db = new Database();
        $this->db = $db->connect();
        $this->dbName = $db->getDbName();

        $this->createDatabaseIfNotExists();
        $this->createTableIfNotExists();
    }

    protected function createDatabaseIfNotExists()
    {
        $checkDB = $this->db->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?");
        $checkDB->execute([$this->dbName]);

        if ($checkDB->rowCount() === 0) {
            $this->db->exec("CREATE DATABASE {$this->dbName}");
            $this->db->exec("USE {$this->dbName}");
        }
    }

    protected function createTableIfNotExists()
    {
        $checkTable = $this->db->prepare("SHOW TABLES LIKE ?");
        $checkTable->execute([$this->tableName]);

        if ($checkTable->rowCount() === 0) {
            $query = "CREATE TABLE {$this->tableName} (id INT AUTO_INCREMENT PRIMARY KEY, task VARCHAR(255) NOT NULL, checked TINYINT(1) NOT NULL DEFAULT 0, position INT NOT NULL DEFAULT 0)";
            $this->db->exec($query);
        }
    }
}