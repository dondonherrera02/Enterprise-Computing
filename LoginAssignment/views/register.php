<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Register</h2>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="error">Registration failed. Email might already exist.</div>
            <?php endif; ?>

            <form action="../controllers/AuthController.php?action=register" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn">Register</button>
            </form>

            <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
