<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Login</h2>
            
            <?php if(isset($_GET['success'])): ?>
                <div class="success">Registration successful! Please login.</div>
            <?php endif; ?>

            <?php if(isset($_GET['error'])): ?>
                <div class="error">Invalid email or password.</div>
            <?php endif; ?>

            <form action="../controllers/AuthController.php?action=login" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <p class="text-center">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
