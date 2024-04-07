<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_agenzia'])) {
    $agenzia_id = $_GET['remove_agenzia'];

    
    $sql_delete_verificaag = "DELETE FROM verificaag WHERE id_agenzia = ?";
    $stmt_delete_verificaag = $conn->prepare($sql_delete_verificaag);
    $stmt_delete_verificaag->bind_param("i", $agenzia_id);

    if ($stmt_delete_verificaag->execute()) {
        
        $sql_remove_agenzia = "DELETE FROM agenzia_immobiliare WHERE idAgenzia = ?";
        $stmt = $conn->prepare($sql_remove_agenzia);
        $stmt->bind_param("i", $agenzia_id);

        if ($stmt->execute()) {
            $sql_agenzie = "SELECT * FROM agenzia_immobiliare";
            $result_agenzie = $conn->query($sql_agenzie);

            if ($result_agenzie) {
                $rows = array();
                while ($row = $result_agenzie->fetch_assoc()) {
                    $rows[] = $row;
                }

                $response = array("success" => true, "message" => "Agenzia rimossa con successo.", 'data' => $rows);
            } else {
                $response = array("success" => false, "message" => "Errore nella query per ottenere i dati aggiornati: " . $conn->error);
            }
        } else {
            $response = array("success" => false, "message" => "Errore nella rimozione dell'agenzia: " . $stmt->error);
        }

        $stmt->close();
    } else {
        $response = array("success" => false, "message" => "Errore nella rimozione dei record correlati: " . $stmt_delete_verificaag->error);
    }

    $stmt_delete_verificaag->close();
} else {
    $sql_agenzie_initial = "SELECT * FROM agenzia_immobiliare";
    $result_agenzie_initial = $conn->query($sql_agenzie_initial);

    if ($result_agenzie_initial) {
        $rows = array();
        while ($row = $result_agenzie_initial->fetch_assoc()) {
            $rows[] = $row;
        }

        $response = array("success" => true, "message" => "Dati ottenuti con successo.", 'data' => $rows);
    } else {
        $response = array("success" => false, "message" => "Errore nella query iniziale: " . $conn->error);
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
