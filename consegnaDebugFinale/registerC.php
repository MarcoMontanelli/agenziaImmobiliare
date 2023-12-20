<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrazione Cliente</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
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

input {
    padding: 8px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #8f00ff; 
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #6a0099; 
}
    </style>
</head>
<body>
    <div class="container">
        <form action="registerC.php" method="post">
            <h2>Registrazione Cliente</h2>
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="ragioneSociale">Ragione Sociale:</label>
            <input type="text" id="ragioneSociale" name="ragioneSociale">

            <label for="numeroTelefono">Numero di Telefono:</label>
            <input type="text" id="numeroTelefono" name="numeroTelefono" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required>

            <input type="submit" value="Registrati">
        </form>
    </div>
</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['nome'];
    $ragioneSociale = $_POST['ragioneSociale'];
    $numeroTelefono = $_POST['numeroTelefono'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

   
    $stmt = $conn->prepare("INSERT INTO cliente (nome, ragioneSociale, numeroTelefono, email, pass) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $ragioneSociale, $numeroTelefono, $email, $password);

   
    if ($stmt->execute()) {
        echo "Registrazione cliente avvenuta con successo!";
    } else {
        echo "Errore durante la registrazione cliente: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();
?>