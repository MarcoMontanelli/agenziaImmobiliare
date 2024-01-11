<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$database = "ageziamontanelli"; // Sostituisci con il tuo nome di database

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Riceve il messaggio dal frontend
    $message = $_POST['message'];

    $result = mysqli_query($conn, "INSERT INTO MESSAGGIO (dataM, contenuto, oggetto, admin_id) VALUES (NOW(), '$message', 'test', 1)");

    // Restituisce una risposta di successo al frontend
    if ($result) {
        echo "Messaggio inviato con successo";
     } else {
        echo "Errore nell'invio del messaggio";
    }
}

// Chiude la connessione al database
$conn->close();
?>