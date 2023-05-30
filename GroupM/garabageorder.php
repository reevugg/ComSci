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

// Array of random values for each column
$fullNames = ["John Doe", "Jane Smith", "Michael Johnson", "Emily Davis", "Christopher Wilson"];
$phones = ["1234567890", "9876543210", "5551234567", "9998887777", "1112223333"];
$emails = ["john@example.com", "jane@example.com", "michael@example.com", "emily@example.com", "chris@example.com"];
$addresses = ["123 Street", "456 Avenue", "789 Road", "321 Boulevard", "654 Lane"];
$zips = ["12345", "67890", "54321", "98765", "23456"];
$cities = ["New York", "Los Angeles", "Chicago", "Houston", "Phoenix"];
$states = ["New York", "California", "Illinois", "Texas", "Arizona"];
$products = ["Product A", "Product B", "Product C", "Product D", "Product E"];

// Generate 100 random data inputs and insert them into the table
for ($i = 0; $i < 100; $i++) {
    // Get random values for each column
    $fullName = $fullNames[array_rand($fullNames)];
    $phone = $phones[array_rand($phones)];
    $email = $emails[array_rand($emails)];
    $address = $addresses[array_rand($addresses)];
    $zip = $zips[array_rand($zips)];
    $city = $cities[array_rand($cities)];
    $state = $states[array_rand($states)];
    $product = $products[array_rand($products)];

    // Create the SQL query to insert values
    $sql = "INSERT INTO View_order (`Full name`, `Phone`, `Email`, `Address`, `ZIP`, `City`, `State`, `Product`)
            VALUES ('$fullName', '$phone', '$email', '$address', '$zip', '$city', '$state', '$product')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully into 'View_order' table<br>";
    } else {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
}

// Close the connection
$conn->close();
?>
