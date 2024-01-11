<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
 
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }

        .header h1 {
            margin: 0;
        }

        .search-form {
            text-align: center;
            margin: 20px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-form input[type="submit"] {
            background-color: #8f00ff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form input[type="submit"]:hover {
            background-color: #6a0099;
        }

        .property {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Homepage agenzia</h1>
    </div>

    <div class="search-form">
        <form method="POST" action="">
            <input type="text" name="size" placeholder="Enter property size">
            <input type="text" name="characteristics" placeholder="Enter property characteristics">
            <input type="submit" name="search" value="Search">
        </form>
    </div>

    <div class="container">
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "ageziamontanelli";

        $connection = mysqli_connect($host, $username, $password, $database);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['search'])) {
            $size = $_POST['size'];
            $characteristics = $_POST['characteristics'];

            $query = "SELECT * FROM property WHERE size = '$size' OR characteristics LIKE '%$characteristics%'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="property">';
                echo '<h2>' . $row['title'] . '</h2>';
                echo '<p>Size: ' . $row['size'] . '</p>';
                echo '<p>Characteristics: ' . $row['characteristics'] . '</p>';
                echo '</div>';
            }
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>

</html>