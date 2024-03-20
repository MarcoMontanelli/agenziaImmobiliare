<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_cliente'])) {
    $cliente_id = $_GET['remove_cliente'];

    
    $sql_remove_cliente = "DELETE FROM cliente WHERE idCliente = ?";
    $stmt = $conn->prepare($sql_remove_cliente);
    $stmt->bind_param("i", $cliente_id);

    if ($stmt->execute()) {
        $sql_clienti = "SELECT * FROM cliente";
        $result_clienti = $conn->query($sql_clienti);

        if ($result_clienti) {
            $rows = array();
            while ($row = $result_clienti->fetch_assoc()) {
                $rows[] = $row;
            }

            $response = array("success" => true, "message" => "Cliente rimosso con successo.", 'data' => $rows);
        } else {
            $response = array("success" => false, "message" => "Errore nella query per ottenere i dati aggiornati: " . $conn->error);
        }
    } else {
        $response = array("success" => false, "message" => "Errore nella rimozione del cliente: " . $stmt->error);
    }

    $stmt->close();
} else {
    $sql_clienti_initial = "SELECT * FROM cliente";
    $result_clienti_initial = $conn->query($sql_clienti_initial);

    if ($result_clienti_initial) {
        $rows = array();
        while ($row = $result_clienti_initial->fetch_assoc()) {
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
