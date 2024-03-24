<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate form data
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mobileNumber = htmlspecialchars($_POST['mobile_number']);
    $newPassword = htmlspecialchars($_POST['new_password']);
    $confirmPassword = htmlspecialchars($_POST['confirm_password']);

    // Check for valid email format
    if (!$email) {
        echo '<script> 
            alert("Invalid email format");
            window.location.href="forgotpw.php";
        </script>';
        exit();
    }

    // Check if new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        echo '<script> 
            alert("New password and confirm password do not match");
            window.location.href="forgotpw.php";
        </script>';
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $selectSql = "SELECT * FROM `users` WHERE `Email`=?";
    $stmtSelect = $conn->prepare($selectSql);
    $stmtSelect->bind_param("s", $email);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();

    if ($result->num_rows > 0) {
        // User found, check the Mobile Number
        $row = $result->fetch_assoc();
        $storedMobileNumber = $row['Mobile_Number']; // Stored in plain text

        if ($mobileNumber == $storedMobileNumber) {
            // Mobile Number is correct, update the password
            $updateSql = "UPDATE `users` SET `Password`=? WHERE `Email`=?";
            $stmtUpdate = $conn->prepare($updateSql);
            $stmtUpdate->bind_param("ss", $newPassword, $email);
            $stmtUpdate->execute();

            echo '<script> 
                alert("Password updated successfully");
                window.location.href="login.php";
            </script>';
            exit();
        } else {
            // Incorrect mobile number, display an alert and redirect to forgotpw.php
            echo '<script> 
                alert("Invalid Mobile Number");
                window.location.href="forgotpw.php";
            </script>';
            exit();
        }
    } else {
        // User not found, display an alert and redirect to forgotpw.php
        echo '<script> 
            alert("User not found");
            window.location.href="forgotpw.php";
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="forgotpw.php" method="post">
            <h1>Password Recovery</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" name="mobile_number" placeholder="Mobile Number" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="input-box">
                <input type="password" name="new_password" placeholder="New Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

            <button type="submit" class="btn">Change Password</button>

            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </form>
    </div>
</body>
</html>
