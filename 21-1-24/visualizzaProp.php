<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ageziamontanelli";

// Creare una connessione al database
$connection = mysqli_connect($host, $username, $password, $database);

// Controllare la connessione
if (!$connection) {
    die("Connessione fallita: " . mysqli_connect_error());
}

// Recuperare l'ultimo proprietario registrato (presumendo che tu abbia un ID auto-incrementante)
$query = "SELECT * FROM PROPRIETARIO ORDER BY codiceFiscale DESC LIMIT 1";
$result = mysqli_query($connection, $query);

// Verificare se la query è stata eseguita con successo
if ($result) {
    $owner = mysqli_fetch_assoc($result);
} else {
    echo "Errore: " . mysqli_error($connection);
}

// Chiudere la connessione al database
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

        .home-button {
            background-color: #8f00ff;
            color: #fff;
            text-decoration: none;
            padding: 8px;
            border-radius: 4px;
            text-align: center;
            margin-top: 16px;
            cursor: pointer;
            width: 100%; /* Imposta la larghezza al 100% */
            display: inline-block;
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

        <a href="debugPage.php" class="home-button">Torna alla Home</a>
    </div>
</body>
</html>