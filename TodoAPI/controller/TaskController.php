<?php
include "model/Task.php";
include "config/Database.php";

class TaskController {
    private $taskModel;

    public function __construct() {
        header("Content-Type: application/json");

        $database = new Database();
        $db = $database->connect();
        $this->taskModel = new Task($db);
    }

    public function index() {
        $tasks = $this->taskModel->read();

        if ($tasks->num_rows == 0) {
            echo json_encode(["message" => "No tasks found"]);
        } else {
            $data = $tasks->fetch_all(MYSQLI_ASSOC);
            echo json_encode($data);
        }
    }

    public function addTask() {
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        if (!isset($data['task']) || empty(trim($data['task']))) {
            http_response_code(400);
            echo json_encode(["message" => "Task field is required"]);
            return;
        }

        $this->taskModel->task = $data['task'];
        $result = $this->taskModel->create();

        if ($result) {
            http_response_code(201);
            echo json_encode(["task" => $data["task"]]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Task not added"]);
        }
    }

    public function updateTask($id) {
        if (!isset($id) || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid or missing task ID"]);
            return;
        }

        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        if (!isset($data['is_completed'])) {
            http_response_code(400);
            echo json_encode(["message" => "is_completed field is required"]);
            return;
        }

        $this->taskModel->id = (int) $id;
        $result = $this->taskModel->update((int) $data['is_completed']);

        if ($result) {
            echo json_encode(["id" => (int) $id, "is_completed" => (int) $data["is_completed"]]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Task not updated"]);
        }
    }

    public function deleteTask($id) {
        if (!isset($id) || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid or missing task ID"]);
            return;
        }

        $this->taskModel->id = (int) $id;
        $result = $this->taskModel->delete();

        if ($result) {
            echo json_encode(["message" => "Task deleted", "id" => (int) $id]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Task not deleted", "id" => (int) $id]);
        }
    }
}