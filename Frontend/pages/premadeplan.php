<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Meal Plan</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../assets/css/premade.css">

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
    
    <section class="home-section">
    <h1>Weekly Meal Plan</h1>

    <div class="meal-card">
        <h2>Sunday</h2>
        <img src="../assets/images/sunday.jpg" alt="Sunday Meal">
        <p>Meal description goes here.</p>
    </div>

    <div class="meal-card">
        <h2>Monday</h2>
        <img src="../assets/images/monday.jpg" alt="Monday Meal">
        <p>Meal description goes here.</p>
    </div>

    <div class="meal-card">
        <h2>Tuesday</h2>
        <img src="../assets/images/tuesday.jpg" alt="Tuesday Meal">
        <p>Meal description goes here.</p>
    </div>

    <div class="meal-card">
        <h2>Wednesday</h2>
        <img src="../assets/images/wednesday.jpg" alt="Wednesday Meal">
        <p>Meal description goes here.</p>
    </div>

    <div class="meal-card">
        <h2>Thursday</h2>
        <img src="../assets/images/thursday.jpg" alt="Thursday Meal">
        <p>Meal description goes here.</p>
    </div>

    <div class="meal-card">
        <h2>Friday</h2>
        <img src="../assets/images/friday.jpg" alt="Friday Meal">
        <p>Meal description goes here.</p>
    </div>

    <div class="meal-card">
        <h2>Saturday</h2>
        <img src="../assets/images/saturday.jpeg" alt="Saturday Meal">
        <p>Meal description goes here.</p>
    </div>
    </section>


    <?php include '../attachedSections/footer.php'; ?>

    <!-- <script src="../assets/js/navbar.js"></script> -->
</body>
</html>