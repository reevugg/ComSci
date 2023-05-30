<?php
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$dbname = "GG";  // Replace with your desired database name

// Create a connection to the MySQL server
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create the adminLogin table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS adminLogin (
    ID INT(11) PRIMARY KEY AUTO_INCREMENT,
    User VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'adminLogin' created successfully or already exists<br>";
} else {
    echo "Error creating table 'adminLogin': " . $conn->error;
}

// Create the View_order table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS View_order (
    ID INT(11) PRIMARY KEY AUTO_INCREMENT,
    `Full name` VARCHAR(255) NOT NULL,
	Phone VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Address VARCHAR(255) NOT NULL,
    ZIP VARCHAR(10) NOT NULL,
    City VARCHAR(255) NOT NULL,
    State VARCHAR(255) NOT NULL,
    Product VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'View_order' created successfully or already exists";
} else {
    echo "Error creating table 'View_order': " . $conn->error;
}

// Close the connection
$conn->close();
?>
