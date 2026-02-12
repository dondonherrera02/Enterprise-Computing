<?php
session_start();
include 'controller/TaskController.php';
$controller = new TaskController();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['add_task'])){
        $controller->addTask($_POST['task']);
        header ("Location:" . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['complete_task'])){
        $controller->updateTask($_POST['id'], 1);
        header ("Location:" . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['undo_complete_task'])){
        $controller->updateTask($_POST['id'], 0);
        header ("Location:" . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST['delete_task'])){
        $controller->deleteTask($_POST['id']);
        header ("Location:" . $_SERVER['PHP_SELF']);
        exit();
    }
}
$tasks = $controller->index();
include 'view/TaskView.php';

// Clear the message after displaying
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>
