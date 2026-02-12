<?php
include __DIR__ . '/../config/Database.php';
include __DIR__ . '/../model/Task.php';

class TaskController {
    private $taskModel;
    private $db;
    
    public function __construct(){
        $database = new Database();
        $this->db = $database->connect();
        
        if($this->db === null){
            return;
        }
        
        $this->taskModel = new Task($this->db);
    }

    public function addTask($task){
        if($this->db === null){
            return false;
        }
        
        if(empty($task)){
            $_SESSION['message'] = 'Task cannot be empty!';
            $_SESSION['message_type'] = 'error';
            return false;
        }
        
        $this->taskModel->task = $task;
        $result = $this->taskModel->create();
        
        if($result === false){
            $_SESSION['message'] = 'Error adding task: ' . $this->db->error;
            $_SESSION['message_type'] = 'error';
            return false;
        } else {
            $_SESSION['message'] = 'Task added successfully!';
            $_SESSION['message_type'] = 'success';
            return true;
        }
    }
    
    public function updateTask($id, $is_completed){
        if($this->db === null){
            return false;
        }
        
        $this->taskModel->id = $id;
        $this->taskModel->is_completed = $is_completed;
        $result = $this->taskModel->update();
        
        if($result === false){
            $_SESSION['message'] = 'Error updating task: ' . $this->db->error;
            $_SESSION['message_type'] = 'error';
            return false;
        } else {
            $_SESSION['message'] = 'Task updated successfully!';
            $_SESSION['message_type'] = 'success';
            return true;
        }
    }
    
    public function deleteTask($id){
        if($this->db === null){
            return false;
        }
        
        $this->taskModel->id = $id;
        $result = $this->taskModel->delete();
        
        if($result === false){
            $_SESSION['message'] = 'Error deleting task: ' . $this->db->error;
            $_SESSION['message_type'] = 'error';
            return false;
        } else {
            $_SESSION['message'] = 'Task deleted successfully!';
            $_SESSION['message_type'] = 'error'; 
            return true;
        }
    }
    
    public function index(){
        if($this->db === null){
            return null;
        }
        return $this->taskModel->read();
    }
}