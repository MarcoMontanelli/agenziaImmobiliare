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

// Seleziona l'ultima verificaAg per l'agenzia specificata
$stmt = $conn->prepare("SELECT * FROM verificaAg WHERE id_agenzia = ? AND verificato = 0 ORDER BY scadenza DESC LIMIT 1");
$stmt->bind_param("i", $agencyId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifica la scadenza del codice
    if ($row['scadenza'] > date('Y-m-d H:i:s')) {
        echo 'valido'; // Codice valido
    } else {
        // Codice scaduto
        echo 'scaduto';

        // Aggiungi qui la logica per eliminare la riga dalla tabella agenzia_immobiliare quando il codice è scaduto
        $stmtRemove = $conn->prepare("DELETE FROM agenzia_immobiliare WHERE idAgenzia = ?");
        $stmtRemove->bind_param("i", $agencyId);
        $stmtRemove->execute();

        // Rimuovi l'entry dalla tabella verificaAg
        $stmtRemoveVerification = $conn->prepare("DELETE FROM verificaAg WHERE id_agenzia = ?");
        $stmtRemoveVerification->bind_param("i", $agencyId);
        $stmtRemoveVerification->execute();
    }
} else {
    echo 'non_trovato'; // Nessun record trovato per l'agenzia specificata
}

// Chiudi le connessioni
$stmt->close();
$conn->close();
?>
