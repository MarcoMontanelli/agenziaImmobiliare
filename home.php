<?php
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    // Se l'utente non è autenticato, reindirizza alla pagina di login
    header("Location: login.php");
    exit();
}

// Prendi l'username dalla sessione
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .welcome-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome, <?php echo $username; ?>!</h2>
        <p>Your credentials:</p>
        <div>
            <strong>Username:</strong> <?php echo $username; ?><br>
        </div>
    </div>
</body>
</html>