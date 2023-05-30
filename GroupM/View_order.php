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

// Check if a row edit request is made
if (isset($_POST['edit_row_id'])) {
    $editId = $_POST['edit_row_id'];
    $fullName = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $updateSql = "UPDATE View_order SET `Full name` = '$fullName', `Phone` = '$phone', `Email` = '$email', `Address` = '$address' WHERE ID = $editId";
    if ($conn->query($updateSql) === TRUE) {
        // Edit saved successfully
    } else {
        echo "Error updating row: " . $conn->error;
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

        .editable {
            cursor: pointer;
        }

        .edit-btn,
        .save-btn,
        .cancel-btn,
        .delete-btn {
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .edit-btn {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }

        .save-btn {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
            display: none;
        }

        .cancel-btn {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
            display: none;
        }

        .delete-btn {
            color: #fff;
            background-color: #c9302c;
            border-color: #ac2925;
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
                        <td class='editable full-name'>" . $row["Full name"] . "</td>
                        <td class='editable phone'>" . $row["Phone"] . "</td>
                        <td class='editable email'>" . $row["Email"] . "</td>
                        <td class='editable address'>" . $address . "</td>
                        <td>" . $row["Product"] . "</td>
                        <td>";
                if (isset($_POST['edit_row_id']) && $_POST['edit_row_id'] == $row["ID"]) {
                    echo "<button class='save-btn'>Save</button>
                          <button class='cancel-btn'>Cancel</button>";
                } else {
                    echo "<button class='edit-btn'>Edit</button>
                          <a href='view_order.php?delete=" . $row["ID"] . "' class='delete-btn'>Delete</a>";
                }
                echo "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found in 'View_order' table</td></tr>";
        }
        ?>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("body").on("click", ".edit-btn", function() {
                var row = $(this).closest("tr");

                if (row.hasClass("editing")) {
                    return; // Don't proceed if already editing
                }

                row.addClass("editing");
                row.find(".edit-btn").hide();
                row.find(".save-btn, .cancel-btn").show();
                row.find(".editable").each(function() {
                    var input = $("<input type='text' class='edit-input'>");
                    input.val($(this).text());
                    $(this).html(input);
                });
            });

            $("body").on("click", ".cancel-btn", function() {
                var row = $(this).closest("tr");

                row.removeClass("editing");
                row.find(".save-btn, .cancel-btn").hide();
                row.find(".edit-btn").show();
                row.find(".editable").each(function() {
                    $(this).text($(this).find("input").val());
                });
            });

            $("body").on("click", ".save-btn", function() {
                var row = $(this).closest("tr");
                var editRowId = row.find("td:first-child").text();
                var fullName = row.find(".full-name input").val();
                var phone = row.find(".phone input").val();
                var email = row.find(".email input").val();
                var address = row.find(".address input").val();

                $.ajax({
                    url: "view_order.php",
                    type: "POST",
                    data: {
                        edit_row_id: editRowId,
                        full_name: fullName,
                        phone: phone,
                        email: email,
                        address: address
                    },
                    success: function() {
                        // Refresh the page after saving the edit
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
