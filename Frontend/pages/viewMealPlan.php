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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View meal plan</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/viewmeal.css">
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
    
    <form action="/action_page.php">

    <div class="all">

        <h1>View Meal Plan</h1>

        <p>
        <div class="dropdown">
            <button class="sixletter">Sunday</button>
            <div class="content">
                <a href="#">S</a>
                <a href="#">U</a>
                <a href="#">N</a>
            </div>
        </div>
        </p>

        <p>
        <div class="dropdown">
            <button class="sixletter">Monday</button>
            <div class="content">
                <a href="#">M</a>
                <a href="#">0</a>
                <a href="#">N</a>
            </div>
        </div>
        </p>

        <p>
            <div class="dropdown">
                <button class="eightletter">Tuesday</button>
                <div class="content">
                    <a href="#">T</a>
                    <a href="#">U</a>
                    <a href="#">E</a>
                </div>
            </div>
        </p>

        <p>
            <div class="dropdown">
                <button class="wednesday">Wednesday</button>
                <div class="content">
                    <a href="#">W</a>
                    <a href="#">E</a>
                    <a href="#">D</a>
                </div>
            </div>
        </p>

        <p>
            <div class="dropdown">
                <button class="thursday">Thursday</button>
                <div class="content">
                    <a href="#">T</a>
                    <a href="#">H</a>
                    <a href="#">U</a>
                </div>
            </div>
        </p>

        <p>
            <div class="dropdown">
                <button class="friday">Friday</button>
                <div class="content">
                    <a href="#">F</a>
                    <a href="#">R</a>
                    <a href="#">I</a>
                </div>
            </div>
        </p>

        <p>
            <div class="dropdown">
                <button class="saturday">Saturday</button>
                <div class="content">
                    <a href="#">S</a>
                    <a href="#">A</a>
                    <a href="#">T</a>
                </div>
            </div>
        </p>

    </div>

    </form>
</section>
    <script src="../assets/js/viewmeal.js"></script>
    <script src="../assets/js/navbar.js"></script>
<script>
  window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".bx-search")

    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    searchBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
        }
    }
}
</script>

<?php include '../attachedSections/footer.php'; ?>

</body>
</html>