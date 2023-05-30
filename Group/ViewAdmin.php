<?php
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "GG";  // Replace with your desired database name

// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all records from the adminLogin table
$sql = "SELECT * FROM adminLogin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start creating the HTML table
    echo "<table>";
    echo "<tr><th>ID</th><th>User</th><th>Password</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["User"] . "</td><td>" . $row["Password"] . "</td></tr>";
    }

    // Close the HTML table
    echo "</table>";
} else {
    echo "No records found in 'adminLogin' table";
}

// Close the connection
$conn->close();
?>
