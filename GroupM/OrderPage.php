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

// Retrieve the submitted form data
$fullname = $_POST["fullname"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$address = $_POST["address"];
$zip = $_POST["zip"];
$city = $_POST["city"];
$state = $_POST["state"];
$product = $_POST["product"];

// Prepare and execute the SQL statement to insert the data into the View_order table
$sql = "INSERT INTO View_order (`Full name`, Phone, Email, Address, ZIP, City, State, Product) 
        VALUES ('$fullname', '$phone', '$email', '$address', '$zip', '$city', '$state', '$product')";

if ($conn->query($sql) === TRUE) {
    echo "Order inserted successfully";
} else {
    echo "Error inserting order: " . $conn->error;
}

// Close the connection
$conn->close();
?>
