<?php
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "GG";  // Replace with the name of the database to drop

// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to drop the database
$sql = "DROP DATABASE $dbname";

if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' dropped successfully";
} else {
    echo "Error dropping database: " . $conn->error;
}

// Close the connection
$conn->close();
?>
