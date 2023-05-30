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

// Retrieve the submitted username and password from the form
$user = $_POST["username"];
$pass = $_POST["password"];

// Prepare a SQL statement to retrieve the user from the adminLogin table
$sql = "SELECT * FROM adminLogin WHERE User = '$user' AND Password = '$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Successful login, redirect to a secure page
    header("Location: view_order.html");
} else {
    // Invalid login, display an error message
    echo "Invalid username or password";
}

// Close the connection
$conn->close();
?>
