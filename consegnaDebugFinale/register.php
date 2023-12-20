<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrazione Agenzia Immobiliare</title>
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
        <form action="register.php" method="post">
            <h2>Registrazione Agenzia Immobiliare</h2>
            
            <label for="nome">Nome Agenzia:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="partitaIva">Partita IVA:</label>
            <input type="text" id="partitaIva" name="partitaIva">

            <label for="indirizzo">Indirizzo:</label>
            <input type="text" id="indirizzo" name="indirizzo">

            <label for="numeroTelefono">Numero di Telefono:</label>
            <input type="text" id="numeroTelefono" name="numeroTelefono" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="nomeProprietario">Nome Proprietario:</label>
            <input type="text" id="nomeProprietario" name="nomeProprietario">

            <label for="localita">Località:</label>
            <input type="text" id="localita" name="localita">

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required>

            <input type="submit" value="Registrati">
        </form>
    </div>
</body>
</html>
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
    $partitaIva = $_POST['partitaIva'];
    $indirizzo = $_POST['indirizzo'];
    $numeroTelefono = $_POST['numeroTelefono'];
    $email = $_POST['email'];
    $nomeProprietario = $_POST['nomeProprietario'];
    $localita = $_POST['località'] ?? $_POST['localita']; 
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO agenzia_immobiliare (nome, partitaIva, indirizzo, numeroTelefono, email, nomeProprietario, località, pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nome, $partitaIva, $indirizzo, $numeroTelefono, $email, $nomeProprietario, $localita, $password);


    if ($stmt->execute()) {
        echo "Registrazione avvenuta con successo!";
    } else {
        echo "Errore durante la registrazione: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();
?>