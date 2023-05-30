<!DOCTYPE html>
<html>
<head>
    <title>View Order Table</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th><a href="view_order.php?sort=ID">ID</a></th>
            <th><a href="view_order.php?sort=Full name">Full Name</a></th>
            <th><a href="view_order.php?sort=Phone">Phone</a></th>
            <th><a href="view_order.php?sort=Email">Email</a></th>
            <th><a href="view_order.php?sort=Address">Address</a></th>
            <th><a href="view_order.php?sort=Product">Product</a></th>
        </tr>

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

        // Check if the 'sort' query parameter is set
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

        // Define the SQL query to select all records from the View_order table with optional sorting
        $sql = "SELECT * FROM View_order";

        // Apply sorting if specified
        if ($sort) {
            $sql .= " ORDER BY $sort";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $address = $row["Address"] . ", " . $row["ZIP"] . ", " . $row["City"] . ", " . $row["State"];
                echo "<tr>
                        <td>" . $row["ID"] . "</td>
                        <td>" . $row["Full name"] . "</td>
                        <td>" . $row["Phone"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $address . "</td>
                        <td>" . $row["Product"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found in 'View_order' table</td></tr>";
        }

        // Close the connection
        $conn->close();
        ?>
    </table>
</body>
</html>
