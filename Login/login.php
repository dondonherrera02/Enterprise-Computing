<?php
include "partials/header.php";
include "partials/navigation.php";

    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // echo $username;
        // echo $password;
    
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        // print_r($result);

        if(mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);
            // print_r($user);
            if(password_verify($password, $user['password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                redirect("dashboard.php");
            } else {
                $error =  "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
            }
        }

?>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <div>
                <label for="username">Username:</label>
                <input id = "username" placeholder="Enter your username" type="text" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input id = "password" placeholder="Enter your password" type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>


<?php include "partials/footer.php"; ?>

<?php mysqli_close($conn); ?>
