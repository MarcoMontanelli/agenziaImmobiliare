<?php
// Replace with your actual database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ageziamontanelli';

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve property details from the database
// Adjust the SQL query based on your database structure
$codiceCatastale = $_GET['codiceCatastale'];
$sql = "SELECT * FROM `proprieta` WHERE codiceCatastale = '$codiceCatastale'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Check if the property exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch property details
        $property = mysqli_fetch_assoc($result);
    } else {
        // Property not found
        $property = null;
    }
} else {
    // Query failed
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Display property details
        if ($property) {
            echo "<h2>Property Details</h2>";
            echo "<p><strong>Codice Catastale:</strong> " . $property['codiceCatastale'] . "</p>";
            echo "<p><strong>Dimensioni:</strong> " . $property['dimensioni'] . "</p>";
            echo "<p><strong>Note:</strong> " . $property['note'] . "</p>";
            echo "<p><strong>Indirizzo:</strong> " . $property['indirizzo'] . "</p>";
            echo "<p><strong>Comune:</strong> " . $property['comune'] . "</p>";
            echo "<p><strong>Prezzo:</strong> " . $property['prezzo'] . "</p>";
            echo "<p><strong>Descrizione:</strong> " . $property['descrizione'] . "</p>";
            echo "<p><strong>Tipo:</strong> " . $property['tipo'] . "</p>";
        } else {
            echo "<p>Property not found!</p>";
        }
        ?>
    </div>
</body>
</html>