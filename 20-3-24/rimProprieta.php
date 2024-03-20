<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ageziamontanelli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_GET['remove_proprieta'])) {
    $proprietà_id = $_GET['remove_proprieta'];

   
    $sql_remove_proprieta = "DELETE FROM proprieta WHERE codiceCatastale = ?";
    $stmt = $conn->prepare($sql_remove_proprieta);
    $stmt->bind_param("i", $proprietà_id);

    if ($stmt->execute()) {
        
        $sql_proprieta = "SELECT * FROM proprieta";
        $result_proprieta = $conn->query($sql_proprieta);

        
        $rows = array();
        while ($row = $result_proprieta->fetch_assoc()) {
            $rows[] = $row;
        }

        $response = array("success" => true, "message" => "Proprietà rimossa con successo.", 'data' => $rows);
    } else {
        $response = array("success" => false, "message" => "Errore nella rimozione della proprietà: " . $stmt->error);
    }

    $stmt->close();
} else {
    
    $sql_proprieta_initial = "SELECT * FROM proprieta";
    $result_proprieta_initial = $conn->query($sql_proprieta_initial);

    
    $rows = array();
    while ($row = $result_proprieta_initial->fetch_assoc()) {
        $rows[] = $row;
    }

    $response = array("success" => true, "message" => "Dati ottenuti con successo.", 'data' => $rows);
}


header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>