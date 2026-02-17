<?php
class Student {
    private $conn;
    private $table_name = "students";

    public $id;
    public $student_id;
    public $name;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all students
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create new student
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (student_id, name, email) VALUES (:student_id, :name, :email)";
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":student_id", $this->student_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete student
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
