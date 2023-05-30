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
    <table>
        <tr>
            <th>
                <div>
                    ID
                    <form method="GET" action="">
                        <input type="hidden" name="sort" value="ID">
                        <select name="order" onchange="this.form.submit()">
                            <option value="asc" <?php if ($sort === 'ID' && $order === 'asc') echo 'selected'; ?>>Ascending</option>
                            <option value="desc" <?php if ($sort === 'ID' && $order === 'desc') echo 'selected'; ?>>Descending</option>
                        </select>
                    </form>
                </div>
            </th>
            <th>
                <div>
                    Full Name
                    <form method="GET" action="">
                        <input type="hidden" name="sort" value="Full name">
                        <select name="order" onchange="this.form.submit()">
                            <option value="asc" <?php if ($sort === 'Full name' && $order === 'asc') echo 'selected'; ?>>Ascending</option>
                            <option value="desc" <?php if ($sort === 'Full name' && $order === 'desc') echo 'selected'; ?>>Descending</option>
                        </select>
                    </form>
                </div>
            </th>
            <th>
                <div>
                    Phone
                    <form method="GET" action="">
                        <input type="hidden" name="sort" value="Phone">
                        <select name="order" onchange="this.form.submit()">
                            <option value="asc" <?php if ($sort === 'Phone' && $order === 'asc') echo 'selected'; ?>>Ascending</option>
                            <option value="desc" <?php if ($sort === 'Phone' && $order === 'desc') echo 'selected'; ?>>Descending</option>
                        </select>
                    </form>
                </div>
            </th>
            <th>
                <div>
                    Email
                    <form method="GET" action="">
                        <input type="hidden" name="sort" value="Email">
                        <select name="order" onchange="this.form.submit()">
                            <option value="asc" <?php if ($sort === 'Email' && $order === 'asc') echo 'selected'; ?>>Ascending</option>
                            <option value="desc" <?php if ($sort === 'Email' && $order === 'desc') echo 'selected'; ?>>Descending</option>
                        </select>
                    </form>
                </div>
            </th>
            <th>
                <div>
                    Address
                    <form method="GET" action="">
                        <input type="hidden" name="sort" value="Address">
                        <select name="order" onchange="this.form.submit()">
                            <option value="asc" <?php if ($sort === 'Address' && $order === 'asc') echo 'selected'; ?>>Ascending</option>
                            <option value="desc" <?php if ($sort === 'Address' && $order === 'desc') echo 'selected'; ?>>Descending</option>
                        </select>
                    </form>
                </div>
            </th>
            <th>
                <div>
                    Product
                    <form method="GET" action="">
                        <input type="hidden" name="sort" value="Product">
                        <select name="order" onchange="this.form.submit()">
                            <option value="asc" <?php if ($sort === 'Product' && $order === 'asc') echo 'selected'; ?>>Ascending</option>
                            <option value="desc" <?php if ($sort === 'Product' && $order === 'desc') echo 'selected'; ?>>Descending</option>
                        </select>
                    </form>
                </div>
            </th>
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
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found in 'View_order' table</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
