<?php
    class Database {
    private $host = "localhost";
    private $db_name = "todofs2";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect(){
        try {
            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->db_name,
            );
            
            if($this->conn->connect_error){
                if(session_status() === PHP_SESSION_NONE){
                    session_start();
                }
                $_SESSION['message'] = 'DB failed: ' . $this->conn->connect_error;
                $_SESSION['message_type'] = 'error';
                return null;
            }
            
            return $this->conn;
        } catch (mysqli_sql_exception $e) {
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION['message'] = 'DB Failed: ' . $e->getMessage();
            $_SESSION['message_type'] = 'error';
            return null;
        }
    }
}
