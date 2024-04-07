<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET['email'];
    $token = $_GET['token'];


    $currentTime = time();
    $stmtVerify = $conn->prepare("SELECT * FROM email_confirmation WHERE email = ? AND token = ? AND expiry_time > ?");
    $stmtVerify->bind_param("ssi", $email, $token, $currentTime);
    $stmtVerify->execute();
    $result = $stmtVerify->get_result();
    
    if ($result->num_rows > 0) {
        
        $stmtActivate = $conn->prepare("UPDATE agenzia_immobiliare SET account_attivo = 1 WHERE email = ?");
        $stmtActivate->bind_param("s", $email);
        $stmtActivate->execute();
        
        echo "Account confermato con successo!";
    } else {
        echo "Token non valido o scaduto.";
    }

    
    $stmtDeleteToken = $conn->prepare("DELETE FROM email_confirmation WHERE email = ?");
    $stmtDeleteToken->bind_param("s", $email);
    $stmtDeleteToken->execute();

    $stmtVerify->close();
    $stmtActivate->close();
    $stmtDeleteToken->close();
}


$conn->close();
?>