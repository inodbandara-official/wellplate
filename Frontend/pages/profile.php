<?php
include 'connect.php';

// Assume you have started the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {
    $userEmail = $_SESSION['user_email'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM users WHERE Email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, retrieve details
        $row = $result->fetch_assoc();
        $userName = $row['First_Name'] . ' ' . $row['Last_Name'];
        $userEmail = $row['Email'];
        $userAge = $row['Age'];
        $userMobileNumber = $row['Mobile_Number'];

    }
} else {
    // Redirect to login if the user is not logged in
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Profile</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/profile.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/navbar.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
  
    body {
        margin: 0;
        padding: 0;
        background-image: url('../assets/images/background.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .home-section {
        margin: 0;
        padding: 0;
        background: transparent;
        backdrop-filter: blur(20px);
        background-color: rgba(255, 255, 255, 0.01);
    }
    </style>
</head>
<body>
<?php include '../attachedSections/navbar.php'; ?>

  <section class="home-section">
  <div class="profile-container">
        <img src="../assets/images/profile.jpg" alt="Profile Picture" class="profile-picture">
        <div class="user-info">
            <h1 class="username"><?php echo $userName; ?></h1>
            <p class="email">E-mail: <?php echo $userEmail; ?></p>
            <p class="age">Age: <?php echo $userAge; ?></p>
            <p class="Diet">Mobile Number: <?php echo $userMobileNumber; ?></p>
            <p class="status">Status: Active</p>
        </div>
    </div>
  </section>
 
  <script src="../assets/js/navbar.js"></script>
  
</body>
<?php include '../attachedSections/footer.php'; ?>
</html>