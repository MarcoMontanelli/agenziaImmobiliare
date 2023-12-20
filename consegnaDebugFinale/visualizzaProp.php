<?php
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

// Retrieve the latest registered property owner (assuming you have an auto-incrementing ID)
$query = "SELECT * FROM PROPRIETARIO ORDER BY codiceFiscale DESC LIMIT 1";
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) {
    $owner = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>dettagli proprietario</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>dettagli proprietario</h2>
        <?php if (isset($owner)): ?>
            <p><strong>nome:</strong> <?php echo $owner['nome']; ?></p>
            <p><strong>telefono:</strong> <?php echo $owner['numeroTelefono']; ?></p>
            <p><strong>Email:</strong> <?php echo $owner['email']; ?></p>
            <p><strong>note particolari:</strong> <?php echo $owner['note']; ?></p>
        <?php else: ?>
            <p>nessuna proprietà trovata.</p>
        <?php endif; ?>
    </div>
</body>
</html>