<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['agencyId'])) {
    $agencyId = $_GET['agencyId'];

    $stmt = $conn->prepare("SELECT codiceVerifica FROM verificaAg WHERE id_agenzia = ? AND scadenza > NOW() AND verificato = 0 ORDER BY scadenza DESC LIMIT 1");
    $stmt->bind_param("i", $agencyId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['codiceVerifica'];
    } else {
        // Codice non disponibile o scaduto
        echo "Codice non disponibile o scaduto.";

        // Aggiungi qui la logica per eliminare la riga dalla tabella verificaAg quando il codice è scaduto
        $stmtRemoveVerification = $conn->prepare("DELETE FROM verificaAg WHERE id_agenzia = ?");
        $stmtRemoveVerification->bind_param("i", $agencyId);
        $stmtRemoveVerification->execute();
    }

    $stmt->close();
}

$conn->close();
?>