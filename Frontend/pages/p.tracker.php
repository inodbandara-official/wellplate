<!DOCTYPE html>
<html>
<head>
    <title>Read Data</title>
</head>
<body>
    <h1>Data from Database</h1>
    <?php
    // Connect to your database
    $servername = "localhost";
    $username = "username";     // chanege to your username
    $password = "password";     // change to your password
    $dbname = "your_database";  // change to your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data
    $sql = "SELECT * FROM your_table";  // change to your table name
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>      <th>ID</th>     <th>Name</th>       <th>Email</th>      </tr>";          //change to your column names
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td></tr>";  //change to your column names asscocited with your table
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>
</html>