<?php
include "controller/TaskController.php";

$controller = new TaskController();

$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$requestUri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']);

// Strip query string if present
$requestUri = strtok($requestUri, '?');

$request = explode("/", trim($requestUri, "/"));
$requestMethod = $_SERVER['REQUEST_METHOD'];

// GET    /           ---> get all tasks
// POST   /task       ---> add a new task         { "task": "..." }
// PUT    /task/1     ---> update task             { "is_completed": 1 }
// DELETE /task/1     ---> delete task

switch ($requestMethod) {
    case 'GET':
        $controller->index();
        break;

    case 'POST':
        $controller->addTask();
        break;

    case 'PUT':
        $id = isset($request[1]) ? $request[1] : null;
        $controller->updateTask($id);
        break;

    case 'DELETE':
        $id = isset($request[1]) ? $request[1] : null;
        $controller->deleteTask($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}