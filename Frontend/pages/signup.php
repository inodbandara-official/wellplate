<?php
include 'connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted

    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $allergies = $_POST["allergies"];
    $primaryDiet = $_POST["primary-diet"];

    // Validate and sanitize data (you should implement more robust validation)
    $username = htmlspecialchars(trim($username));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($password));
    $confirmPassword = htmlspecialchars(trim($confirmPassword));
    $allergies = htmlspecialchars(trim($allergies));
    $primaryDiet = htmlspecialchars(trim($primaryDiet));

    // Perform additional validation and checks if needed

    // Check if passwords match
    if ($password != $confirmPassword) {
        die("Error: Passwords do not match");
    }

    // Insert user data into the database without hashing the password
    $sql = "INSERT INTO users (Username, Email, Password, Allergies, Diet) 
        VALUES ('$username', '$email', '$password', '$allergies', '$primaryDiet')";

    if ($conn->query($sql) === TRUE) {
        echo "SIGN IN SUCCESFULLY!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/signup.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="signup-container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="post">
    <div class="form-group">
            <div class="input-box">
                <input type="text" id="name" placeholder="First Name" required>
                <i class='bx bxs-user'></i>
            </div>
        </div>
        <div class="form-group">
            <div class="input-box">
                <input type="text" id="name" placeholder="Last Name" required>
                <i class='bx bxs-user'></i>
            </div>
        </div>

        <div class="form-group">
        <div class="input-box">
                <input type="number" id="age" placeholder="Age" required>
                <i class='bx bxs-smile'></i>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <input type="tel" id="mobile-number" placeholder="Mobile Number" required>
                <i class='bx bxs-phone'></i>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-box">
                <input type="email" id="email" placeholder="Email" required>
                <i class='bx bxs-envelope' ></i>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <input type="password" id="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
        </div>
        <div class="form-group">
            <button type="submit">Sign Up</button>
        </div>

        <div class="register-link">
            <p>Already have an account? <a href="login.php">Login</a>
        </div>
    </form>
</div>

</body>
</html>
