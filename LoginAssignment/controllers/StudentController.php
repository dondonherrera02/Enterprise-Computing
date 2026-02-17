<?php
session_start();
require_once '../config/database.php';
require_once '../models/Student.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

class StudentController {
    private $db;
    private $student;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->student = new Student($this->db);
    }

    // Create new student
    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->student->student_id = $_POST['student_id'];
            $this->student->name = $_POST['name'];
            $this->student->email = $_POST['email'];

            if($this->student->create()) {
                header("Location: ../views/dashboard.php?success=created");
                exit();
            } else {
                header("Location: ../views/dashboard.php?error=failed");
                exit();
            }
        }
    }

    // Delete student
    public function delete() {
        if(isset($_GET['id'])) {
            $this->student->id = $_GET['id'];

            if($this->student->delete()) {
                header("Location: ../views/dashboard.php?success=deleted");
                exit();
            } else {
                header("Location: ../views/dashboard.php?error=failed");
                exit();
            }
        }
    }
}

// Handle actions
if(isset($_GET['action'])) {
    $studentController = new StudentController();
    
    switch($_GET['action']) {
        case 'create':
            $studentController->create();
            break;
        case 'delete':
            $studentController->delete();
            break;
    }
}
?>
