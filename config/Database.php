<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "123";
    private $database = "clima";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_errno) {
            die("Failed to connect to MySQL: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
