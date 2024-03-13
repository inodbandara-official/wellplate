<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/home.css">
    <title>Well Plate</title>

    <style>
html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
}

section {
    flex: 1;
}

.footer {
  background-color: #004f83;
  color: #fff;
  padding: 20px;
  text-align: center;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.footer-logo {
  display: flex;
  align-items: center;
}

.footer-logo i {
  font-size: 24px;
  margin-right: 5px;
}

.footer-links a {
  text-decoration: none;
  color: var(--color-white);
  margin-right: 15px;
  font-size: 14px;
}

.footer-bottom {
  margin-top: 15px;
}

.footer-bottom p {
  font-size: 12px;
}
    </style>
</head>
<section>
<body background="./assets/images/back.jpg">

    <header>
        <div class="logo">
            <img src="./assets/images/testlogo.jpg" alt="Logo">
        </div>
        <h1>WELL PLATE</h1>
        <div class="Access">
            <button><a href="#">Emergency Contact</a></button>
            <button class="Access-btn1"><a href="./pages/login.php">Log In</a></button>
            <button class="Access-btn2"><a href="./pages/signup.php">Sign Up</a></button>
        </div>
    </header>
    
    <div class="info">
        <h2>Plan your meals</h2>
        <h2>Plan your health</h2>
        <p>Empowering your well-being through personalized nutrion Choices.</p>
        <p>Personalized recommendation and a roadmap to a brighter future all within</p>
        <p>reach at you fingertips.</p>
    </div>

<button class="start" type="button" onclick="location.href='./pages/premadeplan.html'">Premade Meal Plans</button>

</section>
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
      <a href="./pages/aboutus.html">Contact Us</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2024 Well Plate. All rights reserved.</p>
  </div>
</footer>
</html>