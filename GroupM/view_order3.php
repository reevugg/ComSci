<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GG";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ID';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

$validColumns = ['ID', 'Full name', 'Phone', 'Email', 'Address', 'Product'];
if (!in_array($sort, $validColumns)) {
    $sort = 'ID';
}

$validOrders = ['asc', 'desc'];
if (!in_array($order, $validOrders)) {
    $order = 'asc';
}

// Check if a row delete request is made
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $deleteSql = "DELETE FROM View_order WHERE ID = $deleteId";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Row deleted successfully.";
    } else {
        echo "Error deleting row: " . $conn->error;
    }
}

$sql = "SELECT * FROM View_order ORDER BY `$sort` $order";
$result = $conn->query($sql);
?>

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

        select {
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>View Order Table</h2>

    <form action="view_order.php" method="GET">
        <label for="sort">Sort By:</label>
        <select name="sort" id="sort">
            <option value="ID" <?php if ($sort === 'ID') echo 'selected'; ?>>ID</option>
            <option value="Full name" <?php if ($sort === 'Full name') echo 'selected'; ?>>Full Name</option>
            <option value="Phone" <?php if ($sort === 'Phone') echo 'selected'; ?>>Phone</option>
            <option value="Email" <?php if ($sort === 'Email') echo 'selected'; ?>>Email</option>
            <option value="Address" <?php if ($sort === 'Address') echo 'selected'; ?>>Address</option>
            <option value="Product" <?php if ($sort === 'Product') echo 'selected'; ?>>Product</option>
        </select>

        <label for="order">Order:</label>
        <select name="order" id="order">
            <option value="asc" <?php if ($order === 'asc') echo 'selected'; ?>>Ascending</option>
            <option value="desc" <?php if ($order === 'desc') echo 'selected'; ?>>Descending</option>
        </select>

        <input type="submit" value="Sort">
    </form>

    <br>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Product</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $address = $row["Address"] . ", " . $row["ZIP"] . ", " . $row["City"] . ", " . $row["State"];
                echo "<tr>
                        <td>" . $row["ID"] . "</td>
                        <td>" . $row["Full name"] . "</td>
                        <td>" . $row["Phone"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $address . "</td>
                        <td>" . $row["Product"] . "</td>
                        <td><a href='view_order.php?delete=" . $row["ID"] . "'>Delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found in 'View_order' table</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
