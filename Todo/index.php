<?php
include "controller/TaskController.php";
session_start();

$controller = new TaskController();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['add_task'])){
        $controller->addTask($_POST['task']);
        
    }elseif(isset($_POST['complete_task'])){
        $controller->updateTask($_POST['id'],1);

    }elseif(isset($_POST['undo_complete_task'])){
        $controller->updateTask($_POST['id'],0);

    }elseif(isset($_POST['delete_task'])){
        $controller->deleteTask($_POST['id']);
    }

}else{
    $controller-> index();
}