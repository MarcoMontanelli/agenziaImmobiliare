<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrazione Admin</title>
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
    transition: background-color 0.3s ease; 
}

input[type="submit"]:hover {
    background-color: #6a0099; 
}

.button-container {
    text-align: center; /* Centra il contenuto all'interno del container */
    margin-top: 16px; /* Aggiunto margine sopra il bottone */
}

.button-container button {
    background-color: #8f00ff;
    color: #fff;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    padding: 8px;
    margin: 0 auto; /* Centra il bottone orizzontalmente */
}

.button-container button:hover {
    background-color: #6a0099;
}
    </style>
</head>
<body>
    <div class="container">
        <form action="registerA.php" method="post">
            <h2>Registrazione Admin</h2>
            
            <label for="nome">Nome Admin:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="locazione">Locazione:</label>
            <input type="text" id="locazione" name="locazione" required>

            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required>

            <input type="submit" value="Registrati">
        </form>
        <p>sei già registrato? <a href="login.php">accedi</a></p>
        <div class="button-container">
            <button onclick="location.href='debugPage.php'">torna alla home</button>
        </div>
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
    $locazione = $_POST['locazione'];
    $tipo = $_POST['tipo'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO ADMIN (nome, località, tipo, email, pass) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $locazione, $tipo, $email, $password);

    
    if ($stmt->execute()) {
        echo "Registrazione admin avvenuta con successo!";
    } else {
        echo "Errore durante la registrazione admin: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();
?>