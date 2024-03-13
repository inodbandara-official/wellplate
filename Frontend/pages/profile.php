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
        // User found, retrieve the name
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
  <div class="sidebar">
    <div class="logo_details">
      <i class="bx xl-audible icon"></i>
      <div class="logo_name">WELL PLATE</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    
    <ul class="nav-list">
      <li>
        <a href="dashboard.php">
          <i class="bx bx-grid-alt"></i>
          <span class="link_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="generateMealPlan.php">
          <i class='bx bx-cog'></i>
          <span class="link_name">Generate Meal Plan</span>
        </a>
        <span class="tooltip">Generate Meal Plan</span>
      </li>
      <li>
        <a href="viewMealPlan.php">
          <i class="bx bx-folder"></i>
          <span class="link_name">View Meal Plan </span>
        </a>
        <span class="tooltip">View Meal Plan</span>
      </li>
      <li>
        <a href="tracker.html">
          <i class="bx bx-pie-chart-alt-2"></i>
          <span class="link_name">Progress Tracker</span>
        </a>
        <span class="tooltip">Progress Tracker</span>
      </li>
      <li>
        <a href="login.php">
          <i class="bx bx-log-out"></i>
          <span class="link_name">Log Out</span>
        </a>
        <span class="tooltip">Log Out</span>
      </li>
    
      <li class="profile">
        <div class="profile_details">
          <a href="profile.php">
          <img src="../assets/images/profile.jpg" alt="profile image">
          <div class="profile_content">
            <div class="name"><?php echo $userName; ?></div>
            <div class="designation">Admin</div>
          </div>
        </a>
        </div>
        
      </li>
    </ul>
  </div>

  <section class="home-section">
  <div class="profile-container">
        <img src="../assets/images/profile.jpg" alt="Profile Picture" class="profile-picture">
        <div class="user-info">
            <h1 class="username"><?php echo $userName; ?></h1>
            <p class="email">E-mail: <?php echo $userEmail; ?></p>
            <p class="age">Age: 2<?php echo $userAge; ?></p>
            <p class="Diet">Mobile Number: <?php echo $userMobileNumber; ?></p>
            <p class="status">Status: Active</p>
        </div>
    </div>
  </section>
 
  <script src="../assets/js/navbar.js"></script>
  
</body>
<footer class="footer">
  <div class="footer-content">
    <div class="footer-logo">
      <i class="bx xl-audible icon"></i>
      <div class="logo_name">WELL PLATE</div>
    </div>
    <div class="footer-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
      <a href="aboutus.html">About Us</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024 Well Plate. All rights reserved.</p>
  </div>
</footer>
</html>