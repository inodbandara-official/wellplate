<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM `users` WHERE `Username`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, check the password
        $row = $result->fetch_assoc();
        $storedPassword = $row['Password']; // Stored in plain text

        if ($password == $storedPassword) {
            // Password is correct
            // Perform additional actions, such as setting sessions, and redirecting the user
            $_SESSION['user_username'] = $username;
            header("location: ../pages/dashboard.php?username=$username");
            exit();
        } else {
            // Incorrect password, display an alert and redirect to login.php
            echo '<script> 
                alert("Login failed. Invalid password");
                window.location.href="login.php";
            </script>';
            exit();
        }
    } else {
        // User not found, display an alert and redirect to login.php
        echo '<script> 
            alert("Login failed. User not found");
            window.location.href="login.php";
        </script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="login.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember"> Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Sign up</a>
            </div>
        </form>
    </div>
</body>
</html>