<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_proprietario'])) {
    $proprietario_cf = $_GET['remove_proprietario'];

    
    $sql_remove_proprietario = "DELETE FROM PROPRIETARIO WHERE codiceFiscale = ?";
    $stmt = $conn->prepare($sql_remove_proprietario);
    $stmt->bind_param("s", $proprietario_cf);

    if ($stmt->execute()) {
        
        $sql_proprietari = "SELECT * FROM PROPRIETARIO";
        $result_proprietari = $conn->query($sql_proprietari);

        
        $rows = array();
        while ($row = $result_proprietari->fetch_assoc()) {
            $rows[] = $row;
        }

        $response = array("success" => true, "message" => "Proprietario rimosso con successo.", 'data' => $rows);
    } else {
        $response = array("success" => false, "message" => "Errore nella rimozione del proprietario: " . $stmt->error);
    }

    $stmt->close();
} else {
    
    $sql_proprietari_initial = "SELECT * FROM PROPRIETARIO";
    $result_proprietari_initial = $conn->query($sql_proprietari_initial);

    
    $rows = array();
    while ($row = $result_proprietari_initial->fetch_assoc()) {
        $rows[] = $row;
    }

    $response = array("success" => true, "message" => "Dati ottenuti con successo.", 'data' => $rows);
}


header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
