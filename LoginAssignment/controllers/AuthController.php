<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Handle registration
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->username = $_POST['username'];
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if($this->user->register()) {
                header("Location: ../views/login.php?success=registered");
                exit();
            } else {
                header("Location: ../views/register.php?error=failed");
                exit();
            }
        }
    }

    // Handle login
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];

            if($this->user->login()) {
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['username'] = $this->user->username;
                $_SESSION['email'] = $this->user->email;
                header("Location: ../views/dashboard.php");
                exit();
            } else {
                header("Location: ../views/login.php?error=invalid");
                exit();
            }
        }
    }

    // Handle logout
    public function logout() {
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }
}

// Handle actions
if(isset($_GET['action'])) {
    $auth = new AuthController();
    
    switch($_GET['action']) {
        case 'register':
            $auth->register();
            break;
        case 'login':
            $auth->login();
            break;
        case 'logout':
            $auth->logout();
            break;
    }
}
?>
