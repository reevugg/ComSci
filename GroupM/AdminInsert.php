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

// Prepare the values to be inserted
$user = "Reevu";
$password = "foxesarered";

// Create the SQL query to insert values
$sql = "INSERT INTO adminLogin (User, Password) VALUES ('$user', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Values inserted successfully into 'adminLogin' table";
} else {
    echo "Error inserting values: " . $conn->error;
}

// Close the connection
$conn->close();
?>
