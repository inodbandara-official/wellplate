<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted

    // Retrieve form data
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $age = $_POST["age"];
    $mobileNumber = $_POST["mobile-number"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize data (you should implement more robust validation)
    $firstName = htmlspecialchars(trim($firstName));
    $lastName = htmlspecialchars(trim($lastName));
    $age = htmlspecialchars(trim($age));
    $mobileNumber = htmlspecialchars(trim($mobileNumber));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($password));

    // Perform additional validation and checks if needed

    // Insert user data into the database without hashing the password
    $sql = "INSERT INTO users (First_Name, Last_Name, Age, Mobile_Number, Email, Password) 
        VALUES ('$firstName', '$lastName', '$age', '$mobileNumber', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "SIGN IN SUCCESSFULLY!";
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
                <input type="text" id="name" name="first-name" placeholder="First Name" required>
                <i class='bx bxs-user'></i>
            </div>
        </div>
        <div class="form-group">
            <div class="input-box">
                <input type="text" id="name" name="last-name"  placeholder="Last Name" required>
                <i class='bx bxs-user'></i>
            </div>
        </div>

        <div class="form-group">
        <div class="input-box">
                <input type="number" id="age" name="age" placeholder="Age" required>
                <i class='bx bxs-smile'></i>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <input type="tel" id="mobile-number" name="mobile-number" placeholder="Mobile Number" required>
                <i class='bx bxs-phone'></i>
            </div>
        </div>
        
        <div class="form-group">
            <div class="input-box">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope' ></i>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" required>
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
