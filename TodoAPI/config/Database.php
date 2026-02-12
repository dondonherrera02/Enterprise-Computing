<?php
class Database {
    private $host = "localhost";
    private $db_name = "todofs2";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            http_response_code(500);
            die(json_encode([
                "message" => "Database connection failed: " . $this->conn->connect_error
            ]));
        }

        return $this->conn;
    }
}