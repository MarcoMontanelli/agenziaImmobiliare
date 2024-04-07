<?php
$agencyId = $_GET['agencyId'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT * FROM verificaAg WHERE id_agenzia = ? AND verificato = 0 ORDER BY scadenza DESC LIMIT 1");
$stmt->bind_param("i", $agencyId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

 
    if ($row['scadenza'] > date('Y-m-d H:i:s')) {
        echo 'valido'; 
    } else {
        
        echo 'scaduto';

        
        $stmtRemove = $conn->prepare("DELETE FROM agenzia_immobiliare WHERE idAgenzia = ?");
        $stmtRemove->bind_param("i", $agencyId);
        $stmtRemove->execute();

        
        $stmtRemoveVerification = $conn->prepare("DELETE FROM verificaAg WHERE id_agenzia = ?");
        $stmtRemoveVerification->bind_param("i", $agencyId);
        $stmtRemoveVerification->execute();
    }
} else {
    echo 'non_trovato'; 
}

// Chiudi le connessioni
$stmt->close();
$conn->close();
?>
