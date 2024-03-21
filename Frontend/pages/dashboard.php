<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}

$userEmail = $_SESSION['user_email'];
$sql = "SELECT * FROM users WHERE Email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $row['First_Name'] . ' ' . $row['Last_Name'];
} else {
    header("location: login.php");
    exit();
    }

$userEmail = $_SESSION['user_email'];

// SQL query to fetch the highest and latest recorded blood sugar levels for the current user
$sql = "SELECT MAX(Blood_Sugar_Level) AS highest_level, MAX(Date) AS latest_date FROM userdata WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $highestLevel = $row['highest_level'];
    $latestDate = $row['latest_date'];
    
}    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Meal Plan</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/navbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../assets/css/generateMealPlan.css">
    <link rel="stylesheet" href="../assets/css/Dashboard.css">
    <link rel="stylesheet" href="../assets/css/navbadr.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/mealPlan.css">
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
            text-align: center;
        }
    </style>
    
</head>
<body>

    <?php include '../attachedSections/navbar.php'; ?>

    <section class="home-section">
        <div class="content">
            <div class="card illustration">
                <div class="card-body">
                <h4>Welcome Back,<br> <?php echo $userName; ?></h4>
                </div>
            </div>       
            <div class="card">
                <div class="card-body">
                    <h4>Blood Sugar Levels</h4>
                    <p>Highest Recorded : <span style="color: #fff;"><?php echo $highestLevel; ?></span> </p>
                    <p>Latest Recorded :</p>                   
                </div>
            </div>
        </div>
        <?php

include 'connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current user's email from the session
$userEmail = $_SESSION['user_email'];

// SQL query to fetch data for the current user
$sql = "SELECT Date, Blood_Sugar_Level FROM userdata WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Start the table with Bootstrap classes for styling
    echo '<table class="table table-striped table-bordered table-hover">';
    echo "<thead class='thead-dark'>    <tr>  <th>Date</th>   <th>Blood Sugar Level</th>      </tr></thead>";
    echo "<tbody>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>".   "<td>".$row["Date"]."</td>".   "<td>".$row["Blood_Sugar_Level"]."</td>".   "</tr>";
    } 
    echo "</tbody></table>";
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();
?>
    </section>


    <?php include '../attachedSections/footer.php'; ?>

    <script src="../assets/js/navbar.js"></script>
</body>
</html>