<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .completed{text-decoration: line-through; color: grey;}
    </style>
</head>
<body>
    <h1>Task List</h1>
    <?php if(isset($_SESSION["message"])): ?>
        <p><?php echo $_SESSION["message"]; ?></p>
    <?php endif; ?>


    <form method="POST">
        <input type="text" name="task" placeholder="Enter task">
        <button type="submit" name = "add_task">Add Task</button>
    </form>
    <?php while($task = $tasks->fetch_assoc()): ?>
        <div>
            <p class="<?php echo $task["is_completed"]? "completed":""; ?>">
                <?php echo $task['task']; ?>
            </p>

            <?php if(!$task['is_completed']): ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit"name="complete_task">Complete</button>
                </form>
            <?php else: ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit"name="undo_complete_task">Undo</button>
                </form>
            <?php endif; ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit"name="delete_task">Delete</button>
                </form>

            <form action=""></form>
        </div>
    
    <?php endwhile; ?>
    
</body>
</html>