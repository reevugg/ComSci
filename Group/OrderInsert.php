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
$fullName = "Fuck My Life";
$phone = "1234567890";
$email = "FML@example.com";
$address = "123 Street";
$zip = "12345";
$city = "CAT";
$state = "Morecats";
$product = "Cacti2";

// Create the SQL query to insert values
$sql = "INSERT INTO View_order (`Full name`, `Phone`, `Email`, `Address`, `ZIP`, `City`, `State`, `Product`)
        VALUES ('$fullName', '$phone', '$email', '$address', '$zip', '$city', '$state', '$product')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully into 'View_order' table";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
