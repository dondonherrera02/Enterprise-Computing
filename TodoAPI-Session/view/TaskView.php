<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .message {
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .success {
            color: #10db50;
        }
        .error {
            color: #d12d2d;
        }
    </style>
</head>
<body>
    <h1> Task List </h1>
    
    <?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
        <div class="message <?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php endif; ?>
    
    <form method ="POST">
        <input type="text" name="task" placeholder="Enter your task">
        <button type="submit" name="add_task"> Add Task </button>
    </form>
    
    <?php if($tasks !== null): ?>
        <?php while($task = $tasks->fetch_assoc()): ?>
        <div>
            <p>
                <?php echo $task['task']; ?>
            </p>
            <?php if(!$task['is_completed']): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <button type="submit" name="complete_task"> Complete </button>
            </form>
            <?php else: ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <button type="submit" name="undo_complete_task"> Undo </button>
            </form>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <button type="submit" name="delete_task"> Delete </button>
            </form>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</body>
</html>