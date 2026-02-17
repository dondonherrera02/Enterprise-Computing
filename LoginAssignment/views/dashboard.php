<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/database.php';
require_once '../models/Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);
$stmt = $student->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
     <div class="header">
        <h2>Student Management System</h2>
        <div class="user-info">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <a href="../controllers/AuthController.php?action=logout" class="btn-logout">Logout</a>
        </div>
    </div>
    <?php if(isset($_GET['success'])): ?>
        <div class="success">
            <?php 
                if($_GET['success'] == 'created') echo 'Student created successfully!';
                if($_GET['success'] == 'deleted') echo 'Student deleted successfully!';
            ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['error'])): ?>
        <div class="error">Operation failed. Please try again.</div>
    <?php endif; ?>

     <div class="dashboard-container">
            
            <!-- Add Student Form -->
            <div class="form-box">
                <h3>Add New Student</h3>
                <form action="../controllers/StudentController.php?action=create" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Student ID</label>
                            <input type="text" name="student_id" required>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>

                    <button type="submit" class="btn">Add Student</button>
                </form>
            </div>

            <!-- Students List -->
            <div class="students-list">
                <h3>All Students</h3>
                <?php if($stmt->rowCount() > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <a href="../controllers/StudentController.php?action=delete&id=<?php echo $row['id']; ?>" 
                                        class="btn-delete" 
                                        onclick="return confirm('Are you sure you want to delete this student?');">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="no-data">No students found. Add your first student above!</p>
                <?php endif; ?>
            </div>
        </div>
</body>
</html>
