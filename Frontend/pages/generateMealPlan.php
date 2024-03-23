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

if (isset($_POST['submit2'])) {

    $bloodSugarLevel = $_POST['blood-sugar-level'];
    $currentDate = date("Y-m-d");

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO userdata (Email, Date, Blood_Sugar_Level) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $userEmail, $currentDate , $bloodSugarLevel, );
    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        echo '<script> 
        alert("Data Insert Successful!.");
        window.location.href="generateMealPlan.php";
    </script>';
    } else {
        echo '<script> 
            alert("Error Saving data.");
            window.location.href="generateMealPlan.php";
        </script>';
    }

}
?>

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

pre {
        background-color: #f8f8f8;
        padding: 10px;
        border-radius: 5px;
        font-family: 'Courier New', monospace;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

.meal-section {
    margin-bottom: 20px;
    }

.meal-section h2 {
    color: #555;
    margin-bottom: 10px;
}

.food-item {
    margin-left: 20px;
}

</style>
</head>
<body>
<?php include '../attachedSections/navbar.php'; ?>

<section class="home-section">
    <h1>Generate Meal Plan</h1>
    <div class="container-wrapper">
    <div class="container">
        <form id="input-form" method="POST" action="http://localhost:5000/get-recommendations">    
            <label for="blood-sugar-level">Blood Sugar Level:</label>
            <input type="number" id="blood-sugar-level" name="blood-sugar-level" required>
            <br>
            <label for="allergies">Allergies:</label>
            <input type="text" id="allergies" name="allergies">
            <br>
            <label>
                <input type="checkbox" id="is-vegetarian" name="is-vegetarian"> Vegetarian
            </label>
            <br>
            <label>
                <input type="checkbox" id="cheat-day" name="cheat-day"> Cheat Day
            </label>
            <br>
            <button type="submit" name="submit">Get Recommendations</button>
        </form>
    </div>
    <div class="container">
        <form id="input-form" method="POST">    
            <label for="blood-sugar-level">Blood Sugar Level:</label>
            <input type="number" id="blood-sugar-level" name="blood-sugar-level" required>
            <button type="submit" name="submit2">Save to History</button>
        </form>
    </div>
</div>
    <script>
    const recommendationsDiv = document.getElementById('recommendations');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);
        const response = await fetch('http://localhost:5000/get-recommendations', {
            method: 'POST',
            body: formData
        });

        const responseData = await response.text();
        recommendationsDiv.innerHTML = responseData;
    });
</script>
</div>

</section>

<?php include '../attachedSections/footer.php'; ?>

<script src="../assets/js/navbar.js"></script>
</body>
</html>