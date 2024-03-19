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
<?php include '../attachedSections/navbar.php'; ?>

<section class="home-section">
    <h1>Generate Meal Plan</h1>
<div class="container">
    <div class="input-group">
        <label for="bloodSugarLevel">Blood Sugar Level</label>
        <input type="number" id="bloodSugarLevel" placeholder="Enter Blood Sugar Level" name="bloodSugarLevel" min="0" required>
    </div>
    <div class="input-group">
      <label for="age">Primary Diet</label>
      <select id="age" name="age" required>
          <option value="Vegetarian">Vegetarian</option>
          <option value="Vegan">Vegan</option>
      </select>
  </div>

    <div class="input-box">
      <label for="allergies">Allergies</label>
      <input type="text" id="allergies" placeholder="Enter the allergies you have" required/>
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
<p style="font-size: 0px;">    o </p> <!--Tempory fix for a part not getting blureed -->
</section>

<?php include '../attachedSections/footer.php'; ?>

<script src="../assets/js/generateMealPlan.js"></script>
<script src="../assets/js/navbar.js"></script>
</body>
</html>