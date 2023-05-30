<!DOCTYPE html>
<html>
<head>
    <title>Navigation Bar</title>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="OrderPage.html">Order Page</a></li>
        <li><a href="adminlogin.html">Admin login</a></li>
    </ul>

    <?php
        // Your PHP code here
        require 'connect.php';
        require 'DatabaseC.php';
		require 'AdminInsert.php';
    ?>
</body>
</html>
