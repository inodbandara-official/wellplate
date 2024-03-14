<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header("location: login.php");
    exit();
}

$userEmail = $_SESSION['user_email'];
$sql = "SELECT * FROM `users` WHERE `Email`=?";
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
        Hi <?php echo $userName; ?>
    </section>

    <?php include '../attachedSections/footer.php'; ?>

    <script src="../assets/js/navbar.js"></script>
</body>
</html>
