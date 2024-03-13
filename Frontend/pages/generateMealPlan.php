<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Well Plate</title>
<link rel="stylesheet" href="../assets/css/generateMealPlan.css">
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
                <div class="name">Inod Bandara</div>
                <div class="designation">Admin</div>
              </div>
            </a>
            </div>
            
          </li>
        </ul>
      </div>

<section class="home-section">
    <h1>Generate Meal Plan</h1>
<div class="container">
    <div class="input-group">
        <label for="bloodSugarLevel">Blood Sugar Level</label>
        <input type="number" id="bloodSugarLevel" placeholder="Enter Blood Sugar Level" name="bloodSugarLevel" min="0" required>
    </div>
    <div class="input-group">
        <label for="age">Age</label>
        <select id="age" name="age" required>
            <option value="">Select your age range</option>
            <option value="60+">60+</option>
            <option value="50-59">50-59</option>
            <option value="40-49">40-49</option>
            <option value="30-39">30-39</option>
            <option value="20-29">20-29</option>
            <option value="below 19">below 19</option>
        </select>
    </div>
    <div class="input-group checkbox-container">
        <label class="checkbox-label">
            <input type="checkbox" id="cheatMeal" name="cheatMeal">
            Add a cheat meal day.
        </label>
    </div>
    <button id="generateBtn" disabled>GENERATE</button>
    <span id="message" class="message"></span>
</div>

</section>

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

<script src="../assets/js/generateMealPlan.js"></script>
<script src="../assets/js/navbar.js"></script>
</body>
</html>