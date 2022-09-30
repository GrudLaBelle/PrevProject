<?php

namespace Database;

use PDO;

class DBConnection {

    private $dbname;
    private $host;
    private $username;
    private $password;
    private $pdo;

    // constructor
    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }
    
    // method of connection to the DB
    public function getPDO(): PDO
    {
        $newPdo = new PDO(
            "mysql:dbname={$this->dbname};host={$this->host}",
            $this->username,
            $this->password,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
            )
        );
        return $this->pdo ?? $this->pdo = $newPdo;
    }
}
