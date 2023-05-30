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

// Select all records from the View_order table
$sql = "SELECT * FROM View_order";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start creating the HTML table
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>ZIP</th>
            <th>City</th>
            <th>State</th>
            <th>Product</th>
          </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["Full name"] . "</td>
                <td>" . $row["Phone"] . "</td>
                <td>" . $row["Email"] . "</td>
                <td>" . $row["Address"] . "</td>
                <td>" . $row["ZIP"] . "</td>
                <td>" . $row["City"] . "</td>
                <td>" . $row["State"] . "</td>
                <td>" . $row["Product"] . "</td>
              </tr>";
    }

    // Close the HTML table
    echo "</table>";
} else {
    echo "No records found in 'View_order' table";
}

// Close the connection
$conn->close();
?>
