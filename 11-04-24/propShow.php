<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ageziamontanelli';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$codiceCatastale = $_GET['codiceCatastale'];
$sql = "SELECT * FROM `proprieta` WHERE codiceCatastale = '$codiceCatastale'";
$result = mysqli_query($conn, $sql);

if ($result) {
    
    if (mysqli_num_rows($result) > 0) {
        
        $property = mysqli_fetch_assoc($result);
    } else {
        
        $property = null;
    }
} else {
    
    echo "Error: " . mysqli_error($conn);
}

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

        .home-button {
            background-color: #8f00ff;
            color: #fff;
            text-decoration: none;
            padding: 8px;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($property) {
            echo "<h2>INFORMAZIONI PROPRIETA'</h2>";
            echo "<p><strong>Codice Catastale:</strong> " . $property['codiceCatastale'] . "</p>";
            echo "<p><strong>Dimensioni:</strong> " . $property['dimensioni'] . "</p>";
            echo "<p><strong>Note:</strong> " . $property['note'] . "</p>";
            echo "<p><strong>Indirizzo:</strong> " . $property['indirizzo'] . "</p>";
            echo "<p><strong>Comune:</strong> " . $property['comune'] . "</p>";
            echo "<p><strong>Prezzo:</strong> " . $property['prezzo'] . "</p>";
            echo "<p><strong>Descrizione:</strong> " . $property['descrizione'] . "</p>";
            echo "<p><strong>Tipo:</strong> " . $property['tipo'] . "</p>";

            
            echo '<a href="debugPage.php" class="home-button">Torna alla Home</a>';
        } else {
            echo "<p>Property not found!</p>";
        }
        ?>
    </div>
</body>
</html>