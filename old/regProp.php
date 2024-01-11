<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registra un proprietario</title>
    <style>         
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input, textarea {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Property Owner Registration</h2>
        <form action="regProp.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="note">Special Notes:</label>
            <textarea id="note" name="note"></textarea>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>

<?php
// Replace these variables with your database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "ageziamontanelli";

// Create a connection to the database
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $phone = mysqli_real_escape_string($connection, $_POST["phone"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $note = mysqli_real_escape_string($connection, $_POST["note"]);

    // Insert data into the database (adjust the SQL query based on your database structure)
    $query = "INSERT INTO PROPRIETARIO (nome, numeroTelefono, email, note) 
              VALUES ('$name', '$phone', '$email', '$note')";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        // Get the ID of the last inserted owner
        $lastOwnerId = mysqli_insert_id($connection);

        // Redirect to the display_owner.php page with the owner ID as a parameter
        header("Location: mostraProprietario.php?owner_id=$lastOwnerId");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>