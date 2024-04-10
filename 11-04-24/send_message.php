<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ageziamontanelli"; 

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $message = $_POST['message'];

    $result = mysqli_query($conn, "INSERT INTO MESSAGGIO (dataM, contenuto, oggetto, admin_id) VALUES (NOW(), '$message', 'test', 1)");

    
    if ($result) {
        echo "Messaggio inviato con successo";
     } else {
        echo "Errore nell'invio del messaggio";
    }
}


$conn->close();
?>